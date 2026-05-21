<?php
require_once __DIR__ . '/../includes/logo.php';

$city_slug = trim($_GET['city'] ?? '');
$service_slug = trim($_GET['service'] ?? '');
if (!preg_match('/^[a-z0-9_-]+$/', $city_slug) || !preg_match('/^[a-z0-9_-]+$/', $service_slug)) {
    header('HTTP/1.0 404 Not Found');
    exit('404');
}

try {
    require_once __DIR__ . '/../config/db.php';
    $db = getDB();

    // Get city
    $stmt = $db->prepare("SELECT city_name, province, content FROM fenzhan_cities WHERE slug = ? AND is_active = 1 LIMIT 1");
    $stmt->bind_param('s', $city_slug);
    $stmt->execute();
    $cityResult = $stmt->get_result();
    $city = $cityResult->fetch_assoc();
    $stmt->close();

    if (!$city) {
        header('HTTP/1.0 404 Not Found');
        exit('404');
    }

    // Get service/tag
    $stmt = $db->prepare("SELECT id, name, content, seo_title, seo_keywords, seo_description FROM tags WHERE slug = ? LIMIT 1");
    $stmt->bind_param('s', $service_slug);
    $stmt->execute();
    $tagResult = $stmt->get_result();
    $tag = $tagResult->fetch_assoc();
    $stmt->close();

    if (!$tag) {
        header('HTTP/1.0 404 Not Found');
        exit('404');
    }

    $cityName = htmlspecialchars($city['city_name']);
    $svcName = htmlspecialchars($tag['name']);
    $pageTitle = !empty($tag['seo_title']) ? str_replace('{city}', $cityName, $tag['seo_title']) : $cityName . $svcName . '服务 - Yao资金网';
    $pageKeywords = !empty($tag['seo_keywords']) ? $cityName . ',' . $tag['seo_keywords'] : $cityName . ',' . $svcName . ',资金服务';
    $pageDescription = !empty($tag['seo_description']) ? str_replace('{city}', $cityName, $tag['seo_description']) : $cityName . '地区' . $svcName . '服务，专业资金服务解决方案';
    $cityContent = $city['content'] ?? '';
    $tagContent = $tag['content'] ?? '';

    $tagId = (int)$tag['id'];

    // Get related articles tagged with this service
    $artResult = $db->query("SELECT a.id, a.title, a.summary, a.created_at FROM cms_articles a JOIN article_tags at ON a.id = at.article_id WHERE at.tag_id = $tagId AND a.status = 'published' ORDER BY a.created_at DESC LIMIT 6");
    $articles = $artResult->fetch_all(MYSQLI_ASSOC);
    $artResult->close();

    $db->close();
} catch (Exception $e) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('500');
}

// Favicon path
$favicon_path = '/favicon-v2.png';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.yaozijin.com/fenzhan/<?php echo $city_slug; ?>/<?php echo $service_slug; ?>.html">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.min.css?v=20260519">
    <link rel="stylesheet" href="/css/page-custom.css?v=20260519">
    <script>(function(){var xhr=new XMLHttpRequest();xhr.open('GET','/admin/api/fetch-logo.php?t='+Date.now(),true);xhr.onload=function(){if(xhr.status>=200&&xhr.status<400){try{var resp=JSON.parse(xhr.responseText);if(resp.code===0&&resp.data){function fixPath(p){return p;}if(resp.data.header_logo){var hl=document.querySelector('.logo img');if(hl)hl.src=fixPath(resp.data.header_logo);}if(resp.data.footer_logo){var fl=document.querySelector('.footer-logo img');if(fl)fl.src=fixPath(resp.data.footer_logo);}if(resp.data.favicon){var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}lk.href=fixPath(resp.data.favicon);}}}catch(e){}}};xhr.send();})();</script>
    <meta name="baidu-site-verification" content="codeva-XY6IaVM2X4" />
    <meta name="360-site-verification" content="f310464a017d0090a59ed60edaa367e6" />
    <meta name="sogou_site_verification" content="hZk3RVI5el" />
    <meta name="shenma-site-verification" content="2c7c0059f1eb0bc344ff6f62104c6ee9_1779306988"/>
    <meta name="bytedance-verification-code" content="ax5xO1GtSFCBiE8fTWSz" />
    <meta name="msvalidate.01" content="A2A0A42C6A6A5562D58FA90EF4B0CCE6" />
<script>(function(){var el = document.createElement("script");el.src = "https://lf1-cdn-tos.bytegoofy.com/goofy/ttzz/push.js?3b035154874e19e664d8240b09e14e83e00fbc766c8f9a62fe69bf1753ce8548bc434964556b7d7129e9b750ed197d397efd7b0c6c715c1701396e1af40cec962b8d7c8c6655c9b00211740aa8a98e2e";el.id = "ttzz";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(el, s);})(window)</script>
<script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?93b7f42bd69c99e574dac7e18f9ab573";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script>
<style>
    .service-city-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 70px 0 50px; color: #fff; }
    .service-city-header .breadcrumb { display:flex; gap:8px; font-size:13px; color:rgba(255,255,255,0.7); margin-bottom:16px; flex-wrap:wrap; }
    .service-city-header .breadcrumb a { color:rgba(255,255,255,0.7); text-decoration:none; }
    .service-city-header .breadcrumb a:hover { color:#fff; }
    .service-city-header h1 { font-size:36px; font-weight:700; margin:0 0 12px; line-height:1.3; }
    .service-city-header p { font-size:16px; color:rgba(255,255,255,0.85); max-width:700px; line-height:1.6; margin:0; }
    .service-city-body { padding:40px 0; background:#f8fafc; }
    .service-city-body .section-container { max-width:1000px; margin:0 auto; padding:0 20px; }
    .service-city-content { background:#fff; border-radius:12px; padding:30px; margin-bottom:24px; box-shadow:0 1px 3px rgba(0,0,0,0.06); }
    .service-city-content h2 { font-size:22px; font-weight:600; color:#1f2937; margin:0 0 16px; padding-bottom:12px; border-bottom:2px solid #eff6ff; }
    .service-city-content h3 { font-size:17px; font-weight:600; color:#374151; margin:20px 0 10px; }
    .service-city-content p { font-size:15px; color:#4b5563; line-height:1.8; margin:0 0 12px; }
    .related-articles { background:#fff; border-radius:12px; padding:30px; box-shadow:0 1px 3px rgba(0,0,0,0.06); }
    .related-articles h2 { font-size:20px; font-weight:600; color:#1f2937; margin:0 0 16px; padding-bottom:12px; border-bottom:2px solid #eff6ff; }
    .article-item { padding:14px 0; border-bottom:1px solid #f3f4f6; display:flex; justify-content:space-between; align-items:center; }
    .article-item:last-child { border-bottom:none; }
    .article-item a { color:#1e3a8a; text-decoration:none; font-size:15px; }
    .article-item a:hover { text-decoration:underline; }
    .article-item time { font-size:13px; color:#9ca3af; white-space:nowrap; margin-left:16px; }
    .city-content-section { padding-top:0; }
    .tag-glossary p { font-size:15px; color:#4b5563; line-height:1.8; }
    @media (max-width:768px) {
        .service-city-header h1 { font-size:26px; }
        .service-city-header { padding:50px 0 40px; }
        .service-city-content { padding:20px; }
    }
</style>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
            <a href="/" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar"><?php include __DIR__ . "/../includes/nav.php"; ?></ul>
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false"><i class="fas fa-search" aria-hidden="true"></i></button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false"><span></span><span></span><span></span></button>
        </div>
    </nav>
    <main id="main-content">
        <section class="service-city-header">
            <div class="section-container" style="max-width:1000px;margin:0 auto;padding:0 20px;">
                <div class="breadcrumb">
                    <a href="/">首页</a>
                    <span>/</span>
                    <a href="/fenzhan/<?php echo $city_slug; ?>.html"><?php echo $cityName; ?>资金服务</a>
                    <span>/</span>
                    <span><?php echo $svcName; ?></span>
                </div>
                <h1><?php echo $cityName . $svcName . '服务'; ?></h1>
                <p>专业提供<?php echo $cityName; ?>地区<?php echo $svcName; ?>相关资金服务解决方案</p>
            </div>
        </section>
        <section class="service-city-body">
            <div class="section-container">
                <?php if (!empty($cityContent)): ?>
                <div class="service-city-content">
                    <?php echo $cityContent; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($tagContent)): ?>
                <div class="service-city-content">
                    <?php echo $tagContent; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($articles)): ?>
                <div class="related-articles">
                    <h2>相关资讯</h2>
                    <?php foreach ($articles as $a): ?>
                    <div class="article-item">
                        <a href="/news-detail.php?id=<?php echo (int)$a['id']; ?>"><?php echo htmlspecialchars($a['title']); ?></a>
                        <time><?php echo date('Y-m-d', strtotime($a['created_at'])); ?></time>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false"><i class="fas fa-phone-alt" aria-hidden="true"></i></button>
    </div>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="/js/main.min.js?v=20260519"></script>
</body>
</html>