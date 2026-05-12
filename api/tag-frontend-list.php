<?php
/**
 * 前端标签列表API
 */
require_once __DIR__ . '/../admin/api/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

try {
    $conn = getDbConnection();
    $result = $conn->query("
        SELECT t.*,
            (SELECT COUNT(*) FROM article_tags at JOIN cms_articles a ON at.article_id = a.id AND a.status = 'published' WHERE at.tag_id = t.id) as article_count,
            (SELECT COUNT(*) FROM case_tags ct JOIN cases c ON ct.case_id = c.id AND c.status = 1 WHERE ct.tag_id = t.id) as case_count
        FROM tags t
        HAVING (article_count + case_count) > 0
        ORDER BY (article_count + case_count) DESC, t.name ASC
    ");
    $tags = [];
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row;
    }
    $conn->close();
    echo json_encode(['success' => true, 'data' => $tags], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
