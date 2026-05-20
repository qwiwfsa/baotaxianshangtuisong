<?php
/**
 * 导航菜单 - 服务端渲染
 * 从数据库直接输出导航HTML，无JS延迟，无闪烁
 * 使用方式：在 <ul class="nav-menu" role="menubar"> 内部 include 此文件
 */
require_once __DIR__ . '/../config/db.php';

$conn = getDB();

// 确保表存在
$conn->query("CREATE TABLE IF NOT EXISTS nav_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(20) NOT NULL,
    item_id VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    value TEXT,
    icon VARCHAR(100) DEFAULT '',
    item_type VARCHAR(50) DEFAULT '',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

// 查询导航项
$stmt = $conn->prepare("SELECT item_id, name, value AS url, icon FROM nav_settings WHERE type='nav' ORDER BY sort_order ASC");
$stmt->execute();
$result = $stmt->get_result();

$currentPage = $_SERVER['REQUEST_URI'] ?? '/';
// Normalize: /pages/xxx.html -> /xxx.html, remove query string
$currentPage = preg_replace('/^\/pages\//', '/', $currentPage);
$currentPage = strtok($currentPage, '?');

while ($row = $result->fetch_assoc()) {
    $url = htmlspecialchars($row['url'] ?? '#');
    $name = htmlspecialchars($row['name'] ?? '');
    $icon = htmlspecialchars($row['icon'] ?? '');

    // 判断 active
    $isActive = '';
    if ($url === '/') {
        if ($currentPage === '/' || $currentPage === '/index.php' || $currentPage === '/index.html') {
            $isActive = ' active';
        }
    } elseif ($currentPage === $url || str_replace('.html', '.php', $currentPage) === str_replace('.html', '.php', $url)) {
        $isActive = ' active';
    }

    $iconHTML = $icon ? '<i class="' . $icon . '"></i> ' : '';
    echo '<li role="none"><a href="' . $url . '" class="nav-link' . $isActive . '" role="menuitem">' . $iconHTML . $name . '</a></li>' . "\n";
}

$stmt->close();
$conn->close();
