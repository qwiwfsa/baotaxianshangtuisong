<?php require_once __DIR__ . '/../includes/page-seo.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>


    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars(!empty($page_description) ? $page_description : 'Yao资金网业务范围 - 提供上市公司过桥、企业摆账、银行存款、云信实摆真实出表等全方位资金服务'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars(!empty($page_keywords) ? $page_keywords : '北京亮资业务,上市公司过桥资金,企业摆账服务,资金过桥,股票解质押,云信实摆真实出表,银行存款冲量'); ?>">
    <title><?php echo htmlspecialchars($page_title ?: "业务范围 - Yao资金网"); ?></title>

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
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="..//uploads/logo/logo_20260505_122045_69f9c47d515d1.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar"><?php include __DIR__ . "/../includes/nav.php"; ?></ul>




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
        <!-- 业务范围Banner图片 -->
        <div class="business-banner">
            <img src="../images/business-banner.jpg" alt="资金业务">
        </div>

        <!-- 页面标题区 -->
        <section class="page-header">
            <div class="page-header-container">
                <div class="page-header-badge">
                    <i class="fas fa-briefcase"></i>
                    <span>OUR SERVICES</span>
                </div>
                <h1 class="page-header-title">业务范围</h1>
                <p class="page-header-subtitle">涵盖上市公司、企业摆账、银行存款、云信实摆真实出表等全方位资金服务</p>
            </div>
        </section>

        <!-- 业务模块 - 可编辑区域 -->
        <section class="page-content">
            <div class="section-container">
                
                <!-- 业务模块列表 -->
                <div class="editable-section" data-section="services-list">
                    <div class="services-v2-grid">
                        <!-- 业务模块 1: 上市公司类 -->
                        <article class="service-v2-card" data-module-id="1">
                            <div class="service-v2-header">
                                <div class="service-v2-icon-large">
                                    <i class="fas fa-chart-line" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="service-v2-body">
                                <h3 class="service-v2-title">上市公司类</h3>
                                <p class="service-v2-desc">为上市公司提供专业资金解决方案，助力企业资本运作</p>
                                <ul class="service-v2-list">
                                    <li><i class="fas fa-check"></i> 短拆、股票解质押过桥</li>
                                    <li><i class="fas fa-check"></i> 募集账户归还过桥、产业基金备案过桥</li>
                                    <li><i class="fas fa-check"></i> 股票质押、定增、协议转让、代持</li>
                                    <li><i class="fas fa-check"></i> 财务报表优化、降负债</li>
                                </ul>
                                <div class="service-v2-footer">
                                    <button class="btn btn-primary btn-sm">了解详情</button>
                                </div>
                            </div>
                        </article>

                        <!-- 业务模块 2: 企业/个人摆账 -->
                        <article class="service-v2-card" data-module-id="2">
                            <div class="service-v2-header">
                                <div class="service-v2-icon-large">
                                    <i class="fas fa-hand-holding-usd" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="service-v2-body">
                                <h3 class="service-v2-title">企业/个人摆账</h3>
                                <p class="service-v2-desc">灵活多样的摆账方案，满足各类资金展示需求</p>
                                <ul class="service-v2-list">
                                    <li><i class="fas fa-check"></i> 长短期定存摆账、云信票据实摆</li>
                                    <li><i class="fas fa-check"></i> 过账实趴、抵押类资金过桥</li>
                                    <li><i class="fas fa-check"></i> 实缴验资、资金证明、银行保函</li>
                                    <li><i class="fas fa-check"></i> 贸易增量、显账亮资</li>
                                </ul>
                                <div class="service-v2-footer">
                                    <button class="btn btn-primary btn-sm">了解详情</button>
                                </div>
                            </div>
                        </article>

                        <!-- 业务模块 3: 银行存款类 -->
                        <article class="service-v2-card" data-module-id="3">
                            <div class="service-v2-header">
                                <div class="service-v2-icon-large">
                                    <i class="fas fa-university" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="service-v2-body">
                                <h3 class="service-v2-title">银行存款类</h3>
                                <p class="service-v2-desc">专业银行存款冲量服务，优化企业财务报表</p>
                                <ul class="service-v2-list">
                                    <li><i class="fas fa-check"></i> 时点冲量、日均业务</li>
                                    <li><i class="fas fa-check"></i> 月末冲量</li>
                                    <li><i class="fas fa-check"></i> 一年期定期存款</li>
                                    <li><i class="fas fa-check"></i> 三年期定期存款</li>
                                </ul>
                                <div class="service-v2-footer">
                                    <button class="btn btn-primary btn-sm">了解详情</button>
                                </div>
                            </div>
                        </article>

                        <!-- 业务模块 4: 云信实摆真实出表 -->
                        <article class="service-v2-card" data-module-id="4">
                            <div class="service-v2-header">
                                <div class="service-v2-icon-large">
                                    <i class="fas fa-file-invoice-dollar" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="service-v2-body">
                                <h3 class="service-v2-title">云信实摆真实出表</h3>
                                <p class="service-v2-desc">盘活应收账款，加速资金周转，助力企业发展</p>
                                <ul class="service-v2-list">
                                    <li><i class="fas fa-check"></i> 置换云信票据</li>
                                    <li><i class="fas fa-check"></i> 可拆分流转支付</li>
                                    <li><i class="fas fa-check"></i> 融资贴现、准入宽松</li>
                                    <li><i class="fas fa-check"></i> 不看征信、包容执行诉讼主体</li>
                                </ul>
                                <div class="service-v2-footer">
                                    <button class="btn btn-primary btn-sm">了解详情</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                <!-- 业务详情扩展 -->
                <div class="editable-section" data-section="services-details">
                    <div class="service-details-custom">
                        <div class="detail-custom-card">
                            <div class="detail-custom-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="detail-custom-title">核心优势</h4>
                            <ul class="detail-custom-list">
                                <li>资金实力雄厚，单笔可提供数亿至数十亿资金支持</li>
                                <li>操作灵活，可根据客户需求定制个性化方案</li>
                                <li>审批快速，资料齐全后最快当日放款</li>
                                <li>合规安全，严格遵循金融监管要求</li>
                            </ul>
                        </div>
                        <div class="detail-custom-card">
                            <div class="detail-custom-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <h4 class="detail-custom-title">收费说明</h4>
                            <ul class="detail-custom-list">
                                <li>按实际使用天数计费，透明无隐藏费用</li>
                                <li>根据资金规模、期限、风险等级综合定价</li>
                                <li>长期合作客户享受优惠费率</li>
                                <li>具体费用以双方签署协议为准</li>
                            </ul>
                        </div>
                        <div class="detail-custom-card">
                            <div class="detail-custom-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h4 class="detail-custom-title">风险提示</h4>
                            <ul class="detail-custom-list">
                                <li>资金业务存在市场风险，请根据自身情况谨慎决策</li>
                                <li>请确保提供真实、完整的资料信息</li>
                                <li>严格遵守合同约定，按时归还资金</li>
                                <li>投资有风险，入市需谨慎</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 服务流程 -->
                <div class="editable-section" data-section="services-process">
                    <div class="section-header" style="margin-top: 80px;">
                        <div class="section-label">PROCESS</div>
                        <h2 class="section-title">服务流程</h2>
                        <p class="section-subtitle">专业高效的服务流程，确保业务顺利开展</p>
                    </div>

                    <div class="process-custom-grid">
                        <div class="process-custom-item">
                            <div class="process-custom-number">01</div>
                            <div class="process-custom-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h4 class="process-custom-title">需求沟通</h4>
                            <p class="process-custom-desc">了解客户资金需求，评估业务可行性</p>
                        </div>
                        <div class="process-custom-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="process-custom-item">
                            <div class="process-custom-number">02</div>
                            <div class="process-custom-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h4 class="process-custom-title">资料审核</h4>
                            <p class="process-custom-desc">风控审核，确立操作性</p>
                        </div>
                        <div class="process-custom-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="process-custom-item">
                            <div class="process-custom-number">03</div>
                            <div class="process-custom-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h4 class="process-custom-title">账户新开</h4>
                            <p class="process-custom-desc">账户激活后，签署协议控材料</p>
                        </div>
                        <div class="process-custom-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="process-custom-item">
                            <div class="process-custom-number">04</div>
                            <div class="process-custom-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h4 class="process-custom-title">进款和出款</h4>
                            <p class="process-custom-desc">出款后归还材料，协议撕毁结束</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- 页脚 -->
    <script src="../admin/assets/cms.js"></script>

    <script src="../js/main.js"></script>
    
    <!-- CMS Editor -->
    <script>
        (function() {
            console.log('[CMS] 初始化检查...');
            
            const urlParams = new URLSearchParams(window.location.search);
            const isEditMode = urlParams.get('edit') === 'true';
            const isLoggedIn = localStorage.getItem('cms_logged_in') === 'true';
            
            console.log('[CMS] 编辑模式:', isEditMode);
            console.log('[CMS] 登录状态:', isLoggedIn);
            
            if (isEditMode && isLoggedIn) {
                console.log('[CMS] 开始加载编辑器...');
                
                const editorCss = document.createElement('link');
                editorCss.rel = 'stylesheet';
                editorCss.href = 'admin/editor.css';
                editorCss.onerror = function() {
                    console.error('[CMS] 编辑器样式加载失败');
                };
                document.head.appendChild(editorCss);
                
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
    
<?php include '../includes/footer-simple.php'; ?>
</body>
</html>

