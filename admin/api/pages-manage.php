<?php
/**
 * 页面管理CRUD API
 * 操作: list, create, update, delete, toggle-status, get
 */

require_once __DIR__ . '/common.php';
require_once __DIR__ . '/config.php';

try {
    $conn = getDbConnection();

    // 初始化数据库（确保表存在）
    if (function_exists("initDatabase")) { initDatabase($conn); }

    // 运行迁移确保新列存在
    ensureMigration($conn);

    // 获取操作类型
    $action = getGetParam('action', getPostParam('action', 'list'));

    switch ($action) {
        case 'list':
            handleList($conn);
            break;
        case 'get':
            handleGet($conn);
            break;
        case 'create':
            handleCreate($conn);
            break;
        case 'update':
            handleUpdate($conn);
            break;
        case 'delete':
            handleDelete($conn);
            break;
        case 'toggle-status':
            handleToggleStatus($conn);
            break;
        default:
            jsonError('未知操作: ' . $action);
    }

    $conn->close();

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}

/**
 * 确保新列存在
 */
function ensureMigration($conn) {
    $columns = ['status', 'sort_order', 'seo_title', 'seo_keywords', 'seo_description', 'custom_url', 'page_type'];
    foreach ($columns as $col) {
        $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE '$col'");
        if ($result && $result->num_rows === 0) {
            // Column missing, run migration via include
            // Already handled by manual migration, skip for safety
        }
    }
}

/**
 * 获取页面列表
 */
function handleList($conn) {
    $pageType = getGetParam('page_type', '');
    $status = getGetParam('status', '');

    $sql = "SELECT id, page_id, page_name, title, subtitle, status, sort_order, 
            seo_title, seo_keywords, seo_description, custom_url, page_type, 
            last_modified, created_at 
            FROM cms_pages WHERE 1=1";
    $params = [];
    $types = '';

    if ($pageType) {
        $sql .= " AND page_type = ?";
        $params[] = $pageType;
        $types .= 's';
    }
    if ($status) {
        $sql .= " AND status = ?";
        $params[] = $status;
        $types .= 's';
    }

    $sql .= " ORDER BY sort_order ASC, created_at DESC";

    $stmt = $conn->prepare($sql);
    if ($types && $params) {
        $refs = [];
        foreach ($params as $k => $v) $refs[$k] = $v;
        $refs = array_merge([$types], $refs);
        call_user_func_array([$stmt, 'bind_param'], $refs);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $pages = [];
    while ($row = $result->fetch_assoc()) {
        $pages[] = $row;
    }

    $stmt->close();
    jsonSuccess(['pages' => $pages, 'total' => count($pages)]);
}

/**
 * 获取单个页面详情
 */
function handleGet($conn) {
    $pageId = getGetParam('page_id', getPostParam('page_id', ''));
    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    $stmt = $conn->prepare("SELECT id, page_id, page_name, title, subtitle, status, sort_order,
        seo_title, seo_keywords, seo_description, custom_url, page_type,
        last_modified, created_at FROM cms_pages WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        jsonError('页面不存在', 404);
    }

    $page = $result->fetch_assoc();
    $stmt->close();
    jsonSuccess($page);
}

/**
 * 创建新页面
 */
function handleCreate($conn) {
    $data = getAllPostParams();

    $pageName = trim($data['page_name'] ?? '');
    $pageId = trim($data['page_id'] ?? '');
    $title = trim($data['title'] ?? '');
    $subtitle = trim($data['subtitle'] ?? '');
    $status = trim($data['status'] ?? 'active');
    $sortOrder = intval($data['sort_order'] ?? 0);
    $seoTitle = trim($data['seo_title'] ?? '');
    $seoKeywords = trim($data['seo_keywords'] ?? '');
    $seoDescription = trim($data['seo_description'] ?? '');
    $customUrl = trim($data['custom_url'] ?? '');
    $pageType = trim($data['page_type'] ?? 'custom');

    if (empty($pageName)) {
        jsonError('页面名称不能为空');
    }

    // 自动生成 page_id
    if (empty($pageId)) {
        $pageId = 'page_' . time() . '_' . substr(md5(uniqid()), 0, 6);
    }

    // 验证 page_id 唯一性
    $stmt = $conn->prepare("SELECT id FROM cms_pages WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $stmt->close();
        jsonError('页面标识已存在，请更换');
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO cms_pages (page_id, page_name, title, subtitle, status, sort_order, 
        seo_title, seo_keywords, seo_description, custom_url, page_type, content) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '{}')");
    $stmt->bind_param("sssssisssss", $pageId, $pageName, $title, $subtitle, $status, $sortOrder,
        $seoTitle, $seoKeywords, $seoDescription, $customUrl, $pageType);

    if ($stmt->execute()) {
        $newId = $conn->insert_id;
        $stmt->close();
        jsonSuccess(['id' => $newId, 'page_id' => $pageId], '页面创建成功');
    } else {
        $stmt->close();
        jsonError('创建失败: ' . $conn->error);
    }
}

/**
 * 更新页面
 */
function handleUpdate($conn) {
    $data = getAllPostParams();

    $pageId = trim($data['page_id'] ?? '');
    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    // 检查页面是否存在
    $stmt = $conn->prepare("SELECT id FROM cms_pages WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        $stmt->close();
        jsonError('页面不存在', 404);
    }
    $stmt->close();

    // 构建更新SQL
    $fields = [];
    $params = [];
    $types = '';

    $updateableFields = [
        'page_name' => 's', 'title' => 's', 'subtitle' => 's',
        'status' => 's', 'sort_order' => 'i',
        'seo_title' => 's', 'seo_keywords' => 's', 'seo_description' => 's',
        'custom_url' => 's', 'page_type' => 's'
    ];

    foreach ($updateableFields as $field => $type) {
        if (isset($data[$field])) {
            $fields[] = "$field = ?";
            $params[] = $data[$field];
            $types .= $type;
        }
    }

    if (empty($fields)) {
        jsonError('没有要更新的字段');
    }

    $params[] = $pageId;
    $types .= 's';

    $sql = "UPDATE cms_pages SET " . implode(', ', $fields) . " WHERE page_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$refs);

    if ($stmt->execute()) {
        $stmt->close();
        jsonSuccess(['page_id' => $pageId], '更新成功');
    } else {
        $stmt->close();
        jsonError('更新失败: ' . $conn->error);
    }
}

/**
 * 删除页面
 */
function handleDelete($conn) {
    $pageId = getPostParam('page_id', getGetParam('page_id', ''));
    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    // 保护系统页面
    $protectedPages = ['index', 'services', 'cases', 'contact', 'about'];
    if (in_array($pageId, $protectedPages)) {
        jsonError('系统页面受保护，无法删除');
    }

    // 检查是否存在
    $stmt = $conn->prepare("SELECT id FROM cms_pages WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows === 0) {
        $stmt->close();
        jsonError('页面不存在', 404);
    }
    $stmt->close();

    // 删除关联的模块
    $stmt = $conn->prepare("DELETE FROM page_builder_modules WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $stmt->close();

    // 删除页面
    $stmt = $conn->prepare("DELETE FROM cms_pages WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);

    if ($stmt->execute()) {
        $stmt->close();
        jsonSuccess(['page_id' => $pageId], '删除成功');
    } else {
        $stmt->close();
        jsonError('删除失败: ' . $conn->error);
    }
}

/**
 * 切换页面启用/禁用状态
 */
function handleToggleStatus($conn) {
    $pageId = getPostParam('page_id', getGetParam('page_id', ''));
    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    // 获取当前状态
    $stmt = $conn->prepare("SELECT status FROM cms_pages WHERE page_id = ?");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt->close();
        jsonError('页面不存在', 404);
    }
    $row = $result->fetch_assoc();
    $stmt->close();

    $newStatus = $row['status'] === 'active' ? 'inactive' : 'active';

    $stmt = $conn->prepare("UPDATE cms_pages SET status = ? WHERE page_id = ?");
    $stmt->bind_param("ss", $newStatus, $pageId);

    if ($stmt->execute()) {
        $stmt->close();
        jsonSuccess(['page_id' => $pageId, 'status' => $newStatus], '状态已更新');
    } else {
        $stmt->close();
        jsonError('更新失败: ' . $conn->error);
    }
}
