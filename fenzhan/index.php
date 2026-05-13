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
            <div class="cases-showcase-grid" id="casesShowcaseGrid">
                <!-- Case cards rendered by JS -->
            </div>

            <div class="cases-showcase-pagination" id="casesShowcasePagination">
                <button class="pagination-btn pagination-prev" id="prevPageBtn" onclick="changePage(-1)" title="上一页">
                    <span class="pagination-arrow">&lt;</span>
                </button>
                <span class="pagination-info" id="paginationInfo">第 1 页</span>
                <button class="pagination-btn pagination-next" id="nextPageBtn" onclick="changePage(1)" title="下一页">
                    <span class="pagination-arrow">&gt;</span>
                </button>
            </div>
        </div>
    </section>
<?php renderAdvantagesSection($homepageContent); ?>
<?php renderBankLogosSection(); ?>
<?php renderContactSection($city_name, $phone); ?>
    <section class="faq" id="faq" aria-labelledby="faq-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">FAQ</div>
                <h2 class="section-title" id="faq-title">常见问题</h2>
                <p class="section-subtitle">解答您关于资金业务的常见疑问</p>
            </div>
            <div class="faq-container">
                <?php
                try {
                    $faqC = getDbConnection();
                    $faqCats = [];
                    $catR = $faqC->query("SELECT cat_key, cat_label, sort_order FROM faq_categories ORDER BY sort_order ASC");
                    if ($catR) { while ($row = $catR->fetch_assoc()) { $faqCats[$row['cat_key']] = $row; } }
                    $faqItems = [];
                    $faqR = $faqC->query("SELECT id, category, question, answer, sort_order FROM faq WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
                    if ($faqR) {
                        while ($row = $faqR->fetch_assoc()) {
                            $cat = $row['category'] ?: 'general';
                            if (!isset($faqItems[$cat])) $faqItems[$cat] = [];
                            $faqItems[$cat][] = $row;
                        }
                    }
                    $catCfg = ['liangzi'=>['icon'=>'fa-lightbulb'],'guoqiao'=>['icon'=>'fa-exchange-alt'],'baizhang'=>['icon'=>'fa-university'],'receivable'=>['icon'=>'fa-file-invoice-dollar'],'deposit'=>['icon'=>'fa-building-columns'],'general'=>['icon'=>'fa-circle-question']];
                    $hasContent = false;
                    foreach ($catCfg as $k => $cfg) {
                        if (empty($faqItems[$k])) continue;
                        $hasContent = true;
                        $label = isset($faqCats[$k]) ? htmlspecialchars($faqCats[$k]['cat_label'], ENT_QUOTES, 'UTF-8') : $k;
                        echo '<div class="faq-category"><h3 class="faq-category-title"><i class="fas ' . $cfg['icon'] . '"></i> ' . $label . '</h3><div class="faq-list">';
                        foreach ($faqItems[$k] as $item) {
                            $q = htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8');
                            echo '<details class="faq-item"><summary class="faq-question">' . $q . '</summary><div class="faq-answer">' . $item['answer'] . '</div></details>';
                        }
                        echo '</div></div>';
                    }
                    if (!$hasContent) {
                        echo '<div class="faq-category"><h3 class="faq-category-title"><i class="fas fa-lightbulb"></i> 亮资业务</h3><div class="faq-list"><details class="faq-item"><summary class="faq-question">什么是亮资服务？</summary><div class="faq-answer"><p>亮资服务是指企业在投标、合作洽谈等场景中，需要向对方展示自身资金实力时，由专业机构提供的资金证明服务。</p></div></details></div></div>';
                    }
                    $faqC->close();
                } catch (Exception $e) {}
                ?>
            </div>
        </div>
    </section>
    </main>
    <div class="chat-widget" id="chatWidget">
        <button class="chat-widget-btn" id="chatWidgetBtn"><i class="fas fa-phone-alt"></i></button>
        <div class="chat-widget-phone-display"><span><?php echo $escapedPhone; ?></span></div>
    </div>
    <?php require_once __DIR__ . '/../includes/footer.php'; ?>
    <script src="/js/main.js?v=20260513e"></script>

    <!-- Cases Showcase Script -->
    <script>
    (function() {
        var C = [], P = 1, N = 8;
        async function F() {
            try {
                var r = await fetch('/api/cases.php?t=' + Date.now(), {method:'GET', headers:{'Accept':'application/json'}});
                if (!r.headers.get('content-type') || !r.headers.get('content-type').includes('application/json')) { E(); return; }
                var d = await r.json();
                if (d.success && d.cases && d.cases.length > 0) {
                    var seen = {};
                    C = d.cases.filter(function(c) { if (seen[c.id]) return false; seen[c.id] = true; return true; }).map(function(c) {
                        return {id:c.id, title:c.title, summary:c.summary||'', amount:c.amount||'', cover:c.coverImage||c.image||'/uploads/case-default.jpg'};
                    });
                    R(); U();
                } else { E(); }
            } catch(e) { E(); }
        }
        function R() {
            var g = document.getElementById('casesShowcaseGrid');
            if (!g) return;
            var s = (P-1)*N, e = s+N, p = C.slice(s, e);
            if (p.length === 0) { E(); return; }
            var h = '';
            for (var i = 0; i < p.length; i++) {
                var item = p[i];
                h += '<article class="case-card-enhanced" data-id="' + item.id + '">'
                    + '<div class="case-card-image" onclick="openLightbox(\'' + item.cover + '\')">'
                    + '<img src="' + item.cover + '" alt="' + item.title + '" onerror="this.src=\'/uploads/case-default.jpg\'"></div>'
                    + '<div class="case-card-content">'
                    + '<h3 class="case-card-title" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'" style="cursor:pointer">' + item.title + '</h3>'
                    + '<p class="case-card-summary" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'" style="cursor:pointer">' + item.summary + '</p>'
                    + '<div class="case-card-meta"><div class="case-card-amount" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'" style="cursor:pointer">'
                    + '<span class="case-card-amount-label">融资金额</span>'
                    + '<span class="case-card-amount-value">' + item.amount + '</span></div>'
                    + '<button class="btn-view-detail" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'">查看详情</button></div></div></article>';
            }
            g.innerHTML = h;
        }
        function E() {
            var g = document.getElementById('casesShowcaseGrid');
            if (g) g.innerHTML = '<div class="cases-showcase-empty"><i class="fas fa-folder-open"></i><p class="cases-showcase-empty-text">暂无成功案例，敬请期待</p></div>';
        }
        function U() {
            var t = Math.ceil(C.length / N);
            var prev = document.getElementById('prevPageBtn'), next = document.getElementById('nextPageBtn'), info = document.getElementById('paginationInfo');
            if (prev) prev.disabled = P <= 1;
            if (next) next.disabled = P >= t || t === 0;
            if (info) info.textContent = '第 ' + P + ' 页 / 共 ' + (t || 1) + ' 页';
            var pag = document.getElementById('casesShowcasePagination');
            if (pag) pag.style.display = t <= 1 ? 'none' : 'flex';
        }
        window.changePage = function(d) {
            var t = Math.ceil(C.length / N);
            var np = P + d;
            if (np >= 1 && np <= t) { P = np; R(); U(); var el = document.getElementById('casesShowcase'); if (el) el.scrollIntoView({behavior:'smooth', block:'start'}); }
        };
        window.openLightbox = function(src) {
            var lb = document.getElementById('imageLightbox'), li = document.getElementById('lightboxImage');
            if (li) li.src = src; if (lb) { lb.style.display = 'flex'; document.body.style.overflow = 'hidden'; }
        };
        window.closeLightbox = function() {
            var lb = document.getElementById('imageLightbox');
            if (lb) { lb.style.display = 'none'; document.body.style.overflow = ''; }
        };
        document.addEventListener('click', function(e) { if (e.target === document.getElementById('imageLightbox')) closeLightbox(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeLightbox(); });
        document.addEventListener('DOMContentLoaded', F);
    })();
    </script>

    <div id="imageLightbox" class="lightbox-overlay" style="display:none;">
        <div class="lightbox-container">
            <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
            <img id="lightboxImage" src="" alt="图片预览">
        </div>
    </div>

    <style>
        .lightbox-overlay{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);z-index:9999;display:flex;align-items:center;justify-content:center;animation:fadeIn .3s ease;}
        @keyframes fadeIn{from{opacity:0}to{opacity:1}}
        .lightbox-container{position:relative;max-width:90%;max-height:90%;}
        .lightbox-container img{max-width:100%;max-height:90vh;object-fit:contain;border-radius:4px;}
        .lightbox-close{position:absolute;top:-50px;right:0;width:40px;height:40px;background:rgba(255,255,255,0.2);border:none;border-radius:50%;color:#fff;font-size:20px;cursor:pointer;}
        .lightbox-close:hover{background:rgba(255,255,255,0.4);}
        .case-card-image{cursor:pointer;}
        .case-card-image img{transition:transform .3s ease;}
        .case-card-image:hover img{transform:scale(1.05);}
        .cases-showcase-empty{text-align:center;padding:60px 20px;color:#94a3b8;grid-column:1/-1;}
        .cases-showcase-empty i{font-size:48px;display:block;margin-bottom:16px;}
        .cases-showcase-pagination{display:flex;justify-content:center;align-items:center;gap:16px;margin-top:32px;}
        .pagination-btn{padding:8px 20px;background:#fff;border:1px solid #e2e8f0;border-radius:8px;color:#475569;cursor:pointer;font-size:14px;transition:all .2s;}
        .pagination-btn:hover:not(:disabled){border-color:#3b82f6;color:#3b82f6;background:#f0f5ff;}
        .pagination-btn:disabled{opacity:.4;cursor:not-allowed;}
        .pagination-info{font-size:14px;color:#64748b;min-width:140px;text-align:center;}
    </style>
        <script>
    document.addEventListener('DOMContentLoaded',function(){
        window.togglePhoneDisplay=function(){var e=document.getElementById('phoneDisplay');if(e)e.style.display=e.style.display==='none'?'inline-block':'none';};
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
        <section class="cases-showcase" id="casesShowcase">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">SUCCESS CASES</div>
                    <h2 class="section-title">成功案例</h2>
                    <p class="section-subtitle">用真实案例证明专业实力，累计服务500+企业客户</p>
                </div>
                <div class="cases-showcase-grid" id="casesShowcaseGrid">
                </div>
                <div class="cases-showcase-pagination" id="casesShowcasePagination">
                    <button class="pagination-btn pagination-prev" id="prevPageBtn" onclick="changePage(-1)" title="上一页">
                        <span class="pagination-arrow">&lt;</span>
                    </button>
                    <span class="pagination-info" id="paginationInfo">第 1 页</span>
                    <button class="pagination-btn pagination-next" id="nextPageBtn" onclick="changePage(1)" title="下一页">
                        <span class="pagination-arrow">&gt;</span>
                    </button>
                </div>
            </div>
        </section>
        <?php renderAdvantagesSection($homepageContent); ?>
        <?php renderBankLogosSection(); ?>
        <?php renderContactSection($city_name, $phone); ?>
        <?php
                try {
                    $faqConn = getDbConnection();
                    $faqCats = [];
                    $catResult = $faqConn->query("SELECT cat_key, cat_label, sort_order FROM faq_categories ORDER BY sort_order ASC");
                    if ($catResult) {
                        while ($row = $catResult->fetch_assoc()) {
                            $faqCats[$row['cat_key']] = $row;
                        }
                    }

                    $faqItems = [];
                    $faqResult = $faqConn->query("SELECT id, category, question, answer, sort_order FROM faq WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
                    if ($faqResult) {
                        while ($row = $faqResult->fetch_assoc()) {
                            $cat = $row['category'] ?: 'general';
                            if (!isset($faqItems[$cat])) $faqItems[$cat] = [];
                            $faqItems[$cat][] = $row;
                        }
                    }

                    $categoryConfig = [
                        'liangzi'   => ['icon' => 'fa-lightbulb'],
                        'guoqiao'   => ['icon' => 'fa-exchange-alt'],
                        'baizhang'  => ['icon' => 'fa-university'],
                        'receivable'=> ['icon' => 'fa-file-invoice-dollar'],
                        'deposit'   => ['icon' => 'fa-building-columns'],
                        'general'   => ['icon' => 'fa-circle-question'],
                    ];

                    $hasContent = false;
                    foreach ($categoryConfig as $key => $cfg) {
                        if (empty($faqItems[$key])) continue;
                        $hasContent = true;
                        $label = isset($faqCats[$key]) ? htmlspecialchars($faqCats[$key]['cat_label'], ENT_QUOTES, 'UTF-8') : $key;
                        echo '<div class="faq-category">';
                        echo '<h3 class="faq-category-title"><i class="fas ' . $cfg['icon'] . '" aria-hidden="true"></i> ' . $label . '</h3>';
                        echo '<div class="faq-list">';
                        foreach ($faqItems[$key] as $item) {
                            $q = htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8');
                            echo '<details class="faq-item">';
                            echo '<summary class="faq-question">' . $q . '</summary>';
                            echo '<div class="faq-answer">' . $item['answer'] . '</div>';
                            echo '</details>';
                        }
                        echo '</div></div>';
                    }

                    if (!$hasContent) {
                        $fallback = [
                            'liangzi' => ['icon' => 'fa-lightbulb', 'label' => '亮资业务', 'items' => [
                                ['q' => '什么是亮资服务？', 'a' => '<p>亮资服务是指企业在投标、合作洽谈等场景中，需要向对方展示自身资金实力时，由专业机构提供的资金证明服务。</p>'],
                                ['q' => '亮资需要多长时间？', 'a' => '<p>一般情况下，亮资服务可在1-3个工作日内完成，具体时间根据金额大小和银行要求而定。</p>'],
                            ]],
                            'guoqiao' => ['icon' => 'fa-exchange-alt', 'label' => '过桥资金', 'items' => [
                                ['q' => '过桥资金的利率是多少？', 'a' => '<p>过桥资金利率根据金额、期限、风险等因素综合确定，一般在月息1%-3%之间。</p>'],
                                ['q' => '过桥资金最长可以使用多久？', 'a' => '<p>过桥资金通常为短期资金周转，使用期限一般在1-6个月，最长不超过1年。</p>'],
                            ]],
                        ];
                        foreach ($fallback as $key => $fb) {
                            echo '<div class="faq-category">';
                            echo '<h3 class="faq-category-title"><i class="fas ' . $fb['icon'] . '" aria-hidden="true"></i> ' . $fb['label'] . '</h3>';
                            echo '<div class="faq-list">';
                            foreach ($fb['items'] as $item) {
                                echo '<details class="faq-item">';
                                echo '<summary class="faq-question">' . $item['q'] . '</summary>';
                                echo '<div class="faq-answer">' . $item['a'] . '</div>';
                                echo '</details>';
                            }
                            echo '</div></div>';
                        }
                    }
                    $faqConn->close();
                } catch (Exception $e) {
                    // Silent fail
                }
                ?>
        </main>
        <?php require_once __DIR__ . '/../includes/footer.php'; ?>
        <script src="/js/main.js?v=20260513e"></script>

    <!-- Cases Showcase Script -->
    <script>
    (function() {
        var casesData = [], currentPage = 1, perPage = 8;
        async function fetchCases() {
            try {
                var r = await fetch('/api/cases.php?t=' + Date.now(), {method:'GET', headers:{'Accept':'application/json'}});
                if (!r.headers.get('content-type') || !r.headers.get('content-type').includes('application/json')) { showEmpty(); return; }
                var d = await r.json();
                if (d.success && d.cases && d.cases.length > 0) {
                    var seen = {};
                    casesData = d.cases.filter(function(c) { if (seen[c.id]) return false; seen[c.id] = true; return true; }).map(function(c) {
                        return {id:c.id, title:c.title, summary:c.summary||'暂无简介', amount:c.amount||'面议', cover:c.coverImage||c.image||'/uploads/case-default.jpg'};
                    });
                    render(); updatePagination();
                } else { showEmpty(); }
            } catch(e) { showEmpty(); }
        }
        function render() {
            var g = document.getElementById('casesShowcaseGrid');
            if (!g) return;
            var start = (currentPage-1)*perPage, end = start+perPage, page = casesData.slice(start, end);
            if (page.length === 0) { showEmpty(); return; }
            var html = '';
            for (var i = 0; i < page.length; i++) {
                var item = page[i];
                html += '<article class="case-card-enhanced" data-id="' + item.id + '">'
                    + '<div class="case-card-image" onclick="openLightbox(\'' + item.cover + '\')">'
                    + '<img src="' + item.cover + '" alt="' + item.title + '" onerror="this.src=\'/uploads/case-default.jpg\'"></div>'
                    + '<div class="case-card-content">'
                    + '<h3 class="case-card-title" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'" style="cursor:pointer">'
                    + item.title + '</h3>'
                    + '<p class="case-card-summary" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'" style="cursor:pointer">'
                    + item.summary + '</p>'
                    + '<div class="case-card-meta"><div class="case-card-amount" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'" style="cursor:pointer">'
                    + '<span class="case-card-amount-label">融资金额</span>'
                    + '<span class="case-card-amount-value">' + item.amount + '</span></div>'
                    + '<button class="btn-view-detail" onclick="window.location.href=\'case-detail.html?id=' + item.id + '\'">查看详情</button></div></div></article>';
            }
            g.innerHTML = html;
        }
        function showEmpty() {
            var g = document.getElementById('casesShowcaseGrid');
            if (g) g.innerHTML = '<div class="cases-showcase-empty"><i class="fas fa-folder-open"></i><p class="cases-showcase-empty-text">暂无成功案例，敬请期待</p></div>';
        }
        function updatePagination() {
            var total = Math.ceil(casesData.length / perPage);
            var prev = document.getElementById('prevPageBtn'), next = document.getElementById('nextPageBtn'), info = document.getElementById('paginationInfo');
            if (prev) prev.disabled = currentPage <= 1;
            if (next) next.disabled = currentPage >= total || total === 0;
            if (info) info.textContent = '第 ' + currentPage + ' 页 / 共 ' + (total || 1) + ' 页';
            var pag = document.getElementById('casesShowcasePagination');
            if (pag) pag.style.display = total <= 1 ? 'none' : 'flex';
        }
        window.changePage = function(d) {
            var total = Math.ceil(casesData.length / perPage);
            var np = currentPage + d;
            if (np >= 1 && np <= total) {
                currentPage = np; render(); updatePagination();
                var el = document.getElementById('casesShowcase');
                if (el) el.scrollIntoView({behavior:'smooth', block:'start'});
            }
        };
        window.openLightbox = function(src) {
            var lb = document.getElementById('imageLightbox'), li = document.getElementById('lightboxImage');
            if (li) li.src = src; if (lb) { lb.style.display = 'flex'; document.body.style.overflow = 'hidden'; }
        };
        window.closeLightbox = function() {
            var lb = document.getElementById('imageLightbox');
            if (lb) { lb.style.display = 'none'; document.body.style.overflow = ''; }
        };
        document.addEventListener('click', function(e) { if (e.target === document.getElementById('imageLightbox')) closeLightbox(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeLightbox(); });
        document.addEventListener('DOMContentLoaded', fetchCases);
    })();
    </script>

    <div id="imageLightbox" class="lightbox-overlay" style="display:none;">
        <div class="lightbox-container">
            <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
            <img id="lightboxImage" src="" alt="图片预览">
        </div>
    </div>

    <style>
        .lightbox-overlay{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);z-index:9999;display:flex;align-items:center;justify-content:center;animation:fadeIn .3s ease;}
        @keyframes fadeIn{from{opacity:0}to{opacity:1}}
        .lightbox-container{position:relative;max-width:90%;max-height:90%;}
        .lightbox-container img{max-width:100%;max-height:90vh;object-fit:contain;border-radius:4px;}
        .lightbox-close{position:absolute;top:-50px;right:0;width:40px;height:40px;background:rgba(255,255,255,0.2);border:none;border-radius:50%;color:#fff;font-size:20px;cursor:pointer;}
        .lightbox-close:hover{background:rgba(255,255,255,0.4);}
        .case-card-image{cursor:pointer;}
        .case-card-image img{transition:transform .3s ease;}
        .case-card-image:hover img{transform:scale(1.05);}
        .cases-showcase-empty{text-align:center;padding:60px 20px;color:#94a3b8;grid-column:1/-1;}
        .cases-showcase-empty i{font-size:48px;display:block;margin-bottom:16px;}
        .cases-showcase-pagination{display:flex;justify-content:center;align-items:center;gap:16px;margin-top:32px;}
        .pagination-btn{padding:8px 20px;background:#fff;border:1px solid #e2e8f0;border-radius:8px;color:#475569;cursor:pointer;font-size:14px;transition:all .2s;}
        .pagination-btn:hover:not(:disabled){border-color:#3b82f6;color:#3b82f6;background:#f0f5ff;}
        .pagination-btn:disabled{opacity:.4;cursor:not-allowed;}
        .pagination-info{font-size:14px;color:#64748b;min-width:140px;text-align:center;}
    </style>

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
