<?php
/**
 * CMS页面列表API
 * 获取所有页面列表
 */

// 引入数据库配置
require_once __DIR__ . '/config.php';

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 只允许GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 获取数据库连接
$conn = getDbConnection();

// 初始化数据库
if (function_exists("initDatabase")) { initDatabase($conn); }

// 查询所有页面
$result = $conn->query("SELECT page_id, page_name, title, subtitle, last_modified FROM cms_pages ORDER BY last_modified DESC");

$pages = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $pages[] = [
            'pageId' => $row['page_id'],
            'pageName' => $row['page_name'],
            'title' => $row['title'],
            'subtitle' => $row['subtitle'],
            'lastModified' => $row['last_modified']
        ];
    }
}

$conn->close();

echo json_encode([
    'success' => true,
    'data' => [
        'pages' => $pages,
        'total' => count($pages)
    ]
]);
