<?php
/**
 * CMS API Configuration
 */
require_once __DIR__ . '/../../api/config.php';

/**
 * Legacy: get database connection
 * @return mysqli
 */
if (!function_exists('getDbConnection')) {
function getDbConnection() {
    return getDB();
}
}

/**
 * Initialize database structure
 * @param mysqli $conn
 */
if (!function_exists('initDatabase')) {
function initDatabase($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS cms_pages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_id VARCHAR(50) NOT NULL UNIQUE,
        page_name VARCHAR(100) NOT NULL,
        title VARCHAR(200),
        subtitle VARCHAR(200),
        content JSON,
        last_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS cms_sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_id VARCHAR(50) NOT NULL,
        section_id VARCHAR(50) NOT NULL,
        section_name VARCHAR(100),
        content TEXT,
        sort_order INT DEFAULT 0,
        FOREIGN KEY (page_id) REFERENCES cms_pages(page_id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);

    $defaultPages = [
        ['index', '首页', 'Yao资源金 - 专业资金服务'],
        ['services', '业务范围', '业务范围'],
        ['cases', '成功案例', '成功案例'],
        ['contact', '联系我们', '联系我们']
    ];

    $stmt = $conn->prepare("INSERT IGNORE INTO cms_pages (page_id, page_name, title) VALUES (?, ?, ?)");
    foreach ($defaultPages as $page) {
        $stmt->bind_param("sss", $page[0], $page[1], $page[2]);
        $stmt->execute();
    }
    $stmt->close();

    $sql = "CREATE TABLE IF NOT EXISTS cms_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description VARCHAR(255),
        seo_title VARCHAR(200) DEFAULT '',
        seo_keywords VARCHAR(255) DEFAULT '',
        seo_description TEXT,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS cms_articles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        summary TEXT,
        content LONGTEXT,
        category_id INT DEFAULT 0,
        cover_image VARCHAR(500),
        status ENUM('draft', 'published', 'deleted') DEFAULT 'draft',
        is_top TINYINT DEFAULT 0,
        sort_order INT DEFAULT 0,
        view_count INT DEFAULT 0,
        seo_title VARCHAR(200),
        seo_keywords VARCHAR(255),
        seo_description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);
}
}
