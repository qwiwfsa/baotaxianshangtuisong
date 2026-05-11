<?php
/**
 * 手机端 - 常见问题API
 * 从MySQL的faq表读取
 */

require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

try {
    $db = getDB();
    
    $result = $db->query("SELECT id, category, question, answer, sort_order, is_active FROM faq WHERE (is_active IS NULL OR is_active = 1) ORDER BY sort_order ASC, id ASC");
    
    $faqList = [];
    $categoryMap = [];
    
    while ($row = $result->fetch_assoc()) {
        $cat = $row['category'] ?: '其他';
        $item = [
            'id' => (int)$row['id'],
            'question' => $row['question'],
            'answer' => $row['answer'],
            'category' => $cat,
            'sort_order' => (int)$row['sort_order']
        ];
        $faqList[] = $item;
        if (!isset($categoryMap[$cat])) {
            $categoryMap[$cat] = [];
        }
        $categoryMap[$cat][] = $item;
    }
    
    jsonSuccess([
        'faq' => $faqList,
        'total' => count($faqList),
        'categories' => $categoryMap
    ]);


    
} catch (Exception $e) {
    jsonError('数据库查询失败: ' . $e->getMessage());
}
