<?php
// ==========================================
// 百度收录推送（全站URL自动生成）
// ==========================================
$site     = 'https://www.yaozijin.com';
$token    = 'kpdoPMbbubR3edI2';
$api      = "http://data.zz.baidu.com/urls?site={$site}&token={$token}";
$max_push = 5; // 每天推5条，细水长流

// 连接数据库
require_once __DIR__ . '/config/db.php';
$db = getDB();

$all_urls = [];

// 1. 首页 + 核心页面
$all_urls[] = $site . '/';
$all_urls[] = $site . '/news.php';
$all_urls[] = $site . '/services.html';

// 2. 分类聚合页
$catResult = $db->query("SELECT slug FROM cms_categories WHERE slug IS NOT NULL AND slug != ''");
while ($r = $catResult->fetch_assoc()) {
    $all_urls[] = $site . '/category/' . $r['slug'] . '/';
}
$catResult->close();

// 3. 标签页
$tagResult = $db->query("SELECT slug FROM tags ORDER BY sort_order ASC, id ASC");
while ($r = $tagResult->fetch_assoc()) {
    if (preg_match('/^[a-z0-9_-]+$/', $r['slug'])) {
        $all_urls[] = $site . '/tag/' . $r['slug'];
    }
}
$tagResult->close();

// 4. 文章页
$artResult = $db->query("SELECT id FROM cms_articles WHERE status = 'published' ORDER BY id");
while ($r = $artResult->fetch_assoc()) {
    $all_urls[] = $site . '/news-detail.php?id=' . $r['id'];
}
$artResult->close();

// 5. 城市页
$cityResult = $db->query("SELECT slug FROM fenzhan_cities WHERE is_active = 1 ORDER BY sort_order ASC");
while ($r = $cityResult->fetch_assoc()) {
    $all_urls[] = $site . '/fenzhan/' . $r['slug'] . '.html';
}
$cityResult->close();

// 6. 省份页
$provinces = [
    'an-hui','beijing','chongqing','fu-jian','gan-su','gang-ao-tai',
    'guang-dong','guang-xi','gui-zhou','hai-nan','he-bei','he-nan',
    'hei-long-jiang','hu-bei','hu-nan','ji-lin','jiang-su','jiang-xi',
    'liao-ning','nei-meng-gu','ning-xia','qing-hai','shaan-xi','shan-dong',
    'shan-xi','shanghai','si-chuan','tianjin','xi-zang','xin-jiang',
    'yun-nan','zhe-jiang',
];
foreach ($provinces as $p) {
    $all_urls[] = $site . '/fenzhan/province-' . $p . '.html';
}

// 7. 服务+城市组合页（前30城市 × 6核心服务）
$services = ['bai-zhang-ye-mian','zi-jin-zheng-ming','dian-zi-guo-qiao','shang-shi-gong-si-duan-chai','gu-piao-zhi-ya','gong-cheng-liang-zi'];
$topCitiesResult = $db->query("SELECT slug FROM fenzhan_cities WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 30");
$topCities = [];
while ($r = $topCitiesResult->fetch_assoc()) { $topCities[] = $r['slug']; }
$topCitiesResult->close();
foreach ($topCities as $c) {
    foreach ($services as $s) {
        $all_urls[] = $site . '/fenzhan/' . $c . '/' . $s . '.html';
    }
}

$db->close();

// 去重
$all_urls = array_unique($all_urls);

// 读取已推送记录，只推未推送的
$log_file = __DIR__ . '/baidu_pushed_log.txt';
$pushed = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
$to_push = array_values(array_diff($all_urls, $pushed));
$to_push = array_slice($to_push, 0, $max_push);

echo "总 URL: " . count($all_urls) . "\n";
echo "未推送: " . count(array_diff($all_urls, $pushed)) . "\n";
echo "本次推: " . count($to_push) . "\n";

if (empty($to_push)) {
    echo "✅ 全部推送完成\n";
    exit;
}

// 推送给百度
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $to_push),
    CURLOPT_HTTPHEADER => ['Content-Type: text/plain'],
    CURLOPT_TIMEOUT => 10,
]);
$result = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 记录已推送
file_put_contents($log_file, implode("\n", $to_push) . "\n", FILE_APPEND);

echo "HTTP: {$code}\n";
echo "百度返回: {$result}\n";
echo "✅ 完成\n";
