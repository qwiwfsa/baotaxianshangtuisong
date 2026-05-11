<?php
/**
 * 桌面端 - 分类API
 * 从MySQL的cms_categories表读取分类列表
 */

require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

try {
    $db = getDB();
    
    // 获取分类列表
    $result = $db->query("SELECT id, name, description, seo_title, seo_keywords, seo_description, sort_order FROM cms_categories ORDER BY sort_order ASC, id ASC");
    $categories = [];
    if ($result) {
        $categories = $result->fetch_all(MYSQLI_ASSOC);
    }
    
    echo json_encode([
        'success' => true,
        'categories' => $categories
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    jsonError('数据库查询失败: ' . $e->getMessage());
}
