<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = isset($_GET['limit']) ? min(100, intval($_GET['limit'])) : 20;
$offset = ($page - 1) * $limit;
try {
    $conn = getDbConnection();
    $count_res = $conn->query("SELECT COUNT(*) as total FROM announcements");
    $total = $count_res ? $count_res->fetch_assoc()['total'] : 0;
    $result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC LIMIT $offset, $limit");
    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row['content_short'] = mb_substr(strip_tags($row['content']), 0, 100);
            $data[] = $row;
        }
    }
    echo json_encode(['success' => true, 'data' => $data, 'total' => intval($total)]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
