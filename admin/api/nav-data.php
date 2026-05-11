<?php
/**
 * 导航菜单与组件数据获取 API
 * GET: 获取导航菜单或组件列表
 */

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$conn = getDB();

// 确保表存在
$conn->query("CREATE TABLE IF NOT EXISTS cms_nav_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    url VARCHAR(500) NOT NULL,
    icon VARCHAR(100) DEFAULT '',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

$conn->query("CREATE TABLE IF NOT EXISTS cms_components (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comp_id VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) DEFAULT 'basic',
    icon VARCHAR(100) DEFAULT '',
    html TEXT,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

$type = isset($_GET['type']) ? $_GET['type'] : 'nav';

// ========== GET for nav items ==========
if ($type === 'nav') {
    $result = $conn->query("SELECT item_id, name, url, icon, sort_order FROM cms_nav_items ORDER BY sort_order ASC");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'id' => $row['item_id'],
            'name' => $row['name'],
            'url' => $row['url'],
            'icon' => $row['icon']
        ];
    }
    echo json_encode(['code' => 0, 'data' => $items]);
    exit;
}

// ========== GET for components ==========
if ($type === 'component') {
    $result = $conn->query("SELECT comp_id, name, type, icon, html, sort_order FROM cms_components ORDER BY sort_order ASC");
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'id' => $row['comp_id'],
            'name' => $row['name'],
            'type' => $row['type'],
            'icon' => $row['icon'],
            'html' => $row['html']
        ];
    }
    echo json_encode(['code' => 0, 'data' => $items]);
    exit;
}

echo json_encode(['code' => 1, 'msg' => '未知类型']);
