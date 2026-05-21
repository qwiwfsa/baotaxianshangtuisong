<html lang="zh-CN"><head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="专业资金服务平台，主营上市公司短拆、股票解质押过桥、企业个人摆账亮资、实缴验资、资金证明、银行时点日均冲量、工程亮资、定期存款、云信实摆真实出表及云信票据置换，优化财务报表、增资产降负债，诚邀渠道代理合作。">
    <meta name="keywords" content="上市公司短拆,股票解质押过桥,企业摆账,个人亮资,资金证明,实缴验资,银行冲量,工程亮资,过桥短拆,定期存款,云信实摆真实出表,优化财务报表,降负债">
    <meta name="author" content="Yao资金网">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Yao资金网 - 专业资金业务服务商">
    <meta property="og:description" content="提供上市公司过桥、企业摆账、银行存款、资金证明等全方位资金服务">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="zh_CN">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Yao资金网 - 专业资金业务服务商">
    <meta name="twitter:description" content="提供上市公司过桥、企业摆账、银行存款、资金证明等全方位资金服务">
    <link rel="canonical" href="https://www.yaozijin.com/">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">
    <title>ceshi - Yao资金网</title>
    <link rel="icon" href="/favicon-v2.png" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon-v2.png" type="image/x-icon">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="all" onload="this.media='all'">
    <link rel="stylesheet" href="/css/page-custom.css?v=20260519">
    <noscript>&lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"&gt;</noscript>
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
    <!-- 动态内容加载脚本 -->
    <script src="https://hm.baidu.com/hm.js?BAIDU_TONGJI_ID"></script><script>
        // 从localStorage加载编辑后的内容
        (function() {
            const pageName = window.location.pathname.split('/').pop() || 'index.html';
            const savedContent = localStorage.getItem('page_' + pageName);
            if (savedContent) {
                // 页面加载完成后替换内容
                window.addEventListener('load', function() {
                    // 提取body内容
                    const bodyMatch = savedContent.match(/<body[^>]*>([\s\S]*)<\/body>/i);
                    if (bodyMatch && bodyMatch[1]) {
                        // 保留导航栏和页脚，替换主要内容
                        const mainContent = document.querySelector('main');
                        if (mainContent) {
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = bodyMatch[1];
                            // 只替换非导航非页脚的内容
                            const newMain = tempDiv.querySelector('main') || tempDiv;
                            if (newMain) {
                                mainContent.innerHTML = newMain.innerHTML || newMain.innerHTML;
                            }
                        }
                    }
                });
            }
        })();
    </script>
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Yao资金网",
        "description": "专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、云信实摆真实出表等服务",
        "url": "https://www.yaozijin.com",
        "telephone": "+86-13552883008",
        "email": "wanglizhongguo@126.com",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "北京市",
            "addressRegion": "朝阳区",
            "streetAddress": "金融街88号"
        },
        "foundingDate": "2014",
        "areaServed": "CN"
    }
    </script>
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
            } catch(e) {}
        }
    };
    xhr.send();
})();
</script>

<style id="pb-modules">
#main-content .page-section{padding:60px 0}#main-content .section-container{max-width:1200px;margin:0 auto;padding:0 24px}#main-content .section-container h2{font-size:28px;font-weight:700;margin-bottom:16px;color:#1e293b}
#main-content .hero{position:relative;overflow:hidden}#main-content .hero-slide{position:absolute;inset:0}#main-content .hero-slide img{width:100%;height:100%;object-fit:cover}#main-content .hero-container{max-width:1200px;margin:0 auto;padding:60px 24px}#main-content .hero-title{font-size:42px;font-weight:800;margin-bottom:12px}#main-content .hero-subtitle{font-size:20px;margin-bottom:24px;opacity:0.9}
#main-content .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 24px;font-size:14px;font-weight:600;border-radius:8px;cursor:pointer;transition:all 0.2s;text-decoration:none;border:none}#main-content .btn-primary{background:#1e3a8a;color:#fff;padding:14px 28px}#main-content .btn-primary:hover{background:#1e40af;transform:translateY(-1px)}#main-content .btn-secondary{background:#64748b;color:#fff}#main-content .btn-outline{background:transparent;color:#1e3a8a;border:2px solid #1e3a8a}#main-content .btn-small{padding:8px 16px;font-size:12px}#main-content .btn-medium{padding:12px 24px;font-size:14px}#main-content .btn-large{padding:16px 32px;font-size:16px}
#main-content .card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px}#main-content .card{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);transition:box-shadow 0.25s,transform 0.25s}#main-content .card:hover{box-shadow:0 8px 30px rgba(0,0,0,0.10);transform:translateY(-2px)}#main-content .card-img img{width:100%;height:200px;object-fit:cover}#main-content .card-body{padding:20px}#main-content .card-body h3{font-size:18px;font-weight:600;margin-bottom:8px;color:#1e293b}#main-content .card-body p{font-size:14px;color:#64748b;line-height:1.6;margin-bottom:12px}#main-content .card-link{color:#1e3a8a;font-weight:600;font-size:14px;text-decoration:none}#main-content .card-link:hover{text-decoration:underline}
#main-content .carousel{position:relative;overflow:hidden}#main-content .carousel-slide{position:absolute;inset:0}#main-content .carousel-slide img{width:100%;height:100%;object-fit:cover}
#main-content .module-image-text{display:flex;gap:24px;align-items:center}#main-content .module-image-text img{width:100%;border-radius:8px}
#main-content .module-container{margin:0 auto}#main-content .module-video video{width:100%;border-radius:8px}
#main-content .module-button{padding:20px 0}#main-content .module-custom{padding:20px 0}#main-content .module-custom img{max-width:100%;height:auto}
@media(max-width:768px){#main-content .page-section{padding:40px 0}#main-content .section-container{padding:0 16px}#main-content .hero-title{font-size:28px}#main-content .hero-subtitle{font-size:16px}#main-content .card-grid{grid-template-columns:repeat(auto-fill,minmax(260px,1fr))}#main-content .module-image-text{flex-direction:column}}
</style></head>
<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <?php include __DIR__ . "/includes/nav.php"; ?>

    <main id="main-content">
<section class="page-section"><div class="section-container" style="text-align:center"><h2>标题文本</h2><div>这里是内容文本，可以编辑修改。</div></div></section>
<section class="page-section"><div class="section-container"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="图片描述" style="max-width:100%;width:100%" loading="lazy"></div></section>
<section class="page-section"><div class="section-container" style="text-align:center"><h2>标题文本</h2><div>这里是内容文本，可以编辑修改。</div></div></section>
<section class="page-section"><div class="section-container"><div class="card-grid" style="grid-template-columns:repeat(3,1fr)"><div class="card"><div class="card-img"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="卡片标题1" loading="lazy"></div><div class="card-body"><h3>卡片标题1</h3><p>卡片描述内容</p></div></div><div class="card"><div class="card-img"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="卡片标题2" loading="lazy"></div><div class="card-body"><h3>卡片标题2</h3><p>卡片描述内容</p></div></div><div class="card"><div class="card-img"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="卡片标题3" loading="lazy"></div><div class="card-body"><h3>卡片标题3</h3><p>卡片描述内容</p></div></div></div></div></section>
<div class="module module-button" style="text-align:center;padding:20px 0"><span class="btn btn-primary btn-medium">点击按钮</span></div>
<section class="page-section"><div class="section-container"><div class="card-grid" style="grid-template-columns:repeat(3,1fr)"><div class="card"><div class="card-img"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="卡片标题1" loading="lazy"></div><div class="card-body"><h3>卡片标题1</h3><p>卡片描述内容</p></div></div><div class="card"><div class="card-img"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="卡片标题2" loading="lazy"></div><div class="card-body"><h3>卡片标题2</h3><p>卡片描述内容</p></div></div><div class="card"><div class="card-img"><img src="/uploads/20260514_6a05a0508afd2.jpg" alt="卡片标题3" loading="lazy"></div><div class="card-body"><h3>卡片标题3</h3><p>卡片描述内容</p></div></div></div></div></section>
<div class="module module-button" style="text-align:center;padding:20px 0"><span class="btn btn-primary btn-medium">点击按钮</span></div>

</main>

    <!-- 右侧边浮动电话按钮 -->
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
    <div class="chat-widget-phone-display">
                <span class="chat-widget-phone-text">13552883008</span>
            </div></div>

    <!-- 页脚(由数据库动态渲染) -->
        <?php include __DIR__ . "/includes/footer.php"; ?>
<!-- Analytics -->
<!-- Baidu Tongji -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?BAIDU_TONGJI_ID";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<!-- Google Analytics (GA4) -->

<!-- End Analytics -->
<script src="/js/main.js?v=20260513b"></script>
    
    <!-- CMS Data Integration -->

    
    <!-- 成功案例展示脚本 -->
    <script>
        // 成功案例展示模块
        (function() {
            let casesData = [];
            let currentPage = 1;
            const itemsPerPage = 8;
            
            // 从后端API获取案例数据
            async function fetchCases() {
                try {
                    console.log('[首页案例] 开始获取案例数据...');
                    // 使用正确的API路径，添加时间戳防止缓存
                    const response = await fetch('api/cases.php?t=' + Date.now(), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Cache-Control': 'no-cache'
                        }
                    });
                    
                    // 检查响应类型
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('[首页案例] API返回非JSON格式:', text.substring(0, 200));
                        showEmptyState();
                        return;
                    }
                    
                    const result = await response.json();
                    console.log('[首页案例] API返回:', result);
                    
                    if (result.success && result.cases && result.cases.length > 0) {
                        // API返回的是 cases 字段，不是 data 字段
                        // 按ID去重，防止重复显示
                        const seenIds = new Set();
                        const uniqueCases = result.cases.filter(c => {
                            if (seenIds.has(c.id)) {
                                console.log('[首页案例] 去重跳过重复案例:', c.id, c.title);
                                return false;
                            }
                            seenIds.add(c.id);
                            return true;
                        });
                        
                        casesData = uniqueCases.map(c => ({
                            id: c.id,
                            title: c.title,
                            summary: c.summary || '暂无简介',
                            amount: c.amount || '保密',
                            cover_image: c.coverImage || c.image || '/uploads/case-default.jpg'
                        }));
                        console.log('[首页案例] 加载案例数:', casesData.length, '原始数据:', result.cases.length);
                        renderCases();
                        updatePagination();
                    } else {
                        console.log('[首页案例] 无案例数据或API返回失败');
                        showEmptyState();
                    }
                } catch (error) {
                    console.error('[首页案例] 获取案例数据失败:', error);
                    showEmptyState();
                }
            }
            
            // 渲染案例卡片
            function renderCases() {
                const grid = document.getElementById('casesShowcaseGrid');
                if (!grid) return;
                
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const pageData = casesData.slice(startIndex, endIndex);
                
                if (pageData.length === 0) {
                    showEmptyState();
                    return;
                }
                
                grid.innerHTML = pageData.map(item => `
                    <article class="case-card-enhanced" data-id="${item.id}">
                        <div class="case-card-image" onclick="openLightbox('${item.cover_image}')">
                            <img loading="lazy" src="${item.cover_image}" 
                                 alt="${item.title}" 
                                 onerror="this.src='/uploads/case-default.jpg'">
                        </div>
                        <div class="case-card-content">
                            <h3 class="case-card-title" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor: pointer;">${item.title}</h3>
                            <p class="case-card-summary" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor: pointer;">${item.summary}</p>
                            <div class="case-card-meta">
                                <div class="case-card-amount" onclick="window.location.href='case-detail.html?id=${item.id}'" style="cursor: pointer;">
                                    <span class="case-card-amount-label">出资金额</span>
                                    <span class="case-card-amount-value">${item.amount}</span>
                                </div>
                                <button class="btn-view-detail" onclick="window.location.href='case-detail.html?id=${item.id}'">查看详情</button>
                            </div>
                        </div>
                    </article>
                `).join('');
            }
            
            // 显示空状态
            function showEmptyState() {
                const grid = document.getElementById('casesShowcaseGrid');
                if (grid) {
                    grid.innerHTML = `
                        <div class="cases-showcase-empty">
                            <i class="fas fa-folder-open"></i>
                            <p class="cases-showcase-empty-text">暂无成功案例，敬请期待</p>
                        </div>
                    `;
                }
            }
            
            // 更新分页状态
            function updatePagination() {
                const totalPages = Math.ceil(casesData.length / itemsPerPage);
                const prevBtn = document.getElementById('prevPageBtn');
                const nextBtn = document.getElementById('nextPageBtn');
                const pageInfo = document.getElementById('paginationInfo');
                
                if (prevBtn) prevBtn.disabled = currentPage <= 1;
                if (nextBtn) nextBtn.disabled = currentPage >= totalPages || totalPages === 0;
                if (pageInfo) pageInfo.textContent = `第 ${currentPage} 页 / 共 ${totalPages || 1} 页`;
                
                // 如果总页数为1，隐藏分页
                const paginationContainer = document.getElementById('casesShowcasePagination');
                if (paginationContainer) {
                    paginationContainer.style.display = totalPages <= 1 ? 'none' : 'flex';
                }
            }
            
            // 切换页面
            window.changePage = function(direction) {
                const totalPages = Math.ceil(casesData.length / itemsPerPage);
                const newPage = currentPage + direction;
                
                if (newPage >= 1 && newPage <= totalPages) {
                    currentPage = newPage;
                    renderCases();
                    updatePagination();
                    // 滚动到案例区域顶部
                    document.getElementById('casesShowcase').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            };
            
            // 打开图片预览
            window.openLightbox = function(imageSrc) {
                const lightbox = document.getElementById('imageLightbox');
                const lightboxImage = document.getElementById('lightboxImage');
                lightboxImage.src = imageSrc;
                lightbox.style.display = 'flex';
                document.body.style.overflow = 'hidden'; // 禁止背景滚动
            };
            
            // 关闭图片预览
            window.closeLightbox = function() {
                const lightbox = document.getElementById('imageLightbox');
                lightbox.style.display = 'none';
                document.body.style.overflow = ''; // 恢复背景滚动
            };
            
            // 点击背景关闭
            document.addEventListener('click', function(e) {
                const lightbox = document.getElementById('imageLightbox');
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });
            
            // ESC键关闭
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeLightbox();
                }
            });
            
            // 页面加载完成后初始化
            document.addEventListener('DOMContentLoaded', fetchCases);
        })();
    </script>
    
    <!-- 图片预览弹窗 (Lightbox) -->
    <div id="imageLightbox" class="lightbox-overlay" style="display: none;">
        <div class="lightbox-container">
            <button class="lightbox-close" onclick="closeLightbox()" aria-label="关闭预览">
                <i class="fas fa-times"></i>
            </button>
            <img loading="lazy" id="lightboxImage" src="" alt="大图预览">
        </div>
    </div>

    <!-- Lightbox 样式 -->
    <style>
        .lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .lightbox-container {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }
        
        .lightbox-container img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }
        
        .lightbox-close:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        /* 点击图片的指针样式 */
        .case-card-image {
            cursor: pointer;
        }
        
        .case-card-image img {
            transition: transform 0.3s ease;
        }
        
        .case-card-image:hover img {
            transform: scale(1.05);
        }
    
        .hero-title,.hero-subtitle,.hero .btn-primary{transition:none!important;animation:none!important}
        .hero-badge,.hero-title,.hero-subtitle{will-change:auto!important}
</style>

    <!-- 访问统计代码 -->
    <script>
        // 网站访问统计
        (function() {
            // 防止重复发送
            if (window.statsTracked) return;
            window.statsTracked = true;
            
            // 获取当前页面URL
            const pageUrl = window.location.href;
            
            // 获取来源页面
            const referer = document.referrer || '';
            
            // 发送访问统计请求
            function sendStats() {
                const statsData = {
                    action: 'record',
                    page_url: pageUrl,
                    referer: referer
                };
                
                // 使用fetch发送POST请求
                fetch('admin/api/stats.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(statsData).toString()
                }).then(response => response.json())
                  .then(data => {
                      console.log('[Stats] 访问统计已记录:', data);
                  }).catch(error => {
                      console.log('[Stats] 统计记录失败:', error);
                  });
            }
            
            // 页面加载完成后发送统计
            if (document.readyState === 'complete') {
                sendStats();
            } else {
                window.addEventListener('load', sendStats);
            }
        })();
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
            console.log('[CMS] localStorage cms_logged_in:', localStorage.getItem('cms_logged_in'));
            
            if (isEditMode && isLoggedIn) {
                console.log('[CMS] 开始加载编辑器...');
                
                // 加载编辑器样式
                const editorCss = document.createElement('link');
                editorCss.rel = 'stylesheet';
                editorCss.href = 'admin/editor.css';
                editorCss.onerror = function() {
                    console.error('[CMS] 编辑器样式加载失败:', editorCss.href);
                    alert('CMS编辑器样式加载失败，请检查文件路径');
                };
                document.head.appendChild(editorCss);
                console.log('[CMS] 样式表已加载');
                
                // 加载编辑器脚本
                const editorScript = document.createElement('script');
                editorScript.src = 'admin/editor.js';
                editorScript.onload = function() {
                    console.log('[CMS] 编辑器脚本加载成功');
                };
                editorScript.onerror = function() {
                    console.error('[CMS] 编辑器脚本加载失败:', editorScript.src);
                    alert('CMS编辑器脚本加载失败，请检查文件路径');
                };
                document.body.appendChild(editorScript);
            } else if (isEditMode && !isLoggedIn) {
                console.log('[CMS] 未登录，重定向到登录页');
                // 未登录，重定向到登录页
                window.location.href = 'admin/login.html?redirect=' + encodeURIComponent(window.location.href);
            } else {
                console.log('[CMS] 不在编辑模式或未登录');
            }
        })();
    </script>
    <script>
        // 切换电话号码显示：隐藏按钮，原地显示号码
        function togglePhoneDisplay() {
            const btn = document.getElementById('consultNowBtn');
            const phone = document.getElementById('phoneDisplay');
            if (btn && phone) {
                btn.style.display = 'none';
                phone.style.display = 'inline-flex';
            }
        }

        // 点击页面空白处：恢复按钮，隐藏号码
        document.addEventListener('click', function(e) {
            const btn = document.getElementById('consultNowBtn');
            const phone = document.getElementById('phoneDisplay');
            if (btn && phone && phone.style.display !== 'none') {
                // 点击的不是按钮及其子元素，也不是号码及其子元素时隐藏号码
                if (e.target !== btn && !btn.contains(e.target) &&
                    e.target !== phone && !phone.contains(e.target)) {
                    phone.style.display = 'none';
                    btn.style.display = 'inline-flex';
                }
            }
        });
    </script>



</body></html>