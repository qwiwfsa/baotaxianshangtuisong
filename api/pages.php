<?php
/**
 * 页面管理API
 */

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$db = getDB();

switch ($method) {
    case 'GET':
        // 获取页面列表或单个页面
        if (isset($_GET['id'])) {
            // 获取单个页面
            $stmt = $db->prepare("SELECT * FROM pages WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $page = $stmt->fetch();
            
            if ($page) {
                response($page);
            } else {
                error('页面不存在', 404);
            }
        } elseif (isset($_GET['slug'])) {
            // 通过slug获取页面
            $stmt = $db->prepare("SELECT * FROM pages WHERE slug = ?");
            $stmt->execute([$_GET['slug']]);
            $page = $stmt->fetch();
            
            if ($page) {
                response($page);
            } else {
                error('页面不存在', 404);
            }
        } else {
            // 获取页面列表
            $stmt = $db->query("SELECT id, slug, title, status, sort_order, updated_at FROM pages ORDER BY sort_order, id");
            $pages = $stmt->fetchAll();
            response($pages);
        }
        break;
        
    case 'POST':
        // 创建新页面
        $input = getInput();
        
        if (empty($input['slug']) || empty($input['title'])) {
            error('slug和标题不能为空');
        }
        
        try {
            $stmt = $db->prepare("INSERT INTO pages (slug, title, content, meta_description, meta_keywords, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $input['slug'],
                $input['title'],
                $input['content'] ?? '',
                $input['meta_description'] ?? '',
                $input['meta_keywords'] ?? '',
                $input['status'] ?? 1,
                $input['sort_order'] ?? 0
            ]);
            
            $id = $db->lastInsertId();
            response(['id' => $id, 'message' => '页面创建成功']);
        } catch (PDOException $e) {
            error('创建失败: ' . $e->getMessage());
        }
        break;
        
    case 'PUT':
        // 更新页面
        $input = getInput();
        
        if (empty($input['id'])) {
            error('页面ID不能为空');
        }
        
        try {
            $stmt = $db->prepare("UPDATE pages SET title = ?, content = ?, meta_description = ?, meta_keywords = ?, status = ?, sort_order = ? WHERE id = ?");
            $stmt->execute([
                $input['title'] ?? '',
                $input['content'] ?? '',
                $input['meta_description'] ?? '',
                $input['meta_keywords'] ?? '',
                $input['status'] ?? 1,
                $input['sort_order'] ?? 0,
                $input['id']
            ]);
            
            response(['message' => '页面更新成功']);
        } catch (PDOException $e) {
            error('更新失败: ' . $e->getMessage());
        }
        break;
        
    case 'DELETE':
        // 删除页面
        $input = getInput();
        
        if (empty($input['id'])) {
            error('页面ID不能为空');
        }
        
        try {
            $stmt = $db->prepare("DELETE FROM pages WHERE id = ?");
            $stmt->execute([$input['id']]);
            
            response(['message' => '页面删除成功']);
        } catch (PDOException $e) {
            error('删除失败: ' . $e->getMessage());
        }
        break;
        
    default:
        error('不支持的请求方法', 405);
}
