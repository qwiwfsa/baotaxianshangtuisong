<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>
<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
require_once __DIR__ . '/includes/page-seo.php';

// 动态SEO：根据URL参数获取分类SEO信息
require_once __DIR__ . '/config/db.php';
$conn = getDB();
$pageSeo = ['title' => !empty($page_title) ? $page_title : '常见问题 - Yao资金网', 'keywords' => !empty($page_keywords) ? $page_keywords : '常见问题,亮资业务,过桥资金,摆账业务,云信融资出表,FAQ', 'description' => !empty($page_description) ? $page_description : 'Yao资金网常见问题 - 解答您关于资金业务的常见疑问'];
$activeCat = isset($_GET['cat']) ? $_GET['cat'] : '';
if ($activeCat) {
    $stmt = $conn->prepare("SELECT cat_label, seo_title, seo_keywords, seo_description FROM faq_categories WHERE cat_key = ?");
    $stmt->bind_param("s", $activeCat);
    $stmt->execute();
    $catResult = $stmt->get_result();
    if ($catRow = $catResult->fetch_assoc()) {
        $catLabel = $catRow['cat_label'] ?: $activeCat;
        $pageSeo['title'] = ($catRow['seo_title'] ?: $catLabel . ' - 常见问题') . ' - Yao资金网';
        $pageSeo['keywords'] = $catRow['seo_keywords'] ?: $catLabel . ',常见问题,FAQ';
        $pageSeo['description'] = $catRow['seo_description'] ?: 'Yao资金网' . $catLabel . '常见问题解答';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.yaozijin.com/faq.php">
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($pageSeo['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageSeo['keywords']); ?>">
    <title><?php echo htmlspecialchars($pageSeo['title']); ?></title>

    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
    <link rel="stylesheet" href="/css/page-custom.css?v=20260504">
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
                    // 有分类参数时不覆盖，保留PHP设置的分类SEO
                    if (!new URLSearchParams(window.location.search).has('cat')) {
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
                }
            } catch(e) {}
        }
    };
    xhr.send();
})();
</script>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<script>var FAQ_API_DATA = <?php require __DIR__ . '/inc_faq_data.php'; ?>;</script>
<script>
// 强制刷新页面版本（绕过缓存）
if ('caches' in window) {
    caches.keys().then(function(names) {
        names.forEach(function(name) { caches.delete(name); });
    });
}
</script>

<script>
(function(){var ua=navigator.userAgent;if(/Mobile|Android|iPhone|iPod|BlackBerry|Windows Phone|webOS|Opera Mini|IEMobile/i.test(ua)&&window.location.pathname.indexOf("/mobile/")===-1){var p=window.location.pathname.split("/").pop();if(p){window.location.href="mobile/"+p+window.location.search;}}})();
</script>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar"><?php include __DIR__ . "/includes/nav.php"; ?></ul>

            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <main id="main-content">
        <!-- 页面标题区 -->
        <section class="page-header">
            <div class="page-header-container">
                <div class="page-header-badge">
                    <i class="fas fa-question-circle"></i>
                    <span>FAQ</span>
                </div>
                <h1 class="page-header-title">常见问题</h1>
                <p class="page-header-subtitle">解答您关于资金业务的常见疑问</p>
            </div>
        </section>

        <!-- FAQ内容 - 可编辑区域 -->
        <section class="page-content">
            <div class="section-container">
                
                <!-- FAQ搜索 -->
                <div class="editable-section" data-section="faq-search">
                    <div class="faq-search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="faq-search-input" placeholder="搜索问题关键词...">
                        <button class="faq-search-btn">搜索</button>
                    </div>
                </div>

                <!-- FAQ分类 -->
                <div class="editable-section" data-section="faq-categories">
                    <div class="faq-categories" id="faqCategoryButtons">
                        <div class="faq-category-item active" data-category="all">
                            <i class="fas fa-th-large"></i>
                            <span>全部问题</span>
                        </div>
                        <!-- PHP动态生成分类按钮 -->
<?php require_once __DIR__ . '/inc_cat_buttons.php'; ?>
                    </div>
                </div>

                <!-- FAQ列表 -->
                <div class="editable-section" data-section="faq-list">
                    <div class="faq-custom-container">                        <!-- PHP动态渲染FAQ分类（来自数据库） -->
<?php require_once __DIR__ . '/inc_faq_render.php'; ?>
                        <!-- end PHP动态渲染 -->

                <!-- 更多问题 -->
                <div class="editable-section" data-section="faq-more">
                    <div class="faq-more-box">
                        <div class="faq-more-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="faq-more-content">
                            <h3>还有其他问题？</h3>
                            <p>欢迎随时联系我们的专业顾问，我们将竭诚为您解答</p>
                        </div>
                        <div class="contact-button-wrapper">
                            <button class="btn btn-primary" id="faqConsultBtn">
                                <i class="fas fa-phone-alt"></i>
                                联系我们
                            </button>
                            <span id="faqPhoneDisplay" style="display:none;font-size:18px;font-weight:700;color:#1e3a8a;letter-spacing:2px;white-space:nowrap;">13552883008</span>
                        </div>
                    </div>
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

        <!-- 动态加载FAQ数据 -->    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            let faqs = null;
            let categoryLabels = {};
            const categoryIcons = {'liangzi':'fa-lightbulb','guoqiao':'fa-exchange-alt','baizhang':'fa-university','receivable':'fa-file-invoice-dollar','deposit':'fa-landmark','general':'fa-info-circle'};

            try {
                                if (typeof FAQ_API_DATA !== 'undefined' && FAQ_API_DATA) {
                    var apiData = FAQ_API_DATA;
                    if (apiData && apiData.data && apiData.data.length > 0) faqs = apiData.data;
                    if (apiData.categories_order && apiData.categories_order.length > 0) {
                        apiData.categories_order.forEach(function(item) { categoryLabels[item.key] = item.label; });
                    } else if (apiData.categories) {
                        categoryLabels = apiData.categories;
                    }
                }        if (Object.keys(categoryLabels).length === 0) {
                categoryLabels = {'baizhang':'摆账业务','receivable':'云信融资出表','liangzi':'亮资业务','guoqiao':'过桥资金','deposit':'银行存款','general':'一般问题'};
            }

            var catContainer = document.getElementById('faqCategoryButtons');
            if (catContainer) {
                var html = '<div class=\"faq-category-item active\" data-category=\"all\"><i class=\"fas fa-th-large\"></i><span>全部问题</span></div>';
                Object.keys(categoryLabels).forEach(function(k) {
                    html += '<div class=\"faq-category-item\" data-category=\"' + k + '\"><i class=\"fas ' + (categoryIcons[k]||'fa-circle') + '\"></i><span>' + categoryLabels[k] + '</span></div>';
                });
                catContainer.innerHTML = html;
                var catItems = document.querySelectorAll('.faq-category-item');
                for (var ci = 0; ci < catItems.length; ci++) {
                    catItems[ci].addEventListener('click', function() {
                        var cat = this.dataset.category;
                        var items = document.querySelectorAll('.faq-category-item');
                        for (var i2 = 0; i2 < items.length; i2++) items[i2].classList.remove('active');
                        this.classList.add('active');
                        var cats = document.querySelectorAll('.faq-custom-category');
                        for (var c2 = 0; c2 < cats.length; c2++) {
                            cats[c2].style.display = (cat === 'all' || cats[c2].dataset.category === cat) ? 'block' : 'none';
                        }
                        // 更新浏览器URL（不刷新页面）
                        var url = new URL(window.location.href);
                        if (cat === 'all') {
                            url.searchParams.delete('cat');
                        } else {
                            url.searchParams.set('cat', cat);
                        }
                        history.pushState({}, '', url.toString());
                        // 异步获取分类SEO并更新页面meta标签
                        if (cat !== 'all') {
                            var seoXhr = new XMLHttpRequest();
                            seoXhr.open('GET', 'api/faq-category-seo.php?cat=' + encodeURIComponent(cat), true);
                            seoXhr.onload = function() {
                                if (seoXhr.status === 200) {
                                    try {
                                        var resp = JSON.parse(seoXhr.responseText);
                                        if (resp.code === 0 && resp.data) {
                                            var seo = resp.data;
                                            document.title = seo.seo_title + ' - Yao资金网';
                                            var kw = document.querySelector('meta[name="keywords"]');
                                            if (kw) kw.content = seo.seo_keywords;
                                            var desc = document.querySelector('meta[name="description"]');
                                            if (desc) desc.content = seo.seo_description;
                                        }
                                    } catch(e) {}
                                }
                            };
                            seoXhr.send();
                        } else {
                            // 全部问题：恢复默认SEO
                            document.title = '常见问题 - Yao资金网';
                            var kw = document.querySelector('meta[name="keywords"]');
                            if (kw) kw.content = '常见问题,亮资业务,过桥资金,摆账业务,云信融资出表,FAQ';
                            var desc = document.querySelector('meta[name="description"]');
                            if (desc) desc.content = 'Yao资金网常见问题 - 解答您关于资金业务的常见疑问';
                        }
                    });
                }
            }

            if (faqs) {
                var grouped = {};
                for (var fi = 0; fi < faqs.length; fi++) {
                    var f = faqs[fi];
                    var c = f.category || 'general';
                    if (!grouped[c]) grouped[c] = [];
                    grouped[c].push(f);
                }
                var container = document.querySelector('.faq-custom-container');
                if (container) {
                    var h = '';
                    var hasContent = false;
                    var catKeys = Object.keys(categoryLabels);
                    for (var ki = 0; ki < catKeys.length; ki++) {
                        var cat = catKeys[ki];
                        var items = grouped[cat] || [];
                        h += '<div class=\"faq-custom-category\" data-category=\"' + cat + '\"><h3 class=\"faq-custom-category-title\"><i class=\"fas ' + (categoryIcons[cat]||'fa-question') + '\"></i> ' + categoryLabels[cat] + '</h3><div class=\"faq-custom-list\">';
                        if (items.length > 0) {
                            hasContent = true;
                            for (var ii = 0; ii < items.length; ii++) {
                                var faq = items[ii];
                                h += '<details class=\"faq-custom-item\"><summary class=\"faq-custom-question\"><span>' + faq.question + '</span><i class=\"fas fa-chevron-down\"></i></summary><div class=\"faq-custom-answer\">' + faq.answer + '</div></details>';
                            }
                        } else {
                            h += '<p style=\"padding:20px;color:#9ca3af;text-align:center;\">该分类下暂无问题</p>';
                        }
                        h += '</div></div>';
                    }
                    if (hasContent || catKeys.length > 0) {
                        container.innerHTML = h;
                    }
                }
            }
            } catch(e) { console.error('FAQ初始化失败:', e); }
        });
    </script>

    <!-- 页脚 -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="/uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、云信融资出表等全方位资金服务</p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">                   <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <li><a href="/">首页</a></li>
                        <li><a href="/services.html">业务范围</a></li>
                        <li><a href="/cases.html">成功案例</a></li>
                        <li><a href="/advantages.html">服务优势</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">                   <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <li><a href="/news.php">行业资讯</a></li>
                        <li><a href="/faq.html">常见问题</a></li>
                        <li><a href="/contact.html">联系我们</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">                   <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>
    <script src="admin/assets/cms.js"></script>
<script src="/js/main.js"></script>
    <script>
        // 显示/隐藏电话号码
        function showPhoneNumber() {
            const phoneDisplay = document.getElementById('phone-display');
            if (phoneDisplay.style.display === 'none') {
                phoneDisplay.style.display = 'inline-block';
            } else {
                phoneDisplay.style.display = 'none';
            }
        }
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
            
            if (isEditMode && isLoggedIn) {
                console.log('[CMS] 开始加载编辑器...');
                
                // 加载编辑器样式
                const editorCss = document.createElement('link');
                editorCss.rel = 'stylesheet';
                editorCss.href = 'admin/editor.css';
                editorCss.onerror = function() {
                    console.error('[CMS] 编辑器样式加载失败');
                };
                document.head.appendChild(editorCss);
                
                // 加载编辑器脚本
                const editorScript = document.createElement('script');
                editorScript.src = 'admin/editor.js';
                editorScript.onload = function() {
                    console.log('[CMS] 编辑器脚本加载成功');
                };
                editorScript.onerror = function() {
                    console.error('[CMS] 编辑器脚本加载失败');
                };
                document.body.appendChild(editorScript);
            } else if (isEditMode && !isLoggedIn) {
                console.log('[CMS] 未登录，重定向到登录页');
                window.location.href = 'admin/login.html?redirect=' + encodeURIComponent(window.location.href);
            }
        })();

        // 联系我们按钮交互：点击按钮→按钮隐藏，仅显示号码；点击页面空白处→号码隐藏，按钮恢复
        (function() {
            const btn = document.getElementById('faqConsultBtn');
            const phone = document.getElementById('faqPhoneDisplay');
            if (!btn || !phone) return;
            
            let isPhoneVisible = false;

            btn.addEventListener('click', function(e) {
                e.stopPropagation(); // 阻止事件冒泡，避免触发document的点击处理
                btn.style.display = 'none';
                phone.style.display = 'inline';
                isPhoneVisible = true;
            });

            document.addEventListener('click', function(e) {
                if (!isPhoneVisible) return;
                // 点击发生在contact-button-wrapper内部时不处理（已在btn点击时阻断了）
                const wrapper = document.querySelector('.contact-button-wrapper');
                if (wrapper && wrapper.contains(e.target)) return;
                
                phone.style.display = 'none';
                btn.style.display = ''; // 恢复默认display（由CSS类控制）
                isPhoneVisible = false;
            });
        })();
    </script>
    <script src="/js/footer-loader.js?v=20260513e"></script>
</body>
</html>

