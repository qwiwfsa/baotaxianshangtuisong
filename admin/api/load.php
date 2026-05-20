<?php
/**
 * CMS数据加载API
 * 从MySQL数据库加载JSON数据
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

// 获取页面ID
$pageId = isset($_GET['page']) ? $_GET['page'] : '';

if (empty($pageId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少页面ID']);
    exit;
}

// 清理页面ID，防止目录遍历
$pageId = preg_replace('/[^a-zA-Z0-9_-]/', '', $pageId);

// 获取数据库连接
$conn = getDbConnection();

// 初始化数据库（确保表存在）
if (function_exists("initDatabase")) { initDatabase($conn); }

// 查询页面数据
$stmt = $conn->prepare("SELECT page_id, page_name, title, subtitle, content, last_modified FROM cms_pages WHERE page_id = ?");
$stmt->bind_param("s", $pageId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // 页面不存在，返回默认结构
    $defaultData = [
        'page' => $pageId,
        'pageName' => $pageId,
        'title' => '',
        'subtitle' => '',
        'sections' => [],
        'lastModified' => date('Y-m-d H:i:s')
    ];
    
    $stmt->close();
    $conn->close();
    
    echo json_encode([
        'success' => true,
        'page' => $pageId,
        'data' => $defaultData
    ]);
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();
$conn->close();

// 解析内容JSON
$content = json_decode($row['content'], true);
if (!$content) {
    $content = [
        'page' => $row['page_id'],
        'pageName' => $row['page_name'],
        'title' => $row['title'],
        'subtitle' => $row['subtitle'],
        'sections' => [],
        'lastModified' => $row['last_modified']
    ];
}

echo json_encode([
    'success' => true,
    'page' => $pageId,
    'data' => $content
]);
