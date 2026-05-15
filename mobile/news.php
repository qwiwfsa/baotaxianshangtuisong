<?php header("Cache-Control: no-cache, no-store, must-revalidate"); header("Pragma: no-cache"); header("Expires: 0"); ?>
<?php header('Cache-Control: no-cache, no-store, must-revalidate'); header('Pragma: no-cache'); header('Expires: 0'); ?>
<!DOCTYPE html>
<html lang="zh-CN"
data-share-label="分享到："
data-share-to="分享到"
data-share-wx="微信"
data-share-moments="朋友圈"
data-share-wx-desc="打开微信扫一扫，分享给好友或朋友圈"
data-share-wx-hint="打开微信「扫一扫」分享"
data-share-close="关闭"
data-share-copied="链接已复制"
data-share-copy-fail="复制失败"
data-share-copy="复制链接"><head>


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





<link rel="icon" href="../uploads/logo/logo_20260504_045101_69f80995372b0.png">    <!-- 社交分享样式 -->
    <link rel="stylesheet" href="../css/social-share.css">
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
</head>





<body>





    <a href="#main-content" class="skip-link">跳转到主要内容</a>











    <!-- 导航栏 -->





    <nav class="navbar scrolled" id="navbar" role="navigation" aria-label="主导航">





        <div class="navbar-container">





<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="../uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>





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





                    <div class="news-categories" id="newsCategories"><a href="#" class="news-category active" data-cat-id="0">全部资讯</a></div>





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





                <p class="footer-copyright" id="footerCopyright">© 2024 Yao资金网 宏都资本版权所有</p>
                <p class="footer-disclaimer" id="footerDisclaimer">粤ICP备2026052915号</p>





            </div>





        </div>





    </footer>





    <!-- cms.js removed: not needed for news.php -->











    <script src="../js/main.js"></script>
<script>
(async function(){
    var STATE = {all:[], page:1, per:10, loading:false, currentCategory:0};
    var el = document.querySelector('.news-list-container');
    if(!el) return;

    // 默认SEO（全部资讯）
    var NEWS_DEFAULT_SEO = {
        title: '资金行业资讯 | 企业摆账 - 过桥短拆行业动态',
        keywords: '资金行业新闻，企业融资资讯，银行冲量政策，工程亮资新规，实缴验资政策',
        description: '提供资金行业最新政策、市场动态解读，包含过桥短拆、工程亮资、实缴验资、企业摆账行业新规资讯。'
    };

    // 分类SEO同步
    function syncCategorySEO(catId) {
        if (catId === 0) {
            document.title = NEWS_DEFAULT_SEO.title;
            var kw = document.querySelector('meta[name="keywords"]');
            if (kw) kw.content = NEWS_DEFAULT_SEO.keywords;
            var desc = document.querySelector('meta[name="description"]');
            if (desc) desc.content = NEWS_DEFAULT_SEO.description;
            return;
        }
        var seoXhr = new XMLHttpRequest();
        seoXhr.open('GET', '../api/category-seo.php?type=news&id=' + catId, true);
        seoXhr.onload = function() {
            if (seoXhr.status === 200) {
                try {
                    var resp = JSON.parse(seoXhr.responseText);
                    if (resp.code === 0 && resp.data) {
                        var seo = resp.data;
                        if (seo.seo_title) document.title = seo.seo_title;
                        var kw = document.querySelector('meta[name="keywords"]');
                        if (kw && seo.seo_keywords) kw.content = seo.seo_keywords;
                        var desc = document.querySelector('meta[name="description"]');
                        if (desc && seo.seo_description) desc.content = seo.seo_description;
                    }
                } catch(e) {}
            }
        };
        seoXhr.send();
    }

    async function loadNews(){
        STATE.loading = true;
        el.innerHTML = '<div style="text-align:center;padding:40px;color:#666;font-size:16px">加载中...</div>';
        try {
            var url = 'api/news.php?page=1&limit=100&t='+Date.now();
            if(STATE.currentCategory > 0) url += '&category_id='+STATE.currentCategory;
            var r = await fetch(url, {method:'GET',cache:'no-store'});
            if(!r.ok) throw new Error('HTTP '+r.status);
            var d = JSON.parse(await r.text());
            if(!d.success || !d.data) {
                el.innerHTML = '<div style="text-align:center;padding:40px;color:#999">暂无内容</div>'; return;
            }
            // Update categories dynamically
            if(d.data.categories && Array.isArray(d.data.categories)) {
                updateCategories(d.data.categories);
            }
            if(!d.data.news || d.data.news.length===0) {
                el.innerHTML = '<div style="text-align:center;padding:40px;color:#999">暂无内容</div>'; return;
            }
            STATE.all = d.data.news;
            renderPage();
        } catch(e) {
            el.innerHTML = '<div style="text-align:center;padding:40px;color:red;font-size:18px">加载失败: '+e.message+'</div>';
        }
        STATE.loading = false;
    }

    function updateCategories(cats){
        var container = document.getElementById('newsCategories');
        if(!container) return;
        var current = container.querySelectorAll('.news-category');
        var existingHtml = '';
        for(var i=0;i<current.length;i++){
            existingHtml += current[i].outerHTML;
        }
        // Build new category list from API data
        var html = '<a href="#" class="news-category'+(STATE.currentCategory===0?' active':'')+'" data-cat-id="0">全部资讯</a>';
        for(var i=0;i<cats.length;i++){
            var c = cats[i];
            var active = (parseInt(c.id) === STATE.currentCategory) ? ' active' : '';
            html += '<a href="#" class="news-category'+active+'" data-cat-id="'+c.id+'">'+escapeHtml(c.name)+'</a>';
        }
        container.innerHTML = html;
        // Bind click events
        container.querySelectorAll('.news-category').forEach(function(link){
            link.addEventListener('click', function(e){
                e.preventDefault();
                var catId = parseInt(this.dataset.catId);
                STATE.currentCategory = catId;
                STATE.page = 1;
                // Update active class
                container.querySelectorAll('.news-category').forEach(function(l){l.classList.remove('active');});
                this.classList.add('active');
                syncCategorySEO(catId);
                loadNews();
            });
        });
    }

    function escapeHtml(str){
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
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
            if(img) imgHtml = '<div style="flex:0 0 120px;width:120px;height:90px;overflow:hidden;flex-shrink:0;border-radius:8px;margin-top:10px"><img src="'+img+'" style="width:100%;height:100%;object-fit:cover;border-radius:8px" onerror="this.style.display=\'none\'"></div>';
            html += '<div style="background:#fff;border-radius:10px;margin:10px 0;box-shadow:0 1px 8px rgba(0,0,0,0.06);display:flex;align-items:flex-start;overflow:hidden">';
            if(imgHtml) html += imgHtml;
            html += '<div style="flex:1;padding:14px 14px 14px 10px;overflow:hidden">';
            html += '<h3 style="margin:0 0 8px 0;font-size:16px;line-height:1.4"><a href="news-detail.html?id='+a.id+'" style="color:#1e3a8a;text-decoration:none">'+t+'</a></h3>';
            if(s) html += '<p style="margin:0 0 6px 0;font-size:13px;color:#666;line-height:1.5;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">'+s+'</p>';
            if(dt) html += '<span style="font-size:12px;color:#999">'+dt+'</span>';
            html += '</div></div>';
        }
        if(items.length===0) html = '<div style="text-align:center;padding:40px;color:#999">暂无内容</div>';

        var pag = '';
        if(pages > 1){
            pag = '<div style="display:flex;justify-content:center;align-items:center;gap:6px;margin:20px 0">';
            if(pg > 1) {
                pag += '<button onclick="changePage(-1)" style="width:38px;height:38px;border:1px solid #e5e7eb;border-radius:6px;background:#fff;cursor:pointer;font-size:13px;color:#333">&lt;</button>';
            } else {
                pag += '<button disabled style="width:38px;height:38px;border:1px solid #f0f0f0;border-radius:6px;background:#f9fafb;font-size:13px;color:#e5e7eb">&lt;</button>';
            }
            pag += '<span style="width:38px;text-align:center;font-size:13px;color:#666">'+pg+'/'+pages+'</span>';
            if(pg < pages) {
                pag += '<button onclick="changePage(1)" style="width:38px;height:38px;border:1px solid #e5e7eb;border-radius:6px;background:#fff;cursor:pointer;font-size:13px;color:#333">&gt;</button>';
            } else {
                pag += '<button disabled style="width:38px;height:38px;border:1px solid #f0f0f0;border-radius:6px;background:#f9fafb;font-size:13px;color:#e5e7eb">&gt;</button>';
            }
            pag += '</div>';
        }

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

<script>
// 从API同步页脚数据
(function(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../admin/api/footer-data.php?t=' + Date.now(), true);
    xhr.onload = function(){
        if(xhr.status >= 200 && xhr.status < 400){
            try{
                var resp = JSON.parse(xhr.responseText);
                if(resp.code === 0 && resp.data && resp.grouped){
                    var bottom = resp.grouped['bottom'] || [];
                    var copyright = '', disclaimer = '';
                    for(var i = 0; i < bottom.length; i++){
                        if(bottom[i].item_key === 'copyright_text'){
                            copyright = bottom[i].item_value || '';
                        } else if(bottom[i].item_key === 'disclaimer_text'){
                            disclaimer = bottom[i].item_value || '';
                        }
                    }
                    if(copyright){
                        var el = document.getElementById('footerCopyright');
                        if(el) el.innerHTML = copyright;
                    }
                    if(disclaimer){
                        var el = document.getElementById('footerDisclaimer');
                        if(el) el.innerHTML = disclaimer;
                    }
                }
            }catch(e){}
        }
    };
    xhr.send();
})();
</script>
    <!-- 社交分享功能 -->
    <script src="../js/social-share.js"></script>

<script src="../js/footer-loader.js"></script>
<script src="../js/nav-loader.js?v=2"></script>
</body></html>