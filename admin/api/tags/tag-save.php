<?php
/**
 * 标签保存API - 创建或更新
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../../../includes/tag-helper.php';

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

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的请求数据']);
    exit;
}

$id = isset($data['id']) ? intval($data['id']) : 0;
$name = isset($data['name']) ? trim($data['name']) : '';
$slug = isset($data['slug']) ? trim($data['slug']) : '';
$seo_title = isset($data['seo_title']) ? trim($data['seo_title']) : '';
$seo_keywords = isset($data['seo_keywords']) ? trim($data['seo_keywords']) : '';
$seo_description = isset($data['seo_description']) ? trim($data['seo_description']) : '';
$sort_order = isset($data['sort_order']) ? intval($data['sort_order']) : 0;

if (empty($name)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '标签名称不能为空']);
    exit;
}

try {
    $conn = getDbConnection();

    if (empty($slug)) {
        $slug = generateUniqueSlug($name, $conn, $id > 0 ? $id : null);
    } else {
        $checkSql = "SELECT id FROM tags WHERE slug = ?" . ($id > 0 ? " AND id != ?" : "");
        $stmt = $conn->prepare($checkSql);
        if ($id > 0) {
            $stmt->bind_param("si", $slug, $id);
        } else {
            $stmt->bind_param("s", $slug);
        }
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => '别名已被使用，请更换']);
            exit;
        }
        $stmt->close();
    }

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE tags SET name=?, slug=?, seo_title=?, seo_keywords=?, seo_description=?, sort_order=? WHERE id=?");
        $stmt->bind_param("sssssii", $name, $slug, $seo_title, $seo_keywords, $seo_description, $sort_order, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        $stmt = $conn->prepare("INSERT INTO tags (name, slug, seo_title, seo_keywords, seo_description, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $name, $slug, $seo_title, $seo_keywords, $seo_description, $sort_order);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();
    }

    $conn->close();

    echo json_encode(['success' => true, 'message' => '保存成功', 'data' => ['id' => $id]], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '保存失败: ' . $e->getMessage()]);
}
