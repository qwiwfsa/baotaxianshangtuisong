<?php
/**
 * 分类删除API - 独立端点
 * 用于删除文章分类
 */

// 全局错误处理
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $errstr]);
    exit;
});

set_exception_handler(function($e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => '服务器异常: ' . $e->getMessage()]);
    exit;
});

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '不支持的请求方法']);
    exit;
}

try {
    $conn = getDbConnection();
} catch (Exception $e) {
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => '数据库连接失败: ' . $e->getMessage()]);
    exit;
}

// 获取请求数据
$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

$id = isset($data['id']) ? intval($data['id']) : 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少分类ID']);
    $conn->close();
    exit;
}

// 检查分类是否存在
$checkExists = $conn->prepare("SELECT id, name FROM cms_categories WHERE id = ?");
$checkExists->bind_param("i", $id);
$checkExists->execute();
$exists = $checkExists->get_result()->fetch_assoc();
$checkExists->close();

if (!$exists) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => '分类不存在']);
    $conn->close();
    exit;
}

// 检查分类下是否有文章（含非删除状态）
$checkStmt = $conn->prepare("SELECT COUNT(*) as count,
    SUM(CASE WHEN status != 'deleted' THEN 1 ELSE 0 END) as active_count
    FROM cms_articles WHERE category_id = ?");
$checkStmt->bind_param("i", $id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result()->fetch_assoc();
$totalCount = (int)$checkResult['count'];
$activeCount = (int)$checkResult['active_count'];
$checkStmt->close();

if ($activeCount > 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => "该分类下还有 {$activeCount} 篇文章，无法删除。请先将文章移动到其他分类。"]);
    $conn->close();
    exit;
}

// 重置引用该分类的文章的 category_id 为 0（包括已删除的文章）
if ($totalCount > 0) {
    $resetStmt = $conn->prepare("UPDATE cms_articles SET category_id = 0 WHERE category_id = ?");
    $resetStmt->bind_param("i", $id);
    $resetStmt->execute();
    $resetStmt->close();
}

// 执行删除
$stmt = $conn->prepare("DELETE FROM cms_categories WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '分类删除成功']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '删除失败: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
