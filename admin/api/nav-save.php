<?php
/**
 * 导航菜单/组件保存 API
 * POST JSON: 导航菜单/组件的CRUD操作
 * GET: 获取导航/组件数据
 */

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$conn = getDB();

// 初始化导航配置表
$conn->query("CREATE TABLE IF NOT EXISTS nav_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(20) NOT NULL COMMENT 'nav/component',
    item_id VARCHAR(50) NOT NULL COMMENT '项ID',
    name VARCHAR(100) NOT NULL COMMENT '名称',
    value TEXT COMMENT 'HTML内容(组件)/URL(导航)',
    icon VARCHAR(100) DEFAULT '' COMMENT '图标',
    item_type VARCHAR(50) DEFAULT '' COMMENT '组件类型',
    sort_order INT DEFAULT 0 COMMENT '排序',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='导航菜单与组件配置表';");

// ========== GET 处理 ==========
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    if ($type === 'nav') {
        $stmt = $conn->prepare("SELECT item_id AS id, name, value AS url, icon, sort_order FROM nav_settings WHERE type='nav' ORDER BY sort_order ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        echo json_encode(['code' => 0, 'data' => $items]);
        exit;
    }

    if ($type === 'component') {
        $stmt = $conn->prepare("SELECT item_id AS id, name, item_type AS type, icon, value AS html, sort_order FROM nav_settings WHERE type='component' ORDER BY sort_order ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        echo json_encode(['code' => 0, 'data' => $items]);
        exit;
    }

    echo json_encode(['code' => 1, 'msg' => '请指定type参数']);
    exit;
}

// ========== POST 处理 ==========
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['code' => 1, 'msg' => '仅支持GET和POST请求']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['code' => 1, 'msg' => '无效的JSON数据']);
    exit;
}

$action = $input['action'] ?? '';
$type = $input['type'] ?? '';

// --- 保存/更新导航项 ---
if ($action === 'save' && $type === 'nav') {
    $itemId = $input['item_id'] ?? '';
    $name = $input['name'] ?? '';
    $url = $input['url'] ?? '';
    $icon = $input['icon'] ?? '';

    if (!$itemId) {
        // 新增
        $itemId = time() . '_' . rand(100, 999);
        $stmt = $conn->prepare("INSERT INTO nav_settings (type, item_id, name, value, icon) VALUES ('nav', ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $itemId, $name, $url, $icon);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '添加成功', 'id' => $itemId]);
    } else {
        // 更新
        $stmt = $conn->prepare("UPDATE nav_settings SET name=?, value=?, icon=? WHERE type='nav' AND item_id=?");
        $stmt->bind_param("ssss", $name, $url, $icon, $itemId);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '更新成功']);
    }
    exit;
}

// --- 批量保存导航 ---
if ($action === 'save_all' && $type === 'nav') {
    $items = $input['items'] ?? [];
    
    // 先清空旧数据
    $conn->query("DELETE FROM nav_settings WHERE type='nav'");
    
    $sortOrder = 0;
    $stmt = $conn->prepare("INSERT INTO nav_settings (type, item_id, name, value, icon, sort_order) VALUES ('nav', ?, ?, ?, ?, ?)");
    foreach ($items as $item) {
        $itemId = $item['id'] ?? (time() . '_' . $sortOrder);
        $name = $item['name'] ?? '';
        $url = $item['url'] ?? '';
        $icon = $item['icon'] ?? '';
        $stmt->bind_param("ssssi", $itemId, $name, $url, $icon, $sortOrder);
        $stmt->execute();
        $sortOrder++;
    }
    $stmt->close();
    
    echo json_encode(['code' => 0, 'msg' => '保存成功']);
    exit;
}

// --- 删除导航项 ---
if ($action === 'delete' && $type === 'nav') {
    $itemId = $input['item_id'] ?? '';
    if (!$itemId) {
        echo json_encode(['code' => 1, 'msg' => '缺少item_id']);
        exit;
    }
    $stmt = $conn->prepare("DELETE FROM nav_settings WHERE type='nav' AND item_id=?");
    $stmt->bind_param("s", $itemId);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['code' => 0, 'msg' => '删除成功']);
    exit;
}

// --- 保存/更新组件 ---
if ($action === 'save' && $type === 'component') {
    $itemId = $input['item_id'] ?? '';
    $name = $input['name'] ?? '';
    $itemType = $input['item_type'] ?? 'basic';
    $icon = $input['icon'] ?? 'fas fa-cube';
    $html = $input['html'] ?? '';

    if (!$itemId) {
        // 新增
        $itemId = time() . '_' . rand(100, 999);
        $stmt = $conn->prepare("INSERT INTO nav_settings (type, item_id, name, item_type, icon, value) VALUES ('component', ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $itemId, $name, $itemType, $icon, $html);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '组件添加成功', 'id' => $itemId]);
    } else {
        // 更新
        $stmt = $conn->prepare("UPDATE nav_settings SET name=?, item_type=?, icon=?, value=? WHERE type='component' AND item_id=?");
        $stmt->bind_param("sssss", $name, $itemType, $icon, $html, $itemId);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '组件更新成功']);
    }
    exit;
}

// --- 批量保存组件 ---
if ($action === 'save_all' && $type === 'component') {
    $items = $input['items'] ?? [];
    
    // 先清空旧数据
    $conn->query("DELETE FROM nav_settings WHERE type='component'");
    
    $sortOrder = 0;
    $stmt = $conn->prepare("INSERT INTO nav_settings (type, item_id, name, item_type, icon, value, sort_order) VALUES ('component', ?, ?, ?, ?, ?, ?)");
    foreach ($items as $item) {
        $itemId = $item['id'] ?? (time() . '_' . $sortOrder);
        $name = $item['name'] ?? '';
        $itemType = $item['type'] ?? 'basic';
        $icon = $item['icon'] ?? 'fas fa-cube';
        $html = $item['html'] ?? '';
        $stmt->bind_param("sssssi", $itemId, $name, $itemType, $icon, $html, $sortOrder);
        $stmt->execute();
        $sortOrder++;
    }
    $stmt->close();
    
    echo json_encode(['code' => 0, 'msg' => '组件保存成功']);
    exit;
}

// --- 删除组件 ---
if ($action === 'delete' && $type === 'component') {
    $itemId = $input['item_id'] ?? '';
    if (!$itemId) {
        echo json_encode(['code' => 1, 'msg' => '缺少item_id']);
        exit;
    }
    $stmt = $conn->prepare("DELETE FROM nav_settings WHERE type='component' AND item_id=?");
    $stmt->bind_param("s", $itemId);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['code' => 0, 'msg' => '组件删除成功']);
    exit;
}

// --- 记录活动 ---
if ($action === 'save_activity' && $type === 'activity') {
    $activity = $input['activity'] ?? [];
    if (!empty($activity)) {
        // 保存到 nav_settings 表作为活动记录
        $desc = $activity['description'] ?? '';
        $actType = $activity['type'] ?? '';
        $time = $activity['time'] ?? date('Y-m-d H:i:s');
        if ($desc) {
            $itemId = 'activity_' . time();
            $stmt = $conn->prepare("INSERT INTO nav_settings (type, item_id, name, value) VALUES ('activity', ?, ?, ?)");
            $actName = $actType . ': ' . $desc;
            $stmt->bind_param("sss", $itemId, $actName, $time);
            $stmt->execute();
            $stmt->close();
        }
    }
    echo json_encode(['code' => 0, 'msg' => '活动已记录']);
    exit;
}

echo json_encode(['code' => 1, 'msg' => '未知操作']);
