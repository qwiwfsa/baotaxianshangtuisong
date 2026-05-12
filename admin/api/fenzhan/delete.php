<?php
/**
 * 城市分站删除API
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
$id = isset($data['id']) ? intval($data['id']) : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的ID']);
    exit;
}

try {
    $conn = getDbConnection();
    $stmt = $conn->prepare("DELETE FROM fenzhan_cities WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close(); $conn->close();
        echo json_encode(['success' => true, 'message' => '删除成功']);
    } else {
        $err = $stmt->error;
        $stmt->close(); $conn->close();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => '删除失败: ' . $err]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '删除失败: ' . $e->getMessage()]);
}
