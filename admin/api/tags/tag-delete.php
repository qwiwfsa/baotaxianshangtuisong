<?php
/**
 * 标签删除API
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

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);
$id = isset($data['id']) ? intval($data['id']) : (isset($_POST['id']) ? intval($_POST['id']) : 0);

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少标签ID']);
    exit;
}

try {
    $conn = getDbConnection();
    $conn->begin_transaction();

    $conn->query("DELETE FROM article_tags WHERE tag_id = $id");
    $conn->query("DELETE FROM case_tags WHERE tag_id = $id");
    $conn->query("DELETE FROM tags WHERE id = $id");

    $conn->commit();
    $conn->close();

    echo json_encode(['success' => true, 'message' => '删除成功'], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    if (isset($conn)) $conn->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '删除失败: ' . $e->getMessage()]);
}
