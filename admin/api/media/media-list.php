<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = isset($_GET['limit']) ? min(100, intval($_GET['limit'])) : 30;
$offset = ($page - 1) * $limit;
$type = isset($_GET['type']) ? trim($_GET['type']) : '';
try {
    $conn = getDbConnection();
    $where = '';
    if ($type && $type !== 'all') {
        $type_safe = $conn->real_escape_string($type);
        $where = " WHERE file_type LIKE '" . $type_safe . "%'";
    }
    $count_sql = "SELECT COUNT(*) as total FROM media" . $where;
    $count_res = $conn->query($count_sql);
    $total = $count_res ? $count_res->fetch_assoc()['total'] : 0;
    $sql = "SELECT * FROM media" . $where . " ORDER BY created_at DESC LIMIT $offset, $limit";
    $result = $conn->query($sql);
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
