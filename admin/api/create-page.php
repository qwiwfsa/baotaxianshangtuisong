<?php
/**
 * CMS新建页面API
 * 创建新页面并保存到数据库
 */

// 引入数据库配置
require_once __DIR__ . '/config.php';

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 只允许POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 获取POST数据
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的JSON数据']);
    exit;
}

// 验证必需字段
if (empty($data['pageId'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少页面ID']);
    exit;
}

if (empty($data['pageName'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少页面名称']);
    exit;
}

// 清理和验证页面ID
$pageId = preg_replace('/[^a-zA-Z0-9_-]/', '', $data['pageId']);
if (strlen($pageId) < 1 || strlen($pageId) > 50) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '页面ID长度必须在1-50个字符之间']);
    exit;
}

$pageName = htmlspecialchars(trim($data['pageName']), ENT_QUOTES, 'UTF-8');
$url = isset($data['url']) ? trim($data['url']) : $pageId . '.html';
$template = isset($data['template']) ? $data['template'] : 'default';
$title = isset($data['title']) ? htmlspecialchars(trim($data['title']), ENT_QUOTES, 'UTF-8') : $pageName;
$description = isset($data['description']) ? htmlspecialchars(trim($data['description']), ENT_QUOTES, 'UTF-8') : '';

// 确保URL以.html结尾
if (!str_ends_with($url, '.html')) {
    $url .= '.html';
}

// 获取数据库连接
$conn = getDbConnection();

// 初始化数据库（确保表存在）
if (function_exists("initDatabase")) { initDatabase($conn); }

// 检查页面ID是否已存在
$checkStmt = $conn->prepare("SELECT id FROM cms_pages WHERE page_id = ?");
$checkStmt->bind_param("s", $pageId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $checkStmt->close();
    $conn->close();
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => '页面ID已存在']);
    exit;
}
$checkStmt->close();

// 准备默认内容结构
$defaultContent = [
    'page' => $pageId,
    'pageName' => $pageName,
    'title' => $title,
    'subtitle' => '',
    'description' => $description,
    'url' => $url,
    'template' => $template,
    'sections' => [
        [
            'id' => 'header',
            'type' => 'header',
            'title' => $pageName,
            'content' => ''
        ]
    ],
    'elements' => [],
    'lastModified' => date('Y-m-d H:i:s'),
    'createdAt' => date('Y-m-d H:i:s')
];

$contentJson = json_encode($defaultContent, JSON_UNESCAPED_UNICODE);

// 插入新页面
$insertStmt = $conn->prepare("INSERT INTO cms_pages (page_id, page_name, title, subtitle, content) VALUES (?, ?, ?, ?, ?)");
$subtitle = '';
$insertStmt->bind_param("sssss", $pageId, $pageName, $title, $subtitle, $contentJson);
$result = $insertStmt->execute();
$insertStmt->close();
$conn->close();

if (!$result) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '创建页面失败']);
    exit;
}

// 更新cms/content.json
updatePagesIndex($pageId, $pageName, $url, $title, $description);

echo json_encode([
    'success' => true,
    'message' => '页面创建成功',
    'data' => [
        'pageId' => $pageId,
        'pageName' => $pageName,
        'url' => $url,
        'template' => $template,
        'createdAt' => date('Y-m-d H:i:s')
    ]
]);

/**
 * 更新页面索引文件
 */
function updatePagesIndex($pageId, $pageName, $url, $title, $description) {
    $contentFile = __DIR__ . '/../../cms/content.json';
    $content = [];
    
    if (file_exists($contentFile)) {
        $json = file_get_contents($contentFile);
        $content = json_decode($json, true);
    }
    
    if (!isset($content['pages'])) {
        $content['pages'] = [];
    }
    
    $content['pages'][$pageId] = [
        'title' => $title,
        'description' => $description,
        'url' => $url
    ];
    
    $content['version'] = isset($content['version']) ? $content['version'] : '1.0';
    $content['lastUpdated'] = date('c');
    
    file_put_contents($contentFile, json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
