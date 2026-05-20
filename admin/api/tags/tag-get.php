<?php
/**
 * 获取单个标签API
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少标签ID']);
    exit;
}

try {
    $conn = getDbConnection();

    $stmt = $conn->prepare("SELECT t.*,
            (SELECT COUNT(*) FROM article_tags at JOIN cms_articles a ON at.article_id = a.id AND a.status != 'deleted' WHERE at.tag_id = t.id) as article_count,
            (SELECT COUNT(*) FROM case_tags ct JOIN cases c ON ct.case_id = c.id AND c.status = 1 WHERE ct.tag_id = t.id) as case_count
            FROM tags t WHERE t.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => '标签不存在']);
        exit;
    }

    $tag = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'data' => $tag], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '获取标签失败: ' . $e->getMessage()]);
}
