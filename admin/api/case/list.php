<?php
/**
 * 案例列表API
 * 主数据源：MySQL；fallback：JSON索引
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

$cases = [];

// ========== 1. MySQL（主数据源） ==========
try {
    require_once __DIR__ . '/../../../config/db.php';
    $conn = getDB();
    $result = $conn->query("SELECT * FROM cases ORDER BY updated_at DESC");
    while ($row = $result->fetch_assoc()) {
        $contentData = [];
        if (!empty($row['content'])) {
            $parsed = json_decode($row['content'], true);
            if (is_array($parsed)) $contentData = $parsed;
        }
        $cases[] = [
            'id' => (string)$row['id'],
            'title' => $row['title'],
            'type' => $row['category'],
            'city' => $row['company'],
            'amount' => $row['amount'],
            'period' => $row['period'],
            'summary' => $row['description'],
            'image' => $row['image'],
            'coverImage' => $contentData['coverImage'] ?? $row['image'] ?? '',
            'images' => $contentData['images'] ?? [],
            'status' => $row['status'] ? 'published' : 'draft',
            'detail' => $contentData['detail'] ?? '',
            'highlights' => $contentData['highlights'] ?? [],
            'process' => $contentData['process'] ?? [],
            'hasVideo' => $contentData['hasVideo'] ?? false,
            'video' => $contentData['video'] ?? '',
            'seo_title' => $row['seo_title'] ?? '',
            'seo_keywords' => $row['seo_keywords'] ?? '',
            'seo_description' => $row['seo_description'] ?? '',
            'lastModified' => $row['updated_at'] ?? ''
        ];
    }
    $result->free();
    $conn->close();
} catch (Exception $e) {
    error_log('[list.php] MySQL读取失败: ' . $e->getMessage());
    // Fallback到JSON
    $cases = [];
}

// ========== 2. MySQL无数据，fallback到JSON索引 ==========
if (empty($cases)) {
    $adminDir = dirname(dirname(__DIR__));
    $indexFile = $adminDir . '/data/cases-index.json';

    if (file_exists($indexFile)) {
        $cases = json_decode(file_get_contents($indexFile), true);
        if (!is_array($cases)) $cases = [];
    }

    // 过滤掉不存在的文件
    $dataDir = $adminDir . '/data/cases/';
    if (is_dir($dataDir)) {
        $valid = [];
        foreach ($cases as $c) {
            if (file_exists($dataDir . $c['id'] . '.json')) {
                $valid[] = $c;
            }
        }
        $cases = $valid;
    }
}

// 确保status字段
foreach ($cases as $k => $c) {
    if (!isset($c['status']) || empty($c['status'])) {
        $cases[$k]['status'] = 'draft';
    }
}

echo json_encode([
    'success' => true,
    'cases' => $cases,
    'total' => count($cases)
], JSON_UNESCAPED_UNICODE);
