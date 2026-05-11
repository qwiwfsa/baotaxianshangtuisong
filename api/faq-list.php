<?php
/**
 * 桌面端 - 常见问题API
 * 从MySQL的faq表读取
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

try {
    $db = getDB();
    
    $stmt = $db->prepare("SELECT id, category, question, answer, sort_order FROM faq WHERE (is_active IS NULL OR is_active = 1) ORDER BY sort_order ASC, id ASC");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $faqList = [];
    foreach ($rows as $row) {
        $faqList[] = [
            'id' => (int)$row['id'],
            'question' => $row['question'],
            'answer' => $row['answer'],
            'category' => $row['category'] ?: '其他',
            'sort_order' => (int)$row['sort_order']
        ];
    }
    
    // 获取分类顺序
    $categoriesOrder = [];
    $catStmt = $db->prepare("SELECT cat_key, cat_label, sort_order FROM faq_categories ORDER BY sort_order ASC");
    $catStmt->execute();
    $catRows = $catStmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($catRows as $cat) {
        $categoriesOrder[] = [
            'key' => $cat['cat_key'],
            'label' => $cat['cat_label'],
            'sort_order' => (int)$cat['sort_order']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'faq' => $faqList,
        'total' => count($faqList),
        'categories_order' => $categoriesOrder
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
}
