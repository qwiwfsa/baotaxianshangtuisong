<?php
/**
 * 更新手机端导航 - 将数据库导航写入所有手机页面的静态HTML中
 * 消除JS异步加载导致的闪烁
 * 在 nav-save.php 保存导航后调用此脚本
 */
require_once __DIR__ . '/../../config/db.php';

$conn = getDB();

// 查询导航项
$stmt = $conn->prepare("SELECT item_id, name, value AS url, icon FROM nav_settings WHERE type='nav' ORDER BY sort_order ASC");
$stmt->execute();
$result = $stmt->get_result();

// 构建导航HTML（手机端使用相对路径，无图标）
$navHTML = '';
while ($row = $result->fetch_assoc()) {
    $url = htmlspecialchars($row['url'] ?? '#');
    $name = htmlspecialchars($row['name'] ?? '');

    // 手机端URL处理：绝对路径转为相对路径
    if (strpos($url, '/') === 0) {
        $url = $url === '/' ? 'index.html' : ltrim($url, '/');
    }

    $navHTML .= '<li role="none"><a href="' . $url . '" class="nav-link" role="menuitem">' . $name . '</a></li>' . "\n";
}
$stmt->close();
$conn->close();

// 手机端页面列表
$mobileDir = __DIR__ . '/../../mobile';
$pages = ['index.html', 'services.html', 'cases.html', 'advantages.html', 'news.html', 'faq.html', 'contact.html', 'case-detail.html', 'news-detail.html'];

$updated = 0;
foreach ($pages as $page) {
    $filepath = $mobileDir . '/' . $page;
    if (!file_exists($filepath)) continue;

    $content = file_get_contents($filepath);

    // 替换 <ul class="nav-menu" role="menubar" id="dynamicNavMenu">...</ul> 内的所有内容
    $pattern = '/(<ul\s+class="nav-menu"\s+role="menubar"\s+id="dynamicNavMenu"[^>]*>).*?(<\/ul>)/s';
    $replacement = '$1' . "\n" . $navHTML . '$2';

    $newContent = preg_replace($pattern, $replacement, $content);

    if ($newContent !== $content) {
        file_put_contents($filepath, $newContent);
        $updated++;
    }
}

echo "Updated {$updated} mobile pages with current nav.\n";
