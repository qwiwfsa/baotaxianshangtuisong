<?php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$conn = getDbConnection();

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

$where = [];
$params = [];
$types = '';

if ($status_filter !== '' && $status_filter !== '-1') {
    $s = intval($status_filter);
    $where[] = 'c.status = ?';
    $params[] = $s;
    $types .= 'i';
}

if ($search !== '') {
    $where[] = '(c.nickname LIKE ? OR c.content LIKE ? OR COALESCE(a.title, \'\') LIKE ?)';
    $st = '%' . $search . '%';
    $params[] = $st;
    $params[] = $st;
    $params[] = $st;
    $types .= 'sss';
}

$where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

$count_sql = "SELECT COUNT(*) FROM article_comments c LEFT JOIN cms_articles a ON c.article_id = a.id $where_clause";
$count_stmt = $conn->prepare($count_sql);
if (!empty($params)) {
    $count_stmt->bind_param($types, ...$params);
}
$count_stmt->execute();
$total = $count_stmt->get_result()->fetch_row()[0];

$sql = "SELECT c.*, COALESCE(a.title, '(已删除)') as article_title FROM article_comments c LEFT JOIN cms_articles a ON c.article_id = a.id $where_clause ORDER BY c.created_at DESC LIMIT ? OFFSET ?";
$all_params = array_merge($params, [$limit, $offset]);
$all_types = $types . 'ii';

$stmt = $conn->prepare($sql);
$stmt->bind_param($all_types, ...$all_params);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $comments,
    'total' => intval($total),
    'page' => $page,
    'limit' => $limit
], JSON_UNESCAPED_UNICODE);
