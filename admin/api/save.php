<?php
/**
 * CMS数据保存API
 * 接收JSON数据并保存到MySQL数据库
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

// 记录接收到的原始数据到文件
$logFile = __DIR__ . '/../save-debug.log';
$logContent = "\n=== " . date('Y-m-d H:i:s') . " ===\n";
$logContent .= "原始JSON:\n" . $json . "\n\n";
$logContent .= "解析后数据:\n" . print_r($data, true) . "\n";
file_put_contents($logFile, $logContent, FILE_APPEND);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的JSON数据']);
    exit;
}

// 验证必需字段
if (empty($data['page'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少页面ID']);
    exit;
}

$pageId = preg_replace('/[^a-zA-Z0-9_-]/', '', $data['page']);
$pageName = isset($data['pageName']) ? $data['pageName'] : $pageId;
$title = isset($data['title']) ? $data['title'] : '';
$subtitle = isset($data['subtitle']) ? $data['subtitle'] : '';

// 获取数据库连接
$conn = getDbConnection();

// 初始化数据库（确保表存在）
initDatabase($conn);

// 检查页面是否已存在
$checkStmt = $conn->prepare("SELECT content FROM cms_pages WHERE page_id = ?");
$checkStmt->bind_param("s", $pageId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

// 如果页面已存在，合并新旧数据
if ($checkResult->num_rows > 0) {
    $row = $checkResult->fetch_assoc();
    $existingData = json_decode($row['content'], true);

    $logContent = "现有数据:\n" . print_r($existingData, true) . "\n";
    file_put_contents($logFile, $logContent, FILE_APPEND);

    // 合并数据：新数据覆盖旧数据，但保留旧数据中新数据没有的字段
    if (is_array($existingData)) {
        $data = array_merge($existingData, $data);
        $logContent = "合并后数据:\n" . print_r($data, true) . "\n";
        file_put_contents($logFile, $logContent, FILE_APPEND);
    }
}

// 准备内容JSON
$contentJson = json_encode($data, JSON_UNESCAPED_UNICODE);

if ($checkResult->num_rows > 0) {
    // 更新现有页面
    $updateStmt = $conn->prepare("UPDATE cms_pages SET page_name = ?, title = ?, subtitle = ?, content = ? WHERE page_id = ?");
    $updateStmt->bind_param("sssss", $pageName, $title, $subtitle, $contentJson, $pageId);
    $result = $updateStmt->execute();
    $updateStmt->close();
} else {
    // 插入新页面
    $insertStmt = $conn->prepare("INSERT INTO cms_pages (page_id, page_name, title, subtitle, content) VALUES (?, ?, ?, ?, ?)");
    $insertStmt->bind_param("sssss", $pageId, $pageName, $title, $subtitle, $contentJson);
    $result = $insertStmt->execute();
    $insertStmt->close();
}

$checkStmt->close();
$conn->close();

if (!$result) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '保存到数据库失败']);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => '保存成功',
    'page' => $pageId,
    'lastModified' => date('Y-m-d H:i:s')
]);
