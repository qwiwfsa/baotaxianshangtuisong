<?php require_once __DIR__ . '/../includes/page-seo.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN"><head>


    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars(!empty($page_description) ? $page_description : 'Yao资金网常见问题 - 解答您关于资金业务的常见疑问'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars(!empty($page_keywords) ? $page_keywords : '常见问题,亮资业务,过桥资金,摆账业务,云信实摆真实出表,FAQ'); ?>">
    <title><?php echo htmlspecialchars($page_title ?: "常见问题 - Yao资金网"); ?></title>

    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path ?? "../uploads/logo/logo_20260516_071314_6a07a88a2cd5c.png?v=2026051701"); ?>">    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css?v=20260519">
    <link rel="stylesheet" href="../css/page-custom.css?v=20250520">
    <!-- Logo动态加载 -->
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
                    // PHP handles title; // PHP handles title
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
                    // PHP handles title; // PHP handles title
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
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}
        .faq-category-item{transition:none!important;animation:none!important}
        .faq-categories{min-height:50px}

#faqCategoryButtons{display:grid;grid-template-columns:repeat(4,1fr);gap:4px;min-height:44px}
#faqCategoryButtons .faq-category-item{display:flex;align-items:center;justify-content:center;gap:4px;padding:4px 2px;font-size:11px;white-space:nowrap}
</style>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar scrolled" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="..//uploads/logo/logo_20260505_122045_69f9c47d515d1.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu"></ul>




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
                    <div class="faq-categories" id="faqCategoryButtons" style="visibility:hidden">
                    <div class="faq-category-item active" data-category="all" onclick="filterFAQByCategory('all');document.querySelectorAll('.faq-category-item').forEach(i=>i.classList.remove('active'));this.classList.add('active');">
                        <i class="fas fa-th-large"></i>
                        <span>全部</span>
                    </div>
                    <div class="faq-category-item" style="opacity:0.5">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>加载中...</span>
                    </div>
                </div>
                </div>

                <!-- FAQ列表 -->
                                            <div class="editable-section" data-section="faq-list">
                                <div class="faq-custom-container" style="min-height:400px">
                        <div class="faq-loading" id="faqLoading" style="text-align:center;padding:60px 20px;">
                            <i class="fas fa-spinner fa-spin" style="font-size:24px;color:#1e3a8a;display:block;margin-bottom:12px;"></i>
                            <p style="color:#6b7280;font-size:14px;">加载中...</p>
                        </div>
                    </div>
                            </div>

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

    <!-- 动态加载FAQ数据 -->
    <script>
        // 默认SEO配置
        var FAQ_DEFAULT_SEO = {
            title: '常见问题 - Yao资金网',
            keywords: '常见问题,亮资业务,过桥资金,摆账业务,云信实摆真实出表,FAQ',
            description: 'Yao资金网常见问题 - 解答您关于资金业务的常见疑问'
        };

        // 分类SEO同步
        function syncCategorySEO(cat) {
            if (cat === 'all') {
                document.title = FAQ_DEFAULT_SEO.title;
                var kw = document.querySelector('meta[name="keywords"]');
                if (kw) kw.content = FAQ_DEFAULT_SEO.keywords;
                var desc = document.querySelector('meta[name="description"]');
                if (desc) desc.content = FAQ_DEFAULT_SEO.description;
                return;
            }
            var seoXhr = new XMLHttpRequest();
            seoXhr.open('GET', '../api/faq-category-seo.php?cat=' + encodeURIComponent(cat), true);
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
        }

        // 从数据库API加载FAQ数据
        (async function() {
            try {
                const response = await fetch('../admin/api/faq-data.php?t=' + Date.now());
                const result = await response.json();

                if (result.code !== 0 || !result.data) {
                    console.error('FAQ数据加载失败:', result.msg);
                    return;
                }

                const faqs = result.data;
                console.log('加载FAQ数据:', faqs);

                // 分类标签映射
                // 从API动态获取分类标签和排序
                const categoryLabels = {};
                var categoryOrder = [];
                if (result.categories_order && result.categories_order.length > 0) {
                    categoryOrder = result.categories_order;
                    categoryOrder.forEach(function(item) { categoryLabels[item.key] = item.label; });
                } else if (result.categories) {
                    categoryOrder = Object.keys(result.categories).map(function(k){return {key:k,label:result.categories[k]};});
                    Object.assign(categoryLabels, result.categories);
                } else {
                    var uniqueCats = new Set(faqs.map(function(f){return f.category||'general';}));
                    categoryOrder = Array.from(uniqueCats).map(function(k){return {key:k,label:k};});
                    uniqueCats.forEach(function(cat){categoryLabels[cat]=cat;});
                }

                // 分类图标映射
                // 分类图标映射（可扩展）
                const CATEGORY_ICONS = {
                    'liangzi': 'fa-lightbulb',
                    'guoqiao': 'fa-exchange-alt',
                    'baizhang': 'fa-university',
                    'receivable': 'fa-file-invoice-dollar',
                    'deposit': 'fa-landmark',
                    'general': 'fa-info-circle'
                };
                // 从分类名中查找图标，找不到用通用图标
                function getCatIcon(catKey) {
                    return CATEGORY_ICONS[catKey] || 'fa-circle';
                }

                // 动态生成分类按钮
                const categoryButtonsContainer = document.getElementById('faqCategoryButtons');
                if (categoryButtonsContainer) {
                    let buttonsHtml = `
                        <div class="faq-category-item active" data-category="all" onclick="filterFAQByCategory('all');document.querySelectorAll('.faq-category-item').forEach(i=>i.classList.remove('active'));this.classList.add('active');">
                            <i class="fas fa-th-large"></i>
                            <span>全部问题</span>
                        </div>
                    `;

                    categoryOrder.forEach(function(item) {
                        var cat = item.key;
                        var catName = item.label;
                        var catIcon = getCatIcon(cat) || 'fa-circle';
                        buttonsHtml += '<div class="faq-category-item" data-category="' + cat + '"><i class="fas ' + catIcon + '"></i><span>' + catName + '</span></div>';
                    });

                                        // Remove loading placeholder
                    var loadPlaceholder = document.querySelector('#faqCategoryButtons .faq-category-item[style]');
                    if (loadPlaceholder) loadPlaceholder.remove();
                    // Only append new categories, keep existing 全部 button
                    var existingCats = {};
                    document.querySelectorAll('#faqCategoryButtons .faq-category-item').forEach(function(el) {
                        existingCats[el.dataset.category] = true;
                    });
                    // Use DocumentFragment to add all categories at once (no flash)
                    var temp = document.createElement('div');
                    temp.innerHTML = buttonsHtml;
                    var fragment = document.createDocumentFragment();
                    temp.querySelectorAll('.faq-category-item').forEach(function(el) {
                        if (!existingCats[el.dataset.category]) {
                            fragment.appendChild(el);
                        }
                    });
                    categoryButtonsContainer.appendChild(fragment);
                    categoryButtonsContainer.style.visibility = 'visible';

                    // 重新绑定分类点击事件
                    bindCategoryEvents();
                }

                // 绑定分类点击事件
                function bindCategoryEvents() {
                    document.querySelectorAll('.faq-category-item').forEach(item => {
                        item.addEventListener('click', function() {
                            document.querySelectorAll('.faq-category-item').forEach(i => i.classList.remove('active'));
                            this.classList.add('active');

                            const category = this.dataset.category;
                            filterFAQByCategory(category);
                        });
                    });
                }

                // 按分类筛选FAQ
                function filterFAQByCategory(category) {
                    const categories = document.querySelectorAll('.faq-custom-category');
                    categories.forEach(cat => {
                        if (category === 'all' || cat.dataset.category === category) {
                            cat.style.display = 'block';
                        } else {
                            cat.style.display = 'none';
                        }
                    });
                    // SEO同步
                    syncCategorySEO(category);
                }

                // 按分类分组
                const groupedFAQs = {};
                faqs.forEach(faq => {
                    const cat = faq.category || 'general';
                    if (!groupedFAQs[cat]) {
                        groupedFAQs[cat] = [];
                    }
                    groupedFAQs[cat].push(faq);
                });

                // 渲染FAQ列表
                const container = document.querySelector('.faq-custom-container');
                if (container) {
                    let html = '';
                    let hasContent = false;

                    // 遍历所有分类
                                        categoryOrder.forEach(function(item) {
                        var cat = item.key;
                        var catName = item.label;
                        var catIcon = getCatIcon(cat) || 'fa-question';
                        var catFAQs = groupedFAQs[cat] || [];

                        html += '<div class="faq-custom-category" data-category="' + cat + '"><h3 class="faq-custom-category-title"><i class="fas ' + catIcon + '"></i>' + catName + '</h3><div class="faq-custom-list">';

                        if (catFAQs.length > 0) {
                            hasContent = true;
                            for (var fi = 0; fi < catFAQs.length; fi++) {
                                var faq = catFAQs[fi];
                                html += '<details class="faq-custom-item"><summary class="faq-custom-question"><span>' + faq.question + '</span><i class="fas fa-chevron-down"></i></summary><div class="faq-custom-answer">' + faq.answer + '</div></details>';
                            }
                        } else {
                            html += '<p style="padding: 20px; color: #9ca3af; text-align: center;">该分类暂无问题</p>';
                        }

                        html += '</div></div>';
                    });

                    // 如果有数据，替换显示
                    if (hasContent || Object.keys(categoryLabels).length > 0) {
                                            // Hide loading skeleton
                    var loading = document.getElementById('faqLoading');
                    if (loading) loading.style.display = 'none';
                    container.innerHTML = html;
                    }
                }
            } catch (error) {
                console.error('FAQ数据加载失败:', error);
            }
        })();</script>

    <!-- 页脚 -->
    <?php include '../includes/footer-simple.php'; ?>
<script src="../admin/assets/cms.js"></script>

    <script src="../js/main.js"></script>
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
    <script>
        // FAQ分类切换（动画+SEO同步）
        document.addEventListener('DOMContentLoaded', function() {
            const categoryItems = document.querySelectorAll('.faq-category-item');
            const faqCategories = document.querySelectorAll('.faq-custom-category');

            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const category = this.dataset.category;
                    
                    // 更新分类状态
                    categoryItems.forEach(ci => ci.classList.remove('active'));
                    this.classList.add('active');
                    
                    // 显示/隐藏FAQ分类
                    if (category === 'all') {
                        faqCategories.forEach(fc => {
                            fc.style.display = 'block';
                            setTimeout(() => {
                                fc.style.opacity = '1';
                                fc.style.transform = 'translateY(0)';
                            }, 50);
                        });
                    } else {
                        faqCategories.forEach(fc => {
                            if (fc.dataset.category === category) {
                                fc.style.display = 'block';
                                setTimeout(() => {
                                    fc.style.opacity = '1';
                                    fc.style.transform = 'translateY(0)';
                                }, 50);
                            } else {
                                fc.style.opacity = '0';
                                fc.style.transform = 'translateY(20px)';
                                setTimeout(() => {
                                    fc.style.display = 'none';
                                }, 300);
                            }
                        });
                    }
                    // SEO同步
                    syncCategorySEO(category);
                });
            });
        });
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



    

    <script src="../js/nav-loader.js?v=5"></script>
</body></html>