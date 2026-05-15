<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Yao资金网热门标签 - 浏览所有行业标签，快速找到感兴趣的亮资、摆账、企业融资相关文章和案例">
    <meta name="keywords" content="亮资,摆账,企业融资,过桥资金,标签云,热门标签">
    <title>热门标签 - Yao资金网</title>
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
        var pageName='tags';
        var seoXhr=new XMLHttpRequest();
        seoXhr.open('GET','/admin/api/fetch-seo.php?page='+pageName+'&t='+Date.now(),true);
        seoXhr.onload=function(){
            if(seoXhr.status>=200&&seoXhr.status<400){
                try{
                    var seoResp=JSON.parse(seoXhr.responseText);
                    if(seoResp.code===0&&seoResp.data){
                        if(seoResp.data.title){document.title=seoResp.data.title;}
                        if(seoResp.data.keywords){var kw=document.querySelector('meta[name="keywords"]');if(kw)kw.content=seoResp.data.keywords;}
                        if(seoResp.data.description){var desc=document.querySelector('meta[name="description"]');if(desc)desc.content=seoResp.data.description;}
                    }
                }catch(e){}
            }
        };
        seoXhr.send();
    })();
    </script>
    <style>
        .tags-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 80px 0 60px; color: white; text-align: center; }
        .tags-header h1 { font-size: 36px; margin-bottom: 12px; }
        .tags-header p { font-size: 16px; opacity: 0.9; }
        .tags-container { max-width: 1000px; margin: 0 auto; padding: 40px 20px; }
        .tags-cloud { display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; padding: 20px 0; }
        .tag-item { display: flex; flex-direction: column; align-items: center; padding: 20px 28px; background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); text-decoration: none; transition: all 0.3s; min-width: 140px; border: 1px solid #e5e7eb; }
        .tag-item:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(59,130,246,0.15); border-color: #3b82f6; }
        .tag-name { font-size: 18px; font-weight: 600; color: #1f2937; margin-bottom: 6px; }
        .tag-item:hover .tag-name { color: #3b82f6; }
        .tag-count { font-size: 13px; color: #6b7280; }
        .tag-count span { background: #f3f4f6; padding: 2px 10px; border-radius: 12px; }
        .loading { text-align: center; padding: 60px 20px; color: #9ca3af; font-size: 16px; }
        .loading i { animation: spin 1s linear infinite; margin-right: 8px; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .empty-tags { text-align: center; padding: 60px 20px; color: #9ca3af; }
        .empty-tags i { font-size: 48px; margin-bottom: 16px; }
        @media (max-width: 768px) {
            .tags-header { padding: 50px 0 40px; }
            .tags-header h1 { font-size: 26px; }
            .tag-item { min-width: 100px; padding: 14px 18px; }
            .tag-name { font-size: 15px; }
        }
    </style>
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
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
        <section class="tags-header">
        <div class="page-header-container">
            <div class="page-header-content">
                <h1>热门标签</h1>
                <p>浏览所有行业标签，快速找到感兴趣的内容</p>
            </div>
        </div>
    </section>

    <div class="tags-container">
        <div class="loading" id="tagCloudLoading"><i class="fas fa-spinner"></i> 加载中...</div>
        <div class="tags-cloud" id="tagCloud" style="display:none;"></div>
        <div class="empty-tags" id="emptyTags" style="display:none;">
            <i class="fas fa-tags"></i>
            <p>暂无标签</p>
        </div>
    </div>

    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/tag-frontend-list.php')
                .then(r => r.json())
                .then(res => {
                    document.getElementById('tagCloudLoading').style.display = 'none';
                    if (res.success && res.data && res.data.length > 0) {
                        const cloud = document.getElementById('tagCloud');
                        cloud.style.display = 'flex';
                        cloud.innerHTML = res.data.map(tag => {
                            const total = (parseInt(tag.article_count) || 0) + (parseInt(tag.case_count) || 0);
                            return `<a href="/tag/${tag.slug}" class="tag-item">
                                <span class="tag-name">${escapeHtml(tag.name)}</span>
                                <span class="tag-count"><span>${total} 篇内容</span></span>
                            </a>`;
                        }).join('');
                    } else {
                        document.getElementById('emptyTags').style.display = 'block';
                    }
                })
                .catch(err => {
                    document.getElementById('tagCloudLoading').innerHTML = '加载失败，请刷新页面重试';
                });
        });

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    </script>
</body>
</html>
