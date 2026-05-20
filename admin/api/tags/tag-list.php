<?php
/**
 * 标签列表API
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = isset($_GET['limit']) ? min(100, intval($_GET['limit'])) : 20;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

try {
    $conn = getDbConnection();

    $where = '';
    $params = [];
    $types = '';

    if ($search) {
        $where = "WHERE t.name LIKE ? OR t.slug LIKE ?";
        $searchTerm = "%$search%";
        $params = [$searchTerm, $searchTerm];
        $types = "ss";
    }

    $countSql = "SELECT COUNT(*) as total FROM tags t $where";
    $stmt = $conn->prepare($countSql);
    if (!empty($params)) $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $total = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();

    $sql = "SELECT t.*,
            (SELECT COUNT(*) FROM article_tags at JOIN cms_articles a ON at.article_id = a.id AND a.status != 'deleted' WHERE at.tag_id = t.id) as article_count,
            (SELECT COUNT(*) FROM case_tags ct JOIN cases c ON ct.case_id = c.id AND c.status = 1 WHERE ct.tag_id = t.id) as case_count
            FROM tags t $where
            ORDER BY t.sort_order ASC, t.id DESC
            LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);
    $bindParams = $params;
    $bindTypes = $types;
    $bindParams[] = intval($limit);
    $bindTypes .= 'i';
    $bindParams[] = intval($offset);
    $bindTypes .= 'i';

    if (!empty($bindParams)) $stmt->bind_param($bindTypes, ...$bindParams);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = [];
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'data' => $tags, 'total' => (int)$total, 'page' => $page, 'limit' => $limit], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '获取标签列表失败: ' . $e->getMessage()]);
}
