<?php
/**
 * 手机端 - 标签聚合页（修复版）
 */
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Yao资金网标签相关文章">
    <meta name="keywords" content="标签,文章,行业资讯,资金业务">
    <title>标签 - Yao资金网</title>
        <script>
    // 全局错误防御：抑制外部图片404和document异常
    (function() {
        window.addEventListener('error', function(e) {
            if (e.target && e.target.tagName === 'IMG') {
                e.stopPropagation();
                e.preventDefault();
                return true;
            }
        }, true);
        window.onerror = function(msg) {
            if (msg && (msg.toString().indexOf('document.addEventListener') >= 0 ||
                msg.toString().indexOf('GetPic') >= 0 ||
                msg.toString().indexOf('eastmoney') >= 0)) {
                return true;
            }
            return false;
        };
    })();
    </script>

<link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.min.css?v=20250514">
    <style>
        html, body { height: 100%; margin: 0; }
        body { display: flex; flex-direction: column; min-height: 100vh; }
        .main-content { flex: 1 0 auto; }
        .footer { flex-shrink: 0; }
        .mobile-tag-detail { padding: 20px; max-width: 900px; margin: 0 auto; }
        .mobile-tag-back { display: inline-flex; align-items: center; gap: 6px; color: #3b82f6; text-decoration: none; font-size: 14px; margin-bottom: 16px; }
        .mobile-tag-back:hover { color: #1e40af; }
        .mobile-tag-title { font-size: 22px; font-weight: 700; color: #1f2937; margin-bottom: 4px; }
        .mobile-tag-count { font-size: 14px; color: #6b7280; margin-bottom: 20px; }
        .mobile-tabs { display: flex; gap: 4px; margin-bottom: 16px; background: #f3f4f6; border-radius: 8px; padding: 3px; }
        .mobile-tab { flex: 1; padding: 8px; text-align: center; border: none; background: transparent; border-radius: 6px; cursor: pointer; font-size: 13px; color: #6b7280; transition: all 0.2s; }
        .mobile-tab.active { background: white; color: #1e3a8a; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.08); }
        .mobile-tab:hover:not(.active) { color: #374151; }
        .mobile-item { display: flex; gap: 14px; padding: 14px; background: white; border-radius: 10px; margin-bottom: 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.04); border: 1px solid #f3f4f6; transition: box-shadow 0.2s; text-decoration: none; }
        .mobile-item:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .mobile-item-img { width: 100px; min-width: 100px; height: 75px; border-radius: 8px; object-fit: cover; background: #f3f4f6; flex-shrink: 0; display: flex; align-items: center; justify-content: center; color: #d1d5db; font-size: 28px; align-self: center; }
        .mobile-item-info { flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: center; }
        .mobile-item-title { font-size: 15px; font-weight: 600; color: #1f2937; text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4; margin-bottom: 6px; }
        .mobile-item-title:hover { color: #3b82f6; }
        .mobile-item-meta { font-size: 12px; color: #9ca3af; display: flex; gap: 12px; align-items: center; }
        .mobile-item-meta .tag-badge { background: #dbeafe; color: #1d4ed8; padding: 1px 8px; border-radius: 10px; font-size: 11px; }
        .loading { text-align: center; padding: 40px; color: #9ca3af; }
        .loading i { animation: spin 1s linear infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .empty-state { text-align: center; padding: 40px 20px; color: #9ca3af; }
        .empty-state i { font-size: 40px; margin-bottom: 12px; color: #d1d5db; }
        .empty-state p { font-size: 15px; }
        @media (max-width: 640px) {
            .mobile-tag-detail { padding: 16px; }
        }
    </style>
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
</head>
<body>
    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
            <a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="..//uploads/logo/logo_20260505_122045_69f9c47d515d1.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu"></ul>
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <main class="main-content">
        <div class="mobile-tag-detail">
            <a href="tags.php" class="mobile-tag-back"><i class="fas fa-arrow-left"></i> 返回标签</a>
            <div class="mobile-tag-title" id="tagTitle">...</div>
            <div class="mobile-tag-count" id="tagCount">加载中...</div>
            <div class="mobile-tabs" id="tabs">
                <button class="mobile-tab active" onclick="switchMTab('all')">全部</button>
                <button class="mobile-tab" onclick="switchMTab('article')">文章</button>
                <button class="mobile-tab" onclick="switchMTab('case')">案例</button>
            </div>
            <div class="loading" id="loading"><i class="fas fa-spinner"></i> 加载中...</div>
            <div id="contentList"></div>
        </div>
    </main>

    <!-- 页脚 -->
    <footer class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-bottom">
                <p class="footer-copyright" id="footerCopyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer" id="footerDisclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>

    <script src="../js/main.js"></script>
    <script>
        var slug = '<?php echo addslashes($slug); ?>';
        var mType = 'all';

        function loadMData() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('contentList').innerHTML = '';
            fetch('../api/tag-frontend-detail.php?slug=' + encodeURIComponent(slug) + '&type=' + mType + '&t=' + Date.now())
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    document.getElementById('loading').style.display = 'none';
                    if (res.success && res.data) {
                        var tag = res.data.tag || {};
                        document.getElementById('tagTitle').textContent = tag.name || slug;
                        var ac = parseInt(res.data.articles && res.data.articles.total) || 0;
                        var cc = parseInt(res.data.cases && res.data.cases.total) || 0;
                        document.getElementById('tagCount').textContent = '共 ' + (ac + cc) + ' 篇内容';
                        renderMItems(res.data);
                        if (tag.seo_title) document.title = tag.seo_title;
                        if (tag.seo_keywords) {
                            var kw = document.querySelector('meta[name="keywords"]');
                            if (kw) kw.content = tag.seo_keywords;
                        }
                        if (tag.seo_description) {
                            var desc = document.querySelector('meta[name="description"]');
                            if (desc) desc.content = tag.seo_description;
                        }
                    } else {
                        document.getElementById('tagTitle').textContent = '标签未找到';
                        document.getElementById('tagCount').textContent = '';
                    }
                })
                .catch(function() {
                    document.getElementById('loading').innerHTML = '加载失败，请刷新重试';
                });
        }

        function renderMItems(data) {
            var c = document.getElementById('contentList');
            c.innerHTML = '';
            var items = [];
            if (mType === 'all' || mType === 'article') {
                (data.articles && data.articles.list || []).forEach(function(a) {
                    var img = a.cover_image ? fixImgPath(a.cover_image) : '';
                    items.push({title:a.title, link:'news-detail.html?id=' + a.id, label:'文章', date:a.created_at, image:img});
                });
            }
            if (mType === 'all' || mType === 'case') {
                (data.cases && data.cases.list || []).forEach(function(a) {
                    var img = a.image ? fixImgPath(a.image) : '';
                    items.push({title:a.title, link:'case-detail.html?id=' + a.id, label:'案例', date:a.created_at, image:img});
                });
            }
            if (items.length === 0) {
                c.innerHTML = '<div class="empty-state"><i class="fas fa-inbox"></i><p>该分类暂无内容</p></div>';
                return;
            }
            items.forEach(function(item) {
                var imgHtml = item.image
                    ? '<img class="mobile-item-img" src="' + item.image + '" alt="" onerror="this.style.display=\'none\'">'
                    : '<div class="mobile-item-img"><i class="fas fa-file-alt"></i></div>';
                c.innerHTML += '<a href="' + item.link + '" class="mobile-item">' + imgHtml + '<div class="mobile-item-info"><div class="mobile-item-title">' + esc(item.title) + '</div><div class="mobile-item-meta"><span class="tag-badge">' + item.label + '</span><span>' + (item.date || '').substring(0,10) + '</span></div></div></a>';
            });
        }

        function esc(t) { if (!t) return ''; var d = document.createElement('div'); d.textContent = t; return d.innerHTML; }

        function fixImgPath(p) {
            if (!p) return '';
            if (p.indexOf('http') === 0 || p.indexOf('/') === 0) return p;
            return '../' + p;
        }

        function switchMTab(t) {
            mType = t;
            document.querySelectorAll('.mobile-tab').forEach(function(b) { b.classList.remove('active'); });
            document.querySelectorAll('.mobile-tab').forEach(function(b) {
                if (t === 'all' && b.textContent.indexOf('全部') >= 0) b.classList.add('active');
                else if (t === 'article' && b.textContent.indexOf('文章') >= 0) b.classList.add('active');
                else if (t === 'case' && b.textContent.indexOf('案例') >= 0) b.classList.add('active');
            });
            loadMData();
        }

        if (slug) {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', loadMData);
            } else {
                loadMData();
            }
        }
    </script>
<script src="../js/nav-loader.js?v=5"></script>
</body>
</html>
