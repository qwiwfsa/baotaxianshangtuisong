<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success'=>false,'message'=>'Method not allowed']); exit; }
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || empty($data['name']) || empty($data['url'])) {
    echo json_encode(['success' => false, 'message' => '名称和URL为必填']);
    exit;
}
try {
    $conn = getDbConnection();
    $name = $conn->real_escape_string($data['name']);
    $url = $conn->real_escape_string($data['url']);
    $logo = $conn->real_escape_string($data['logo'] ?? '');
    $desc = $conn->real_escape_string($data['description'] ?? '');
    $sort = intval($data['sort_order'] ?? 0);
    $status = isset($data['status']) ? intval($data['status']) : 1;
    if (!empty($data['id'])) {
        $id = intval($data['id']);
        $stmt = $conn->prepare("UPDATE friend_links SET name=?, url=?, logo=?, description=?, sort_order=?, status=? WHERE id=?");
        $stmt->bind_param("ssssiii", $name, $url, $logo, $desc, $sort, $status, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO friend_links (name, url, logo, description, sort_order, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $name, $url, $logo, $desc, $sort, $status);
    }
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
