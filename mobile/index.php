<?php
$page_title = '';
$meta_keywords = '';
$meta_description = '';
try {
    require_once __DIR__ . '/../config/db.php';
    $db = getDB();
    $stmt = $db->prepare("SELECT page_title, meta_keywords, meta_description FROM seo_settings WHERE page_id = ? LIMIT 1");
    $stmt->bind_param('s', $page_id);
    $page_id = 'index.html';
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['page_title'])) $page_title = $row['page_title'];
        if (!empty($row['meta_keywords'])) $meta_keywords = $row['meta_keywords'];
        if (!empty($row['meta_description'])) $meta_description = $row['meta_description'];
    }
    $stmt->close();
    $db->close();
} catch (Exception $e) {}

// Dynamic favicon served via /favicon.php (no-cache, reads admin settings)
$favicon_path = '/favicon-v2.png';

?>

<html lang="zh-CN" data-immersive-translate-page-theme="light"><head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars(!empty($meta_description) ? $meta_description : '专业资金服务平台，主营上市公司短拆、股票解质押过桥、企业个人摆账亮资、实缴验资、资金证明、银行时点日均冲量、工程亮资、定期存款、应收账款融资及云信票据置换，优化财务报表、增资产降负债，诚邀渠道代理合作。'); ?>">

    <meta name="keywords" content="<?php echo htmlspecialchars(!empty($meta_keywords) ? $meta_keywords : '上市公司短拆,股票解质押过桥,企业摆账,个人亮资,资金证明,实缴验资,银行冲量,工程亮资,过桥短拆,定期存款,应收账款融资,优化财务报表,降负债'); ?>">
    <meta name="author" content="Yao资金">

    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?php echo htmlspecialchars(!empty($page_title) ? $page_title : 'Yao资金- 专业资金业务服务。'); ?>">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="zh_CN">
    <link rel="canonical" href="https://www.yaozijin.com/">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
    <title><?php echo htmlspecialchars(!empty($page_title) ? $page_title : "首页 - Yao资金网"); ?></title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="all" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <link rel="stylesheet" href="../css/style.css?v=20260519">
    <link rel="stylesheet" href="../css/page-custom.css?v=20250520">

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Yao资金",
        "description": "专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等服务",
        "url": "https://www.yaozijin.com",
        "telephone": "+86-13552883008",
        "email": "wanglizhongguo@126.com",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "北京市",

            "addressRegion": "朝阳区",

            "streetAddress": "金融街8号"
        },
        "foundingDate": "2014",
        "areaServed": "CN"
    }
    </script>
    <!-- Logo动态加?-->
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','../admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){
                        function fixSubDir(p){return p&&p.indexOf('http')!==0?'../'+(p.charAt(0)==='/'?p.substring(1):p):p;}
                        if(resp.data.header_logo){
                            var hl=document.querySelector('.logo img');
                            if(hl)hl.src=fixSubDir(resp.data.header_logo);
                        }
                        if(resp.data.footer_logo){
                            var fl=document.querySelector('.footer-logo img');
                            if(fl)fl.src=fixSubDir(resp.data.footer_logo);
                        }
                        if(resp.data.favicon){
                            var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');
                            if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}
                            lk.href=fixSubDir(resp.data.favicon);
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
    xhr.open('GET', '../admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data && data.code === 0 && data.data) {
                    var seo = data.data;
                    // PHP handles title
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
<script>
(function() {
    var pageName = window.location.pathname.split('/').pop() || 'index.html';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data && data.code === 0 && data.data) {
                    var seo = data.data;
                    // PHP handles title
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
<link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>"><style>
.cases-showcase-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    padding: 30px 0;
}
.cases-showcase-pagination .pagination-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #f3f4f6;
    color: #4b5563;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
}
.cases-showcase-pagination .pagination-btn:hover:not(.disabled) {
    background: #2563eb;
    color: #fff;
    transform: translateY(-2px);
}
.cases-showcase-pagination .pagination-btn.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    pointer-events: none;
}
.cases-showcase-pagination .pagination-info {
    font-size: 14px;
    color: #6b7280;
    font-weight: 500;
}
</style>
<style data-id="immersive-translate-input-injected-css"></style><style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
</head>
<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-link">跳转到主要内容</a>


    <!-- 主导航 -->
    <nav class="navbar scrolled" id="navbar" role="navigation" aria-label="主导航">

        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="../uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金" style="height:48px;width:auto;" class=""></a>

            <ul class="nav-menu" role="menubar" id="dynamicNavMenu"><li role="none"><a href="index.html" class="nav-link" role="menuitem">首页</a></li><li role="none"><a href="/mobile/services.html" class="nav-link" role="menuitem">业务范围</a></li><li role="none"><a href="/mobile/cases.html" class="nav-link" role="menuitem">成功案例</a></li><li role="none"><a href="/mobile/advantages.html" class="nav-link" role="menuitem">服务优势</a></li><li role="none"><a href="/mobile/news.php" class="nav-link" role="menuitem">行业资讯</a></li><li role="none"><a href="/mobile/faq.html" class="nav-link" role="menuitem">常见问题</a></li><li role="none"><a href="/mobile/pages/page_1778812379_0b9248.html" class="nav-link" role="menuitem">测试问题</a></li><li role="none"><a href="/mobile/contact.html" class="nav-link" role="menuitem">联系我们</a></li></ul>


            

            <!-- 搜索按钮 -->
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false" aria-controls="navMenu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>

        <!-- 搜索弹窗 -->
        <div class="search-overlay" id="searchOverlay" role="search" aria-hidden="true">
            <div class="search-container">
                <form class="search-form" id="searchForm" action="#" method="get">
                    <input type="search" class="search-input" id="searchInput" placeholder="搜索业务、案例、资讯.." aria-label="搜索内容">

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
                    <button class="btn btn-primary" id="consultNowBtn" onclick="togglePhoneDisplay()">立即咨询</button>
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
                    <div class="stat-number" data-target="10">10+</div>
                    <div class="stat-label">年行业经验</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="500">500+</div>
                    <div class="stat-label">服务企业</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="30">30亿+</div>
                    <div class="stat-label">亿资金规模</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="99">99%</div>
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
                <p class="section-subtitle">涵盖上市公司、企业摆账、银行存款、应收账款融资等全方位资金服务</p>

            </div>

            <div class="services-grid">
                <article class="service-card" data-service="listed" style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s, transform 0.5s;">
                    <h3 class="service-title">上市公司类</h3>

                    <ul class="service-list">
                        <li>短拆、股票解质押过桥</li>
                        <li>募集账户归还过桥、产业基金备案过桥</li>
                        <li>股票质押、定增、协议转让、代持</li>
                        <li>财务报表优化、降负债</li>
                    </ul>

                </article>

                <article class="service-card" data-service="摆账" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
                    <h3 class="service-title">企业/个人摆账</h3>
                    <ul class="service-list">
                        <li>长短期定存摆账、云信票据实摆</li>
                        <li>过账实趴、抵押类资金过桥</li>
                        <li>实缴验资、资金证明、银行保函</li>
                        <li>贸易增量、显账亮资</li>
                    </ul>

                </article>

                <article class="service-card" data-service="deposit" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
                    <h3 class="service-title">银行存款类</h3>

                    <ul class="service-list">
                        <li>时点冲量、日均业务</li>
                        <li>月末冲量</li>
                        <li>一年期定期存款</li>
                        <li>三年期定期存款</li>
                    </ul>

                </article>

                <article class="service-card" data-service="receivable" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
                    <h3 class="service-title">云信融资出表</h3>
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
                <div class="detail-card" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
                    <h4 class="detail-title"><i class="fas fa-star" aria-hidden="true"></i> 核心优势</h4>
                    <ul class="detail-list">
                        <li>资金实力雄厚,单笔可提供数亿至数十亿资金支持</li>
                        <li>操作灵活,可根据客户需求定制个性化方案</li>
                        <li class="">审批快速,资料齐全后最快当日放</li>
                        <li>合规安全,严格遵循金融监管要求</li>

                    </ul>
                </div>
                <div class="detail-card" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
                    <h4 class="detail-title"><i class="fas fa-calculator" aria-hidden="true"></i> 收费说明</h4>
                    <ul class="detail-list">
                        <li class="">按实际使用天数计费,透明无隐藏费用</li>

                        <li>根据资金规模、期限、风险等级综合定价</li>

                        <li class="">长期合作客户享受优惠费率</li>
                        <li>具体费用以双方签署协议为准</li>

                    </ul>
                </div>
                <div class="detail-card" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
                    <h4 class="detail-title"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> 风险提示</h4>
                    <ul class="detail-list">
                        <li class="">资金业务存在市场风险,请根据自身情况谨慎决策</li>
                        <li class="">请确保提供真实、完整的资料信息</li>
                        <li class="">严格遵守合同约定,按时归还资金</li>

                        <li class="">投资有风险,入市需谨慎</li>
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
                    <article class="case-card-enhanced" data-id="1778589809435">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('..//uploads/20260513_6a049f4f44bb7.png')">
                            <img src="..//uploads/20260513_6a049f4f44bb7.png" alt="3 亿元个人名下资金证明 | 大额个人资产实力证明案例" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=1778589809435'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">3 亿元个人名下资金证明 | 大额个人资产实力证明案例</h3>
                            <p class="case-card-summary">为客户提供3 亿元个人名下资金证明服务，资金直接出至客户个人账户名下，满足项目合作、移民留学、资产实力展示等场景的资金证明需求。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">3亿</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=1778589809435'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="18">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260512_6a031f630d19c.jpg')">
                            <img src="../uploads/20260512_6a031f630d19c.jpg" alt="某酒店老板 1 亿元工程亮资 | 油品项目资金实力证明案例" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=18'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">某酒店老板 1 亿元工程亮资 | 油品项目资金实力证明案例</h3>
                            <p class="case-card-summary">为企业老板提供1 亿元工程亮资服务，在项目合作中展示现金资金实力，助力拿下油品批发项目，实现业务收益。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">3000万</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=18'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="17">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260512_6a03007bb5037.png')">
                            <img src="../uploads/20260512_6a03007bb5037.png" alt="某上市公司过桥融资" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=17'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">某上市公司过桥融资</h3>
                            <p class="case-card-summary">为某上市公司提供5 亿大额过桥融资服务，解决其短期资金周转难题，保障业务平稳过渡。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">5亿</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=17'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="16">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260512_6a031da704d85.png')">
                            <img src="../uploads/20260512_6a031da704d85.png" alt="某高新技术企业 6000 万实缴验资服务案例" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=16'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">某高新技术企业 6000 万实缴验资服务案例</h3>
                            <p class="case-card-summary">为某高新技术企业提供6000 万元注册资金实缴验资服务，助力企业完成工商实缴流程，满足高新技术企业资质认定需求。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">6000 万</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=16'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="15">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260427_69efb19af3aa8.jpg')">
                            <img src="../uploads/20260427_69efb19af3aa8.jpg" alt="3000 万现金亮资服务 | 企业工程项目资金实力证明案例" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=15'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">3000 万现金亮资服务 | 企业工程项目资金实力证明案例</h3>
                            <p class="case-card-summary">为企业提供3000 万现金亮资服务，解决企业工程项目投标阶段现金流不足、无法证明资金实力的问题，助力项目中标。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">3000万</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=15'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="14">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260512_6a03197e79f62.png')">
                            <img src="../uploads/20260512_6a03197e79f62.png" alt="某上市制造企业 4亿股票解质押过桥融资案例" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=14'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">某上市制造企业 4亿股票解质押过桥融资案例</h3>
                            <p class="case-card-summary">为上市制造企业股东提供5.8 亿元股票解质押过桥资金，成功化解质押风险，保障企业正常运营。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">4亿元</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=14'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="13">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260512_6a03127a92af0.png')">
                            <img src="../uploads/20260512_6a03127a92af0.png" alt="某连锁零售企业 1 亿元摆账流水打印服务案例" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=13'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">某连锁零售企业 1 亿元摆账流水打印服务案例</h3>
                            <p class="case-card-summary">为某连锁零售企业提供1 亿元大额企业摆账及流水打印服务，满足企业业务审计、资质审核阶段的资金实力与经营流水证明需求。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">1亿元</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=13'">查看详情</button>
                            </div>
                        </div>
                    </article>
                
                    <article class="case-card-enhanced" data-id="12">
                        <div class="case-card-image" onclick="window.openLightbox &amp;&amp; window.openLightbox('../uploads/20260512_6a031aaeabfdc.jpeg')">
                            <img src="../uploads/20260512_6a031aaeabfdc.jpeg" alt="应收账款不确权 对价云信融资 | 低成本企业资金周转方案" onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=12'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">应收账款不确权 对价云信融资 | 低成本企业资金周转方案</h3>
                            <p class="case-card-summary">提供企业应收账款（不确权）置换云信电子债权凭证服务，可流转支付、融资贴现，真实出表，成本低、不挑企业，助力三角债清理、债务重组与企业降负债。</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">8000万元</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=12'">查看详情</button>
                            </div>
                        </div>
                    </article>
                </div>
            
            <div class="cases-showcase-pagination" id="casesShowcasePagination" style="display: flex; justify-content: center; align-items: center; gap: 6px; margin: 20px 0px;">
                <button onclick="changePage(-1)" id="prevPageBtn" style="width:38px;height:38px;border:1px solid #e5e7eb;border-radius:6px;background:#fff;cursor:pointer;font-size:13px;color:#9ca3af" class="disabled">&lt;</button>
                
                <button onclick="changePage(1)" id="nextPageBtn" style="width:38px;height:38px;border:1px solid #e5e7eb;border-radius:6px;background:#fff;cursor:pointer;font-size:13px;color:#9ca3af">&gt;</button>
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
                                <span class="advantages-stat-number">500+</span>

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

                <p class="advantages-subtitle">专业、高效、安全</p>

                        </div>
                    </div>

                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">丰富的行业经验</h3>

                <p class="advantages-subtitle">专业、高效、安全</p>

                        </div>
                    </div>

                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">丰富的行业经验</h3>

                <p class="advantages-subtitle">专业、高效、安全</p>

                        </div>
                    </div>

                    <div class="advantages-feature">
                        <div class="advantages-check">
                            <i class="fas fa-check" aria-hidden="true"></i>
                        </div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">丰富的行业经验</h3>

                <p class="advantages-subtitle">专业、高效、安全</p>

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
                <p class="section-subtitle">涵盖上市公司、企业摆账、银行存款、应收账款融资等全方位资金服务。</p>

            </div>
            <div class="bank-logos-wrapper">
                <img src="../images/合作银行logo.jpg" alt="合作银行" class="bank-logos-image">
            </div>
        </div>
    </section>

    <!-- FAQ常见问题 (动态加载) -->
    <section class="faq" id="faq" aria-labelledby="faq-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">FAQ</div>
                <h2 class="section-title" id="faq-title">常见问题</h2>
                <p class="section-subtitle">解答您关于资金业务的常见疑问</p>
            </div>
            <div id="faqContainer" class="faq-container">
<?php
$faqDb = getDB();
// Get category config from faq_categories table
$faqCatResult = $faqDb->query("SELECT cat_key, cat_label FROM faq_categories ORDER BY sort_order ASC");
$faqCatNames = [];
$faqOrder = [];
while ($faqCatRow = $faqCatResult->fetch_assoc()) {
    $key = $faqCatRow['cat_key'];
    $faqCatNames[$key] = $faqCatRow['cat_label'];
    $faqOrder[] = $key;
}
// Get FAQ items
$faqResult = $faqDb->query("SELECT id, category, question, answer FROM faq WHERE (is_active IS NULL OR is_active = 1) ORDER BY sort_order ASC, id ASC");
$faqItems = [];
while ($faqRow = $faqResult->fetch_assoc()) {
    $cat = $faqRow['category'] ?: 'general';
    if (!isset($faqItems[$cat])) $faqItems[$cat] = [];
    $faqItems[$cat][] = $faqRow;
}
$faqDb->close();
// Icon mapping (icons not in DB)
$faqCatIcons = ['liangzi'=>'fa-lightbulb','guoqiao'=>'fa-exchange-alt','baizhang'=>'fa-university','receivable'=>'fa-file-invoice-dollar','deposit'=>'fa-piggy-bank','general'=>'fa-question-circle'];
$rendered = [];
foreach ($faqOrder as $cat) {
    if (!empty($faqItems[$cat])) {
        $icon = $faqCatIcons[$cat] ?? 'fa-question-circle';
        $name = $faqCatNames[$cat] ?? $cat;
        $html = '<div class="faq-category">';
        $html .= '<h3 class="faq-category-title"><i class="fas ' . $icon . '" aria-hidden="true"></i> ' . htmlspecialchars($name) . '</h3>';
        $html .= '<div class="faq-list">';
        foreach ($faqItems[$cat] as $item) {
            $html .= '<details class="faq-item">';
            $html .= '<summary class="faq-question">' . htmlspecialchars($item['question']) . '</summary>';
            $html .= '<div class="faq-answer">' . $item['answer'] . '</div>';
            $html .= '</details>';
        }
        $html .= '</div></div>';
        $rendered[] = $html;
    }
    unset($faqItems[$cat]);
}
foreach ($faqItems as $cat => $items) {
    $icon = $faqCatIcons[$cat] ?? 'fa-question-circle';
    $name = $faqCatNames[$cat] ?? $cat;
    $html = '<div class="faq-category">';
    $html .= '<h3 class="faq-category-title"><i class="fas ' . $icon . '" aria-hidden="true"></i> ' . htmlspecialchars($name) . '</h3>';
    $html .= '<div class="faq-list">';
    foreach ($items as $item) {
        $html .= '<details class="faq-item">';
        $html .= '<summary class="faq-question">' . htmlspecialchars($item['question']) . '</summary>';
        $html .= '<div class="faq-answer">' . $item['answer'] . '</div>';
        $html .= '</details>';
    }
    $html .= '</div></div>';
    $rendered[] = $html;
}
echo implode('', $rendered);
?>

    </section>

    
    </main>

    <!-- 页脚 -->
    <?php include '../includes/footer-simple.php'; ?>
<script src="../js/main.js?v=3"></script>

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

                    // 使用桌面端同一个API接口
                    const response = await fetch('../api/cases.php?t=' + Date.now(), {
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
                        // API返回的是 cases 字段

                        // 按ID去重,防止重复显示
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
                            cover_image: c.coverImage || c.image || 'images/case-default.svg'
                        }));
                        console.log('[首页案例] 加载完成,案例数:', casesData.length);

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
                        <div class="case-card-image" onclick="window.openLightbox && window.openLightbox('../${item.cover_image}')">
                            <img src="../${item.cover_image}"
                                 alt="${item.title}"
                                 onerror="this.src='../images/case-default.svg'">
                        </div>
                        <div class="case-card-content" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor:pointer">
                            <h3 class="case-card-title" style="cursor:pointer">${item.title}</h3>
                            <p class="case-card-summary">${item.summary}</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">${item.amount}</span>
                                </div>
                                <button class="btn-view-detail" onclick="event.stopPropagation();window.location.href='case-detail.html?id=${item.id}'">查看详情</button>
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
                            <p class="cases-showcase-empty-text">暂无成功案例,敬请期待</p>

                        </div>
                    `;
                }
            }

            // 更新分页
            function updatePagination() {
                var totalPages = Math.ceil(casesData.length / itemsPerPage);
                var prevBtn = document.getElementById('prevPageBtn');
                var nextBtn = document.getElementById('nextPageBtn');
                var pageInfo = document.getElementById('paginationInfo');

                if (prevBtn) {
                    if (currentPage <= 1) { prevBtn.classList.add('disabled'); } else { prevBtn.classList.remove('disabled'); }
                }
                if (nextBtn) {
                    if (currentPage >= totalPages || totalPages === 0) { nextBtn.classList.add('disabled'); } else { nextBtn.classList.remove('disabled'); }
                }
                if (pageInfo) pageInfo.textContent = '第' + currentPage + ' 页 / 共' + (totalPages || 1) + ' 页';

                var paginationContainer = document.getElementById('casesShowcasePagination');
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
                    // 滚动到案例区域顶?                    document.getElementById('casesShowcase').scrollIntoView({ behavior: 'smooth', block: 'start' });
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
            <img id="lightboxImage" src="" alt="大图预览">
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

        /* 点击图片的指针样?*/
        .case-card-image {
            cursor: pointer;
        }

        .case-card-image img {
            transition: transform 0.3s ease;
        }

        .case-card-image:hover img {
            transform: scale(1.05);
        }
    </style>

    <!-- 访问统计代码 -->
    <script>
        // 网站访问统计
        (function() {
            // 防止重复记录
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
                fetch('../admin/api/stats.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(statsData).toString()
                }).then(response => response.json())
                  .then(data => {
                      console.log('[Stats] 访访问统计已记录?', data);

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
        // 切换电话号码显示:隐藏按钮,原地显示号码
        function togglePhoneDisplay() {
            const btn = document.getElementById('consultNowBtn');
            const phone = document.getElementById('phoneDisplay');
            if (btn && phone) {
                btn.style.display = 'none';
                phone.style.display = 'inline-flex';
            }
        }

        // 点击页面空白处:恢复按钮,隐藏号码?
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('consultNowBtn');
            const phone = document.getElementById('phoneDisplay');
            if (btn && phone && phone.style.display !== 'none') {
                // 点击的不是按钮及其子元素,也不是号码及其子元素时隐藏号码
                if (e.target !== btn && !btn.contains(e.target) &&
                    e.target !== phone && !phone.contains(e.target)) {
                    phone.style.display = 'none';
                    btn.style.display = 'inline-flex';
                }
            }
        });
    </script>





    <script src="../js/nav-loader.js?v=5"></script>
<script src="../admin/assets/cms-1778895578.js"></script>
</body></html>