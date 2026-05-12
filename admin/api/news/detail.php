<?php
/**
 * 文章详情API - 优化版本
 * 获取单篇文章详情
 */

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Cache-Control: public, max-age=60');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$basicOnly = isset($_GET['basic']) && $_GET['basic'] == '1'; // 只获取基本信息

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少文章ID']);
    exit;
}

// 设置数据库连接超时
ini_set('default_socket_timeout', 3);

try {
    $conn = getDbConnection();
} catch (Exception $e) {
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => '数据库连接失败']);
    exit;
}

// 获取文章详情 - 根据basic参数决定查询字段
if ($basicOnly) {
    // 只查询基本信息（不含content，用于快速加载）
    $stmt = $conn->prepare("SELECT a.id, a.title, a.summary, a.category_id, a.cover_image, 
                                   a.status, a.is_top, a.sort_order, a.view_count,
                                   a.seo_title, a.seo_keywords, a.seo_description,
                                   a.created_at, a.updated_at, c.name as category_name 
                           FROM cms_articles a 
                           LEFT JOIN cms_categories c ON a.category_id = c.id 
                           WHERE a.id = ?");
} else {
    // 完整查询
    $stmt = $conn->prepare("SELECT a.*, c.name as category_name 
                           FROM cms_articles a 
                           LEFT JOIN cms_categories c ON a.category_id = c.id 
                           WHERE a.id = ?");
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    $conn->close();
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => '文章不存在']);
    exit;
}

$article = $result->fetch_assoc();

// 调试信息：记录content字段状态
error_log("Article ID: $id, Content field exists: " . (isset($article['content']) ? 'yes' : 'no'));
if (isset($article['content'])) {
    error_log("Content length: " . strlen($article['content']));
}

// 处理图片路径
if ($article['cover_image']) {
    $article['cover_image'] = fixImagePath($article['cover_image']);
}

// 如果不是仅基本信息模式，更新浏览量并获取上一篇下一篇
if (!$basicOnly) {
    // 更新浏览量
    $updateStmt = $conn->prepare("UPDATE cms_articles SET view_count = view_count + 1 WHERE id = ?");
    $updateStmt->bind_param("i", $id);
    $updateStmt->execute();
    $updateStmt->close();

    // 获取上一篇和下一篇
    $prevStmt = $conn->prepare("SELECT id, title FROM cms_articles WHERE id < ? AND status = 'published' ORDER BY id DESC LIMIT 1");
    $prevStmt->bind_param("i", $id);
    $prevStmt->execute();
    $prevResult = $prevStmt->get_result();
    $article['prev'] = $prevResult->fetch_assoc();
    $prevStmt->close();

    $nextStmt = $conn->prepare("SELECT id, title FROM cms_articles WHERE id > ? AND status = 'published' ORDER BY id ASC LIMIT 1");
    $nextStmt->bind_param("i", $id);
    $nextStmt->execute();
    $nextResult = $nextStmt->get_result();
    $article['next'] = $nextResult->fetch_assoc();
    $nextStmt->close();
}


    // 获取文章关联标签
    $tagIds = [];
    $tagStmt = $conn->prepare("SELECT tag_id FROM article_tags WHERE article_id = ?");
    $tagStmt->bind_param("i", $id);
    $tagStmt->execute();
    $tagResult = $tagStmt->get_result();
    while ($tagRow = $tagResult->fetch_assoc()) {
        $tagIds[] = (int)$tagRow["tag_id"];
    }
    $tagStmt->close();
    $article["tag_ids"] = $tagIds;

$stmt->close();
$conn->close();

echo json_encode([
    'success' => true,
    'data' => $article
]);

function fixImagePath($path) {
    if (empty($path)) return '';
    if (strpos($path, 'http') === 0) return $path;
    if (strpos($path, '/') === 0) return $path; // 已经是绝对路径
    // 数据库可能存的是 uploads/xxx.jpg，直接加/变成绝对路径
    if (strpos($path, 'uploads/') === 0) {
        return '/' . $path;
    }
    // 纯文件名，补上 uploads/ 目录
    return '/uploads/' . ltrim($path, '/');
}
