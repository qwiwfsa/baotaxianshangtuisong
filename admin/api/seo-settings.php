<?php
/**
 * SEO设置管理API
 * 管理整站和各页面的SEO设置
 * 数据表: seo_settings (MySQL)
 */

require_once __DIR__ . '/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    case 'OPTIONS':
        http_response_code(204);
        break;
    default:
        jsonResponse(1, '不支持的请求方法', null, 405);
}

/**
 * GET - 获取SEO设置
 * 无参数：获取所有页面设置
 * ?page_id=xxx：获取单个页面设置
 */
function handleGet() {
    try {
        $conn = getDbConnection();
        
        // 初始化表
        initSeoSettingsTable($conn);
        
        $pageId = isset($_GET['page_id']) ? trim($_GET['page_id']) : '';
        
        if ($pageId !== '') {
            // 获取单个页面
            $stmt = $conn->prepare("SELECT * FROM seo_settings WHERE page_id = ?");
            $stmt->bind_param("s", $pageId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();
            
            if ($row) {
                unset($row['id']);
                jsonResponse(0, 'success', $row);
            } else {
                jsonResponse(0, '未找到该页面设置', null);
            }
        } else {
            // 获取所有设置
            $result = $conn->query("SELECT * FROM seo_settings ORDER BY page_id ASC");
            $settings = [];
            while ($row = $result->fetch_assoc()) {
                unset($row['id']);
                $settings[] = $row;
            }
            jsonResponse(0, 'success', $settings);
        }
        
        $conn->close();
    } catch (Exception $e) {
        jsonResponse(1, '数据库错误: ' . $e->getMessage(), null, 500);
    }
}

/**
 * POST - 保存SEO设置（支持批量）
 * JSON body:
 * {
 *   "settings": [
 *     {"page_id": "global", "page_title": "...", "meta_keywords": "...", "meta_description": "..."},
 *     {"page_id": "index.html", ...},
 *     ...
 *   ]
 * }
 */
function handlePost() {
    try {
        $conn = getDbConnection();
        
        // 初始化表
        initSeoSettingsTable($conn);
        
        // 获取请求数据
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        $data = null;
        
        if (strpos($contentType, 'application/json') !== false) {
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
        }
        
        if (!$data || !isset($data['settings']) || !is_array($data['settings'])) {
            // 兼容单条保存
            $data = ['settings' => [$data]];
        }
        
        $settings = $data['settings'];
        if (empty($settings)) {
            jsonResponse(1, '没有要保存的数据');
        }
        
        $stmt = $conn->prepare(
            "INSERT INTO seo_settings (page_id, page_title, meta_keywords, meta_description, updated_at) 
             VALUES (?, ?, ?, ?, NOW()) 
             ON DUPLICATE KEY UPDATE 
             page_title = VALUES(page_title), 
             meta_keywords = VALUES(meta_keywords), 
             meta_description = VALUES(meta_description), 
             updated_at = NOW()"
        );
        
        $savedCount = 0;
        foreach ($settings as $item) {
            if (!isset($item['page_id']) || empty($item['page_id'])) {
                continue;
            }
            
            $pageId = trim($item['page_id']);
            $pageTitle = isset($item['page_title']) ? trim($item['page_title']) : '';
            $metaKeywords = isset($item['meta_keywords']) ? trim($item['meta_keywords']) : '';
            $metaDescription = isset($item['meta_description']) ? trim($item['meta_description']) : '';
            
            $stmt->bind_param("ssss", $pageId, $pageTitle, $metaKeywords, $metaDescription);
            if ($stmt->execute()) {
                $savedCount++;
            }
        }
        
        $stmt->close();
        
        // 获取更新后的所有设置
        $result = $conn->query("SELECT * FROM seo_settings ORDER BY page_id ASC");
        $allSettings = [];
        while ($row = $result->fetch_assoc()) {
            unset($row['id']);
            $allSettings[] = $row;
        }
        
        $conn->close();
        
        jsonResponse(0, '成功保存 ' . $savedCount . ' 条设置', $allSettings);
        
    } catch (Exception $e) {
        jsonResponse(1, '保存失败: ' . $e->getMessage(), null, 500);
    }
}

/**
 * 初始化seo_settings表
 */
function initSeoSettingsTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS seo_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_id VARCHAR(100) NOT NULL UNIQUE,
        page_title VARCHAR(255) DEFAULT '',
        meta_keywords TEXT,
        meta_description TEXT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);
    
    // 确保有整站默认设置
    $check = $conn->query("SELECT id FROM seo_settings WHERE page_id = 'global'");
    if ($check && $check->num_rows === 0) {
        $conn->query("INSERT INTO seo_settings (page_id, page_title, meta_keywords, meta_description) 
                      VALUES ('global', '', '', '')");
    }
}

/**
 * JSON响应
 */
function jsonResponse($code, $msg, $data = null, $httpCode = 200) {
    http_response_code($httpCode);
    header('Content-Type: application/json; charset=utf-8');
    $result = ['code' => $code, 'msg' => $msg];
    if ($data !== null) {
        $result['data'] = $data;
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
