<?php
/**
 * CMS数据库配置文件
 * MySQL数据库连接配置
 */

// 使用统一数据库配置
require_once __DIR__ . '/../../config/db.php';

/**
 * 获取数据库连接（兼容旧代码）
 * @return mysqli
 * @throws Exception
 */
function getDbConnection() {
    return getDB();
}

/**
 * 初始化数据库表结构
 * @param mysqli $conn
 */
function initDatabase($conn) {
    // 创建CMS页面表
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

    // 创建CMS区块表
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

    // 插入默认页面数据
    $defaultPages = [
        ['index', '首页', 'Yao资金网 - 专业资金服务'],
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
    
    // 创建文章分类表
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

    // 创建文章表
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
    
    // 注意：不再自动插入默认分类，分类完全由用户管理
}
