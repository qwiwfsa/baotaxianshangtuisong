<?php
/**
 * 前台获取SEO数据API
 * GET ?page=index.html 返回该页面的SEO数据
 * 如果页面有独立设置则返回，否则返回整站默认设置
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// 使用统一数据库配置
require_once __DIR__ . '/../../config/db.php';

try {
    $conn = getDB();
    
    // 确保表存在
    $conn->query("CREATE TABLE IF NOT EXISTS seo_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_id VARCHAR(100) NOT NULL UNIQUE,
        page_title VARCHAR(255) DEFAULT '',
        meta_keywords TEXT,
        meta_description TEXT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    
    // 获取请求的页面
    $page = isset($_GET['page']) ? trim($_GET['page']) : 'index.html';
    
    // 默认值
    $defaults = [
        'page_title' => '',
        'meta_keywords' => '',
        'meta_description' => ''
    ];
    
    // 先查当前页面的独立设置
    $stmt = $conn->prepare("SELECT page_title, meta_keywords, meta_description FROM seo_settings WHERE page_id = ?");
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $result = $stmt->get_result();
    $pageSettings = $result->fetch_assoc();
    $stmt->close();
    
    // 再查整站默认设置
    $stmt = $conn->prepare("SELECT page_title, meta_keywords, meta_description FROM seo_settings WHERE page_id = 'global'");
    $stmt->execute();
    $result = $stmt->get_result();
    $globalSettings = $result->fetch_assoc();
    $stmt->close();
    
    $conn->close();
    
    // 合并设置：页面独立设置优先，没有则用整站默认
    $data = [
        'page_id' => $page,
        'page_title' => '',
        'meta_keywords' => '',
        'meta_description' => ''
    ];
    
    if ($pageSettings) {
        $data['has_custom'] = true;
        $data['page_title'] = $pageSettings['page_title'] ?? '';
        $data['meta_keywords'] = $pageSettings['meta_keywords'] ?? '';
        $data['meta_description'] = $pageSettings['meta_description'] ?? '';
    } else {
        $data['has_custom'] = false;
        // 使用全局设置
        if ($globalSettings) {
            $data['page_title'] = $globalSettings['page_title'] ?? '';
            $data['meta_keywords'] = $globalSettings['meta_keywords'] ?? '';
            $data['meta_description'] = $globalSettings['meta_description'] ?? '';
        }
    }
    
    // 如果页面独立设置中有空字段，用全局默认填充
    if ($pageSettings && $globalSettings) {
        if (empty($data['page_title'])) {
            $data['page_title'] = $globalSettings['page_title'] ?? '';
        }
        if (empty($data['meta_keywords'])) {
            $data['meta_keywords'] = $globalSettings['meta_keywords'] ?? '';
        }
        if (empty($data['meta_description'])) {
            $data['meta_description'] = $globalSettings['meta_description'] ?? '';
        }
    }
    
    echo json_encode([
        'code' => 0,
        'msg' => 'success',
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    echo json_encode([
        'code' => 1,
        'msg' => $e->getMessage(),
        'data' => [
            'page_id' => $page,
            'page_title' => '',
            'meta_keywords' => '',
            'meta_description' => ''
        ]
    ], JSON_UNESCAPED_UNICODE);
}
