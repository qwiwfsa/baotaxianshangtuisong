<?php
/**
 * 桌面端 - 行业资讯API
 * 从MySQL的cms_articles表读取已发布文章，支持分页
 */

require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

$categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
if ($page < 1) $page = 1;
if ($limit < 1 || $limit > 200) $limit = 50;
$offset = ($page - 1) * $limit;

$db = getDB();

// 获取总数
$countSql = "SELECT COUNT(*) as total FROM cms_articles WHERE status = 'published'";
if ($categoryId > 0) {
    $countSql .= " AND category_id = " . intval($categoryId);
}
$countResult = $db->query($countSql);
$total = 0;
if ($countResult) {
    $row = $countResult->fetch_assoc();
    $total = (int)$row['total'];
}

// 查询文章
$sql = "SELECT id, title, summary, content, cover_image, category_id, status, created_at, updated_at FROM cms_articles WHERE status = 'published'";
if ($categoryId > 0) {
    $sql .= " AND category_id = " . intval($categoryId);
}
$sql .= " ORDER BY updated_at DESC, created_at DESC LIMIT " . intval($limit) . " OFFSET " . intval($offset);

$result = $db->query($sql);
$rows = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

$news = [];
foreach ($rows as $row) {
    $coverImage = $row['cover_image'] ? ltrim($row['cover_image'], '/') : '';

    $news[] = [
        'id' => (int)$row['id'],
        'title' => $row['title'],
        'summary' => $row['summary'],
        'content' => $row['content'],
        'cover_image' => $coverImage,
        'category_id' => (int)$row['category_id'],
        'date' => date('Y-m-d', strtotime($row['created_at'])),
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        'status' => 'published'
    ];
}

// 获取分类列表
$catResult = $db->query("SELECT id, name FROM cms_categories ORDER BY sort_order ASC, id ASC");
$categories = [];
if ($catResult) {
    while ($cat = $catResult->fetch_assoc()) {
        $categories[] = $cat;
    }
}

jsonSuccess([
    'news' => $news,
    'total' => $total,
    'page' => $page,
    'limit' => $limit,
    'totalPages' => ceil($total / $limit),
    'categories' => $categories
]);
