<?php
/**
 * 城市分站保存API（新建/更新）
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的JSON']);
    exit;
}

$id = isset($data['id']) ? intval($data['id']) : 0;
$city_name = isset($data['city_name']) ? trim($data['city_name']) : '';
$slug = isset($data['slug']) ? trim($data['slug']) : '';
$province = isset($data['province']) ? trim($data['province']) : '';
$title = isset($data['title']) ? trim($data['title']) : '';
$keywords = isset($data['keywords']) ? trim($data['keywords']) : '';
$description = isset($data['description']) ? trim($data['description']) : '';
$content = isset($data['content']) ? $data['content'] : '';
$phone = isset($data['phone']) ? trim($data['phone']) : '';
$sort_order = isset($data['sort_order']) ? intval($data['sort_order']) : 0;
$is_active = isset($data['is_active']) ? intval($data['is_active']) : 1;

if ($city_name === '' || $slug === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '城市名称和slug不能为空']);
    exit;
}

try {
    $conn = getDbConnection();

    // Check slug uniqueness
    $checkSql = $id > 0
        ? "SELECT id FROM fenzhan_cities WHERE slug = ? AND id != ?"
        : "SELECT id FROM fenzhan_cities WHERE slug = ?";
    $checkStmt = $conn->prepare($checkSql);
    if ($id > 0) {
        $checkStmt->bind_param("si", $slug, $id);
    } else {
        $checkStmt->bind_param("s", $slug);
    }
    $checkStmt->execute();
    if ($checkStmt->get_result()->num_rows > 0) {
        $checkStmt->close(); $conn->close();
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '该slug已存在']);
        exit;
    }
    $checkStmt->close();

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE fenzhan_cities SET city_name=?, slug=?, province=?, title=?, keywords=?, description=?, content=?, phone=?, sort_order=?, is_active=? WHERE id=?");
        $stmt->bind_param("ssssssssiii", $city_name, $slug, $province, $title, $keywords, $description, $content, $phone, $sort_order, $is_active, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO fenzhan_cities (city_name, slug, province, title, keywords, description, content, phone, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssii", $city_name, $slug, $province, $title, $keywords, $description, $content, $phone, $sort_order, $is_active);
    }

    if ($stmt->execute()) {
        $newId = $id > 0 ? $id : $stmt->insert_id;
        $stmt->close(); $conn->close();
        echo json_encode([
            'success' => true,
            'message' => $id > 0 ? '更新成功' : '创建成功',
            'data' => ['id' => $newId]
        ], JSON_UNESCAPED_UNICODE);
    } else {
        $err = $stmt->error;
        $stmt->close(); $conn->close();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => '保存失败: ' . $err]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '保存失败: ' . $e->getMessage()]);
}
