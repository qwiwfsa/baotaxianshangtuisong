<?php
/**
 * 前端标签详情聚合API
 */
require_once __DIR__ . '/../admin/api/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = isset($_GET['limit']) ? min(20, intval($_GET['limit'])) : 10;
$offset = ($page - 1) * $limit;

if (empty($slug)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少slug']);
    exit;
}

try {
    $conn = getDbConnection();

    // Get tag info
    $stmt = $conn->prepare("SELECT * FROM tags WHERE slug = ?");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    $tag = $result->fetch_assoc();
    $stmt->close();

    if (!$tag) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => '标签不存在']);
        exit;
    }

    $response = [
        'tag' => $tag,
        'articles' => ['list' => [], 'total' => 0],
        'cases' => ['list' => [], 'total' => 0]
    ];

    // Get articles
    if ($type === 'all' || $type === 'article') {
        $countSql = "SELECT COUNT(*) as total FROM article_tags at JOIN cms_articles a ON at.article_id = a.id WHERE at.tag_id = ? AND a.status = 'published'";
        $stmt = $conn->prepare($countSql);
        $stmt->bind_param("i", $tag['id']);
        $stmt->execute();
        $articleTotal = $stmt->get_result()->fetch_assoc()['total'];
        $stmt->close();

        $sql = "SELECT a.id, a.title, a.summary, a.cover_image, a.created_at, a.updated_at, a.view_count
                FROM article_tags at JOIN cms_articles a ON at.article_id = a.id
                WHERE at.tag_id = ? AND a.status = 'published'
                ORDER BY a.is_top DESC, a.created_at DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $tag['id'], $limit, $offset);
        $stmt->execute();
        $articles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $response['articles'] = ['list' => $articles, 'total' => (int)$articleTotal];
    }

    // Get cases
    if ($type === 'all' || $type === 'case') {
        $countSql = "SELECT COUNT(*) as total FROM case_tags ct JOIN cases c ON ct.case_id = c.id WHERE ct.tag_id = ? AND c.status = 1";
        $stmt = $conn->prepare($countSql);
        $stmt->bind_param("i", $tag['id']);
        $stmt->execute();
        $caseTotal = $stmt->get_result()->fetch_assoc()['total'];
        $stmt->close();

        $sql = "SELECT c.id, c.title, c.company, c.amount, c.category, c.description, c.image, c.created_at, c.updated_at
                FROM case_tags ct JOIN cases c ON ct.case_id = c.id
                WHERE ct.tag_id = ? AND c.status = 1
                ORDER BY c.updated_at DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $tag['id'], $limit, $offset);
        $stmt->execute();
        $cases = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $response['cases'] = ['list' => $cases, 'total' => (int)$caseTotal];
    }

    $conn->close();
    echo json_encode(['success' => true, 'data' => $response], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
