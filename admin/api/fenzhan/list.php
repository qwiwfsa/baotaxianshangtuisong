<?php
/**
 * 城市分站列表API
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = isset($_GET['limit']) ? min(100, max(1, intval($_GET['limit']))) : 15;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

try {
    $conn = getDbConnection();
    $where = '';
    $params = [];
    $types = '';

    if ($search !== '') {
        $where = "WHERE city_name LIKE ? OR slug LIKE ? OR province LIKE ?";
        $like = '%' . $search . '%';
        $params = [$like, $like, $like];
        $types = 'sss';
    }

    // Count total
    $countSql = "SELECT COUNT(*) as total FROM fenzhan_cities $where";
    $countStmt = $conn->prepare($countSql);
    if (!empty($params)) {
        $countStmt->bind_param($types, ...$params);
    }
    $countStmt->execute();
    $total = $countStmt->get_result()->fetch_assoc()['total'];
    $countStmt->close();

    // Fetch page
    $dataSql = "SELECT id, city_name, slug, province, phone, sort_order, is_active, created_at, updated_at
                FROM fenzhan_cities $where ORDER BY sort_order ASC, id ASC LIMIT ? OFFSET ?";
    $dataStmt = $conn->prepare($dataSql);
    if (!empty($params)) {
        $dataStmt->bind_param($types . 'ii', ...array_merge($params, [$limit, $offset]));
    } else {
        $dataStmt->bind_param('ii', $limit, $offset);
    }
    $dataStmt->execute();
    $result = $dataStmt->get_result();
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $dataStmt->close();
    $conn->close();

    echo json_encode([
        'success' => true,
        'data' => $rows,
        'total' => (int)$total,
        'page' => $page,
        'limit' => $limit
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '查询失败: ' . $e->getMessage()]);
}
