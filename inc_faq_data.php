<?php
// 从数据库读取FAQ数据，输出为JSON供前端JS使用
require_once __DIR__ . '/config/db.php';
$conn = getDB();

$data = [];
$categories = [];
$categoriesOrder = [];

// 获取分类
$catResult = $conn->query("SELECT cat_key, cat_label, sort_order, seo_title, seo_keywords, seo_description FROM faq_categories ORDER BY sort_order ASC");
if ($catResult) {
    while ($row = $catResult->fetch_assoc()) {
        $categories[$row['cat_key']] = $row['cat_label'];
        $categoriesOrder[] = [
            'key' => $row['cat_key'],
            'label' => $row['cat_label'],
            'sort_order' => (int)$row['sort_order'],
            'seo_title' => $row['seo_title'] ?? '',
            'seo_keywords' => $row['seo_keywords'] ?? '',
            'seo_description' => $row['seo_description'] ?? ''
        ];
    }
}

// 获取FAQ条目
$faqResult = $conn->query("SELECT id, category, question, answer, sort_order, seo_title, seo_keywords, seo_description FROM faq WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
if ($faqResult) {
    while ($row = $faqResult->fetch_assoc()) {
        $data[] = [
            'id' => (int)$row['id'],
            'category' => $row['category'],
            'question' => $row['question'],
            'answer' => $row['answer'],
            'sort_order' => (int)$row['sort_order'],
            'seo_title' => $row['seo_title'] ?? '',
            'seo_keywords' => $row['seo_keywords'] ?? '',
            'seo_description' => $row['seo_description'] ?? ''
        ];
    }
}

echo json_encode([
    'code' => 0,
    'data' => $data,
    'categories' => $categories,
    'categories_order' => $categoriesOrder
], JSON_UNESCAPED_UNICODE);
