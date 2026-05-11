<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Yao资金网网站地图，快速导航到网站的各个页面。">
    <meta name="robots" content="noindex, follow">
    <title>网站地图 - Yao资金网</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .sitemap-page {
            padding: 120px 0 80px;
            background: var(--bg-secondary);
            min-height: 100vh;
        }
        
        .sitemap-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .sitemap-header {
            text-align: center;
            margin-bottom: 48px;
        }
        
        .sitemap-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 16px;
        }
        
        .sitemap-content {
            background: white;
            padding: 48px;
            border-radius: 24px;
            box-shadow: var(--shadow-card);
        }
        
        .sitemap-section {
            margin-bottom: 32px;
        }
        
        .sitemap-section:last-child {
            margin-bottom: 0;
        }
        
        .sitemap-category {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sitemap-category i {
            color: var(--color-primary);
        }
        
        .sitemap-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        
        .sitemap-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: var(--bg-secondary);
            border-radius: 8px;
            transition: all var(--transition-fast) ease;
        }
        
        .sitemap-item:hover {
            background: var(--color-primary);
            color: white;
            transform: translateX(4px);
        }
        
        .sitemap-item i {
            color: var(--color-accent);
            transition: color var(--transition-fast) ease;
        }
        
        .sitemap-item:hover i {
            color: white;
        }
        
        .sitemap-link {
            font-size: 15px;
            font-weight: 500;
            color: inherit;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            color: var(--color-primary);
            font-weight: 600;
        }
        
        .back-link:hover {
            gap: 12px;
        }
        
        @media (max-width: 768px) {
            .sitemap-page {
                padding: 100px 0 60px;
            }
            
            .sitemap-title {
                font-size: 28px;
            }
            
            .sitemap-content {
                padding: 28px;
            }
            
            .sitemap-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
</head>
<body>
    <!-- 简化导航 -->
    <nav class="navbar" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000; background: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border-light);">
        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <a href="index.html" class="btn btn-outline">返回首页</a>
        </div>
    </nav>

    <main class="sitemap-page">
        <div class="sitemap-container">
            <header class="sitemap-header">
                <h1 class="sitemap-title">网站地图</h1>
            </header>
            
            <div class="sitemap-content">
                <section class="sitemap-section">
                    <h2 class="sitemap-category">
                        <i class="fas fa-home"></i>
                        主要页面
                    </h2>
                    <div class="sitemap-list">
                        <a href="index.html" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">首页</span>
                        </a>
                        <a href="index.html#services" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">业务范围</span>
                        </a>
                        <a href="index.html#cases" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">成功案例</span>
                        </a>
                        <a href="index.html#advantages" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">服务优势</span>
                        </a>
                        <a href="index.html#about" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">关于我们</span>
                        </a>
                        <a href="index.html#testimonials" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">客户评价</span>
                        </a>
                        <a href="index.html#news" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">行业资讯</span>
                        </a>
                        <a href="index.html#faq" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">常见问题</span>
                        </a>
                        <a href="index.html#contact" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">联系我们</span>
                        </a>
                    </div>
                </section>

                <section class="sitemap-section">
                    <h2 class="sitemap-category">
                        <i class="fas fa-briefcase"></i>
                        业务详情
                    </h2>
                    <div class="sitemap-list">
                        <a href="index.html#services" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">上市公司类业务</span>
                        </a>
                        <a href="index.html#services" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">企业/个人摆账</span>
                        </a>
                        <a href="index.html#services" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">银行存款类业务</span>
                        </a>
                        <a href="index.html#services" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">应收账款融资</span>
                        </a>
                    </div>
                </section>

                <section class="sitemap-section">
                    <h2 class="sitemap-category">
                        <i class="fas fa-file-alt"></i>
                        法律合规
                    </h2>
                    <div class="sitemap-list">
                        <a href="privacy.html" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">隐私政策</span>
                        </a>
                        <a href="compliance.html" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">合规声明</span>
                        </a>
                        <a href="sitemap.html" class="sitemap-item">
                            <i class="fas fa-chevron-right"></i>
                            <span class="sitemap-link">网站地图</span>
                        </a>
                    </div>
                </section>
            </div>
            
            <a href="index.html" class="back-link">
                <i class="fas fa-arrow-left"></i>
                返回首页
            </a>
        </div>
    </main>

    <!-- 简化页脚 -->
<?php include 'includes/footer.php'; ?>

    
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
</body>
</html>

