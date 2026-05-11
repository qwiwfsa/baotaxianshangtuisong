<?php
/**
 * 文章保存API
 * 创建或更新文章
 */

// 启用错误报告（开发调试用，生产环境请关闭）
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/save_error.log');

// 记录请求日志
$logFile = __DIR__ . '/../logs/save_debug.log';
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

function writeLog($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

writeLog('=== 文章保存API被调用 ===');
writeLog('请求方法: ' . $_SERVER['REQUEST_METHOD']);
writeLog('请求URI: ' . $_SERVER['REQUEST_URI']);

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 获取POST数据
$rawData = file_get_contents('php://input');
writeLog('原始请求数据长度: ' . strlen($rawData));
writeLog('原始请求数据: ' . substr($rawData, 0, 1000));

$data = json_decode($rawData, true);

if (!$data) {
    $jsonError = json_last_error_msg();
    writeLog('JSON解析错误: ' . $jsonError);
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的请求数据: ' . $jsonError]);
    exit;
}

writeLog('解析后的数据: ' . json_encode($data, JSON_UNESCAPED_UNICODE));

// 验证必填字段
if (empty($data['title'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '文章标题不能为空']);
    exit;
}

$id = isset($data['id']) ? intval($data['id']) : 0;
$title = trim($data['title']);
$summary = isset($data['summary']) ? trim($data['summary']) : '';
$content = isset($data['content']) ? $data['content'] : '';
$categoryId = isset($data['category_id']) ? intval($data['category_id']) : 0;
$coverImage = isset($data['cover_image']) ? $data['cover_image'] : '';

// 归一化封面图片路径：废弃旧 news/ 路径，统一为 uploads/ 开头
if (!empty($coverImage)) {
    $coverImage = ltrim($coverImage, '/');
    if (strpos($coverImage, 'news/') === 0) {
        $coverImage = 'uploads/' . substr($coverImage, 5);
    }
}
$status = isset($data['status']) && in_array($data['status'], ['published', 'draft']) ? $data['status'] : 'draft';
$isTop = isset($data['is_top']) ? intval($data['is_top']) : 0;
$sortOrder = isset($data['sort_order']) ? intval($data['sort_order']) : 0;
$seoTitle = isset($data['seo_title']) ? trim($data['seo_title']) : '';
$seoKeywords = isset($data['seo_keywords']) ? trim($data['seo_keywords']) : '';
$seoDescription = isset($data['seo_description']) ? trim($data['seo_description']) : '';

// 自动生成摘要
if (empty($summary) && !empty($content)) {
    $summary = mb_substr(strip_tags($content), 0, 200) . '...';
}

// 获取数据库连接
try {
    $conn = getDbConnection();
    writeLog('数据库连接成功');
} catch (Exception $e) {
    writeLog('数据库连接失败: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '数据库连接失败: ' . $e->getMessage()]);
    exit;
}

initDatabase($conn);

if ($id > 0) {
    // 更新文章
    $stmt = $conn->prepare("UPDATE cms_articles SET 
        title = ?, summary = ?, content = ?, category_id = ?, cover_image = ?, 
        status = ?, is_top = ?, sort_order = ?, seo_title = ?, seo_keywords = ?, seo_description = ?,
        updated_at = NOW() 
        WHERE id = ?");
    $stmt->bind_param("sssissiisssi", $title, $summary, $content, $categoryId, $coverImage, 
                      $status, $isTop, $sortOrder, $seoTitle, $seoKeywords, $seoDescription, $id);
} else {
    // 创建文章
    $stmt = $conn->prepare("INSERT INTO cms_articles 
        (title, summary, content, category_id, cover_image, status, is_top, sort_order, 
         seo_title, seo_keywords, seo_description, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("sssissiisss", $title, $summary, $content, $categoryId, $coverImage, 
                      $status, $isTop, $sortOrder, $seoTitle, $seoKeywords, $seoDescription);
}

if ($stmt->execute()) {
    $articleId = $id > 0 ? $id : $stmt->insert_id;
    $stmt->close();
    $conn->close();
    
    writeLog('文章保存成功, ID: ' . $articleId);
    
    echo json_encode([
        'success' => true,
        'message' => $id > 0 ? '文章更新成功' : '文章创建成功',
        'data' => ['id' => $articleId]
    ]);
} else {
    $error = $stmt->error;
    writeLog('SQL执行错误: ' . $error);
    $stmt->close();
    $conn->close();
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '保存失败: ' . $error]);
}
