<?php
/**
 * 文章列表API - 优化版本
 * 获取文章列表，支持分类筛选和分页
 */

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 获取参数
$category = isset($_GET['category']) ? intval($_GET['category']) : 0;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12;
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$status = isset($_GET['status']) ? $_GET['status'] : 'all';

// 限制每页数量
if ($limit < 1 || $limit > 50) $limit = 12; // 限制最大50条
if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

// 设置数据库连接超时
ini_set('default_socket_timeout', 3);

try {
    $conn = getDbConnection();
    // 只在表不存在时初始化，减少开销
    // initDatabase($conn); // 注释掉，避免每次请求都检查表
} catch (Exception $e) {
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => '数据库连接失败，请稍后重试']);
    exit;
}

// 构建查询
$where = ["status != 'deleted'"]; // 默认排除已删除的文章
$params = [];
$types = "";

if ($category > 0) {
    $where[] = "category_id = ?";
    $params[] = $category;
    $types .= "i";
}

if ($keyword) {
    $where[] = "(title LIKE ? OR summary LIKE ? OR content LIKE ?)";
    $searchTerm = "%$keyword%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "sss";
}

if ($status === 'published') {
    $where[] = "status = 'published'";
} elseif ($status === 'draft') {
    $where[] = "status = 'draft'";
} elseif ($status === 'deleted') {
    // 明确请求已删除文章时才显示
    $where = ["status = 'deleted'"];
    $params = [];
    $types = "";
}

$whereClause = implode(" AND ", $where);

// 获取总数 - 使用缓存减少查询
$cacheKey = "article_count_" . md5($whereClause . serialize($params));
$total = null;

// 简单的内存缓存（同一请求内）
static $countCache = [];
if (isset($countCache[$cacheKey])) {
    $total = $countCache[$cacheKey];
} else {
    $countSql = "SELECT COUNT(*) as total FROM cms_articles WHERE $whereClause";
    $stmt = $conn->prepare($countSql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $total = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();
    $countCache[$cacheKey] = $total;
}

// 获取文章列表 - 优化查询，只选择必要字段
$sql = "SELECT a.id, a.title, a.summary, a.category_id, a.cover_image, a.status, 
               a.is_top, a.sort_order, a.view_count, a.created_at, a.updated_at,
               c.name as category_name 
        FROM cms_articles a 
        LEFT JOIN cms_categories c ON a.category_id = c.id 
        WHERE $whereClause 
        ORDER BY a.is_top DESC, a.sort_order ASC, a.created_at DESC 
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$params[] = $limit;
$params[] = $offset;
$types .= "ii";
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$articles = [];
while ($row = $result->fetch_assoc()) {
    // 处理图片路径
    if ($row['cover_image']) {
        $row['cover_image'] = fixImagePath($row['cover_image']);
    }
    // 限制摘要长度，减少传输数据
    if ($row['summary'] && strlen($row['summary']) > 200) {
        $row['summary'] = mb_substr($row['summary'], 0, 200) . '...';
    }
    // 修复封面图片路径
    $row['cover_image'] = fixImagePath($row['cover_image']);
    $articles[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode([
    'success' => true,
    'data' => $articles,
    'pagination' => [
        'page' => $page,
        'limit' => $limit,
        'total' => $total,
        'totalPages' => ceil($total / $limit)
    ]
]);

/**
 * 修复图片路径
 * 封面图存储在 uploads/ 目录下
 * 从 admin/api/news/ 访问 uploads 需要 ../../../uploads/
 */
function fixImagePath($path) {
    if (empty($path)) return '';
    if (strpos($path, 'http') === 0) return $path;
    if (strpos($path, '/') === 0) return $path; // 已经是绝对路径
    // 数据库可能存的是 uploads/xxx.jpg，直接加/变成绝对路径
    if (strpos($path, 'uploads/') === 0) {
        return '/' . $path;
    }
    // 纯文件名，补上 uploads/ 目录
    return '/uploads/' . ltrim($path, '/');
}
