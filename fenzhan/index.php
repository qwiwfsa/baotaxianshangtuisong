<?php
/**
 * 城市分站前端渲染模板
 * 100% 复用主站首页模板，动态替换城市名称变量
 * 含缓存、SEO优化、区县模块
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/common-content.php';

if (!function_exists('getDbConnection')) {
    function getDbConnection() { return getDB(); }
}

// ---------- 缓存配置 ----------
$cacheDir = __DIR__ . '/cache/';
$cacheTTL = 3600;
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if ($slug === '') {
    http_response_code(404);
    exit('Page not found');
}

// ---------- 加载城市数据 ----------
try {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM fenzhan_cities WHERE slug = ? AND is_active = 1");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt->close(); $conn->close();
        http_response_code(404);
        exit('Page not found');
    }
    $city = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    http_response_code(500);
    exit('Internal error');
}

// ---------- 缓存读取 ----------
if (!is_dir($cacheDir)) {
    @mkdir($cacheDir, 0755, true);
}
$cacheKey = preg_replace('/[^a-z0-9-]/', '', $slug);
$cacheFile = $cacheDir . $cacheKey . '.html';

if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTTL) {
    echo file_get_contents($cacheFile);
    exit;
}

// ---------- 城市变量 ----------
$city_name = $city['city_name'];
$phone = !empty($city['phone']) ? $city['phone'] : '13552883008';
$province = $city['province'] ?? '';

// ---------- SEO 自动生成 ----------
$page_title = $city_name . '资金_过桥短拆_实资摆账_资金证明 - Yao资金网';
$page_keywords = $city_name . '资金,' . $city_name . '过桥短拆,' . $city_name . '实资摆账,' . $city_name . '资金证明,' . $city_name . '大额亮资';
$page_description = '专业提供' . $city_name . '企业个人、过桥短拆实资摆账、资金证明、大额亮资等资金业务，快速安全，全国多地拥有丰富企业资源，口碑良好。';

if (!empty($city['title'])) $page_title = $city['title'];
if (!empty($city['keywords'])) $page_keywords = $city['keywords'];
if (!empty($city['description'])) $page_description = $city['description'];

// ---------- 区县数据加载 ----------
$districts = [];
$districtFile = __DIR__ . '/districts.json';
if (file_exists($districtFile)) {
    $allDistricts = json_decode(file_get_contents($districtFile), true) ?: [];
    if (isset($allDistricts[$city_name])) {
        $districts = $allDistricts[$city_name];
    } elseif (isset($allDistricts[$province])) {
        $districts = $allDistricts[$province];
    }
}

$escapedCity = htmlspecialchars($city_name, ENT_QUOTES, 'UTF-8');
$escapedPhone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$escapedTitle = htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8');
$escapedKeywords = htmlspecialchars($page_keywords, ENT_QUOTES, 'UTF-8');
$escapedDesc = htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8');

// ---------- 加载首页公共内容 ----------
$homepageContent = loadHomepageContent();

// ---------- 区县模块HTML ----------
$districtHtml = '';
if (!empty($districts)) {
    $districtHtml = '
    <!-- 城市专属服务范围 -->
    <section class="services" id="city-districts" style="padding-top:0;">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">LOCAL DISTRICTS</div>
                <h2 class="section-title">' . $escapedCity . '服务范围</h2>
                <p class="section-subtitle">覆盖' . $escapedCity . '全城，为您提供便捷的网点服务</p>
            </div>
            <div class="districts-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:12px;padding:20px 0;">';
    foreach ($districts as $d) {
        $dName = htmlspecialchars(trim($d), ENT_QUOTES, 'UTF-8');
        $districtHtml .= '<div style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:8px;padding:12px 16px;text-align:center;font-size:14px;color:#374151;">' . $dName . '</div>';
    }
    $districtHtml .= '
            </div>
        </div>
    </section>';
}

// ---------- 加载公共模板（若存在则使用，否则回退到内联模板） ----------
// 构建完整的页面主体HTML（包含所有PHP渲染的区块）
try {
    ob_start();
    ?>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
            <a href="/" class="logo"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu">
                <li><a href="/" class="nav-link">首页</a></li>
                <li><a href="/services.html" class="nav-link">业务范围</a></li>
                <li><a href="/cases.html" class="nav-link">成功案例</a></li>
                <li><a href="/advantages.html" class="nav-link">核心优势</a></li>
                <li><a href="/news.php" class="nav-link">行业资讯</a></li>
                <li><a href="/faq.html" class="nav-link">常见问题</a></li>
                <li><a href="/contact.html" class="nav-link">联系我们</a></li>
            </ul>
            <button class="search-toggle" id="searchToggle"><i class="fas fa-search"></i></button>
            <button class="mobile-menu-btn" id="mobileMenuBtn"><span></span><span></span><span></span></button>
        </div>
    </nav>
    <main id="main-content">
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-badge"><i class="fas fa-shield-alt"></i><span>专业资金服务 . 值得信赖</span></div>
            <h1 class="hero-title"><?php echo $escapedCity; ?>专业资金服务商<br>助力企业稳健发展</h1>
            <p class="hero-subtitle"><?php echo $escapedCity; ?>企业一站式资金解决方案</p>
            <div class="hero-buttons">
                <div class="booking-wrapper">
                    <button class="btn btn-primary" onclick="togglePhoneDisplay()">立即咨询</button>
                    <span id="phoneDisplay" style="display:none;font-size:18px;font-weight:700;color:rgb(30,58,138);"><?php echo $escapedPhone; ?></span>
                </div>
            </div>
            <div class="stats">
                <div class="stat-card"><div class="stat-number">10+</div><div class="stat-label">年行业经验</div></div>
                <div class="stat-card"><div class="stat-number">500+</div><div class="stat-label">服务企业</div></div>
                <div class="stat-card"><div class="stat-number">100亿+</div><div class="stat-label">资金规模</div></div>
                <div class="stat-card"><div class="stat-number">99%</div><div class="stat-label">客户好评</div></div>
            </div>
        </div>
    </section>
<?php renderServicesSection($homepageContent, $city_name); ?>
<?php echo $districtHtml; ?>
    <section class="cases-showcase" id="casesShowcase">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">SUCCESS CASES</div>
                <h2 class="section-title">成功案例</h2>
                <p class="section-subtitle">用事实彰显专业实力，累计服务500+企业客户</p>
            </div>
            <div class="cases-showcase-grid" id="casesShowcaseGrid"></div>
        </div>
    </section>
<?php renderAdvantagesSection($homepageContent); ?>
<?php renderBankLogosSection(); ?>
<?php renderContactSection($city_name, $phone); ?>
<?php renderFaqSection($homepageContent, $phone); ?>
    </main>
    <div class="chat-widget" id="chatWidget">
        <button class="chat-widget-btn" id="chatWidgetBtn"><i class="fas fa-phone-alt"></i></button>
        <div class="chat-widget-phone-display"><span><?php echo $escapedPhone; ?></span></div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand"><div class="footer-logo"><img src="/uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金网" style="height:48px;width:auto;"></div></div>
                <div class="footer-nav" data-footer-group="quick_links"><h4>快速导航</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="service_links"><h4>服务项目</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="contact"><h4>联系方式</h4><ul class="footer-nav-list"></ul></div>
            </div>
            <div class="footer-bottom"><p class="footer-copyright"></p><p class="footer-disclaimer"></p></div>
        </div>
    </footer>
    <script src="/js/footer-loader.js?v=20260513e"></script>
    <script src="/js/main.js?v=20260513e"></script>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        window.togglePhoneDisplay=function(){var e=document.getElementById('phoneDisplay');if(e)e.style.display=e.style.display==='none'?'inline-block':'none';};
        var g=document.getElementById('casesShowcaseGrid');
        if(g){var x=new XMLHttpRequest();x.open('GET','/admin/api/cases-showcase.php?limit=6',true);
        x.onload=function(){if(x.status>=200&&x.status<400){try{var r=JSON.parse(x.responseText);if(r.code===0&&r.data&&r.data.length>0){g.innerHTML=r.data.map(function(c){return '<article><div><img src=\"'+(c.image||'/uploads/case-default.jpg')+'\" alt=\"'+c.title+'\"></div><h3>'+c.title+'</h3><p>'+(c.summary||'')+'</p></article>';}).join('');}}catch(e){}}};x.send();}
    });
    </script>
<?php
        $bodyContent = ob_get_clean();
    } catch (Exception $e) {
        $bodyContent = '';
    }

$templateContent = null;
try {
    $tplConn = getDbConnection();
    $tplStmt = $tplConn->prepare("SELECT content FROM cms_sections WHERE page_id='city_template' AND section_id='body' LIMIT 1");
    $tplStmt->execute();
    $tplResult = $tplStmt->get_result();
    if ($tplRow = $tplResult->fetch_assoc()) {
        $templateContent = $tplRow['content'];
    }
    $tplStmt->close();
    $tplConn->close();
} catch (Exception $e) {
    $templateContent = null;
}

if (!empty($templateContent)) {
    $search = array('{{cityName}}', '{{cityPinyin}}', '{{cityPhone}}', '{{cityContent}}', '{{year}}');
    $replace = array(
        $escapedCity,
        htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'),
        $escapedPhone,
        $bodyContent,
        date('Y')
    );
    $html = str_replace($search, $replace, $templateContent);
} else {
    function buildPage($escapedCity, $escapedPhone, $escapedTitle, $escapedKeywords, $escapedDesc, $districtHtml, $city_name, $slug) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
        <meta name="description" content="<?php echo $escapedDesc; ?>">
        <meta name="keywords" content="<?php echo $escapedKeywords; ?>">
        <title><?php echo $escapedTitle; ?></title>
        <link rel="stylesheet" href="/css/style.css?v=20260513e">
        <link rel="stylesheet" href="/css/page-custom.css?v=20260513e">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <base href="/">
    </head>
    <body>
        <a href="#main-content" class="skip-link">跳转到主要内容</a>
        <nav class="navbar" id="navbar">
            <div class="navbar-container">
                <a href="/" class="logo"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;"></a>
                <ul class="nav-menu">
                    <li><a href="/">首页</a></li>
                    <li><a href="/services.html">业务范围</a></li>
                    <li><a href="/cases.html">成功案例</a></li>
                    <li><a href="/advantages.html">核心优势</a></li>
                    <li><a href="/news.php">行业资讯</a></li>
                    <li><a href="/faq.html">常见问题</a></li>
                    <li><a href="/contact.html">联系我们</a></li>
                </ul>
            </div>
        </nav>
        <main id="main-content">
        <section class="hero">
            <div class="hero-container">
                <h1><?php echo $escapedCity; ?>专业资金服务商</h1>
                <p><?php echo $escapedCity; ?>企业一站式资金解决方案</p>
                <button class="btn btn-primary" onclick="togglePhoneDisplay()">立即咨询</button>
                <span id="phoneDisplay" style="display:none;"><?php echo $escapedPhone; ?></span>
            </div>
        </section>
        <?php renderServicesSection($homepageContent, $city_name); ?>
        <?php echo $districtHtml; ?>
        <section class="cases-showcase">
            <div class="section-container">
                <h2>成功案例</h2>
                <div class="cases-showcase-grid" id="casesShowcaseGrid"></div>
            </div>
        </section>
        <?php renderAdvantagesSection($homepageContent); ?>
        <?php renderBankLogosSection(); ?>
        <?php renderContactSection($city_name, $phone); ?>
        <?php renderFaqSection($homepageContent, $phone); ?>
        </main>
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-brand"><div class="footer-logo"><img src="/uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金网" style="height:48px;"></div></div>
                <div class="footer-nav" data-footer-group="quick_links"><h4>快速导航</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="service_links"><h4>服务项目</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="contact"><h4>联系方式</h4><ul class="footer-nav-list"></ul></div>
            </div>
            <div class="footer-bottom"><p class="footer-copyright"></p></div>
        </footer>
        <script src="/js/footer-loader.js?v=20260513e"></script>
        <script src="/js/main.js?v=20260513e"></script>
    </body>
    </html>
    <?php
    return ob_get_clean();
    }
    $html = buildPage($escapedCity, $escapedPhone, $escapedTitle, $escapedKeywords, $escapedDesc, $districtHtml, $city_name, $slug);
}
// ---------- 写入缓存 ----------
if (!empty($cacheFile)) {
    file_put_contents($cacheFile, $html);
}

// ---------- 输出 ----------
echo $html;
