<?php
/**
 * 城市分站获取单条API
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if ($id <= 0 && $slug === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少ID或slug参数']);
    exit;
}

try {
    $conn = getDbConnection();
    if ($id > 0) {
        $stmt = $conn->prepare("SELECT * FROM fenzhan_cities WHERE id = ?");
        $stmt->bind_param("i", $id);
    } else {
        $stmt = $conn->prepare("SELECT * FROM fenzhan_cities WHERE slug = ?");
        $stmt->bind_param("s", $slug);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt->close(); $conn->close();
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => '分站不存在']);
        exit;
    }
    $row = $result->fetch_assoc();
    $stmt->close(); $conn->close();
    echo json_encode(['success' => true, 'data' => $row], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '查询失败: ' . $e->getMessage()]);
}
