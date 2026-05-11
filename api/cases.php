<?php
/**
 * 桌面端 - 案例列表API
 * 从MySQL读取已发布案例
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

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
    
    // 先检查cases表是否存在
    $tableCheck = $db->query("SHOW TABLES LIKE 'cases'");
    if ($tableCheck->num_rows === 0) {
        // cases表不存在，返回空数组
        echo json_encode([
            'success' => true,
            'cases' => [],
            'total' => 0,
            'message' => 'cases表不存在'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    $result = $db->query("SELECT id, title, company, amount, period, category, description, image, content, status, sort_order, created_at, updated_at FROM cases WHERE status = 1 ORDER BY sort_order ASC, id DESC");
    
    $cases = [];
    while ($row = $result->fetch_assoc()) {
        $contentData = json_decode($row['content'], true) ?: [];
        
        $cases[] = [
            'id' => (string)$row['id'],
            'title' => $row['title'],
            'type' => $row['category'],
            'city' => $row['company'],
            'amount' => $row['amount'],
            'period' => $row['period'],
            'summary' => $row['description'],
            'image' => $row['image'],
            'coverImage' => $contentData['coverImage'] ?? $row['image'],
            'images' => $contentData['images'] ?? [],
            'detail' => $contentData['detail'] ?? $row['description'],
            'highlights' => $contentData['highlights'] ?? [],
            'highlightTitle' => $contentData['highlightTitle'] ?? '',
            'process' => $contentData['process'] ?? [],
            'hasVideo' => $contentData['hasVideo'] ?? false,
            'video' => $contentData['video'] ?? '',
            'status' => 'published',
            'lastModified' => $row['updated_at']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'cases' => $cases,
        'total' => count($cases)
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
}
