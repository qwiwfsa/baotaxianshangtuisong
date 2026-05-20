<?php
/**
 * 文章删除API
 * 删除单篇或多篇文章
 */

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 获取请求数据
$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

$ids = [];

if (isset($data['id'])) {
    $ids[] = intval($data['id']);
} elseif (isset($data['ids']) && is_array($data['ids'])) {
    $ids = array_map('intval', $data['ids']);
}

if (empty($ids)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少文章ID']);
    exit;
}

$conn = getDbConnection();
if (function_exists("initDatabase")) { initDatabase($conn); }

// 构建IN查询
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));

// 软删除：将状态改为deleted
$stmt = $conn->prepare("UPDATE cms_articles SET status = 'deleted', updated_at = NOW() WHERE id IN ($placeholders)");
$stmt->bind_param($types, ...$ids);

if ($stmt->execute()) {
    $affected = $stmt->affected_rows;
    $stmt->close();
    $conn->close();
    
    echo json_encode([
        'success' => true,
        'message' => "成功删除 {$affected} 篇文章",
        'data' => ['deleted_count' => $affected]
    ]);
} else {
    $error = $stmt->error;
    $stmt->close();
    $conn->close();
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '删除失败: ' . $error]);
}
