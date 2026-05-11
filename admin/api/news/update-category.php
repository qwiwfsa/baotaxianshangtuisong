<?php
/**
 * 批量更新文章分类API
 */

require_once __DIR__ . '/../../../config/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 获取POST数据
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!isset($data['ids']) || !is_array($data['ids']) || empty($data['ids'])) {
    echo json_encode(['success' => false, 'message' => '请选择要更新的文章']);
    exit;
}

if (!isset($data['category_id']) || empty($data['category_id'])) {
    echo json_encode(['success' => false, 'message' => '请选择分类']);
    exit;
}

$ids = $data['ids'];
$categoryId = intval($data['category_id']);

// 获取分类名称
try {
    $conn = getDB();
    
    // 获取分类名称
    $stmt = $conn->prepare("SELECT name FROM cms_categories WHERE id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
    
    if (!$category) {
        echo json_encode(['success' => false, 'message' => '分类不存在']);
        exit;
    }
    
    $categoryName = $category['name'];
    
    // 批量更新文章分类（只更新 category_id）
    $idList = implode(',', array_map('intval', $ids));
    $sql = "UPDATE cms_articles SET category_id = ? WHERE id IN ($idList)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    
    $affectedRows = $stmt->affected_rows;
    
    $conn->close();
    
    echo json_encode([
        'success' => true,
        'message' => "成功更新 {$affectedRows} 篇文章的分类",
        'affected' => $affectedRows
    ]);
    
} catch (Exception $e) {
    error_log('[update-category.php] 更新失败: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => '更新失败: ' . $e->getMessage()]);
}
