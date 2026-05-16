<?php
require_once __DIR__ . '/includes/logo.php';
require_once __DIR__ . '/device-detect.php';

DeviceDetector::redirect();
require_once __DIR__ . '/includes/page-seo.php';

// Server-side CMS hero data - read from cms_pages table (visual builder save target)
$cmsHeroTitle = '';
$cmsHeroSubtitle = '';
$cmsHeroButtonText = '';
try {
    require_once __DIR__ . '/config/db.php';
    $cmsDb = getDB();
    $cmsStmt = $cmsDb->prepare("SELECT title, subtitle, content FROM cms_pages WHERE page_id = 'index' LIMIT 1");
    $cmsStmt->execute();
    $cmsRes = $cmsStmt->get_result();
    if ($cmsRow = $cmsRes->fetch_assoc()) {
        $cmsHeroTitle = $cmsRow['title'] ?? '';
        $cmsHeroSubtitle = $cmsRow['subtitle'] ?? '';
        if (!empty($cmsRow['content'])) {
            $contentData = json_decode($cmsRow['content'], true);
            if ($contentData) {
                // Check nested data structure (visual builder format)
                $heroData = $contentData['data'] ?? $contentData;
                $cmsHeroTitle = $cmsHeroTitle ?: ($heroData['heroTitle'] ?? '');
                $cmsHeroSubtitle = $cmsHeroSubtitle ?: ($heroData['heroSubtitle'] ?? '');
                $cmsHeroButtonText = $heroData['heroButtonText'] ?? '';
            }
        }
    }
    $cmsStmt->close();
    $cmsDb->close();
} catch (Exception $e) {}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <meta name="author" content="Yao资金网">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Yao资金网 - 专业资金业务服务商">
    <meta property="og:description" content="提供上市公司过桥、企业摆账、银行存款、资金证明等全方位资金服务">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="zh_CN">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Yao资金网 - 专业资金业务服务商">
    <meta name="twitter:description" content="提供上市公司过桥、企业摆账、银行存款、资金证明等全方位资金服务">
    <link rel="canonical" href="https://www.yaozijin.com/">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
    <title><?php echo htmlspecialchars(!empty($page_title) ? $page_title : "Yao资金网"); ?></title>
    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
    <!-- 动态内容加载脚本 -->
    <script>
        // 从localStorage加载编辑后的内容
        (function() {
            const pageName = window.location.pathname.split('/').pop() || 'index.html';
            const savedContent = localStorage.getItem('page_' + pageName);
            if (savedContent) {
                // 页面加载完成后替换内容
                window.addEventListener('load', function() {
                    // 提取body内容
                    const bodyMatch = savedContent.match(/<body[^>]*>([\s\S]*)<\/body>/i);
                    if (bodyMatch && bodyMatch[1]) {
                        // 保留导航栏和页脚，替换主要内容
                        const mainContent = document.querySelector('main');
                        if (mainContent) {
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = bodyMatch[1];
                            // 只替换非导航非页脚的内容
                            const newMain = tempDiv.querySelector('main') || tempDiv;
                            if (newMain) {
                                mainContent.innerHTML = newMain.innerHTML || newMain.innerHTML;
                            }
                        }
                    }
                });
            }
        })();
    </script>
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Yao资金网",
        "description": "专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等服务",
        "url": "https://www.yaozijin.com",
        "telephone": "+86-13552883008",
        "email": "wanglizhongguo@126.com",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "北京市",
            "addressRegion": "朝阳区",
            "streetAddress": "金融街88号"
        },
        "foundingDate": "2014",
        "areaServed": "CN"
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
<script>
(function() {
    var pageName = window.location.pathname.split('/').pop() || 'index.html';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data && data.code === 0 && data.data) {
                    var seo = data.data;
                    // PHP handles title - title set server-side
                    if (seo.meta_keywords) {
                        var kw = document.querySelector('meta[name="keywords"]');
                        if (kw) kw.content = seo.meta_keywords;
                    }
                    if (seo.meta_description) {
                        var desc = document.querySelector('meta[name="description"]');
                        if (desc) desc.content = seo.meta_description;
                    }
                }
            } catch(e) {}
        }
    };
    xhr.send();
})();
</script>

</head>
<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img loading="lazy" src="<?php echo $header_logo; ?>" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar"><?php include __DIR__ . "/includes/nav.php"; ?></ul>
            
            

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

        <!-- 搜索框 -->
        <div class="search-overlay" id="searchOverlay" role="search" aria-hidden="true">
            <div class="search-container">
                <form class="search-form" id="searchForm" action="#" method="get">
                    <input type="search" class="search-input" id="searchInput" placeholder="搜索业务、案例、资讯..." aria-label="搜索内容">
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
    <!-- Hero区域 -->
    <section class="hero" id="home" aria-labelledby="hero-title">
        <div class="hero-container">
            <div class="hero-badge">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                <span class="">专业资金服务 · 值得信赖</span>
            </div>

            <h1 class="hero-title" id="hero-title">专业资金解决方案
                助力企业稳健发展</h1>

            <p class="hero-subtitle">提供上市公司短拆、企业摆账、银行存款、资金证明等全方位资金服务，以专业实力和丰富经验，为您的企业发展保驾护航。</p>


            <div class="hero-buttons">
                <div class="booking-wrapper" style="display:flex;align-items:center;gap:12px;">
                    <button class="btn btn-primary" id="consultNowBtn" onclick="togglePhoneDisplay()">
                        <i class="fas fa-phone-alt"></i>
                        立即咨询
                    </button>
                    <span id="phoneDisplay" style="display:none;font-size:18px;font-weight:700;color:#1e3a8a;letter-spacing:2px;white-space:nowrap;background:#fff;border-radius:8px;padding:8px 16px;box-shadow:0 2px 8px rgba(0,0,0,0.12);">13552883008</span>
                </div>
                <!-- 预约咨询按钮已移除 2026-04-30 -->
                <!-- <div class="booking-wrapper">
                    <button class="btn btn-outline" id="bookingBtn" onclick="toggleBookingCard(this)">预约咨询</button>
                    <div class="contact-card contact-card-left" id="bookingCard" style="display:none;">
                        <div class="contact-card-content">
                            <div class="contact-card-phone">
                                <i class="fas fa-phone-alt"></i>
                                <span>13552883008</span>
                            </div>
                        </div>
                    </div>
                -->
            </div>
            
            <div class="stats" role="region" aria-label="公司数据统计">
                <div class="stat-card">
                    <div class="stat-number" data-target="10">0</div>
                    <div class="stat-label">年行业经验</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="500">0</div>
                    <div class="stat-label">服务企业</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="100">0</div>
                    <div class="stat-label">亿资金规模</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="99">0</div>
                    <div class="stat-label">%客户满意度</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 核心业务领域 -->
    <section class="services" id="services" aria-labelledby="services-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">OUR SERVICES</div>
                <h2 class="section-title" id="services-title">核心业务领域</h2>
                <p class="section-subtitle">涵盖上市公司、企业摆账、银行存款、资金证明等全方位资金服务</p>
            </div>
            
            <div class="services-grid">
                <article class="service-card" data-service="listed">
                    <h3 class="service-title">上市公司类</h3>
                    <ul class="service-list">
                        <li>短拆、股票解质押过桥</li>
                        <li>募集账户归还过桥、产业基金备案过桥</li>
                        <li>股票质押、定增、协议转让、代持</li>
                        <li>财务报表优化、降负债</li>
                    </ul>
                </article>
                
                <article class="service-card" data-service="摆账">
                    <h3 class="service-title">企业/个人摆账</h3>
                    <ul class="service-list">
                        <li>长短期定存摆账、云信票据实摆</li>
                        <li>过账实趴、抵押类资金过桥</li>
                        <li>实缴验资、资金证明、银行保函</li>
                        <li>贸易增量、显账亮资</li>
                    </ul>
                </article>
                
                <article class="service-card" data-service="deposit">
                    <h3 class="service-title">银行存款类</h3>
                    <ul class="service-list">
                        <li>时点冲量、日均业务</li>
                        <li>月末冲量</li>
                        <li>一年期定期存款</li>
                        <li>三年期定期存款</li>
                    </ul>
                </article>
                
                <article class="service-card" data-service="receivable">
                    <h3 class="service-title">应收账款融资</h3>
                    <ul class="service-list">
                        <li>置换云信票据</li>
                        <li>可拆分流转支付</li>
                        <li>融资贴现、准入宽松</li>
                        <li>不看征信、包容执行诉讼主体</li>
                    </ul>
                </article>
            </div>

            <!-- 业务详情扩展 -->
            <div class="service-details" id="serviceDetails">
                <div class="detail-card">
                    <h4 class="detail-title"><i class="fas fa-star" aria-hidden="true"></i> 核心优势</h4>
                    <ul class="detail-list">
                        <li>资金实力雄厚，单笔可提供数亿至数十亿资金支持</li>
                        <li>操作灵活，可根据客户需求定制个性化方案</li>
                        <li>审批快速，资料齐全后最快当日放款</li>
                        <li>合规安全，严格遵循金融监管要求</li>
                    </ul>
                </div>
                <div class="detail-card">
                    <h4 class="detail-title"><i class="fas fa-calculator" aria-hidden="true"></i> 收费说明</h4>
                    <ul class="detail-list">
                        <li>按实际使用天数计费，透明无隐藏费用</li>
                        <li>根据资金规模、期限、风险等级综合定价</li>
                        <li>长期合作客户享受优惠费率</li>
                        <li>具体费用以双方签署协议为准</li>
                    </ul>
                </div>
                <div class="detail-card">
                    <h4 class="detail-title"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> 风险提示</h4>
                    <ul class="detail-list">
                        <li>资金业务存在市场风险，请根据自身情况谨慎决策</li>
                        <li>请确保提供真实、完整的资料信息</li>
                        <li>严格遵守合同约定，按时归还资金</li>
                        <li>投资有风险，入市需谨慎</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 成功案例展示 -->
    <section class="cases-showcase" id="casesShowcase" aria-labelledby="cases-showcase-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">SUCCESS CASES</div>
                <h2 class="section-title" id="cases-showcase-title">成功案例</h2>
                <p class="section-subtitle">真实案例见证专业实力，累计服务500+企业客户</p>
            </div>
            
            <div class="cases-showcase-grid" id="casesShowcaseGrid">
                <!-- 案例卡片将通过JavaScript动态加载 -->
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

    <!-- 服务优势 -->
    <section class="advantages" id="advantages" aria-labelledby="advantages-title">
        <div class="section-container">
            <div class="advantages-header">
                <h2 class="advantages-title" id="advantages-title">服务优势</h2>
                <p class="advantages-subtitle">专业、高效、安全</p>
            </div>
            
            <div class="advantages-content">
                <div class="advantages-visual">
                    <div class="advantages-image-wrapper">
                        <div class="advantages-icon-main">
                            <i class="fas fa-thumbs-up" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-stats">
                            <div class="advantages-stat">
                                <span class="advantages-stat-number">500+</span>
                                <span class="advantages-stat-label">服务企业</span>
                            </div>
                            <div class="advantages-stat">
                                <span class="advantages-stat-number">99%</span>
                                <span class="advantages-stat-label">客户满意度</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="advantages-features">
                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">丰富的行业经验</h3>
                            <p class="advantages-feature-desc">深耕资金业务十余年，积累了丰富的行业经验和资源网络，能够为客户提供最专业的服务。</p>
                        </div>
                    </div>
                    
                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">强大的资金实力</h3>
                            <p class="advantages-feature-desc">累计管理资金规模超100亿元，单笔可提供数亿至数十亿资金支持，满足各类大型项目需求。</p>
                        </div>
                    </div>
                    
                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">专业的服务团队</h3>
                            <p class="advantages-feature-desc">核心团队成员均来自国内知名金融机构，平均从业经验超过15年，专业能力强。</p>
                        </div>
                    </div>
                    
                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">完善的风控体系</h3>
                            <p class="advantages-feature-desc">建立了完善的风险控制体系，严格遵循合规要求，确保每笔业务安全可控。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 合作银行 -->
    <section class="bank-logos-section">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">合作银行</h2>
                <p class="section-subtitle">与多家银行建立深度合作关系</p>
            </div>
            <div class="bank-logos-wrapper">
                <img loading="lazy" src="/uploads/bank-logos.jpg" alt="合作银行" class="bank-logos-image">
            </div>
        </div>
    </section>

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
                    require_once __DIR__ . "/config/db.php";
                    $faqConn = getDB();
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
                        // Fallback to hardcoded defaults if DB has no FAQ data
                        $fallback = [
                            'liangzi' => ['icon' => 'fa-lightbulb', 'label' => '亮资业务', 'items' => [
                                ['q' => '什么是亮资业务？', 'a' => '<p>亮资业务是指企业在参与招投标、项目洽谈、商务合作等场景时，需要向对方展示资金实力的服务。我们提供大额资金在客户账户中展示，证明企业具备相应的资金履约能力。</p>'],
                                ['q' => '亮资业务需要多长时间？', 'a' => '<p>根据客户需求，亮资业务可分为时点亮资和时期亮资。时点亮资通常在1-3个工作日内完成；时期亮资根据约定期限，从几天到数月不等。</p>'],
                            ]],
                            'guoqiao' => ['icon' => 'fa-exchange-alt', 'label' => '过桥资金', 'items' => [
                                ['q' => '过桥资金适用于哪些场景？', 'a' => '<p>过桥资金主要适用于：银行贷款续贷、股票解质押、募集账户归还、企业并购、项目保证金、资金周转等短期资金需求场景。</p>'],
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
                } catch (Exception $e) {
                    // If DB fails, show nothing (silent fail)
                }
                ?>
            </div>
        </div>
    </section>
    </main>

    <!-- 右侧边浮动电话按钮 -->
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
    </div>

    <!-- 页脚(由数据库动态渲染) -->
    <?php include 'includes/footer.php'; ?>
<script src="/js/main.js?v=20260513b"></script>
    
    <!-- CMS Data Integration -->

    
    <!-- 成功案例展示脚本 -->
    <script>
        // 成功案例展示模块
        (function() {
            let casesData = [];
            let currentPage = 1;
            const itemsPerPage = 8;
            
            // 从后端API获取案例数据
            async function fetchCases() {
                try {
                    console.log('[首页案例] 开始获取案例数据...');
                    // 使用正确的API路径，添加时间戳防止缓存
                    const response = await fetch('api/cases.php?t=' + Date.now(), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    });
                    
                    // 检查响应类型
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('[首页案例] API返回非JSON格式:', text.substring(0, 200));
                        showEmptyState();
                        return;
                    }
                    
                    const result = await response.json();
                    console.log('[首页案例] API返回:', result);
                    
                    if (result.success && result.cases && result.cases.length > 0) {
                        // API返回的是 cases 字段，不是 data 字段
                        // 按ID去重，防止重复显示
                        const seenIds = new Set();
                        const uniqueCases = result.cases.filter(c => {
                            if (seenIds.has(c.id)) {
                                console.log('[首页案例] 去重跳过重复案例:', c.id, c.title);
                                return false;
                            }
                            seenIds.add(c.id);
                            return true;
                        });
                        
                        casesData = uniqueCases.map(c => ({
                            id: c.id,
                            title: c.title,
                            summary: c.summary || '暂无简介',
                            amount: c.amount || '保密',
                            cover_image: c.coverImage || c.image || '/uploads/case-default.jpg'
                        }));
                        console.log('[首页案例] 加载案例数:', casesData.length, '原始数据:', result.cases.length);
                        renderCases();
                        updatePagination();
                    } else {
                        console.log('[首页案例] 无案例数据或API返回失败');
                        showEmptyState();
                    }
                } catch (error) {
                    console.error('[首页案例] 获取案例数据失败:', error);
                    showEmptyState();
                }
            }
            
            // 渲染案例卡片
            function renderCases() {
                const grid = document.getElementById('casesShowcaseGrid');
                if (!grid) return;
                
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const pageData = casesData.slice(startIndex, endIndex);
                
                if (pageData.length === 0) {
                    showEmptyState();
                    return;
                }
                
                grid.innerHTML = pageData.map(item => `
                    <article class="case-card-enhanced" data-id="${item.id}">
                        <div class="case-card-image" onclick="openLightbox('${item.cover_image}')">
                            <img loading="lazy" src="${item.cover_image}" 
                                 alt="${item.title}" 
                                 onerror="this.src='/uploads/case-default.jpg'">
                        </div>
                        <div class="case-card-content">
                            <h3 class="case-card-title" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor: pointer;">${item.title}</h3>
                            <p class="case-card-summary" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor: pointer;">${item.summary}</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor: pointer;">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">${item.amount}</span>
                                </div>
                                <button class="btn-view-detail" onclick="window.location.href='case-detail.html?id=${item.id}'">查看详情</button>
                            </div>
                        </div>
                    </article>
                `).join('');
            }
            
            // 显示空状态
            function showEmptyState() {
                const grid = document.getElementById('casesShowcaseGrid');
                if (grid) {
                    grid.innerHTML = `
                        <div class="cases-showcase-empty">
                            <i class="fas fa-folder-open"></i>
                            <p class="cases-showcase-empty-text">暂无成功案例，敬请期待</p>
                        </div>
                    `;
                }
            }
            
            // 更新分页状态
            function updatePagination() {
                const totalPages = Math.ceil(casesData.length / itemsPerPage);
                const prevBtn = document.getElementById('prevPageBtn');
                const nextBtn = document.getElementById('nextPageBtn');
                const pageInfo = document.getElementById('paginationInfo');
                
                if (prevBtn) prevBtn.disabled = currentPage <= 1;
                if (nextBtn) nextBtn.disabled = currentPage >= totalPages || totalPages === 0;
                if (pageInfo) pageInfo.textContent = `第 ${currentPage} 页 / 共 ${totalPages || 1} 页`;
                
                // 如果总页数为1，隐藏分页
                const paginationContainer = document.getElementById('casesShowcasePagination');
                if (paginationContainer) {
                    paginationContainer.style.display = totalPages <= 1 ? 'none' : 'flex';
                }
            }
            
            // 切换页面
            window.changePage = function(direction) {
                const totalPages = Math.ceil(casesData.length / itemsPerPage);
                const newPage = currentPage + direction;
                
                if (newPage >= 1 && newPage <= totalPages) {
                    currentPage = newPage;
                    renderCases();
                    updatePagination();
                    // 滚动到案例区域顶部
                    document.getElementById('casesShowcase').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            };
            
            // 打开图片预览
            window.openLightbox = function(imageSrc) {
                const lightbox = document.getElementById('imageLightbox');
                const lightboxImage = document.getElementById('lightboxImage');
                lightboxImage.src = imageSrc;
                lightbox.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // 禁止背景滚动
            };
            
            // 关闭图片预览
            window.closeLightbox = function() {
                const lightbox = document.getElementById('imageLightbox');
                lightbox.style.display = 'none';
                document.body.style.overflow = ''; // 恢复背景滚动
            };
            
            // 点击背景关闭
            document.addEventListener('click', function(e) {
                const lightbox = document.getElementById('imageLightbox');
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });
            
            // ESC键关闭
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            });
            
            // 页面加载完成后初始化
            document.addEventListener('DOMContentLoaded', fetchCases);
        })();
    </script>
    
    <!-- 图片预览弹窗 (Lightbox) -->
    <div id="imageLightbox" class="lightbox-overlay" style="display: none;">
        <div class="lightbox-container">
            <button class="lightbox-close" onclick="closeLightbox()" aria-label="关闭预览">
                <i class="fas fa-times"></i>
            </button>
            <img loading="lazy" id="lightboxImage" src="" alt="大图预览">
        </div>
    </div>

    <!-- Lightbox 样式 -->
    <style>
        .lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .lightbox-container {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }
        
        .lightbox-container img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }
        
        .lightbox-close:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        /* 点击图片的指针样式 */
        .case-card-image {
            cursor: pointer;
        }
        
        .case-card-image img {
            transition: transform 0.3s ease;
        }
        
        .case-card-image:hover img {
            transform: scale(1.05);
        }
    
        .hero-title,.hero-subtitle,.hero .btn-primary{transition:none!important;animation:none!important}
        .hero-badge,.hero-title,.hero-subtitle{will-change:auto!important}
</style>

    <!-- 访问统计代码 -->
    <script>
        // 网站访问统计
        (function() {
            // 防止重复发送
            if (window.statsTracked) return;
            window.statsTracked = true;
            
            // 获取当前页面URL
            const pageUrl = window.location.href;
            
            // 获取来源页面
            const referer = document.referrer || '';
            
            // 发送访问统计请求
            function sendStats() {
                const statsData = {
                    action: 'record',
                    page_url: pageUrl,
                    referer: referer
                };
                
                // 使用fetch发送POST请求
                fetch('admin/api/stats.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(statsData).toString()
                }).then(response => response.json())
                  .then(data => {
                      console.log('[Stats] 访问统计已记录:', data);
                  }).catch(error => {
                      console.log('[Stats] 统计记录失败:', error);
                  });
            }
            
            // 页面加载完成后发送统计
            if (document.readyState === 'complete') {
                sendStats();
            } else {
                window.addEventListener('load', sendStats);
            }
        })();
    </script>

    <!-- CMS Editor -->
    <script>
        // 检查是否需要加载编辑器
        (function() {
            console.log('[CMS] 初始化检查...');
            
            const urlParams = new URLSearchParams(window.location.search);
            const isEditMode = urlParams.get('edit') === 'true';
            const isLoggedIn = localStorage.getItem('cms_logged_in') === 'true';
            
            console.log('[CMS] 编辑模式:', isEditMode);
            console.log('[CMS] 登录状态:', isLoggedIn);
            console.log('[CMS] localStorage cms_logged_in:', localStorage.getItem('cms_logged_in'));
            
            if (isEditMode && isLoggedIn) {
                console.log('[CMS] 开始加载编辑器...');
                
                // 加载编辑器样式
                const editorCss = document.createElement('link');
                editorCss.rel = 'stylesheet';
                editorCss.href = 'admin/editor.css';
                editorCss.onerror = function() {
                    console.error('[CMS] 编辑器样式加载失败:', editorCss.href);
                    alert('CMS编辑器样式加载失败，请检查文件路径');
                };
                document.head.appendChild(editorCss);
                console.log('[CMS] 样式表已加载');
                
                // 加载编辑器脚本
                const editorScript = document.createElement('script');
                editorScript.src = 'admin/editor.js';
                editorScript.onload = function() {
                    console.log('[CMS] 编辑器脚本加载成功');
                };
                editorScript.onerror = function() {
                    console.error('[CMS] 编辑器脚本加载失败:', editorScript.src);
                    alert('CMS编辑器脚本加载失败，请检查文件路径');
                };
                document.body.appendChild(editorScript);
            } else if (isEditMode && !isLoggedIn) {
                console.log('[CMS] 未登录，重定向到登录页');
                // 未登录，重定向到登录页
                window.location.href = 'admin/login.html?redirect=' + encodeURIComponent(window.location.href);
            } else {
                console.log('[CMS] 不在编辑模式或未登录');
            }
        })();
    </script>
    <script>
        // 切换电话号码显示：隐藏按钮，原地显示号码
        function togglePhoneDisplay() {
            const btn = document.getElementById('consultNowBtn');
            const phone = document.getElementById('phoneDisplay');
            if (btn && phone) {
                btn.style.display = 'none';
                phone.style.display = 'inline-flex';
            }
        }

        // 点击页面空白处：恢复按钮，隐藏号码
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('consultNowBtn');
            const phone = document.getElementById('phoneDisplay');
            if (btn && phone && phone.style.display !== 'none') {
                // 点击的不是按钮及其子元素，也不是号码及其子元素时隐藏号码
                if (e.target !== btn && !btn.contains(e.target) &&
                    e.target !== phone && !phone.contains(e.target)) {
                    phone.style.display = 'none';
                    btn.style.display = 'inline-flex';
                }
            }
        });
    </script>
</body>
</html>

