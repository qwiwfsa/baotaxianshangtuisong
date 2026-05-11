<?php
/**
 * 手机端 - 案例列表API
 * 从MySQL读取已发布案例
 */

require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

try {
    $db = getDB();
    
    // 查询已发布的案例
    $result = $db->query("SELECT id, title, company, amount, period, category, description, image, content, status, sort_order, created_at, updated_at FROM cases WHERE status = 1 ORDER BY sort_order ASC, id DESC");
    $rows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    
    $cases = [];
    foreach ($rows as $row) {
        $contentData = json_decode($row['content'], true) ?: [];
        
        $case = [
            'id' => (string)$row['id'],
            'title' => $row['title'],
            'type' => $row['category'],
            'city' => $row['company'],
            'amount' => $row['amount'],
            'period' => $row['period'],
            'summary' => $row['description'],
            'image' => $row['image'] ? ltrim($row['image'], '/') : '',
            'coverImage' => $contentData['coverImage'] ?? $row['image'],
            'images' => $contentData['images'] ?? [],
            'detail' => $contentData['detail'] ?? $row['description'],
            'highlights' => $contentData['highlights'] ?? [],
            'process' => $contentData['process'] ?? [],
            'hasVideo' => $contentData['hasVideo'] ?? false,
            'video' => $contentData['video'] ?? '',
            'status' => 'published',
            'lastModified' => $row['updated_at']
        ];
        $cases[] = $case;
    }
    
    jsonSuccess([
        'cases' => $cases,
        'total' => count($cases)
    ]);
    
} catch (Exception $e) {
    jsonError('数据库查询失败: ' . $e->getMessage());
}
