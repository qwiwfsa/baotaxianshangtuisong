<?php
/**
 * 动态生成 Sitemap XML
 */
header('Content-Type: application/xml; charset=utf-8');
header('X-Robots-Tag: noindex, follow');

require_once __DIR__ . '/config/db.php';

$domain = 'https://www.yaozijin.com';

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  
  <url><loc><?=$domain?>/</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
  <url><loc><?=$domain?>/services.html</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
  <url><loc><?=$domain?>/cases.html</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
  <url><loc><?=$domain?>/advantages.html</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
  <url><loc><?=$domain?>/news.php</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
  <url><loc><?=$domain?>/faq.html</loc><changefreq>weekly</changefreq><priority>0.6</priority></url>
  <url><loc><?=$domain?>/contact.html</loc><changefreq>monthly</changefreq><priority>0.5</priority></url>
  <url><loc><?=$domain?>/city.html</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
<?php
try {
    $db = getDB();

    // 文章
    $result = $db->query("SELECT id, updated_at FROM cms_articles WHERE status = 'published' ORDER BY updated_at DESC");
    while ($row = $result->fetch_assoc()) {
        $lastmod = date('Y-m-d', strtotime($row['updated_at']));
        echo "  <url><loc>{$domain}/news-detail.php?id={$row['id']}</loc><lastmod>{$lastmod}</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>
";
    }

    // 案例
    $result = $db->query("SELECT id, updated_at FROM cases ORDER BY updated_at DESC");
    while ($row = $result->fetch_assoc()) {
        $lastmod = date('Y-m-d', strtotime($row['updated_at']));
        echo "  <url><loc>{$domain}/case-detail.html?id={$row['id']}</loc><lastmod>{$lastmod}</lastmod><changefreq>monthly</changefreq><priority>0.6</priority></url>
";
    }

    // 城市分站
    $result = $db->query("SELECT slug, updated_at FROM fenzhan_cities WHERE is_active = 1 ORDER BY sort_order ASC");
    while ($row = $result->fetch_assoc()) {
        $lastmod = date('Y-m-d', strtotime($row['updated_at']));
        echo "  <url><loc>{$domain}/fenzhan/{$row['slug']}.html</loc><lastmod>{$lastmod}</lastmod><changefreq>weekly</changefreq><priority>0.6</priority></url>
";
    }

    // 标签
    $result = $db->query("SELECT slug FROM tags ORDER BY sort_order ASC");
    while ($row = $result->fetch_assoc()) {
        echo "  <url><loc>{$domain}/tag/{$row['slug']}</loc><changefreq>weekly</changefreq><priority>0.5</priority></url>
";
    }

    $db->close();
} catch (Exception $e) {}
?>
</urlset>