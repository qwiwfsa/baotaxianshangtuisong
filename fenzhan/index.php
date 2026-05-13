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

// ---------- 生成最终HTML ----------
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
    <meta name="author" content="Yao资金网">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.yaozijin.com/fenzhan/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>.html">
    <title><?php echo $escapedTitle; ?></title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="all" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <link rel="stylesheet" href="/css/style.css?v=20260513e">
    <link rel="stylesheet" href="/css/page-custom.css?v=20260513e">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <base href="/">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "<?php echo $escapedCity; ?>资金服务 - Yao资金网",
        "description": "<?php echo $escapedDesc; ?>",
        "url": "https://www.yaozijin.com/fenzhan/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>.html",
        "telephone": "<?php echo $escapedPhone; ?>",
        "email": "wanglizhongguo@126.com",
        "areaServed": "<?php echo $escapedCity; ?>",
        "foundingDate": "2014"
    }
    </script>

    <!-- Logo动态加载 -->
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){
                        function fixPath(p){return p&&p.charAt(0)==='/'?p.substring(1):p;}
                        if(resp.data.header_logo){
                            var hl=document.querySelector('.logo img');
                            if(hl)hl.src=fixPath(resp.data.header_logo);
                        }
                        if(resp.data.footer_logo){
                            var fl=document.querySelector('.footer-logo img');
                            if(fl)fl.src=fixPath(resp.data.footer_logo);
                        }
                        if(resp.data.favicon){
                            var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');
                            if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}
                            lk.href=fixPath(resp.data.favicon);
                        }
                    }
                }catch(e){}
            }
        };
        xhr.send();
    })();
    </script>
</head>
<body>
    <!-- Skip to main content -->
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
            <a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu">
                <li role="none"><a href="index.html" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                <li role="none"><a href="advantages.html" class="nav-link" role="menuitem">核心优势</a></li>
                <li role="none"><a href="news.php" class="nav-link" role="menuitem">行业资讯</a></li>
                <li role="none"><a href="faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                <li role="none"><a href="contact.html" class="nav-link" role="menuitem">联系我们</a></li>
            </ul>

            <script>
                (function() {
                    var defaultNavItems = [
                        { id: '1', name: '首页', url: 'index.html', icon: 'fas fa-home' },
                        { id: '2', name: '业务范围', url: 'services.html', icon: 'fas fa-briefcase' },
                        { id: '3', name: '成功案例', url: 'cases.html', icon: 'fas fa-trophy' },
                        { id: '4', name: '核心优势', url: 'advantages.html', icon: 'fas fa-star' },
                        { id: '5', name: '行业资讯', url: 'news.html', icon: 'fas fa-newspaper' },
                        { id: '6', name: '常见问题', url: 'faq.html', icon: 'fas fa-question-circle' },
                        { id: '7', name: '联系我们', url: 'contact.html', icon: 'fas fa-phone' }
                    ];

                    function renderNav(items) {
                        var container = document.getElementById('dynamicNavMenu');
                        if (!container) return;
                        var currentPage = window.location.pathname.split('/').pop() || 'index.html';
                        container.innerHTML = items.map(function(item) {
                            var isActive = item.url === currentPage || (currentPage === '' && item.url === 'index.html');
                            return '<li role="none"><a href="' + item.url + '" class="nav-link' + (isActive ? ' active' : '') + '" role="menuitem">' + item.name + '</a></li>';
                        }).join('');
                        try { localStorage.setItem('cms_nav_items', JSON.stringify(items)); } catch(e) {}
                    }

                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'admin/api/nav-save.php?type=nav&t=' + Date.now(), true);
                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 400) {
                            try {
                                var resp = JSON.parse(xhr.responseText);
                                if (resp.code === 0 && resp.data && resp.data.length > 0) {
                                    renderNav(resp.data);
                                    return;
                                }
                            } catch(e) {}
                        }
                        try {
                            var stored = localStorage.getItem('cms_nav_items');
                            if (stored) {
                                var parsed = JSON.parse(stored);
                                if (Array.isArray(parsed) && parsed.length > 0) {
                                    renderNav(parsed);
                                    return;
                                }
                            }
                        } catch(e) {}
                        renderNav(defaultNavItems);
                    };
                    xhr.onerror = function() {
                        try {
                            var stored = localStorage.getItem('cms_nav_items');
                            if (stored) {
                                var parsed = JSON.parse(stored);
                                if (Array.isArray(parsed) && parsed.length > 0) {
                                    renderNav(parsed);
                                    return;
                                }
                            }
                        } catch(e) {}
                        renderNav(defaultNavItems);
                    };
                    xhr.send();
                })();
            </script>

            <button class="search-toggle" id="searchToggle" aria-label="搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false" aria-controls="navMenu">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div class="search-overlay" id="searchOverlay" role="search" aria-hidden="true">
            <div class="search-container">
                <form class="search-form" id="searchForm" action="#" method="get">
                    <input type="search" class="search-input" id="searchInput" placeholder="搜索业务、案例或资讯..." aria-label="搜索关键词">
                    <button type="submit" class="search-submit" aria-label="搜索"><i class="fas fa-search" aria-hidden="true"></i></button>
                </form>
                <div class="search-suggestions" id="searchSuggestions" aria-live="polite"></div>
                <button class="search-close" id="searchClose" aria-label="关闭搜索"><i class="fas fa-times" aria-hidden="true"></i></button>
            </div>
        </div>
    </nav>

    <main id="main-content">
    <!-- Hero区域 -->
    <section class="hero" id="home" aria-labelledby="hero-title">
        <div class="hero-container">
            <div class="hero-badge">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                <span>专业资金服务 · 值得信赖</span>
            </div>

            <h1 class="hero-title" id="hero-title"><?php echo $escapedCity; ?>专业资金服务商<br>助力企业稳健发展</h1>

            <p class="hero-subtitle"><?php echo $escapedCity; ?>企业一站式资金解决方案</p>

            <div class="hero-buttons">
                <div class="booking-wrapper" style="display:flex;align-items:center;gap:12px;">
                    <button class="btn btn-primary" onclick="togglePhoneDisplay()" style="display: inline-block;">立即咨询</button>
                    <span id="phoneDisplay" style="display: none; font-size: 18px; font-weight: 700; color: rgb(30, 58, 138); letter-spacing: 2px; white-space: nowrap; background: rgb(255, 255, 255); border-radius: 8px; padding: 8px 16px; box-shadow: rgba(0, 0, 0, 0.12) 0px 2px 8px;"><?php echo $escapedPhone; ?></span>
                </div>
            </div>

            <div class="stats" role="region" aria-label="公司数据统计">
                <div class="stat-card">
                    <div class="stat-number" data-target="10">10+</div>
                    <div class="stat-label">年行业经验</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="500">500+</div>
                    <div class="stat-label">服务企业</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="100">100亿+</div>
                    <div class="stat-label">资金规模</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="99">99%</div>
                    <div class="stat-label">客户好评</div>
                </div>
            </div>
        </div>
    </section>

<?php renderServicesSection($homepageContent, $city_name); ?>

    <!-- 城市专属区县服务范围 -->
    <?php echo $districtHtml; ?>

    <!-- 成功案例展示 -->
    <section class="cases-showcase" id="casesShowcase" aria-labelledby="cases-showcase-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">SUCCESS CASES</div>
                <h2 class="section-title" id="cases-showcase-title">成功案例</h2>
                <p class="section-subtitle">用事实彰显专业实力，累计服务500+企业客户</p>
            </div>
            <div class="cases-showcase-grid" id="casesShowcaseGrid"></div>
            <div class="cases-showcase-pagination" id="casesShowcasePagination" style="display:flex;">
                <button class="pagination-btn pagination-prev" id="prevPageBtn" onclick="changePage(-1)" title="上一页" disabled><span class="pagination-arrow">&lt;</span></button>
                <span class="pagination-info" id="paginationInfo">第 1 页 / 共 2 页</span>
                <button class="pagination-btn pagination-next" id="nextPageBtn" onclick="changePage(1)" title="下一页"><span class="pagination-arrow">&gt;</span></button>
            </div>
        </div>
    </section>

    <!-- 核心优势 -->
    <?php renderAdvantagesSection($homepageContent); ?>

<?php renderBankLogosSection(); ?>
<?php renderContactSection($city_name, $phone); ?>
<?php renderFaqSection($homepageContent, $phone); ?>
    </main>

    <!-- 右侧浮动电话按钮 -->
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="点击电话" aria-expanded="false">
            <i class="fas fa-phone-alt"></i>
        </button>
        <div class="chat-widget-phone-display">
            <span class="chat-widget-phone-text"><?php echo $escapedPhone; ?></span>
        </div>
    </div>

    <!-- 页脚 -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="/uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速导航</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">服务项目</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom" id="footerDynamicContainer">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>

    <script src="/js/footer-loader.js?v=20260513e"></script>
    <script src="/js/main.js?v=20260513e"></script>
    <script src="/js/cms.js?v=20260513e"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.nav-menu a').forEach(function(link) {
            link.classList.remove('active');
        });

        window.togglePhoneDisplay = function() {
            var el = document.getElementById('phoneDisplay');
            if (el) el.style.display = el.style.display === 'none' ? 'inline-block' : 'none';
        };

        var grid = document.getElementById('casesShowcaseGrid');
        if (grid) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/admin/api/cases-showcase.php?limit=6', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.code === 0 && resp.data && resp.data.length > 0) {
                            grid.innerHTML = resp.data.map(function(c) {
                                var img = c.image || 'uploads/case-default.jpg';
                                return '<article class="case-card-enhanced"><div class="case-card-image"><img src="' + img + '" alt="' + c.title + '" onerror="this.src=\'uploads/case-default.jpg\';this.onerror=null;"></div><div class="case-card-content"><h3 class="case-card-title" style="cursor:pointer;" onclick="window.location.href=\'case-detail.html?id=' + c.id + '\'">' + c.title + '</h3><p class="case-card-summary">' + (c.summary || '') + '</p></div></article>';
                            }).join('');
                        }
                    } catch(e) {}
                }
            };
            xhr.send();
        }
    });
    </script>
</body>
</html>
<?php
return ob_get_clean();
}

// ---------- 生成页面 ----------
$html = buildPage($escapedCity, $escapedPhone, $escapedTitle, $escapedKeywords, $escapedDesc, $districtHtml, $city_name, $slug);

// ---------- 写入缓存 ----------
if (!empty($cacheFile)) {
    file_put_contents($cacheFile, $html);
}

// ---------- 输出 ----------
echo $html;
