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
    $count_res = $conn->query("SELECT COUNT(*) as total FROM friend_links");
    $total = $count_res ? $count_res->fetch_assoc()['total'] : 0;
    $result = $conn->query("SELECT * FROM friend_links ORDER BY sort_order ASC, id DESC LIMIT $offset, $limit");
    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode(['success' => true, 'data' => $data, 'total' => intval($total)]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
