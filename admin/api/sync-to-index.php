<?php
/**
 * 同步导航和页脚到 index.html
 * 调用方式: php /www/wwwroot/www.yaozijin.com/admin/api/sync-to-index.php
 */
require_once __DIR__ . '/config.php';

$conn = getDbConnection();

// 1. Sync navigation from nav_settings to index.html
$result = $conn->query("SELECT name, value FROM nav_settings WHERE type='nav' ORDER BY sort_order ASC");
$navHtml = '<ul class="nav-menu" role="menubar">';
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $navHtml .= '<li role="none"><a href="' . htmlspecialchars($row['value'] ?? '#') . '" class="nav-link" role="menuitem">' . htmlspecialchars($row['name'] ?? '') . '</a></li>';
    }
}
$navHtml .= '</ul>';

$indexFile = __DIR__ . '/../../../index.html';
if (file_exists($indexFile)) {
    $idx = file_get_contents($indexFile);
    $idx = preg_replace('/<ul class="nav-menu"[^>]*>.*?<\/ul>/s', $navHtml, $idx);
    if ($idx) file_put_contents($indexFile, $idx);
    echo "Nav synced to index.html\n";
}

// 2. Sync footer from includes/footer.php to index.html
$footerFile = __DIR__ . '/../../../includes/footer.php';
if (file_exists($indexFile) && file_exists($footerFile)) {
    ob_start();
    include $footerFile;
    $footerHtml = trim(ob_get_clean());
    if (!empty($footerHtml)) {
        if (strpos($footerHtml, '<footer') === false) {
            $footerHtml = '<footer class="footer">' . $footerHtml . '</footer>';
        }
        $idx = file_get_contents($indexFile);
        $idx = preg_replace('/<footer[^>]*>.*?<\/footer>/s', $footerHtml, $idx);
        if ($idx) file_put_contents($indexFile, $idx);
        echo "Footer synced to index.html\n";
    }
}

$conn->close();
echo "Done\n";
