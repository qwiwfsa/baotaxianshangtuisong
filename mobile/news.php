<?php header('Cache-Control: no-cache, no-store, must-revalidate'); header('Pragma: no-cache'); header('Expires: 0'); ?>
<!DOCTYPE html>
<html lang="zh-CN"><head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">





    <meta charset="UTF-8">





    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">





    <meta name="description" content="提供资金行业最新政策、市场动态解读，包含过桥短拆、工程亮资、实缴验资、企业摆账行业新规资讯。">





    <meta name="keywords" content="资金行业新闻，企业融资资讯，银行冲量政策，工程亮资新规，实缴验资政策">





    <title>资金行业资讯 | 企业摆账 - 过桥短拆行业动态</title>





    <link rel="preconnect" href="https://cdnjs.cloudflare.com">





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">





    <link rel="stylesheet" href="../css/style.css">





    <link rel="stylesheet" href="../css/page-custom.css">





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





                        if(resp.data.header_logo){





                            var hl=document.querySelector('.logo img');





                            if(hl)hl.src=resp.data.header_logo;





                        }





                        if(resp.data.footer_logo){





                            var fl=document.querySelector('.footer-logo img');





                            if(fl)fl.src=resp.data.footer_logo;





                        }





                        if(resp.data.favicon){





                            var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');





                            if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}





                            lk.href=resp.data.favicon;





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





<link rel="icon" href="../uploads/logo/logo_20260504_045101_69f80995372b0.png"></head>





<body>





    <a href="#main-content" class="skip-link">跳转到主要内容</a>











    <!-- 导航栏 -->





    <nav class="navbar scrolled" id="navbar" role="navigation" aria-label="主导航">





        <div class="navbar-container">





<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="../uploads/logo/logo_20260501_234314_69f51e721c7d0.png" alt="Yao资金网" style="height:48px;width:auto;"></a>





            <ul class="nav-menu" role="menubar" id="dynamicNavMenu">





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





                    <span>NEWS &amp; INSIGHTS</span>





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





                    <div class="news-categories" id="newsCategories"><a href="#" class="news-category active" data-cat-id="0">全部资讯</a><a href="#" class="news-category" data-cat-id="5">企业摆账</a><a href="#" class="news-category" data-cat-id="1">过桥短拆</a><a href="#" class="news-category" data-cat-id="4">实缴验资</a><a href="#" class="news-category" data-cat-id="2">显账亮资</a><a href="#" class="news-category" data-cat-id="3">金融知识</a></div>





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





<div class="editable-section" data-section="news-pagination">





                    <div class="news-pagination">





                        <a href="#" class="pagination-btn disabled"><i class="fas fa-chevron-left"></i></a><a href="#" class="pagination-btn disabled"><i class="fas fa-chevron-right"></i></a>





                    </div>





                </div>











            </div>





        </section>











    </main>











    <!-- 页脚 -->





    <footer class="footer">





        <div class="footer-container">





            <div class="footer-bottom">





                <p class="footer-copyright">© 2024 Yao资金网 版权所有</p>





                <p class="footer-disclaimer">投资有风险，理财需谨慎。本网站内容仅供参考，不构成投资建议。</p>





            </div>





        </div>





    </footer>





    <!-- cms.js removed: not needed for news.php -->











    <script src="../js/main.js"></script>
<script>
(async function(){
    var STATE = {all:[], page:1, per:10, loading:false};
    var el = document.querySelector('.news-list-container');
    if(!el) return;

    async function loadNews(){
        STATE.loading = true;
        el.innerHTML = '<div style="text-align:center;padding:40px;color:#666;font-size:16px">加载中...</div>';
        try {
            var r = await fetch('api/news.php?page=1&limit=100&t='+Date.now(), {method:'GET',cache:'no-store'});
            if(!r.ok) throw new Error('HTTP '+r.status);
            var d = JSON.parse(await r.text());
            if(!d.success || !d.data || !d.data.news || d.data.news.length===0) {
                el.innerHTML = '<div style="text-align:center;padding:40px;color:#999">暂无内容</div>'; return;
            }
            STATE.all = d.data.news;
            renderPage();
        } catch(e) {
            el.innerHTML = '<div style="text-align:center;padding:40px;color:red;font-size:18px">加载失败: '+e.message+'</div>';
        }
        STATE.loading = false;
    }

    function renderPage(){
        var total = STATE.all.length, pages = Math.ceil(total/STATE.per)||1;
        var pg = STATE.page; if(pg<1) pg=1; if(pg>pages) pg=pages; STATE.page=pg;
        var start = (pg-1)*STATE.per, end = Math.min(start+STATE.per, total);
        var items = STATE.all.slice(start,end);
        var html = '';
        for(var i=0;i<items.length;i++){
            var a = items[i];
            var t = a.title||'', s = a.summary||'', dt = (a.date||a.created_at||'').substring(0,10);
            var img = a.cover_image ? '../'+a.cover_image : '';
            var imgHtml = '';
            if(img) imgHtml = '<div style="flex:0 0 120px;width:120px;height:90px;overflow:hidden;flex-shrink:0;border-radius:8px;margin-top:10px"><img src="'+img+'" style="width:100%;height:100%;object-fit:cover;border-radius:8px" onerror="this.remove()"></div>';
            html += '<div style="background:#fff;border-radius:10px;margin:10px 0;box-shadow:0 1px 8px rgba(0,0,0,0.06);display:flex;align-items:flex-start;overflow:hidden">';
            if(imgHtml) html += imgHtml;
            html += '<div style="flex:1;padding:14px 14px 14px 10px;overflow:hidden">';
            html += '<h3 style="margin:0 0 8px 0;font-size:16px;line-height:1.4"><a href="news-detail.html?id='+a.id+'" style="color:#1e3a8a;text-decoration:none">'+t+'</a></h3>';
            if(s) html += '<p style="margin:0 0 6px 0;font-size:13px;color:#666;line-height:1.5;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">'+s+'</p>';
            if(dt) html += '<span style="font-size:12px;color:#999">'+dt+'</span>';
            html += '</div></div>';
        }
        if(items.length===0) html = '<div style="text-align:center;padding:40px;color:#999">暂无内容</div>';

        // Pagination
        var pag = '<div style="display:flex;justify-content:center;align-items:center;gap:6px;margin:20px 0">';
        pag += '<button onclick="changePage(-1)" style="width:38px;height:38px;border:1px solid #e5e7eb;border-radius:6px;background:#fff;cursor:pointer;font-size:13px;color:#9ca3af"'+(pg<=1?' disabled style="width:38px;height:38px;border:1px solid #f0f0f0;border-radius:6px;background:#f9fafb;font-size:13px;color:#e5e7eb"':'')+'>&lt;</button>';
        pag += '<button onclick="changePage(1)" style="width:38px;height:38px;border:1px solid #e5e7eb;border-radius:6px;background:#fff;cursor:pointer;font-size:13px;color:#9ca3af"'+(pg>=pages?' disabled style="width:38px;height:38px;border:1px solid #f0f0f0;border-radius:6px;background:#f9fafb;font-size:13px;color:#e5e7eb"':'')+'>&gt;</button>';
        pag += '</div>';

        el.innerHTML = html + pag;
    }

    window.changePage = function(dir){
        STATE.page += dir;
        renderPage();
        window.scrollTo({top:el.offsetTop-60,behavior:'smooth'});
    };
    window.changePage2 = function(p){
        STATE.page = p;
        renderPage();
        window.scrollTo({top:el.offsetTop-60,behavior:'smooth'});
    };

    loadNews();
})();</script>
    <script src="../js/footer-loader.js"></script>
<script>
(function() {
    // Ĭ�ϵ�����Ŀ - APIʧ��ʱʹ��
    var defaultNavItems = [
        { id: '1', name: '首页', url: 'index.html', icon: 'fas fa-home' },
        { id: '2', name: '业务范围', url: 'services.html', icon: 'fas fa-briefcase' },
        { id: '3', name: '成功案例', url: 'cases.html', icon: 'fas fa-trophy' },
        { id: '4', name: '服务优势', url: 'advantages.html', icon: 'fas fa-star' },
        { id: '5', name: '行业资讯', url: 'news.php', icon: 'fas fa-newspaper' },
        { id: '6', name: '常见问题', url: 'faq.html', icon: 'fas fa-question-circle' },
        { id: '7', name: '联系我们', url: 'contact.html', icon: 'fas fa-phone' }
    ];

    function renderNav(items) {
        var container = document.getElementById('dynamicNavMenu');
        if (!container) return;
        var currentPage = window.location.pathname.split('/').pop() || 'index.html';
        var isMobile = window.location.pathname.indexOf('/mobile/') === 0;
        container.innerHTML = items.map(function(item) {
            var url = item.url;
            if (isMobile && url.indexOf('/') === 0) {
                url = url === '/' ? 'index.html' : url.substring(1);
            }
            var isActive = url === currentPage || (currentPage === '' && url === 'index.html');
            return '<li role="none"><a href="' + url + '" class="nav-link' + (isActive ? ' active' : '') + '" role="menuitem">' + item.name + '</a></li>';
        }).join('');
        try { localStorage.setItem('cms_nav_items', JSON.stringify(items)); } catch(e) {}
    }

    // 1. 先从数据库加载
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../admin/api/nav-save.php?type=nav&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            try {
                var resp = JSON.parse(xhr.responseText);
                if (resp.code === 0 && resp.data && resp.data.length > 0) {
                    renderNav(resp.data);
                    return;
                }
            } catch(e) {}
        }
        loadFromLocal();
    };
    xhr.onerror = function() { loadFromLocal(); };
    xhr.send();

    function loadFromLocal() {
        try {
            var stored = localStorage.getItem('cms_nav_items');
            if (stored) {
                var parsed = JSON.parse(stored);
                if (Array.isArray(parsed) && parsed.length > 0) {
                    renderNav(parsed);
                    return;
                }
            }
        } catch(e) {}
        renderNav(defaultNavItems);
    }
})();
</script>
</body></html>