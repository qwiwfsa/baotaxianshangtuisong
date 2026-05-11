<?php
/**
 * 文章列表API
 * 从数据库读取已发布文章，供前台展示
 */

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    $conn = getDB();
    
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $limit = isset($_GET['limit']) ? min(50, intval($_GET['limit'])) : 20;
    $offset = ($page - 1) * $limit;
    $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
    
    $where = "status = 'published'";
    $countParams = [];
    if ($category_id > 0) {
        $where .= " AND category_id = " . intval($category_id);
    }
    
    $countSql = "SELECT COUNT(*) as total FROM cms_articles WHERE {$where}";
    $countResult = $conn->query($countSql);
    $total = $countResult->fetch_assoc()['total'];
    
    $sql = "SELECT id, title, summary, LEFT(content, 300) as content, category_id, cover_image, 
                   created_at, updated_at, view_count
            FROM cms_articles 
            WHERE {$where}
            ORDER BY is_top DESC, created_at DESC 
            LIMIT " . intval($limit) . " OFFSET " . intval($offset);
    
    $result = $conn->query($sql);
    
    $articles = [];
    while ($row = $result->fetch_assoc()) {
        if (empty($row['summary'])) {
            $row['summary'] = strip_tags($row['content']);
        }
        unset($row['content']);
        $articles[] = $row;
    }
    
    $conn->close();
    
    echo json_encode([
        'code' => 0,
        'data' => $articles,
        'total' => (int)$total,
        'page' => $page,
        'limit' => $limit
    ], JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'code' => 1,
        'msg' => '获取文章列表失败: ' . $e->getMessage()
    ]);
}
