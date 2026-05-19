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
// ---------- 省份拼音映射 ----------
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

// 检测是否省份页（必须在 city query 之前）
$is_province_page = false;
$province_name = '';
$province_slug_param = '';
if (strpos($slug, 'province-') === 0) {
    $province_slug_param = substr($slug, 9);
    if (isset($slug_to_province[$province_slug_param])) {
        $is_province_page = true;
        $province_name = $slug_to_province[$province_slug_param];
    }
}


// ---------- 加载城市数据 ----------
if (!$is_province_page) {
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
} else {
    // 省份页：使用空数据，城市列表由 province hero 渲染
    $city = [
        'city_name' => $province_name,
        'phone' => '13552883008',
        'province' => $province_name,
        'content' => '',
        'title' => '',
        'keywords' => '',
        'description' => '',
    ];
}// ---------- 缓存读取 ----------
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
$province_to_slug = array_flip($slug_to_province);
$province_slug = '';
if (!empty($province) && isset($province_to_slug[$province])) {
    $province_slug = $province_to_slug[$province];
} elseif (!empty($city_name) && isset($province_to_slug[$city_name])) {
    // 直辖市/单列市：城市名本身就是省份 slug
    $province_slug = $province_to_slug[$city_name];
}
$city_content = $city['content'] ?? '';


// ---------- 区县数据加载 ----------
$districts = [];
try {
    $dc = getDbConnection();
    $ds = $dc->prepare("SELECT district_name FROM city_districts WHERE city_name = ? ORDER BY sort_order ASC");
    $ds->bind_param("s", $city_name);
    $ds->execute();
    $dr = $ds->get_result();
    while ($drow = $dr->fetch_assoc()) {
        $districts[] = $drow['district_name'];
    }
    $ds->close();
    $dc->close();
} catch (Exception $e) {
    $districts = [];
}

$escapedCity = htmlspecialchars($city_name, ENT_QUOTES, 'UTF-8');
$escapedPhone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
// 默认 SEO
$page_title = !empty($city['title']) ? $city['title'] : $city_name . '资金服务_过桥短拆_实资摆账_资金证明 - Yao资金网';
$page_keywords = !empty($city['keywords']) ? $city['keywords'] : $city_name . '资金,' . $city_name . '过桥短拆,' . $city_name . '实资摆账,' . $city_name . '资金证明';
$page_description = !empty($city['description']) ? $city['description'] : '专业提供' . $city_name . '、' . $province . '地区企业个人、过桥短拆实资摆账、资金证明、大额亮资等资金业务，快速安全。';
// 省份页 SEO 覆盖
if ($is_province_page) {
    $page_title = $province_name . '资金服务_过桥短拆_实资摆账_资金证明 - Yao资金网';
    $page_keywords = $province_name . '资金,' . $province_name . '过桥短拆,' . $province_name . '实资摆账,' . $province_name . '资金证明';
    $page_description = '专业提供' . $province_name . '全省各地企业个人、过桥短拆实资摆账、资金证明、大额亮资等资金业务，覆盖全省各市县，快速安全。';
}
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
            <div class="districts-grid" class="districts-grid">';
    foreach ($districts as $d) {
        $dName = htmlspecialchars(trim($d), ENT_QUOTES, 'UTF-8');
        $districtHtml .= '<div class="district-item">' . $dName . '</div>';
    }
    $districtHtml .= '
            </div>
        </div>
    </section>';
}

// ---------- 加载公共模板（目前仅使用，后期可编辑模板） ----------
// 以下生成城市页面HTML主体内容（包含PHP渲染逻辑块）
try {
    ob_start();
    ?>

        <a href="#main-content" class="skip-link">跳转到主要内容</a>
        <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img loading="lazy" src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu">
                <!-- 动态菜单将在这里加载 -->
            </ul>

            <script src="/js/nav-loader.js?v=4" defer></script>

            <!-- 搜索按钮 -->
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false" aria-controls="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- 搜索层 -->
        <div class="search-overlay" id="searchOverlay" role="search" aria-hidden="true">
            <div class="search-container">
                <form class="search-form" id="searchForm" action="#" method="get">
                    <input type="search" class="search-input" id="searchInput" placeholder="搜索业务、文章或资讯..." aria-label="搜索关键词">
                    <button type="submit" class="search-submit" aria-label="搜索">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </form>
                <div class="search-suggestions" id="searchSuggestions" aria-live="polite"></div>
                <button class="search-close" id="searchClose" aria-label="关闭搜索">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </nav>
        <main id="main-content">
        <nav class="breadcrumb-nav" aria-label="面包屑导航">
            <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="/" itemprop="item"><span itemprop="name">首页</span></a>
                    <meta itemprop="position" content="1">
                </li>
                <?php if ($is_province_page): ?>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>资金服务</span>
                    <meta itemprop="position" content="2">
                </li>
                <?php else: ?>
                <?php if (!empty($province)): ?>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="/fenzhan/province-<?php echo htmlspecialchars($province_slug, ENT_QUOTES, 'UTF-8'); ?>.html" itemprop="item"><span itemprop="name"><?php echo htmlspecialchars($province, ENT_QUOTES, 'UTF-8'); ?>资金服务</span></a>
                    <meta itemprop="position" content="2">
                </li>
                <?php endif; ?>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="/fenzhan/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>.html" itemprop="item"><span itemprop="name"><?php echo htmlspecialchars($city_name, ENT_QUOTES, 'UTF-8'); ?>资金服务</span></a>
                    <meta itemprop="position" content="3">
                </li>
                <?php endif; ?>
            </ol>
        </nav>
                <?php if ($is_province_page): ?>
        <section class="province-hero">
            <div class="section-container">
                <div class="province-hero-header">
                    <div class="section-label">PROVINCE SERVICE</div>
                    <h1 class="province-hero-title"><?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>资金服务</h1>
                    <p class="province-hero-subtitle">覆盖<?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>全省各市县，专业企业资金服务</p>
                </div>
                <div class="province-city-list">
                    <?php
                    $pcConn = getDbConnection();
                    $pcStmt = $pcConn->prepare("SELECT city_name, slug FROM fenzhan_cities WHERE province = ? AND is_active = 1 ORDER BY sort_order ASC, city_name ASC");
                    $pcStmt->bind_param('s', $province_name);
                    $pcStmt->execute();
                    $pcResult = $pcStmt->get_result();
                    while ($pcRow = $pcResult->fetch_assoc()):
                        $pcName = htmlspecialchars($pcRow['city_name'], ENT_QUOTES, 'UTF-8');
                        $pcSlug = htmlspecialchars($pcRow['slug'], ENT_QUOTES, 'UTF-8');
                    ?>
                    <a href="/fenzhan/<?php echo $pcSlug; ?>.html" class="province-city-item">
                        <div class="province-city-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <span class="province-city-name"><?php echo $pcName; ?></span>
                    </a>
                    <?php endwhile; $pcConn->close(); ?>
                </div>
                <div class="province-description">
                    <h2 class="province-description-title"><?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>全省资金服务</h2>
                    <p class="province-description-text"><?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>资金服务网覆盖全省各市县，专业提供过桥短拆、实资摆账、资金证明、大额亮资等企业资金服务。凭借多年行业经验和雄厚的资金实力，为<?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>地区企业提供高效、安全、专业的资金解决方案。</p>
                    <p class="province-description-text">服务范围涵盖<?php echo htmlspecialchars($province_name, ENT_QUOTES, 'UTF-8'); ?>全省所有区县，最快当天放款，额度灵活，手续简便。专业团队一对一服务，确保资金安全、流程合规。</p>
                </div>
            </div>
        </section><?php else: ?>
        <section class="hero" id="home" aria-labelledby="hero-title">
            <div class="hero-container">
                <div class="hero-badge">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <span>专业资金服务商 · 值得信赖</span>
                </div>
                <h1 class="hero-title" id="hero-title"><?php
                    $ht = $homepageContent['heroTitle'] ?? '专业资金服务商\n助力企业稳健发展';
                    echo nl2br(htmlspecialchars($escapedCity . $ht));
                ?></h1>
                <p class="hero-subtitle"><?php
                    $hs = $homepageContent['heroSubtitle'] ?? '企业一站式资金解决方案';
                    echo htmlspecialchars($escapedCity . '地区' . $hs);
                ?></p>
                <div class="hero-buttons">
                    <div class="booking-wrapper" style="display:flex;align-items:center;gap:12px;">
                        <button class="btn btn-primary" id="consultNowBtn" onclick="togglePhoneDisplay()" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-phone-alt"></i> 立即咨询
                        </button>
                        <span id="phoneDisplay" style="display:none;font-size:18px;font-weight:700;color:#1e3a8a;letter-spacing:2px;white-space:nowrap;background:#fff;border-radius:8px;padding:8px 16px;box-shadow:0 2px 8px rgba(0,0,0,0.12);"><?php echo $escapedPhone; ?></span>
                    </div>
                </div>
                <?php
                $heroStats = [
                    ['number' => $homepageContent['stat1Number'] ?? '10+', 'label' => $homepageContent['stat1Label'] ?? '行业经验'],
                    ['number' => $homepageContent['stat2Number'] ?? '500+', 'label' => $homepageContent['stat2Label'] ?? '服务企业'],
                    ['number' => $homepageContent['stat3Number'] ?? '30亿+', 'label' => $homepageContent['stat3Label'] ?? '资金规模'],
                    ['number' => $homepageContent['stat4Number'] ?? '99%', 'label' => $homepageContent['stat4Label'] ?? '客户满意度'],
                ];
                ?>
                <div class="stats" role="region" aria-label="公司数据统计">
                    <?php foreach ($heroStats as $s): ?>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo htmlspecialchars($s['number']); ?></div>
                        <div class="stat-label"><?php echo htmlspecialchars($s['label']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php renderServicesSection($homepageContent, $city_name); ?>
        <?php echo $districtHtml; ?>
        <?php if (!empty($city_content)): ?>
        <section class="city-content-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">CITY INSIGHTS</div>
                    <h2 class="section-title"><?php echo htmlspecialchars($city_name); ?>深度解读</h2>
                    <p class="section-subtitle">深入了解<?php echo htmlspecialchars($city_name); ?>经济环境与资金市场特点</p>
                </div>
                <div class="city-content-wrapper">
                    <div class="city-content-card">
                        <div class="city-content-body">
                        <?php echo $city_content; ?>
                    </div>
                        </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if (!$is_province_page && !empty($province)):
            $sibConn = getDbConnection();
            $sibStmt = $sibConn->prepare("SELECT city_name, slug FROM fenzhan_cities WHERE province = ? AND slug != ? AND is_active = 1 ORDER BY sort_order ASC, city_name ASC LIMIT 20");
            $sibStmt->bind_param('ss', $province, $slug);
            $sibStmt->execute();
            $sibResult = $sibStmt->get_result();
            if ($sibResult->num_rows > 0):
        ?>
        <section class="city-related-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">RELATED CITIES</div>
                    <h2 class="section-title">同省城市</h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($province, ENT_QUOTES, 'UTF-8'); ?>其他城市资金服务</p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;padding:20px 0;justify-content:center;">
                    <?php while ($sibRow = $sibResult->fetch_assoc()):
                        $sibName = htmlspecialchars($sibRow['city_name'], ENT_QUOTES, 'UTF-8');
                        $sibSlug = htmlspecialchars($sibRow['slug'], ENT_QUOTES, 'UTF-8');
                    ?>
                    <a href="/fenzhan/<?php echo $sibSlug; ?>.html" style="display:block;padding:16px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#374151;font-size:14px;font-weight:500;text-align:center;transition:all 0.2s;" onmouseover="this.style.borderColor='#3b82f6';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#e5e7eb';this.style.background='#f8fafc'">
                        <?php echo $sibName; ?>
                    </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php endif; endif; if (isset($sibConn)) $sibConn->close(); ?>
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

        <section class="page-content" style="padding-top:0;">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">FAQ</div>
                    <h2 class="section-title">常见问题</h2>
                    <p class="section-subtitle">为您解答资金业务中的常见疑问</p>
                </div>
        
        <div class="faq-grid">
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
                        echo '<div class="faq-custom-category" data-category="' . $key . '">';
                        echo '<h3 class="faq-custom-category-title"><i class="fas ' . $cfg['icon'] . '" aria-hidden="true"></i> ' . $label . '</h3>';
                        echo '<div class="faq-custom-list">';
                        foreach ($faqItems[$key] as $item) {
                            $q = htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8');
                            echo '<details class="faq-custom-item">';
                            echo '<summary class="faq-custom-question"><span>' . $q . '</span><i class="fas fa-chevron-down"></i></summary>';
                            echo '<div class="faq-custom-answer">' . $item['answer'] . '</div>';
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
                            echo '<div class="faq-custom-category" data-category="' . $key . '">';
                            echo '<h3 class="faq-custom-category-title"><i class="fas ' . $fb['icon'] . '" aria-hidden="true"></i> ' . $fb['label'] . '</h3>';
                            echo '<div class="faq-custom-list">';
                            foreach ($fb['items'] as $item) {
                                echo '<details class="faq-custom-item">';
                                echo '<summary class="faq-custom-question"><span>' . $item['q'] . '</span><i class="fas fa-chevron-down"></i></summary>';
                                echo '<div class="faq-custom-answer">' . $item['a'] . '</div>';
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
        </div>
            </div>
        </section>
        </main>
        <?php require_once __DIR__ . '/../includes/footer.php'; ?>
        <script src="/js/main.js?v=20260513e" defer></script>

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
                    + '<img loading="lazy" src="' + item.cover + '" alt="' + item.title + '" onerror="this.src=\'/uploads/case-default.jpg\'"></div>'
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
            <img loading="lazy" id="lightboxImage" src="" alt="图片预览">
        </div>
    </div>

    

        <script>
    function togglePhoneDisplay() {
        const btn = document.getElementById('consultNowBtn');
        const phone = document.getElementById('phoneDisplay');
        if (btn && phone) {
            btn.style.display = 'none';
            phone.style.display = 'inline-flex';
        }
    }
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('consultNowBtn');
        const phone = document.getElementById('phoneDisplay');
        if (btn && phone && phone.style.display !== 'none') {
            if (e.target !== btn && !btn.contains(e.target) &&
                e.target !== phone && !phone.contains(e.target)) {
                phone.style.display = 'none';
                btn.style.display = 'inline-flex';
            }
        }
    });
    </script>
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','/admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p;}
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
    $search = array('{{cityName}}', '{{cityPinyin}}', '{{cityPhone}}', '{{cityContent}}', '{{year}}', '{{cityTitle}}', '{{cityKeywords}}', '{{cityDescription}}');
    $replace = array(
        $escapedCity,
        htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'),
        $escapedPhone,
        $bodyContent,
        date('Y'),
        $escapedTitle,
        $escapedKeywords,
        $escapedDesc
    );
    $html = str_replace($search, $replace, $templateContent);
} else {
    function buildPage($escapedCity, $escapedPhone, $escapedTitle, $escapedKeywords, $escapedDesc, $districtHtml, $city_name, $slug, $province = '', $is_province_page = false) {
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <meta name="baidu-site-verification" content="codeva-XY6IaVM2X4" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
        <meta name="description" content="<?php echo $escapedDesc; ?>">
        <meta name="keywords" content="<?php echo $escapedKeywords; ?>">
        <title><?php echo $escapedTitle; ?></title>
        <link rel="stylesheet" href="/css/style.min.css?v=20260514">
        <link rel="stylesheet" href="/css/page-custom.css?v=20260519">
        <link rel="stylesheet" href="/css/fenzhan.css?v=20260521">
        <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <base href="/">
    <link rel="canonical" href="https://www.yaozijin.com/fenzhan/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>.html">
    <meta name="robots" content="index, follow">
        <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?php echo $escapedCity; ?>资金服务 - Yao资金网",
        "description": "<?php echo $escapedDesc; ?>",
        "url": "https://www.yaozijin.com/fenzhan/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>.html",
        "telephone": "<?php echo $escapedPhone; ?>",
        "areaServed": {
            "@type": "City",
            "name": "<?php echo $escapedCity; ?>"
        }
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type": "ListItem", "position": 1, "name": "首页", "item": "https://www.yaozijin.com/"},
            {"@type": "ListItem", "position": 2, "name": "<?php echo $escapedCity; ?>资金服务", "item": "https://www.yaozijin.com/fenzhan/<?php echo htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>.html"}
        ]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {"@type": "Question", "name": "什么是亮资服务？", "acceptedAnswer": {"@type": "Answer", "text": "亮资服务是指企业在投标、合作洽谈等场景中，需要向对方展示自身资金实力时，由专业机构提供的资金证明服务。"}},
            {"@type": "Question", "name": "过桥资金的利率是多少？", "acceptedAnswer": {"@type": "Answer", "text": "过桥资金利率根据金额、期限、风险等因素综合确定，一般在月息1%-3%之间。"}},
            {"@type": "Question", "name": "资金证明需要什么材料？", "acceptedAnswer": {"@type": "Answer", "text": "一般需要提供企业营业执照、法人身份证、近期财务报表以及具体资金用途说明，材料齐全后1-3个工作日可出具。"}},
            {"@type": "Question", "name": "实资摆账和资金证明有什么区别？", "acceptedAnswer": {"@type": "Answer", "text": "实资摆账是将资金实际存入账户并显示在银行流水和对账单中，而资金证明仅提供银行出具的证明文件，不涉及资金实际到账。"}}
        ]
    }
    </script>
    </head>
    <body>
        <a href="#main-content" class="skip-link">跳转到主要内容</a>
        <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img loading="lazy" src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu">
                <!-- 动态菜单将在这里加载 -->
            </ul>

            <script src="/js/nav-loader.js?v=4" defer></script>

            <!-- 搜索按钮 -->
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false" aria-controls="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- 搜索层 -->
        <div class="search-overlay" id="searchOverlay" role="search" aria-hidden="true">
            <div class="search-container">
                <form class="search-form" id="searchForm" action="#" method="get">
                    <input type="search" class="search-input" id="searchInput" placeholder="搜索业务、文章或资讯..." aria-label="搜索关键词">
                    <button type="submit" class="search-submit" aria-label="搜索">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                </form>
                <div class="search-suggestions" id="searchSuggestions" aria-live="polite"></div>
                <button class="search-close" id="searchClose" aria-label="关闭搜索">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </nav>
        <main id="main-content">
                <section class="hero" id="home" aria-labelledby="hero-title">
            <div class="hero-container">
                <div class="hero-badge">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <span>专业资金服务商 · 值得信赖</span>
                </div>
                <h1 class="hero-title" id="hero-title"><?php
                    $ht = $homepageContent['heroTitle'] ?? '专业资金服务商\n助力企业稳健发展';
                    echo nl2br(htmlspecialchars($escapedCity . $ht));
                ?></h1>
                <p class="hero-subtitle"><?php
                    $hs = $homepageContent['heroSubtitle'] ?? '企业一站式资金解决方案';
                    echo htmlspecialchars($escapedCity . '地区' . $hs);
                ?></p>
                <div class="hero-buttons">
                    <div class="booking-wrapper" style="display:flex;align-items:center;gap:12px;">
                        <button class="btn btn-primary" id="consultNowBtn" onclick="togglePhoneDisplay()" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-phone-alt"></i> 立即咨询
                        </button>
                        <span id="phoneDisplay" style="display:none;font-size:18px;font-weight:700;color:#1e3a8a;letter-spacing:2px;white-space:nowrap;background:#fff;border-radius:8px;padding:8px 16px;box-shadow:0 2px 8px rgba(0,0,0,0.12);"><?php echo $escapedPhone; ?></span>
                    </div>
                </div>
                <?php
                $heroStats = [
                    ['number' => $homepageContent['stat1Number'] ?? '10+', 'label' => $homepageContent['stat1Label'] ?? '行业经验'],
                    ['number' => $homepageContent['stat2Number'] ?? '500+', 'label' => $homepageContent['stat2Label'] ?? '服务企业'],
                    ['number' => $homepageContent['stat3Number'] ?? '30亿+', 'label' => $homepageContent['stat3Label'] ?? '资金规模'],
                    ['number' => $homepageContent['stat4Number'] ?? '99%', 'label' => $homepageContent['stat4Label'] ?? '客户满意度'],
                ];
                ?>
                <div class="stats" role="region" aria-label="公司数据统计">
                    <?php foreach ($heroStats as $s): ?>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo htmlspecialchars($s['number']); ?></div>
                        <div class="stat-label"><?php echo htmlspecialchars($s['label']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php renderServicesSection($homepageContent, $city_name); ?>
        <?php echo $districtHtml; ?>
        <?php if (!empty($city_content)): ?>
        <section class="city-content-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">CITY INSIGHTS</div>
                    <h2 class="section-title"><?php echo htmlspecialchars($city_name); ?>深度解读</h2>
                    <p class="section-subtitle">深入了解<?php echo htmlspecialchars($city_name); ?>经济环境与资金市场特点</p>
                </div>
                <div class="city-content-wrapper">
                    <div class="city-content-card">
                        <div class="city-content-body">
                        <?php echo $city_content; ?>
                    </div>
                        </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php if (!$is_province_page && !empty($province)):
            $sibConn = getDbConnection();
            $sibStmt = $sibConn->prepare("SELECT city_name, slug FROM fenzhan_cities WHERE province = ? AND slug != ? AND is_active = 1 ORDER BY sort_order ASC, city_name ASC LIMIT 20");
            $sibStmt->bind_param('ss', $province, $slug);
            $sibStmt->execute();
            $sibResult = $sibStmt->get_result();
            if ($sibResult->num_rows > 0):
        ?>
        <section class="city-related-section">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">RELATED CITIES</div>
                    <h2 class="section-title">同省城市</h2>
                    <p class="section-subtitle"><?php echo htmlspecialchars($province, ENT_QUOTES, 'UTF-8'); ?>其他城市资金服务</p>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;padding:20px 0;justify-content:center;">
                    <?php while ($sibRow = $sibResult->fetch_assoc()):
                        $sibName = htmlspecialchars($sibRow['city_name'], ENT_QUOTES, 'UTF-8');
                        $sibSlug = htmlspecialchars($sibRow['slug'], ENT_QUOTES, 'UTF-8');
                    ?>
                    <a href="/fenzhan/<?php echo $sibSlug; ?>.html" style="display:block;padding:16px;background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;text-decoration:none;color:#374151;font-size:14px;font-weight:500;text-align:center;transition:all 0.2s;" onmouseover="this.style.borderColor='#3b82f6';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#e5e7eb';this.style.background='#f8fafc'">
                        <?php echo $sibName; ?>
                    </a>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php endif; endif; if (isset($sibConn)) $sibConn->close(); ?>
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

        <section class="page-content" style="padding-top:0;">
            <div class="section-container">
                <div class="section-header">
                    <div class="section-label">FAQ</div>
                    <h2 class="section-title">常见问题</h2>
                    <p class="section-subtitle">为您解答资金业务中的常见疑问</p>
                </div>
        
        <div class="faq-grid">
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
                        echo '<div class="faq-custom-category" data-category="' . $key . '">';
                        echo '<h3 class="faq-custom-category-title"><i class="fas ' . $cfg['icon'] . '" aria-hidden="true"></i> ' . $label . '</h3>';
                        echo '<div class="faq-custom-list">';
                        foreach ($faqItems[$key] as $item) {
                            $q = htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8');
                            echo '<details class="faq-custom-item">';
                            echo '<summary class="faq-custom-question"><span>' . $q . '</span><i class="fas fa-chevron-down"></i></summary>';
                            echo '<div class="faq-custom-answer">' . $item['answer'] . '</div>';
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
                            echo '<div class="faq-custom-category" data-category="' . $key . '">';
                            echo '<h3 class="faq-custom-category-title"><i class="fas ' . $fb['icon'] . '" aria-hidden="true"></i> ' . $fb['label'] . '</h3>';
                            echo '<div class="faq-custom-list">';
                            foreach ($fb['items'] as $item) {
                                echo '<details class="faq-custom-item">';
                                echo '<summary class="faq-custom-question"><span>' . $item['q'] . '</span><i class="fas fa-chevron-down"></i></summary>';
                                echo '<div class="faq-custom-answer">' . $item['a'] . '</div>';
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
        </div>
            </div>
        </section>
        </main>
        <?php require_once __DIR__ . '/../includes/footer.php'; ?>
        <script src="/js/main.js?v=20260513e" defer></script>

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
                    + '<img loading="lazy" src="' + item.cover + '" alt="' + item.title + '" onerror="this.src=\'/uploads/case-default.jpg\'"></div>'
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
            <img loading="lazy" id="lightboxImage" src="" alt="图片预览">
        </div>
    </div>

    

        <script>
    function togglePhoneDisplay() {
        const btn = document.getElementById('consultNowBtn');
        const phone = document.getElementById('phoneDisplay');
        if (btn && phone) {
            btn.style.display = 'none';
            phone.style.display = 'inline-flex';
        }
    }
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('consultNowBtn');
        const phone = document.getElementById('phoneDisplay');
        if (btn && phone && phone.style.display !== 'none') {
            if (e.target !== btn && !btn.contains(e.target) &&
                e.target !== phone && !phone.contains(e.target)) {
                phone.style.display = 'none';
                btn.style.display = 'inline-flex';
            }
        }
    });
    </script>
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','/admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p;}
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
</body>
    </html>
    <?php
    return ob_get_clean();
    }
    $html = buildPage($escapedCity, $escapedPhone, $escapedTitle, $escapedKeywords, $escapedDesc, $districtHtml, $city_name, $slug, $province, $is_province_page);
}
// ---------- 写入缓存 ----------
if (!empty($cacheFile)) {
    $html = str_replace("100亿", "30亿", $html);

        @file_put_contents($cacheFile, $html);
    }
echo $html;

