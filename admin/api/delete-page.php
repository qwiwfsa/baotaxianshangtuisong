<?php
/**
 * CMS删除页面API
 * 支持从MySQL数据库和JSON文件两种存储方式删除页面
 */

// 引入数据库配置
require_once __DIR__ . '/config.php';

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 允许POST和DELETE请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 获取请求数据
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
} else {
    $data = $_POST;
}

// 验证必需字段
$pageId = isset($data['pageId']) ? $data['pageId'] : (isset($_GET['pageId']) ? $_GET['pageId'] : '');

if (empty($pageId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少页面ID']);
    exit;
}

// 清理页面ID
$pageId = preg_replace('/[^a-zA-Z0-9_-]/', '', $pageId);

// 页面名称映射表
$pageNameMap = [
    'index' => '首页',
    'services' => '业务范围',
    'cases' => '成功案例',
    'case-detail' => '案例详情',
    'advantages' => '服务优势',
    'news' => '行业资讯',
    'faq' => '常见问题',
    'contact' => '联系我们',
    'privacy' => '隐私政策',
    'compliance' => '合规声明',
    'sitemap' => '网站地图'
];

// 保护关键页面不被删除
$protectedPages = ['index', 'services', 'cases', 'contact', 'about'];
if (in_array($pageId, $protectedPages)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => '该页面受保护，无法删除']);
    exit;
}

$deletedFromDb = false;
$pageName = isset($pageNameMap[$pageId]) ? $pageNameMap[$pageId] : $pageId;

// ===== 尝试从MySQL数据库删除 =====
try {
    $conn = getDbConnection();

    // 检查页面是否存在
    $checkStmt = $conn->prepare("SELECT id, page_name FROM cms_pages WHERE page_id = ?");
    $checkStmt->bind_param("s", $pageId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $pageInfo = $checkResult->fetch_assoc();
        $pageName = $pageInfo['page_name'];
        $checkStmt->close();

        // 删除页面
        $deleteStmt = $conn->prepare("DELETE FROM cms_pages WHERE page_id = ?");
        $deleteStmt->bind_param("s", $pageId);
        $result = $deleteStmt->execute();
        $deleteStmt->close();
        if ($result) {
            $deletedFromDb = true;
        }
    } else {
        $checkStmt->close();
    }

    $conn->close();
} catch (Exception $e) {
    // 数据库不可用，继续使用文件方式删除
}

// ===== 从JSON数据文件中删除 =====
$jsonFile = __DIR__ . '/../data/' . $pageId . '.json';
if (file_exists($jsonFile)) {
    unlink($jsonFile);
}

// ===== 从cms/content.json中移除 =====
removeFromPagesIndex($pageId);

// ===== 从localStorage标记清除（通过删除对应的JSON文件通知前端） =====
if (!empty($pageId)) {
    // 如果有对应的HTML文件，可以选择保留或删除
    // 目前仅删除JSON数据文件，HTML文件保留（重置为默认内容）
}

if (!$deletedFromDb) {
    // 虽然没有MySQL记录，但JSON文件删除成功也算成功
    echo json_encode([
        'success' => true,
        'message' => '页面数据已清除',
        'data' => [
            'pageId' => $pageId,
            'pageName' => $pageName,
            'deletedAt' => date('Y-m-d H:i:s'),
            'note' => '从JSON文件存储中删除'
        ]
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => '页面删除成功',
    'data' => [
        'pageId' => $pageId,
        'pageName' => $pageName,
        'deletedAt' => date('Y-m-d H:i:s')
    ]
]);

/**
 * 从页面索引中移除
 */
function removeFromPagesIndex($pageId) {
    $contentFile = __DIR__ . '/../../cms/content.json';
    
    if (!file_exists($contentFile)) {
        return;
    }
    
    $json = file_get_contents($contentFile);
    $content = json_decode($json, true);
    
    if (isset($content['pages'][$pageId])) {
        unset($content['pages'][$pageId]);
        $content['lastUpdated'] = date('c');
        file_put_contents($contentFile, json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
