<?php
/**
 * 数据库安装脚本
 * 访问此文件自动创建数据库和表
 */

// 数据库配置
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'hongdu_cms';

try {
    // 连接MySQL（不指定数据库）
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 创建数据库
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ 数据库创建成功: $dbname\n";
    
    // 使用数据库
    $pdo->exec("USE $dbname");
    
    // 创建pages表
    $pdo->exec("CREATE TABLE IF NOT EXISTS pages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        slug VARCHAR(50) NOT NULL UNIQUE,
        title VARCHAR(100) NOT NULL,
        content LONGTEXT,
        meta_description VARCHAR(255),
        meta_keywords VARCHAR(255),
        status TINYINT DEFAULT 1,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✓ pages表创建成功\n";
    
    // 创建cases表
    $pdo->exec("CREATE TABLE IF NOT EXISTS cases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        company VARCHAR(100),
        amount VARCHAR(50),
        period VARCHAR(50),
        category VARCHAR(50),
        description TEXT,
        content LONGTEXT,
        image VARCHAR(255),
        status TINYINT DEFAULT 1,
        sort_order INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✓ cases表创建成功\n";
    
    // 创建news表
    $pdo->exec("CREATE TABLE IF NOT EXISTS news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        summary TEXT,
        content LONGTEXT,
        category VARCHAR(50),
        cover_image VARCHAR(255),
        author VARCHAR(50),
        views INT DEFAULT 0,
        status TINYINT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✓ news表创建成功\n";
    
    // 创建media表
    $pdo->exec("CREATE TABLE IF NOT EXISTS media (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        original_name VARCHAR(255),
        file_path VARCHAR(255) NOT NULL,
        file_type VARCHAR(50),
        file_size INT,
        used_in VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✓ media表创建成功\n";
    
    // 创建users表
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        role VARCHAR(20) DEFAULT 'admin',
        last_login TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✓ users表创建成功\n";
    
    // 插入默认管理员
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
    $stmt->execute(['admin', $password, 'admin@hengdziben.com', 'admin']);
    echo "✓ 默认管理员账号创建成功 (admin/admin123)\n";
    
    // 插入默认页面
    $pages = [
        ['index', '首页', '<h1>专业资金解决方案</h1><p>提供上市公司短拆、企业摆账、银行存款、应收账款融资等全方位资金服务</p>', '宏都资本-专业资金业务服务商'],
        ['services', '业务范围', '<h1>业务范围</h1><p>涵盖上市公司、企业摆账、银行存款、应收账款融资等全方位资金服务</p>', '宏都资本业务范围'],
        ['cases', '成功案例', '<h1>成功案例</h1><p>多年来，我们已成功服务数百家企业，累计管理资金规模超百亿</p>', '宏都资本成功案例'],
        ['contact', '联系我们', '<h1>联系我们</h1><p>电话：13552883008</p>', '宏都资本联系方式']
    ];
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO pages (slug, title, content, meta_description, status) VALUES (?, ?, ?, ?, 1)");
    foreach ($pages as $page) {
        $stmt->execute($page);
    }
    echo "✓ 默认页面数据插入成功\n";
    
    echo "\n========================================\n";
    echo "数据库安装完成！\n";
    echo "========================================\n";
    echo "后台地址: http://localhost:8080/admin/\n";
    echo "账号: admin\n";
    echo "密码: admin123\n";
    
} catch (PDOException $e) {
    echo "安装失败: " . $e->getMessage() . "\n";
}
