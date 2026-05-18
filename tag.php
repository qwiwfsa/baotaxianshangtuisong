<?php
require_once __DIR__ . '/includes/logo.php';
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
// ===== 动态 SEO - 标签页 =====
$tag_seo_title = '标签 - Yao资金网';
$tag_seo_desc = '浏览Yao资金网相关标签内容';
$tag_seo_keywords = '';
$tag_slug_seo = trim($_GET['slug'] ?? '');
if ($tag_slug_seo) {
    try {
        require_once __DIR__ . '/config/db.php';

        $db_tag = getDB();
        $stmt_tag = $db_tag->prepare("SELECT name, seo_title, seo_keywords, seo_description FROM tags WHERE slug = ? LIMIT 1");
        $stmt_tag->bind_param('s', $tag_slug_seo);
        $stmt_tag->execute();
        $result_tag = $stmt_tag->get_result();
        if ($row_tag = $result_tag->fetch_assoc()) {
            $tag_name_seo = $row_tag['name'];
            $tag_seo_title = !empty($row_tag['seo_title']) ? $row_tag['seo_title'] : ($tag_name_seo . ' - Yao资金网');
            $tag_seo_desc = !empty($row_tag['seo_description']) ? $row_tag['seo_description'] : ('浏览与' . $tag_name_seo . '相关的文章和案例');
            $tag_seo_keywords = !empty($row_tag['seo_keywords']) ? $row_tag['seo_keywords'] : $tag_name_seo;
        }
        $stmt_tag->close();
        $db_tag->close();
    } catch (Exception $e) {}
}


// Get slug from URL
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <link rel="canonical" href="https://www.yaozijin.com/tag/<?php echo htmlspecialchars($tag_slug_seo, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <meta charset="UTF-8">
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($tag_seo_desc, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="亮资,摆账,企业融资,过桥资金">
    <title><?php echo htmlspecialchars($tag_seo_title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.min.css?v=20250514">
    <link rel="stylesheet" href="css/page-custom.css">
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','/admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p&&p.charAt(0)==='/'?p:p;}
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
    <style>
        .tag-detail-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 80px 0 60px; color: white; }
        .tag-detail-header-container { max-width: 1000px; margin: 0 auto; padding: 0 20px; }
        .tag-back-btn { display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 14px; margin-bottom: 20px; }
        .tag-back-btn:hover { color: white; }
        .tag-detail-title { font-size: 32px; font-weight: 700; margin-bottom: 8px; }
        .tag-detail-count { font-size: 15px; opacity: 0.85; }
        .tag-content { max-width: 1000px; margin: 0 auto; padding: 30px 20px; }
        .tag-tabs { display: flex; gap: 4px; margin-bottom: 24px; background: #f3f4f6; border-radius: 10px; padding: 4px; }
        .tag-tab { flex: 1; padding: 10px 20px; text-align: center; border: none; background: transparent; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 500; color: #6b7280; transition: all 0.2s; }
        .tag-tab.active { background: white; color: #1e3a8a; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .tag-tab:hover:not(.active) { color: #374151; }
        .tag-item-card { display: flex; gap: 20px; padding: 20px; background: white; border-radius: 12px; margin-bottom: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f3f4f6; transition: all 0.2s; }
        .tag-item-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .tag-item-img { width: 200px; min-height: 130px; border-radius: 8px; object-fit: cover; background: #f3f4f6; flex-shrink: 0; }
        .tag-item-info { flex: 1; }
        .tag-item-title { font-size: 18px; font-weight: 600; color: #1f2937; margin-bottom: 8px; text-decoration: none; display: block; }
        .tag-item-title:hover { color: #3b82f6; }
        .tag-item-summary { font-size: 14px; color: #6b7280; line-height: 1.6; margin-bottom: 10px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .tag-item-meta { font-size: 12px; color: #9ca3af; display: flex; gap: 16px; align-items: center; }
        .tag-item-meta .badge { background: #dbeafe; color: #1d4ed8; padding: 2px 10px; border-radius: 12px; }
        .loading { text-align: center; padding: 40px; color: #9ca3af; }
        .loading i { animation: spin 1s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .empty-state { text-align: center; padding: 60px 20px; color: #9ca3af; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; }
        .tag-pagination { display: flex; justify-content: center; align-items: center; gap: 6px; margin-top: 30px; padding: 14px 0; }
        .tag-pagination .pagination-btn { min-width: 80px; height: 40px; white-space: nowrap; padding: 0 20px; font-size: 14px; font-weight: 500; color: #1e3a8a; background: #fff; border: 1px solid #1e3a8a; border-radius: 6px; cursor: pointer; transition: all 0.2s; }
        .tag-pagination .pagination-btn:hover { background: #eff6ff; }
        .tag-pagination .pagination-btn.disabled { opacity: 0.5; cursor: not-allowed; border-color: #d1d5db; color: #9ca3af; }
        .tag-pagination .pagination-current { display: inline-flex; align-items: center; justify-content: center; min-width: 38px; height: 38px; margin: 0 12px; padding: 0 8px; font-size: 14px; font-weight: 500; color: #1e3a8a; }
        @media (max-width: 768px) {
            .tag-detail-header { padding: 50px 0 40px; }
            .tag-detail-title { font-size: 24px; }
            .tag-item-card { flex-direction: column; gap: 12px; }
            .tag-item-img { width: 100%; height: 180px; }
            .tag-tabs { gap: 2px; }
            .tag-tab { padding: 8px 12px; font-size: 13px; }
        }
    </style>
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
<style>
html{scroll-behavior:auto;overflow-y:scroll}#tagContentList{min-height:400px}#tagLoading{min-height:200px}
</style>
</head>
<body>
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

    <main>
        <section class="tag-detail-header">
        <div class="tag-detail-header-container">
            <a href="/tags.php" class="tag-back-btn"><i class="fas fa-arrow-left"></i> 返回标签列表</a>
            <h1 class="tag-detail-title" id="tagTitle">...</h1>
            <p class="tag-detail-count" id="tagCount">加载中...</p>
        </div>
    </section>

    <div class="tag-content">
        <div class="tag-tabs" id="tagTabs" style="display:none;">
            <button class="tag-tab active" data-type="all" onclick="switchTab('all')">全部</button>
            <button class="tag-tab" data-type="article" onclick="switchTab('article')">文章</button>
            <button class="tag-tab" data-type="case" onclick="switchTab('case')">案例</button>
        </div>
        <div class="loading" id="tagLoading"><i class="fas fa-spinner"></i> 加载中...</div>
        <div id="tagContentList"></div>
        <div class="tag-pagination" id="tagPagination" style="display:none;"></div>
        <div class="empty-state" id="tagEmpty" style="display:none;"><i class="fas fa-inbox"></i><p>该分类暂无内容</p></div>
    </div>

    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        const slug = '<?php echo addslashes($slug); ?>';
        let currentType = 'all';
        let currentPage = 1;
        let tagData = null;

        document.addEventListener('DOMContentLoaded', function() {
            if (!slug) {
                document.getElementById('tagTitle').textContent = '标签不存在';
                document.getElementById('tagCount').textContent = '请检查链接是否正确';
                document.getElementById('tagLoading').style.display = 'none';
                return;
            }
            loadTagData();
        });

        function loadTagData() {
            var loading = document.getElementById('tagLoading');
            var contentList = document.getElementById('tagContentList');
            if (loading) loading.style.display = 'block';
            if (contentList) contentList.style.opacity = '0.5';

            fetch('/api/tag-frontend-detail.php?slug=' + encodeURIComponent(slug) + '&type=' + currentType + '&page=' + currentPage + '&limit=10')
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (loading) loading.style.display = 'none';
                    if (contentList) contentList.style.opacity = '1';
                    if (res.success && res.data) {
                        tagData = res.data;
                        renderTagInfo(tagData.tag);
                        renderContent(tagData);
                        document.getElementById('tagTabs').style.display = 'flex';
                    } else {
                        document.getElementById('tagTitle').textContent = '标签不存在';
                        document.getElementById('tagCount').textContent = '';
                    }
                })
                .catch(function(err) {
                    if (loading) loading.innerHTML = '加载失败，请刷新重试';
                });
        }

        function renderTagInfo(tag) {
            document.getElementById('tagTitle').textContent = tag.name || '...';
            const articleCount = parseInt(tagData.articles?.total) || 0;
            const caseCount = parseInt(tagData.cases?.total) || 0;
            const total = articleCount + caseCount;
            document.getElementById('tagCount').textContent = `共 ${total} 篇相关内容`;

            // Update SEO
            if (tag.seo_title) document.title = tag.seo_title;
            if (tag.seo_keywords) {
                const kw = document.querySelector('meta[name="keywords"]');
                if (kw) kw.content = tag.seo_keywords;
            }
            if (tag.seo_description) {
                const desc = document.querySelector('meta[name="description"]');
                if (desc) desc.content = tag.seo_description;
            }
        }

        function renderContent(data) {
            const container = document.getElementById('tagContentList');
            container.innerHTML = '';

            let items = [];
            if (currentType === 'all' || currentType === 'article') {
                items = items.concat((data.articles?.list || []).map(a => ({ ...a, _type: 'article' })));
            }
            if (currentType === 'all' || currentType === 'case') {
                items = items.concat((data.cases?.list || []).map(c => ({ ...c, _type: 'case' })));
            }

            if (items.length === 0) {
                document.getElementById('tagEmpty').style.display = 'block';
                document.getElementById('tagPagination').style.display = 'none';
                return;
            }

            items.forEach(item => {
                const isArticle = item._type === 'article';
                const title = item.title;
                const summary = item.summary || '';
                const image = isArticle ? item.cover_image : item.image;
                const date = item.created_at || '';
                const link = isArticle ? `/news-detail.php?id=${item.id}` : `/case-detail.html?id=${item.id}`;
                const typeLabel = isArticle ? '文章' : '案例';

                const card = document.createElement('div');
                card.className = 'tag-item-card';
                card.innerHTML = `
                    ${image ? `<img class="tag-item-img" src="${image}" alt="${escapeHtml(title)}" onerror="this.style.display='none'">` : `<div class="tag-item-img" style="display:flex;align-items:center;justify-content:center;color:#d1d5db;"><i class="fas fa-file-alt fa-3x"></i></div>`}
                    <div class="tag-item-info">
                        <a href="${link}" class="tag-item-title">${escapeHtml(title)}</a>
                        <div class="tag-item-summary">${escapeHtml(summary.replace(/<[^>]*>/g, '').substring(0, 150))}</div>
                        <div class="tag-item-meta">
                            <span class="badge">${typeLabel}</span>
                            <span><i class="far fa-calendar-alt"></i> ${date.substring(0, 10)}</span>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });

            // Pagination
            const totalItems = data.articles?.total || 0;
            const totalPages = Math.max(1, Math.ceil(totalItems / 10));
            if (totalPages > 1) {
                const pagination = document.getElementById('tagPagination');
                pagination.style.display = 'flex';
                var h = '';
                if (currentPage > 1) h += '<button class="pagination-btn" onclick="changePage(' + (currentPage - 1) + ')">上一页</button>';
                else h += '<button class="pagination-btn disabled">上一页</button>';
                h += '<span class="pagination-current">' + currentPage + ' / ' + totalPages + '</span>';
                if (currentPage < totalPages) h += '<button class="pagination-btn" onclick="changePage(' + (currentPage + 1) + ')">下一页</button>';
                else h += '<button class="pagination-btn disabled">下一页</button>';
                var phtml = h;
                pagination.innerHTML = phtml;
            }
        }

        function switchTab(type) {
            currentType = type;
            currentPage = 1;
            document.querySelectorAll('.tag-tab').forEach(t => t.classList.remove('active'));
            document.querySelector(`.tag-tab[data-type="${type}"]`).classList.add('active');
            loadTagData();
        }

        function changePage(page) {
            if (page < 1) return;
            currentPage = page;
            loadTagData();
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    </script>
</body>
</html>
