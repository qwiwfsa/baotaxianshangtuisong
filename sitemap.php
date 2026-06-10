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
// Province hub pages
$slug_to_province_sitemap = [
    'an-hui' => '安徽', 'beijing' => '北京', 'chongqing' => '重庆',
    'fu-jian' => '福建', 'gan-su' => '甘肃', 'gang-ao-tai' => '港澳台',
    'guang-dong' => '广东', 'guang-xi' => '广西', 'gui-zhou' => '贵州',
    'hai-nan' => '海南', 'he-bei' => '河北', 'he-nan' => '河南',
    'hei-long-jiang' => '黑龙江', 'hu-bei' => '湖北', 'hu-nan' => '湖南',
    'ji-lin' => '吉林', 'jiang-su' => '江苏', 'jiang-xi' => '江西',
    'liao-ning' => '辽宁', 'nei-meng-gu' => '内蒙古', 'ning-xia' => '宁夏',
    'qing-hai' => '青海', 'shaan-xi' => '陕西', 'shan-dong' => '山东',
    'shan-xi' => '山西', 'shanghai' => '上海', 'si-chuan' => '四川',
    'tianjin' => '天津', 'xi-zang' => '西藏', 'xin-jiang' => '新疆',
    'yun-nan' => '云南', 'zhe-jiang' => '浙江',
];
foreach ($slug_to_province_sitemap as $pslug => $pname) {
    $url = 'https://www.yaozijin.com/fenzhan/province-' . $pslug . '.html';
?>
  <url><loc><?=$url?></loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
<?php } ?>
  <url><loc><?=$domain?>/category/shang-shi-gong-si/</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <url><loc><?=$domain?>/category/qi-ye-bai-zhang/</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <url><loc><?=$domain?>/category/xian-zhang-liang-zi/</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <url><loc><?=$domain?>/category/shi-jiao-yan-zi/</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <url><loc><?=$domain?>/category/guo-qiao-duan-chai/</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <url><loc><?=$domain?>/category/jin-rong-zhi-shi/</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>

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