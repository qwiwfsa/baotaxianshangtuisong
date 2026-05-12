<?php
/**
 * 数据库迁移 - 为 cms_pages 表添加新字段
 * 新增: status, sort_order, seo_title, seo_keywords, seo_description, custom_url, page_type
 * 可通过CLI或HTTP运行
 */

$isCLI = (php_sapi_name() === 'cli');

if (!$isCLI) {
    header('Content-Type: application/json; charset=utf-8');
}

// 使用统一数据库配置（自动适配本地/服务器环境）
require_once dirname(__DIR__) . '/config.php';
$conn = getDB();

try {

    $messages = [];

    // 检查并添加 status 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'status'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN status ENUM('active','inactive') NOT NULL DEFAULT 'active' AFTER subtitle");
        $messages[] = "[OK] Added column: status";
    } else {
        $messages[] = "[SKIP] Column already exists: status";
    }

    // 检查并添加 sort_order 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'sort_order'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN sort_order INT NOT NULL DEFAULT 0 AFTER status");
        $messages[] = "[OK] Added column: sort_order";
    } else {
        $messages[] = "[SKIP] Column already exists: sort_order";
    }

    // 检查并添加 seo_title 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'seo_title'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN seo_title VARCHAR(200) DEFAULT '' AFTER sort_order");
        $messages[] = "[OK] Added column: seo_title";
    } else {
        $messages[] = "[SKIP] Column already exists: seo_title";
    }

    // 检查并添加 seo_keywords 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'seo_keywords'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN seo_keywords VARCHAR(500) DEFAULT '' AFTER seo_title");
        $messages[] = "[OK] Added column: seo_keywords";
    } else {
        $messages[] = "[SKIP] Column already exists: seo_keywords";
    }

    // 检查并添加 seo_description 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'seo_description'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN seo_description TEXT AFTER seo_keywords");
        $messages[] = "[OK] Added column: seo_description";
    } else {
        $messages[] = "[SKIP] Column already exists: seo_description";
    }

    // 检查并添加 custom_url 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'custom_url'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN custom_url VARCHAR(200) DEFAULT '' AFTER seo_description");
        $messages[] = "[OK] Added column: custom_url";
    } else {
        $messages[] = "[SKIP] Column already exists: custom_url";
    }

    // 检查并添加 page_type 列
    $result = $conn->query("SHOW COLUMNS FROM cms_pages LIKE 'page_type'");
    if ($result && $result->num_rows === 0) {
        $conn->query("ALTER TABLE cms_pages ADD COLUMN page_type VARCHAR(50) NOT NULL DEFAULT 'custom' AFTER custom_url");
        $messages[] = "[OK] Added column: page_type";
    } else {
        $messages[] = "[SKIP] Column already exists: page_type";
    }

    // 确保 page_builder_modules 表存在
    $conn->query("CREATE TABLE IF NOT EXISTS page_builder_modules (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_id VARCHAR(50) NOT NULL,
        module_type VARCHAR(50) NOT NULL,
        module_data JSON,
        sort_order INT DEFAULT 0,
        is_active TINYINT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_page_id (page_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    $messages[] = "[OK] Ensured table exists: page_builder_modules";

    // 更新现有系统页面的 page_type
    $conn->query("UPDATE cms_pages SET page_type = 'system' WHERE page_id IN ('index', 'services', 'cases', 'contact') AND (page_type = 'custom' OR page_type IS NULL OR page_type = '')");
    $messages[] = "[OK] Updated system page types";

    $conn->close();

    $messages[] = "[DONE] Migration completed successfully.";

    $output = implode("\n", $messages);

    if ($isCLI) {
        echo $output . "\n";
    } else {
        echo json_encode(['code' => 0, 'msg' => 'Migration completed', 'data' => ['messages' => $messages]], JSON_UNESCAPED_UNICODE);
    }

} catch (Exception $e) {
    if ($isCLI) {
        echo "Error: " . $e->getMessage() . "\n";
    } else {
        http_response_code(500);
        echo json_encode(['code' => 1, 'msg' => 'Migration failed: ' . $e->getMessage()], JSON_UNESCAPED_UNICODE);
    }
}
