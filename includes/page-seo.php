<?php
/**
 * 页面SEO - 读取后台SEO设置
 * 使用: include此文件后，$page_title, $page_keywords, $page_description 可用
 * page_id根据当前URL自动匹配 seo_settings 表
 */
$page_title = '';
$page_keywords = '';
$page_description = '';

// 从URL获取page_id (例: /news.php -> news.php, /mobile/index.html -> index.html)
$current_uri = $_SERVER['REQUEST_URI'] ?? '';
$page_id = basename(parse_url($current_uri, PHP_URL_PATH));
// Normalize: .php -> .html to match admin settings
$page_id = str_replace('.php', '.html', $page_id);
if ($page_id === 'index.html' && empty($page_id)) $page_id = 'index.html';
if (empty($page_id)) $page_id = 'index.html';

try {
    require_once __DIR__ . '/../config/db.php';
    $db = getDB();
    $stmt = $db->prepare("SELECT page_title, meta_keywords, meta_description FROM seo_settings WHERE page_id = ? LIMIT 1");
    $stmt->bind_param('s', $page_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['page_title'])) $page_title = $row['page_title'];
        if (!empty($row['meta_keywords'])) $page_keywords = $row['meta_keywords'];
        if (!empty($row['meta_description'])) $page_description = $row['meta_description'];
    }
    $stmt->close();
    $db->close();
} catch (Exception $e) {}

// Legacy bridge for pages using different variable names
$pageSeo = ['title' => $page_title, 'keywords' => $page_keywords, 'description' => $page_description];
$seo_title = $page_title;
$seo_keywords = $page_keywords;
$seo_desc = $page_description;
