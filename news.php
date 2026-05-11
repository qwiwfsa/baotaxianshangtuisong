<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Yao资金网行业资讯 - 亮资知识、摆账流程、资金行业政策、企业融资常识。了解最新行业动态与业务资讯">
    <meta name="keywords" content="亮资知识,摆账流程,资金行业政策,企业融资常识,过桥资金,摆账业务,银行存款,应收账款融资">
    <title>行业资讯 - Yao资金网</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page-custom.css">
    <!-- Logo动态加载 -->
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p&&p.charAt(0)==='/'?p.substring(1):p;}
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
                    if (seo.page_title) document.title = seo.page_title;
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

    <style>
        /* 新闻分页样式 - 统一风格 */
        .news-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin-top: 30px;
            padding: 14px 0;
        }
        .news-pagination .pagination-current {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    height: 38px;
    margin: 0 4px;
    font-size: 14px;
    font-weight: 500;
    background: #1e3a8a;
    color: #fff;
    border-radius: 6px;
}

.pagination-btn {
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            font-size: 13px;
            font-weight: 600;
            color: #9ca3af;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-sizing: border-box;
        }
        .news-pagination .pagination-btn:hover {
            border-color: #1e3a8a;
            color: #1e3a8a;
        }
        .news-pagination .pagination-btn.active {
            background: #1e3a8a;
            color: #fff;
            border-color: #1e3a8a;
        }
        .news-pagination .pagination-btn.disabled {
            color: #e5e7eb;
            border-color: #f0f0f0;
            background: #f9fafb;
            cursor: not-allowed;
            pointer-events: none;
        }
        .news-pagination .pagination-btn i {
            font-size: 13px;
        }


    </style>

<script>
(function(){var ua=navigator.userAgent;if(/Mobile|Android|iPhone|iPod|BlackBerry|Windows Phone|webOS|Opera Mini|IEMobile/i.test(ua)&&window.location.pathname.indexOf("/mobile/")===-1){var p=window.location.pathname.split("/").pop();if(p){window.location.href="mobile/"+p;}}})();
</script>
    <!-- 社交分享样式 -->
    <link rel="stylesheet" href="css/social-share.css">
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="images/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar">
                <li role="none"><a href="index.html" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                <li role="none"><a href="advantages.html" class="nav-link" role="menuitem">服务优势</a></li>
                <li role="none"><a href="news.php" class="nav-link active" role="menuitem">行业资讯</a></li>
                <li role="none"><a href="faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                <li role="none"><a href="contact.html" class="nav-link" role="menuitem">联系我们</a></li>
            </ul>

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
                    <i class="fas fa-newspaper"></i>
                    <span>NEWS & INSIGHTS</span>
                </div>
                <h1 class="page-header-title">行业资讯</h1>
                <p class="page-header-subtitle">了解最新行业动态与业务资讯</p>
            </div>
        </section>

        <!-- 资讯内容 - 可编辑区域 -->
        <section class="page-content">
            <div class="section-container">
                
                <!-- 资讯分类 -->
                <div class="editable-section" data-section="news-categories">
                    <div class="news-categories" id="newsCategories">
                        <a href="#" class="news-category active" data-cat-id="0">全部资讯</a>
                        <!-- 分类将通过JS动态加载 -->
                    </div>
                </div>



                <!-- 精选资讯（大图展示） -->
                <div class="editable-section" data-section="news-featured">
                    <div class="news-featured-grid">
                        <!-- 精选资讯卡片已删除 -->
                    </div>
                </div>

                <!-- 资讯列表 - 卡片式设计 -->
                <div class="editable-section" data-section="news-list">
                    <div class="news-list-container">
                        <!-- 文章由JS动态加载 -->
                    </div><div class="news-pagination">
                        <a href="#" class="pagination-btn disabled"><i class="fas fa-chevron-left"></i></a><a href="#" class="pagination-btn disabled"><i class="fas fa-chevron-right"></i></a>
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

    <!-- 页脚 -->
<?php include 'includes/footer.php'; ?>


    <script src="js/main.js"></script>
    
    <!-- 动态加载资讯文章 -->
    <script>
        // 当前选中的分类
        let currentCategoryId = 0;
        
        // 从服务器API加载分类和文章数据（与手机端一致，从数据库读取）
        async function loadNewsFromServer() {
            console.log('[News] 开始从服务器加载文章...');
            try {
                const ts = Date.now();
                const apiUrl = currentCategoryId
                    ? 'mobile/api/news.php?category_id=' + currentCategoryId + '&limit=100&t=' + ts
                    : 'mobile/api/news.php?limit=100&t=' + ts;
                const response = await fetch(apiUrl, {
                    method: 'GET',
                    cache: 'no-store',
                    headers: { 'Accept': 'application/json', 'Cache-Control': 'no-cache, no-store, must-revalidate', 'Pragma': 'no-cache', 'Expires': '0' }
                });
                if (!response.ok) { return null; }
                const result = await response.json();
                if (result.success && result.data && result.data.news) {
                    console.log('[News] 从服务器加载了', result.data.news.length, '篇文章');
                    return result.data.news;
                }
                return null;
            } catch (error) {
                console.error('[News] 从服务器加载失败:', error);
                return null;
            }
        }

        // 从服务器API加载最新分类并按点击事件生成分类UI
        async function loadCategoriesFromServer() {
            console.log('[News] 从服务器加载分类...');
            const categoriesContainer = document.getElementById('newsCategories');
            if (!categoriesContainer) return;
            
            try {
                const resp = await fetch('mobile/api/news.php?limit=1&t=' + Date.now(), {
                    cache: 'no-store',
                    headers: { 'Accept': 'application/json', 'Cache-Control': 'no-cache' }
                });
                if (resp.ok) {
                    const result = await resp.json();
                    if (result.success && result.data && result.data.categories) {
                        localStorage.setItem('cms_categories', JSON.stringify(result.data.categories));
                        console.log('[News] 服务器分类已更新, 共', result.data.categories.length, '个');
                    }
                }
            } catch (e) {
                console.warn('[News] 从服务器加载分类失败，使用本地缓存:', e);
            }
        }
        
        // 从localStorage加载分类到UI（每次点击先调用loadCategoriesFromServer，再调用此函数）
        function loadCategories() {
            console.log('[News] 开始加载分类...');
            
            const categories = JSON.parse(localStorage.getItem('cms_categories') || '[]');
            console.log('[News] 本地存储分类数量:', categories.length);
            
            const categoriesContainer = document.getElementById('newsCategories');
            if (!categoriesContainer) {
                console.error('[News] 找不到分类容器');
                return;
            }
            
            // 保存当前选中的分类ID
            const prevSelected = currentCategoryId;
            
            // 重建容器 - 保留"全部资讯"
            categoriesContainer.innerHTML = '';
            
            // "全部资讯"链接
            const allLink = document.createElement('a');
            allLink.href = '#';
            allLink.className = 'news-category' + (prevSelected === 0 ? ' active' : '');
            allLink.textContent = '全部资讯';
            allLink.dataset.catId = '0';
            allLink.addEventListener('click', function(e) {
                e.preventDefault();
                currentCategoryId = 0;
                updateActiveCategory();
                loadNewsByCategory();
            });
            categoriesContainer.appendChild(allLink);
            
            // 添加CMS分类
            if (categories.length > 0) {
                categories.forEach(cat => {
                    const catLink = document.createElement('a');
                    catLink.href = '#';
                    catLink.className = 'news-category' + (parseInt(cat.id) === prevSelected ? ' active' : '');
                    catLink.textContent = cat.name;
                    catLink.dataset.catId = cat.id;
                    catLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentCategoryId = parseInt(cat.id);
                        updateActiveCategory();
                        loadNewsByCategory();
                    });
                    categoriesContainer.appendChild(catLink);
                });
            } else {
                // 使用默认分类
                const defaultCategories = ['行业动态', '政策解读', '业务知识', '公司新闻'];
                defaultCategories.forEach((name, index) => {
                    const catLink = document.createElement('a');
                    catLink.href = '#';
                    catLink.className = 'news-category';
                    catLink.textContent = name;
                    catLink.dataset.catId = index + 1;
                    catLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        currentCategoryId = index + 1;
                        updateActiveCategory();
                        loadNewsByCategory();
                    });
                    categoriesContainer.appendChild(catLink);
                });
            }
            
            console.log('[News] 分类加载完成');
        }
        
        // 更新活跃分类样式 和 SEO信息
        function updateActiveCategory() {
            document.querySelectorAll('.news-category').forEach(cat => {
                cat.classList.remove('active');
                if (parseInt(cat.dataset.catId) === currentCategoryId) {
                    cat.classList.add('active');
                }
            });
            updateCategorySeo();
        }

        // 更新分类SEO信息（仅更新meta标签，前端不显示标题/描述文字）
        function updateCategorySeo() {
            const categories = JSON.parse(localStorage.getItem('cms_categories') || '[]');
            
            if (currentCategoryId > 0) {
                const cat = categories.find(c => parseInt(c.id) === currentCategoryId);
                if (cat) {
                    // 动态更新页面标题
                    document.title = (cat.seo_title || cat.name) + ' - 行业资讯 - Yao资金网';
                    
                    // 更新keywords
                    if (cat.seo_keywords) {
                        var kw = document.querySelector('meta[name="keywords"]');
                        if (kw) kw.content = cat.seo_keywords;
                    }
                    
                    // 更新description
                    if (cat.seo_description) {
                        var desc = document.querySelector('meta[name="description"]');
                        if (desc) desc.content = cat.seo_description;
                    }
                }
            } else {
                // 全部资讯 - 恢复默认标题
                document.title = '行业资讯 - Yao资金网';
            }
        }
        
        // 从服务器API或localStorage加载已发布的文章（优先从数据库）
        // 渲染文章列表到页面（分页版，每页10篇）
        function renderArticles(articles) {
            console.log('[News] 开始渲染文章...');
            
            // 按日期排序（最新的在前）
            articles.sort((a, b) => {
                const dateA = new Date(a.publishDate || a.created_at || 0);
                const dateB = new Date(b.publishDate || b.created_at || 0);
                return dateB - dateA;
            });
            
            if (articles.length === 0) {
                const newsContainer = document.querySelector('.news-list-container');
                if (newsContainer) {
                    newsContainer.innerHTML = '<div class="news-empty"><p>该分类下暂无文章</p></div>';
                }
                return;
            }
            
            const pageSize = 10;
            const totalPages = Math.ceil(articles.length / pageSize);
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;
            
            const startIdx = (currentPage - 1) * pageSize;
            const endIdx = Math.min(startIdx + pageSize, articles.length);
            const pageArticles = articles.slice(startIdx, endIdx);
            
            const newsContainer = document.querySelector('.news-list-container');
            if (!newsContainer) {
                console.error('[News] 找不到文章列表容器');
                return;
            }
            
            newsContainer.innerHTML = '';
            pageArticles.forEach(article => {
                newsContainer.insertAdjacentHTML('beforeend', createNewsCard(article));
            });
            
            // 渲染分页器
            renderPagination(currentPage, totalPages, articles);
            
            console.log('[News] 文章加载完成，共', articles.length, '篇，当前页', currentPage);
        }
        
        // 渲染分页按钮
        function renderPagination(page, totalPages, allArticles) {
            const paginationContainer = document.querySelector('.news-pagination');
            if (!paginationContainer) return;
            
            if (totalPages <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }
            
            let html = '';
            
            // 上一页
            if (page > 1) {
                html += '<a href="javascript:void(0)" class="pagination-btn" onclick="goToPage(' + (page - 1) + ')"><i class="fas fa-chevron-left"></i></a>';
            } else {
                html += '<a href="javascript:void(0)" class="pagination-btn disabled"><i class="fas fa-chevron-left"></i></a>';
            }
            // 当前页
            html += '<span class="pagination-current">' + page + '</span>';
            // 下一页
            if (page < totalPages) {
                html += '<a href="javascript:void(0)" class="pagination-btn" onclick="goToPage(' + (page + 1) + ')"><i class="fas fa-chevron-right"></i></a>';
            } else {
                html += '<a href="javascript:void(0)" class="pagination-btn disabled"><i class="fas fa-chevron-right"></i></a>';
            }
            
            paginationContainer.innerHTML = html;
        }
        
        // 跳转到指定页
        function goToPage(page) {
            currentPage = page;
            if (allNewsArticles && allNewsArticles.length > 0) {
                renderArticles(allNewsArticles);
            } else {
                console.warn('[News] 没有文章数据，无法翻页');
            }
        }
        
        // 验证图片数据是否有效
        function isValidImage(imageData) {
            if (!imageData) return false;
            if (typeof imageData !== 'string') return false;
            // 检查是否是有效的Base64图片
            if (imageData.startsWith('data:image')) {
                // 检查Base64数据是否完整（至少要有头部和一部分数据）
                return imageData.length > 100;
            }
            // 检查是否是有效的URL
            if (imageData.startsWith('http://') || imageData.startsWith('https://') || imageData.startsWith('/')) {
                return imageData.length > 10;
            }
            // 检查是否是相对路径
            if(imageData.startsWith('images/')||imageData.startsWith('uploads/')){return true;}
            return false;
        }

        // 获取有效的封面图片
        function getValidCoverImage(article) {
            // 如果有封面图，使用封面图
            if (article.cover_image && isValidImage(article.cover_image)) {
                return article.cover_image;
            }
            // 如果没有封面图，返回 null（显示空白占位图）
            return null;
        }

        // 创建文章卡片HTML
        function createNewsCard(article) {
            const title = article.title || '无标题';
            const summary = article.summary || article.content?.replace(/<[^>]*>/g, '').substring(0, 100) + '...' || '';
            const date = article.publishDate || article.created_at || new Date().toISOString();
            const formattedDate = new Date(date).toLocaleDateString('zh-CN');
            const coverImage = getValidCoverImage(article);
            const articleId = article.id;
            
            // 左图右文布局 - 4:3横图比例
            const imageHtml = coverImage 
                ? `<div style="flex:0 0 180px;width:180px;height:135px;overflow:hidden;border-radius:6px"><img src="${coverImage}" alt="${title}" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy"></div>`
                : `<div style="flex:0 0 180px;width:180px;height:135px;background:#f3f4f6;border-radius:6px"></div>`;
            
            return `
                <article style="display:flex;gap:24px;align-items:stretch;padding:20px 0;border-bottom:1px solid #f0f0f0;margin-bottom:0">
                    ${imageHtml}
                    <div style="flex:1;display:flex;flex-direction:column;justify-content:center;padding-right:20px">
                        <h3 style="margin:0 0 10px 0;font-size:20px;font-weight:600;line-height:1.5"><a href="news-detail.php?id=${articleId}" style="color:#1e293b;text-decoration:none;letter-spacing:1px">${title}</a></h3>
                        <p style="margin:0 0 14px 0;font-size:15px;color:#8e959f;line-height:1.7;letter-spacing:1px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">${summary}</p>
                        <div style="display:flex;align-items:center">
                            <a href="news-detail.php?id=${articleId}" style="font-size:14px;color:#1e3a8a;text-decoration:none">查看更多 →</a>
                            <time style="font-size:14px;color:#b0b4ba;margin-left:auto;padding-right:20px">${formattedDate}</time>
                        </div>
                    </div>
                </article>
            `;
        }
        
        // 当前页码 + 全局文章数据（供分页使用）
        let currentPage = 1;
        let allNewsArticles = [];
        
        // 页面加载完成后执行
        document.addEventListener('DOMContentLoaded', async function() {
            // 先加载分类，再加载文章（确保分类最新后再加载文章）
            await loadCategoriesFromServer();
            loadCategories();
            
            // 再从API加载全部文章
            loadNewsFromServer().then(articles => {
                if (articles && articles.length > 0) {
                    renderArticles(articles);
                    allNewsArticles = articles;
                }
            });
        });

        // 分类点击：先更新分类数据，再加载文章（确保分类实时同步）
        async function loadNewsByCategory() {
            loadNewsFromServer().then(articles => {
                if (articles && articles.length > 0) {
                    renderArticles(articles);
                    allNewsArticles = articles;
                }
            });
        }
        
        // 分类点击时：服务器加载分类 → 更新UI → 加载文章（串行，无竞态）
        async function loadCategoriesAndArticles() {
            await loadCategoriesFromServer();
            loadCategories();
            updateActiveCategory();
            loadNewsByCategory();
        }</script>
    
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
    </script>
    <!-- 社交分享功能 -->
    <script src="js/social-share.js"></script>
</body>
</html>

