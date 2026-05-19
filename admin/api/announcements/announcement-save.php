<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success'=>false,'message'=>'Method not allowed']); exit; }
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || empty($data['title'])) {
    echo json_encode(['success' => false, 'message' => '标题为必填']);
    exit;
}
try {
    $conn = getDbConnection();
    $title = $conn->real_escape_string($data['title']);
    $content = $conn->real_escape_string($data['content'] ?? '');
    $status = isset($data['status']) ? intval($data['status']) : 1;
    if (!empty($data['id'])) {
        $id = intval($data['id']);
        $stmt = $conn->prepare("UPDATE announcements SET title=?, content=?, status=? WHERE id=?");
        $stmt->bind_param("ssii", $title, $content, $status, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO announcements (title, content, status) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $content, $status);
    }
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
