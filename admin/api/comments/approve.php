<?php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '请求方式不支持']);
    exit;
}

$conn = getDbConnection();

$input = json_decode(file_get_contents('php://input'), true);
$id = isset($input['id']) ? intval($input['id']) : 0;
$status = isset($input['status']) ? intval($input['status']) : 1;

if ($id <= 0 || !in_array($status, [1, 2])) {
    echo json_encode(['success' => false, 'message' => '参数错误']);
    exit;
}

$stmt = $conn->prepare("UPDATE article_comments SET status = ? WHERE id = ?");
$stmt->bind_param('ii', $status, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => '已更新']);
} else {
    echo json_encode(['success' => false, 'message' => '未找到该评论']);
}
