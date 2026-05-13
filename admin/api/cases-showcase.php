<?php
/**
 * 案例展示API - 直接查询数据库获取已发布案例
 */
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

try {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 6;
    require_once __DIR__ . '/../../config/db.php';
    $db = getDB();

    $result = $db->query("SELECT id, title, category, company, amount, image, content, description, sort_order FROM cases WHERE status = 1 ORDER BY sort_order ASC, id DESC LIMIT " . intval($limit));

    $list = [];
    while ($row = $result->fetch_assoc()) {
        $contentData = json_decode($row['content'], true) ?: [];
        $list[] = [
            'id' => (string)$row['id'],
            'title' => $row['title'],
            'type' => $row['category'] ?? '',
            'city' => $row['company'] ?? '',
            'amount' => $row['amount'] ?? '',
            'summary' => $row['description'] ?? '',
            'image' => $row['image'] ?? '',
            'coverImage' => $contentData['coverImage'] ?? $row['image'] ?? '',
            'images' => $contentData['images'] ?? [],
        ];
    }

    echo json_encode(['code' => 0, 'msg' => 'success', 'data' => $list, 'total' => count($list)], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(['code' => -1, 'msg' => $e->getMessage(), 'data' => []], JSON_UNESCAPED_UNICODE);
}