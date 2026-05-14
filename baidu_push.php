<?php
// ==========================================
// 配置项（你不用改，我已经帮你填好了）
// ==========================================
$site     = 'https://www.yaozijin.com';
$token    = 'QxqqlCuYCvyjcTy2';
$api      = "http://data.zz.baidu.com/urls?site={$site}&token={$token}";
$max_push = 5; // 每天最多推5条，安全不超限


// ==========================================
// 你所有要推送的链接（已经全部修好）
// ==========================================
$all_urls = array(
    "https://www.yaozijin.com/news-detail.php?id=380",
    "https://www.yaozijin.com/news-detail.php?id=381",
    "https://www.yaozijin.com/news-detail.php?id=382",
    "https://www.yaozijin.com/news-detail.php?id=383",
    "https://www.yaozijin.com/news-detail.php?id=384",
    "https://www.yaozijin.com/news-detail.php?id=385",
    "https://www.yaozijin.com/news-detail.php?id=386",
    "https://www.yaozijin.com/news-detail.php?id=387",
    "https://www.yaozijin.com/news-detail.php?id=388",
    "https://www.yaozijin.com/news-detail.php?id=389",
    "https://www.yaozijin.com/news-detail.php?id=390",
    "https://www.yaozijin.com/news-detail.php?id=391",
    "https://www.yaozijin.com/news-detail.php?id=392",
    "https://www.yaozijin.com/news-detail.php?id=393",
    "https://www.yaozijin.com/news-detail.php?id=394",
    "https://www.yaozijin.com/news-detail.php?id=395",
    "https://www.yaozijin.com/news-detail.php?id=396",
    "https://www.yaozijin.com/news-detail.php?id=397",
    "https://www.yaozijin.com/news-detail.php?id=398",
    "https://www.yaozijin.com/news-detail.php?id=399",
    "https://www.yaozijin.com/news-detail.php?id=400",
    "https://www.yaozijin.com/news-detail.php?id=401",
    "https://www.yaozijin.com/news-detail.php?id=402",
    "https://www.yaozijin.com/news-detail.php?id=403",
    "https://www.yaozijin.com/news-detail.php?id=404",
    "https://www.yaozijin.com/news-detail.php?id=405",
    "https://www.yaozijin.com/news-detail.php?id=406",
    "https://www.yaozijin.com/news-detail.php?id=407",
    "https://www.yaozijin.com/news-detail.php?id=408",
    "https://www.yaozijin.com/news-detail.php?id=409",
    "https://www.yaozijin.com/news-detail.php?id=410",
    "https://www.yaozijin.com/news-detail.php?id=411",
    "https://www.yaozijin.com/news-detail.php?id=412",
    "https://www.yaozijin.com/news-detail.php?id=413",
    "https://www.yaozijin.com/news-detail.php?id=414",
    "https://www.yaozijin.com/news-detail.php?id=415",
    "https://www.yaozijin.com/news-detail.php?id=416",
    "https://www.yaozijin.com/news-detail.php?id=417",
    "https://www.yaozijin.com/news-detail.php?id=418",
    "https://www.yaozijin.com/news-detail.php?id=419",
    "https://www.yaozijin.com/news-detail.php?id=420",
    "https://www.yaozijin.com/news-detail.php?id=421",
    "https://www.yaozijin.com/news-detail.php?id=422",
    "https://www.yaozijin.com/news-detail.php?id=423",
    "https://www.yaozijin.com/news-detail.php?id=424",
    "https://www.yaozijin.com/news-detail.php?id=425",
    "https://www.yaozijin.com/news-detail.php?id=426",
    "https://www.yaozijin.com/news-detail.php?id=427",
    "https://www.yaozijin.com/news-detail.php?id=428",
    "https://www.yaozijin.com/news-detail.php?id=429",
    "https://www.yaozijin.com/news-detail.php?id=430",
    "https://www.yaozijin.com/news-detail.php?id=431",
    "https://www.yaozijin.com/news-detail.php?id=432",
    "https://www.yaozijin.com/news-detail.php?id=433",
    "https://www.yaozijin.com/news-detail.php?id=434",
    "https://www.yaozijin.com/news-detail.php?id=435",
    "https://www.yaozijin.com/news-detail.php?id=436",
    "https://www.yaozijin.com/news-detail.php?id=437",
    "https://www.yaozijin.com/news-detail.php?id=438",
    "https://www.yaozijin.com/news-detail.php?id=439",
    "https://www.yaozijin.com/news-detail.php?id=441",
    "https://www.yaozijin.com/news-detail.php?id=442",
    "https://www.yaozijin.com/news-detail.php?id=443",
    "https://www.yaozijin.com/news-detail.php?id=444",
    "https://www.yaozijin.com/news-detail.php?id=445",
    "https://www.yaozijin.com/news-detail.php?id=446",
    "https://www.yaozijin.com/news-detail.php?id=447",
    "https://www.yaozijin.com/news-detail.php?id=448",
    "https://www.yaozijin.com/news-detail.php?id=449",
    "https://www.yaozijin.com/news-detail.php?id=450",
    "https://www.yaozijin.com/news-detail.php?id=451",
    "https://www.yaozijin.com/news-detail.php?id=452",
    "https://www.yaozijin.com/news-detail.php?id=453",
    "https://www.yaozijin.com/news-detail.php?id=454",
    "https://www.yaozijin.com/news-detail.php?id=455",
    "https://www.yaozijin.com/news-detail.php?id=456",
    "https://www.yaozijin.com/news-detail.php?id=457",
    "https://www.yaozijin.com/news-detail.php?id=458",
    "https://www.yaozijin.com/news-detail.php?id=459",
    "https://www.yaozijin.com/news-detail.php?id=460",
    "https://www.yaozijin.com/news-detail.php?id=461",
    "https://www.yaozijin.com/news-detail.php?id=462",
    "https://www.yaozijin.com/news-detail.php?id=463",
    "https://www.yaozijin.com/news-detail.php?id=474",
    "https://www.yaozijin.com/news-detail.php?id=476",
    "https://www.yaozijin.com/news-detail.php?id=478",
    "https://www.yaozijin.com/news-detail.php?id=482",
    "https://www.yaozijin.com/news-detail.php?id=485",
    "https://www.yaozijin.com/news-detail.php?id=490",
    "https://www.yaozijin.com/news-detail.php?id=493",
    "https://www.yaozijin.com/news-detail.php?id=495",
    "https://www.yaozijin.com/news-detail.php?id=497",
    "https://www.yaozijin.com/news-detail.php?id=498",
    "https://www.yaozijin.com/news-detail.php?id=501",
    "https://www.yaozijin.com/news-detail.php?id=502",
    "https://www.yaozijin.com/news-detail.php?id=504",
    "https://www.yaozijin.com/news-detail.php?id=507",
    "https://www.yaozijin.com/news-detail.php?id=511",
    "https://www.yaozijin.com/news-detail.php?id=512",
    "https://www.yaozijin.com/news-detail.php?id=517",
    "https://www.yaozijin.com/news-detail.php?id=518",
    "https://www.yaozijin.com/news-detail.php?id=519",
    "https://www.yaozijin.com/news-detail.php?id=521",
    "https://www.yaozijin.com/news-detail.php?id=522",
    "https://www.yaozijin.com/news-detail.php?id=523",
    "https://www.yaozijin.com/news-detail.php?id=524",
    "https://www.yaozijin.com/news-detail.php?id=525",
    "https://www.yaozijin.com/news-detail.php?id=526",
    "https://www.yaozijin.com/news-detail.php?id=527",
    "https://www.yaozijin.com/news-detail.php?id=528",
    "https://www.yaozijin.com/news-detail.php?id=529",
    "https://www.yaozijin.com/news-detail.php?id=530",
    "https://www.yaozijin.com/news-detail.php?id=531",
    "https://www.yaozijin.com/news-detail.php?id=532",
    "https://www.yaozijin.com/news-detail.php?id=533",
    "https://www.yaozijin.com/news-detail.php?id=534",
    "https://www.yaozijin.com/news-detail.php?id=535",
    "https://www.yaozijin.com/news-detail.php?id=536",
    "https://www.yaozijin.com/news-detail.php?id=537",
    "https://www.yaozijin.com/news-detail.php?id=538",
    "https://www.yaozijin.com/news-detail.php?id=539",
    "https://www.yaozijin.com/news-detail.php?id=540",
    "https://www.yaozijin.com/news-detail.php?id=541",
    "https://www.yaozijin.com/news-detail.php?id=542",
    "https://www.yaozijin.com/news-detail.php?id=543",
    "https://www.yaozijin.com/news-detail.php?id=544",
    "https://www.yaozijin.com/news-detail.php?id=545",
    "https://www.yaozijin.com/news-detail.php?id=546"
);


// ==========================================
// 智能推送逻辑（自动去重 + 每天只推N条）
// ==========================================
$log_file = 'pushed_log.txt'; // 已推送记录
$pushed   = file_exists($log_file) ? file($log_file, FILE_IGNORE_NEW_LINES) : [];
$to_push  = array_diff($all_urls, $pushed);
$to_push  = array_slice($to_push, 0, $max_push);

if(empty($to_push)){
    die("✅ 今天没有需要推送的链接");
}

// 开始推送给百度
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $to_push),
    CURLOPT_HTTPHEADER => ['Content-Type: text/plain'],
]);

$result = curl_exec($ch);
$code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// 记录已推送
file_put_contents($log_file, implode("\n", $to_push)."\n", FILE_APPEND);

// 输出结果
echo "✅ 本次推送：".count($to_push)." 条\n";
echo "🔗 HTTP状态码：{$code}\n";
echo "📦 百度返回：{$result}\n";
echo "\n✅ 已自动记录，明天继续推下一批！";

curl_close($ch);
?>