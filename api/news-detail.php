<?php
/**
 * 桌面端 - 文章详情API
 * 从MySQL的cms_articles表读取单篇文章
 */

require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少文章ID']);
    exit;
}

try {
    $db = getDB();
    
    // 获取文章详情
    $stmt = $db->prepare("SELECT a.*, c.name as category_name 
                          FROM cms_articles a 
                          LEFT JOIN cms_categories c ON a.category_id = c.id 
                          WHERE a.id = ? AND a.status = 'published'");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => '文章不存在']);
        exit;
    }
    
    $article = $result->fetch_assoc();
    $stmt->close();
    
    // 处理封面图片路径 - 统一返回相对于网站根目录的路径
    if ($article['cover_image']) {
        $coverImage = $article['cover_image'];
        if (strpos($coverImage, 'http') === 0) {
            // HTTP路径，保持不变
        } elseif (strpos($coverImage, '/') === 0) {
            // 已经是绝对路径
        } elseif (strpos($coverImage, 'uploads/') === 0) {
            // 数据库存的是 uploads/xxx.jpg，加/变成绝对路径
            $coverImage = '/' . $coverImage;
        } else {
            // 纯文件名，补上 uploads/
            $coverImage = '/uploads/' . ltrim($coverImage, '/');
        }
        $article['cover_image'] = $coverImage;
    }
    
    // 更新浏览量
    $updateStmt = $db->prepare("UPDATE cms_articles SET view_count = view_count + 1 WHERE id = ?");
    $updateStmt->bind_param('i', $id);
    $updateStmt->execute();
    $updateStmt->close();
    
    // 获取上一篇和下一篇
    $prevStmt = $db->prepare("SELECT id, title FROM cms_articles WHERE id < ? AND status = 'published' ORDER BY id DESC LIMIT 1");
    $prevStmt->bind_param('i', $id);
    $prevStmt->execute();
    $prevResult = $prevStmt->get_result();
    $article['prev'] = $prevResult->fetch_assoc();
    $prevStmt->close();
    
    $nextStmt = $db->prepare("SELECT id, title FROM cms_articles WHERE id > ? AND status = 'published' ORDER BY id ASC LIMIT 1");
    $nextStmt->bind_param('i', $id);
    $nextStmt->execute();
    $nextResult = $nextStmt->get_result();
    $article['next'] = $nextResult->fetch_assoc();
    $nextStmt->close();
    
    // 格式化日期
    $article['date'] = date('Y-m-d', strtotime($article['created_at']));
    
    jsonSuccess($article);
    
} catch (Exception $e) {
    jsonError('数据库查询失败: ' . $e->getMessage());
}
