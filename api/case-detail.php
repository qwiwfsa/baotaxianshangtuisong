<?php
/**
 * 桌面端 - 案例详情API
 * 从MySQL读取单个案例
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

$caseId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$caseId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

try {
    $db = getDB();
    
    // 检查cases表是否存在
    $tableCheck = $db->query("SHOW TABLES LIKE 'cases'");
    if ($tableCheck->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'exists' => false,
            'message' => 'cases表不存在'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    $stmt = $db->prepare("SELECT id, title, company, amount, period, category, description, image, content, status, sort_order, created_at, updated_at, seo_title, seo_keywords, seo_description FROM cases WHERE id = ? AND status = 1 LIMIT 1");
    $stmt->bind_param('i', $caseId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if (!$row) {
        http_response_code(404);
        echo json_encode(['success' => false, 'exists' => false, 'message' => '案例不存在']);
        exit;
    }
    
    $contentData = json_decode($row['content'], true) ?: [];
    
    $caseData = [
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
        'lastModified' => $row['updated_at'],
        'seo_title' => $row['seo_title'] ?? '',
        'seo_keywords' => $row['seo_keywords'] ?? '',
        'seo_description' => $row['seo_description'] ?? ''
    ];
    
    echo json_encode([
        'success' => true,
        'exists' => true,
        'case' => $caseData
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
}
