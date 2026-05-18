<?php
/**
 * 城市分站 XML Sitemap 生成器
 * URL: /fenzhan/sitemap.xml
 */
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
require_once __DIR__ . '/../config/db.php';
if (!function_exists('getDbConnection')) {
    function getDbConnection() { return getDB(); }
}
// Province hub pages
$slug_to_province = [
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
foreach ($slug_to_province as $pslug => $pname) {
    $url = 'https://www.yaozijin.com/fenzhan/province-' . $pslug . '.html';
?>
  <url><loc><?php echo $url; ?></loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
<?php }
// City pages
try {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT slug, updated_at FROM fenzhan_cities WHERE is_active = 1 ORDER BY sort_order ASC, city_name ASC");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $url = 'https://www.yaozijin.com/fenzhan/' . htmlspecialchars($row['slug'], ENT_QUOTES, 'UTF-8') . '.html';
        $lastmod = date('Y-m-d', strtotime($row['updated_at'] ?? 'now'));
?>
  <url><loc><?php echo $url; ?></loc><lastmod><?php echo $lastmod; ?></lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>
<?php }
    $stmt->close();
    $conn->close();
} catch (Exception $e) {}
?>
</urlset>