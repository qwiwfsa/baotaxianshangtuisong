<?php
require_once __DIR__ . '/includes/logo.php';
require_once __DIR__ . '/device-detect.php';

DeviceDetector::redirect();
require_once __DIR__ . '/includes/page-seo.php';

// News list page SEO
$news_page_title = '行业资讯 - Yao资金网';
$news_page_keywords = '金融知识,融资服务,资金业务政策,企业融资常识,过桥资金,票据业务,银行冲量,应收账款融资';
$news_page_desc = 'Yao资金网行业资讯 - 金融知识、融资流程、资金业务政策、企业融资常识。了解最新行业动态和专业资讯';
try {
    require_once __DIR__ . '/config/db.php';
    $db_n = getDB();
    $res_n = $db_n->query("SELECT page_title, meta_keywords, meta_description FROM seo_settings WHERE page_id='news.html' LIMIT 1");
    if ($res_n && $row_n = $res_n->fetch_assoc()) {
        if (!empty($row_n['page_title'])) $news_page_title = $row_n['page_title'];
        if (!empty($row_n['meta_keywords'])) $news_page_keywords = $row_n['meta_keywords'];
        if (!empty($row_n['meta_description'])) $news_page_desc = $row_n['meta_description'];
    }
    $db_n->close();
} catch (Exception $e) {}
?>

<?php require_once __DIR__ . '/includes/news-prerender.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.yaozijin.com/news.php">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($news_page_desc); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <title><?php echo htmlspecialchars($news_page_title); ?></title>

    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.min.css?v=20250514">
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
    var pageName = window.location.pathname.split('/').pop().replace('.php','.html') || 'index.html';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data && data.code === 0 && data.data) {
                    var seo = data.data;
                    // Title handled by PHP server-side
                    // // PHP handles title
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
    margin: 0 12px;
    padding: 0 8px;
    font-size: 14px;
    font-weight: 500;
    background: transparent;
    color: #6b7280;
    border-radius: 6px;
    white-space: nowrap;
}

.pagination-btn {
            min-width: 80px;
            height: 40px;
            padding: 0 20px;
            font-size: 14px;
            font-weight: 500;
            color: #1e3a8a;
            background: #fff;
            border: 1px solid #1e3a8a;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-sizing: border-box;
            white-space: nowrap;
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
            color: #1e3a8a;
            border-color: #1e3a8a;
            background: #fff;
            cursor: pointer;
            pointer-events: auto;
            opacity: 0.7;
        }


    
.news-category{transition:none!important;animation:none!important}
</style><style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
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
                        <?php foreach ($allCategories as $cat): ?>
                        <a href="#" class="news-category" data-cat-id="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></a>
                        <?php endforeach; ?>
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
                        <?php if (!empty($allArticles)): ?>
                        <?php foreach ($allArticles as $article): echo renderArticleCard($article, $page); endforeach; ?>
                        <?php else: ?>
                        <div class="news-empty"><p>暂无新闻</p></div>
                        <?php endif; ?>
                    </div><div class="news-pagination">
                        <?php echo renderPagination($page, $totalPages); ?>
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
<script src="/js/main.js"></script>
    
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
                    ? '/mobile/api/news.php?category_id=' + currentCategoryId + '&limit=1000&t=' + ts
                    : '/mobile/api/news.php?limit=1000&t=' + ts;
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
                const resp = await fetch('/mobile/api/news.php?limit=1&t=' + Date.now(), {
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
            // 保留全部资讯避免闪烁 - 只移除动态分类
            while (categoriesContainer.children.length > 1) {
                categoriesContainer.removeChild(categoriesContainer.lastChild);
            }
            if (categoriesContainer.children.length === 0) {
                const allLinkReset = document.createElement('a');
                allLinkReset.href = '#';
                allLinkReset.className = 'news-category';
                allLinkReset.textContent = '全部资讯';
                allLinkReset.dataset.catId = '0';
                categoriesContainer.appendChild(allLinkReset);
            }
            categoriesContainer.firstElementChild.className = 'news-category' + (prevSelected === 0 ? ' active' : '');
            categoriesContainer.firstElementChild.addEventListener('click', function(e) {
                e.preventDefault();
                currentCategoryId = 0;
                updateActiveCategory();
                loadNewsByCategory();
            });
            
            
            
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
                    document.title = (cat.page_title || cat.name) + ' - 行业资讯 - Yao资金网';
                    
                    // 更新keywords
                    if (cat.meta_keywords) {
                        var kw = document.querySelector('meta[name="keywords"]');
                        if (kw) kw.content = cat.meta_keywords;
                    }
                    
                    // 更新description
                    if (cat.meta_description) {
                        var desc = document.querySelector('meta[name="description"]');
                        if (desc) desc.content = cat.meta_description;
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
                html += '<button class="pagination-btn" onclick="goToPage(' + (page - 1) + ')">上一页</button>';
            } else {
                html += '<button class="pagination-btn disabled" onclick="goToPage(1)">上一页</button>';
            }
            // 当前页
            html += '<span class="pagination-current">' + page + ' / ' + totalPages + '</span>';
            // 下一页
            if (page < totalPages) {
                html += '<button class="pagination-btn" onclick="goToPage(' + (page + 1) + ')">下一页</button>';
            } else {
                html += '<button class="pagination-btn disabled" onclick="goToPage(' + totalPages + ')">下一页</button>';
            }
            
            paginationContainer.innerHTML = html;
        }
        
        // Helper for pagination UI update
        function renderPaginationHelper(page, totalPages) {
            var c = document.querySelector('.news-pagination');
            if (!c) return;
            if (totalPages <= 1) { c.innerHTML = ''; return; }
            var h = '';
            if (page > 1) h += '<button class="pagination-btn" onclick="goToPage(' + (page - 1) + ')">上一页</button>';
            else h += '<button class="pagination-btn disabled" disabled>上一页</button>';
            h += '<span class="pagination-current">' + page + ' / ' + totalPages + '</span>';
            if (page < totalPages) h += '<button class="pagination-btn" onclick="goToPage(' + (page + 1) + ')">下一页</button>';
            else h += '<button class="pagination-btn disabled" disabled>下一页</button>';
            c.innerHTML = h;
        }

// 跳转到指定页
        function goToPage(page) {
            currentPage = page;
            // Always load all articles from API for proper pagination
            loadNewsFromServer().then(function(articles) {
                if (articles && articles.length > 0) {
                    allNewsArticles = articles;
                    renderArticles(articles);
                }
            });
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
                        <h3 style="margin:0 0 10px 0;font-size:20px;font-weight:600;line-height:1.5"><a href="news-detail.php?id=${articleId}&page=${currentPage}" style="color:#1e293b;text-decoration:none;letter-spacing:1px">${title}</a></h3>
                        <p style="margin:0 0 14px 0;font-size:15px;color:#8e959f;line-height:1.7;letter-spacing:1px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">${summary}</p>
                        <div style="display:flex;align-items:center">
                            <a href="news-detail.php?id=${articleId}&page=${currentPage}" style="font-size:14px;color:#1e3a8a;text-decoration:none">查看更多 →</a>
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
        // 从URL读取page参数，返回列表时保持页码
        (function() {
            var p = new URLSearchParams(window.location.search).get('page');
            if (p && !isNaN(p) && parseInt(p) > 0) {
                currentPage = parseInt(p);
            }
        })();

        // Check if content is already pre-rendered by server
        var preRendered = document.querySelector('.news-list-container article');

        document.addEventListener('DOMContentLoaded', async function() {
            if (preRendered) {
                console.log('[News] Using pre-rendered content');
                try {
                    var prerenderData = <?php echo $preRenderData; ?>;
                    currentPage = prerenderData.page || 1;
                    allNewsArticles = <?php echo $articlesJson; ?>;
                    // If more than one page, load full article list for proper pagination
                    if (prerenderData.totalPages > 1) {
                        loadNewsFromServer().then(function(articles) {
                            if (articles && articles.length > 0) {
                                allNewsArticles = articles;
                                renderPagination(currentPage, Math.ceil(articles.length / 10), articles);
                            }
                        });
                    }
                } catch(e) {}
                loadCategoriesFromServer();
                loadCategories();
                return;
            }

            // Fallback: original async loading
            await loadCategoriesFromServer();
            loadCategories();
            
            loadNewsFromServer().then(articles => {
                if (articles && articles.length > 0) {
                    allNewsArticles = articles;
                    renderArticles(articles);
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
    </script></body>
</html>

