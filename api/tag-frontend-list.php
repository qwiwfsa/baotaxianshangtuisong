<?php
/**
 * 前端标签列表API
 */
require_once __DIR__ . '/../admin/api/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

try {
    $conn = getDbConnection();

    $sql = "SELECT t.id, t.name, t.slug, t.seo_title,
                   (SELECT COUNT(*) FROM article_tags at JOIN cms_articles a ON at.article_id = a.id WHERE at.tag_id = t.id AND a.status = 'published') as article_count,
                   (SELECT COUNT(*) FROM case_tags ct JOIN cases c ON ct.case_id = c.id WHERE ct.tag_id = t.id AND c.status = 1) as case_count
            FROM tags t
            HAVING (article_count > 0 OR case_count > 0)
            ORDER BY (article_count + case_count) DESC, t.id DESC";

    $result = $conn->query($sql);
    $tags = $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    echo json_encode(['success' => true, 'data' => $tags], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
