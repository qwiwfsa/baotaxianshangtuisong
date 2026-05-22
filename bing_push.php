<?php
// ==========================================
// Bing 收录推送（全站URL自动生成）
// ==========================================
$site   = 'https://www.yaozijin.com';
$apiKey = 'aaa0e5f750fe48119eb88a3abbb503f6';
$api    = "https://ssl.bing.com/webmaster/api.svc/json/SubmitUrlBatch?apikey={$apiKey}";
$max    = 100; // Bing 每日配额 100 条

require_once __DIR__ . '/config/db.php';
$db = getDB();

$all_urls = [];

// 首页 + 核心页
$all_urls[] = $site . '/';
$all_urls[] = $site . '/news.php';
$all_urls[] = $site . '/services.html';

// 分类聚合页
$catResult = $db->query("SELECT slug FROM cms_categories WHERE slug IS NOT NULL AND slug != ''");
while ($r = $catResult->fetch_assoc()) {
    $all_urls[] = $site . '/category/' . $r['slug'] . '/';
}
$catResult->close();

// 标签页
$tagResult = $db->query("SELECT slug FROM tags ORDER BY sort_order ASC");
while ($r = $tagResult->fetch_assoc()) {
    if (preg_match('/^[a-z0-9_-]+$/', $r['slug'])) {
        $all_urls[] = $site . '/tag/' . $r['slug'];
    }
}
$tagResult->close();

// 文章页
$artResult = $db->query("SELECT id FROM cms_articles WHERE status = 'published' ORDER BY id");
while ($r = $artResult->fetch_assoc()) {
    $all_urls[] = $site . '/news-detail.php?id=' . $r['id'];
}
$artResult->close();

// 城市页
$cityResult = $db->query("SELECT slug FROM fenzhan_cities WHERE is_active = 1 ORDER BY sort_order ASC");
while ($r = $cityResult->fetch_assoc()) {
    $all_urls[] = $site . '/fenzhan/' . $r['slug'] . '.html';
}
$cityResult->close();

// 省份页
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

// 服务+城市组合页（前30城市 × 6核心服务）
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
$all_urls = array_unique($all_urls);

// 读取已推送记录，取未推送的
$log_file = __DIR__ . '/bing_pushed_log.txt';
$pushed = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
$to_push = array_values(array_diff($all_urls, $pushed));
$to_push = array_slice($to_push, 0, $max);

echo "总 URL: " . count($all_urls) . "\n";
echo "未推送: " . count(array_diff($all_urls, $pushed)) . "\n";
echo "本次推: " . count($to_push) . "\n";

if (empty($to_push)) {
    echo "✅ 全部推送完成\n";
    exit;
}

// 推送给 Bing（每次最多500条）
$chunks = array_chunk($to_push, 500);
foreach ($chunks as $chunk) {
    $data = json_encode([
        'siteUrl' => $site,
        'urlList' => $chunk,
    ]);

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_TIMEOUT => 30,
    ]);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP: {$code}\n";
    echo "Bing返回: {$result}\n";

    if ($code >= 400) break; // 失败就不继续
}

// 记录已推送
file_put_contents($log_file, implode("\n", $to_push) . "\n", FILE_APPEND);
echo "✅ 完成\n";
