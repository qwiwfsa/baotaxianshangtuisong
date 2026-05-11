<?php
/**
 * 文章分类API - 优化版本
 * 获取、创建、更新、删除分类
 */

// 全局错误处理 - 必须在任何其他代码之前设置
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $errstr]);
    exit;
});

set_exception_handler(function($e) {
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'message' => '服务器异常: ' . $e->getMessage()]);
    exit;
});

// 禁用错误输出到页面，确保始终返回JSON
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once __DIR__ . '/../config.php';

// 确保在任何输出之前设置header
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
// 分类缓存：禁止浏览器缓存，确保删除后即时生效

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

// 设置数据库连接超时
ini_set('default_socket_timeout', 3);

try {
    $conn = getDbConnection();
} catch (Exception $e) {
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => '数据库连接失败: ' . $e->getMessage()]);
    exit;
} catch (Error $e) {
    http_response_code(503);
    echo json_encode(['success' => false, 'message' => '系统错误: ' . $e->getMessage()]);
    exit;
}

switch ($method) {
    case 'GET':
        // 获取分类列表 - 包含SEO字段
        $result = $conn->query("SELECT id, name, description, seo_title, seo_keywords, seo_description, sort_order FROM cms_categories ORDER BY sort_order ASC, id ASC");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $categories]);
        break;
        
    case 'POST':
        // 创建分类
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        
        if (empty($data['name'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => '分类名称不能为空']);
            break;
        }
        
        $name = trim($data['name']);
        $description = isset($data['description']) ? trim($data['description']) : '';
        $seo_title = isset($data['seo_title']) ? trim($data['seo_title']) : '';
        $seo_keywords = isset($data['seo_keywords']) ? trim($data['seo_keywords']) : '';
        $seo_description = isset($data['seo_description']) ? trim($data['seo_description']) : '';
        $sortOrder = isset($data['sort_order']) ? intval($data['sort_order']) : 0;
        
        $stmt = $conn->prepare("INSERT INTO cms_categories (name, description, seo_title, seo_keywords, seo_description, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $name, $description, $seo_title, $seo_keywords, $seo_description, $sortOrder);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true, 
                'message' => '分类创建成功',
                'data' => ['id' => $stmt->insert_id]
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => '创建失败: ' . $stmt->error]);
        }
        $stmt->close();
        break;
        
    case 'PUT':
        // 更新分类（支持单个或批量排序更新）
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        
        // 批量排序更新：接收 { categories: [{id, sort_order}, ...] }
        if (isset($data['categories']) && is_array($data['categories'])) {
            $stmt = $conn->prepare("UPDATE cms_categories SET sort_order = ? WHERE id = ?");
            $updated = 0;
            foreach ($data['categories'] as $cat) {
                if (isset($cat['id']) && isset($cat['sort_order'])) {
                    $stmt->bind_param("ii", $cat['sort_order'], $cat['id']);
                    if ($stmt->execute()) {
                        $updated++;
                    }
                }
            }
            $stmt->close();
            echo json_encode(['success' => true, 'message' => "分类排序已更新（{$updated}条）"]);
            break;
        }
        
        // 单个分类更新
        $id = isset($data['id']) ? intval($data['id']) : 0;
        if ($id <= 0 || empty($data['name'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => '参数错误']);
            break;
        }
        
        $name = trim($data['name']);
        $description = isset($data['description']) ? trim($data['description']) : '';
        $seo_title = isset($data['seo_title']) ? trim($data['seo_title']) : '';
        $seo_keywords = isset($data['seo_keywords']) ? trim($data['seo_keywords']) : '';
        $seo_description = isset($data['seo_description']) ? trim($data['seo_description']) : '';
        $sortOrder = isset($data['sort_order']) ? intval($data['sort_order']) : 0;
        
        $stmt = $conn->prepare("UPDATE cms_categories SET name = ?, description = ?, seo_title = ?, seo_keywords = ?, seo_description = ?, sort_order = ? WHERE id = ?");
        $stmt->bind_param("sssssii", $name, $description, $seo_title, $seo_keywords, $seo_description, $sortOrder, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '分类更新成功']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => '更新失败: ' . $stmt->error]);
        }
        $stmt->close();
        break;
        
    case 'DELETE':
        // 删除分类
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        
        $id = isset($data['id']) ? intval($data['id']) : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => '缺少分类ID']);
            break;
        }
        
        // 先检查分类是否存在
        $checkExists = $conn->prepare("SELECT id FROM cms_categories WHERE id = ?");
        $checkExists->bind_param("i", $id);
        $checkExists->execute();
        $exists = $checkExists->get_result()->fetch_assoc();
        $checkExists->close();
        
        if (!$exists) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => '分类不存在']);
            break;
        }
        
        // 检查分类下是否有文章（含所有状态）
        $checkStmt = $conn->prepare("SELECT COUNT(*) as count, 
            SUM(CASE WHEN status != 'deleted' THEN 1 ELSE 0 END) as active_count 
            FROM cms_articles WHERE category_id = ?");
        $checkStmt->bind_param("i", $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result()->fetch_assoc();
        $totalCount = $checkResult['count'];
        $activeCount = $checkResult['active_count'];
        $checkStmt->close();
        
        // 如果有非删除状态的文章，提示用户
        if ($activeCount > 0) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => "该分类下还有 {$activeCount} 篇文章，无法删除。请先将文章移动到其他分类。"]);
            break;
        }
        
        // 如果有已删除的文章，先将其 category_id 置为 0
        if ($totalCount > 0) {
            $resetStmt = $conn->prepare("UPDATE cms_articles SET category_id = 0 WHERE category_id = ?");
            $resetStmt->bind_param("i", $id);
            $resetStmt->execute();
            $resetStmt->close();
        }
        
        // 执行删除
        $stmt = $conn->prepare("DELETE FROM cms_categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '分类删除成功']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => '删除失败: ' . $stmt->error]);
        }
        $stmt->close();
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => '不支持的请求方法']);
        break;
}

$conn->close();
