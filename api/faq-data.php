<?php
/**
 * 桌面端FAQ数据API
 * 从faq表读取数据，返回JSON供前端faq.html使用
 */

error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../config/db.php';

try {
    $conn = getDB();

    // 获取FAQ条目
    $faqResult = $conn->query("SELECT id, category, question, answer, sort_order FROM faq WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
    $data = [];
    if ($faqResult) {
        while ($row = $faqResult->fetch_assoc()) {
            $data[] = [
                'id' => (int)$row['id'],
                'category' => $row['category'],
                'question' => $row['question'],
                'answer' => $row['answer'],
                'sort_order' => (int)$row['sort_order']
            ];
        }
    }

    // 获取分类配置
    $catResult = $conn->query("SELECT cat_key, cat_label, sort_order FROM faq_categories ORDER BY sort_order ASC");
    $categories = [];
    $categoriesOrder = [];
    if ($catResult) {
        while ($row = $catResult->fetch_assoc()) {
            $categories[$row['cat_key']] = $row['cat_label'];
            $categoriesOrder[] = [
                'key' => $row['cat_key'],
                'label' => $row['cat_label'],
                'sort_order' => (int)$row['sort_order']
            ];
        }
    }

    $conn->close();

    echo json_encode([
        'code' => 0,
        'data' => $data,
        'categories' => $categories,
        'categories_order' => $categoriesOrder
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['code' => 1, 'msg' => '服务器错误: ' . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
