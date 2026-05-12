<?php
/**
 * 标签选项API - 供文章/案例编辑器使用
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

try {
    $conn = getDbConnection();
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $sql = "SELECT id, name, slug FROM tags";
    $params = [];
    $types = '';

    if ($search) {
        $sql .= " WHERE name LIKE ? OR slug LIKE ?";
        $searchTerm = "%$search%";
        $params = [$searchTerm, $searchTerm];
        $types = "ss";
    }

    $sql .= " ORDER BY name ASC";

    $stmt = $conn->prepare($sql);
    if (!empty($params)) $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    $tags = [];
    while ($row = $result->fetch_assoc()) {
        $tags[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'data' => $tags], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '获取标签选项失败']);
}
