<?php require_once __DIR__ . '/../includes/page-seo.php'; ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>


    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars(!empty($page_description) ? $page_description : '联系我们 - 获取专业的资金服务咨询，电话：13552883008'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars(!empty($page_keywords) ? $page_keywords : '联系我们,Yao资金网电话,资金服务咨询,商务合作'); ?>">
    <title><?php echo htmlspecialchars($page_title ?: "联系我们"); ?></title>

    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path ?? "../uploads/logo/logo_20260516_071314_6a07a88a2cd5c.png?v=2026051701"); ?>">    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
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
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}.contact-qr-section{background:#fff;border-radius:12px;padding:24px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,0.06);margin-top:20px}.contact-qr-section h3{font-size:16px;color:#1f2937;margin-bottom:16px}.contact-qr-image{width:160px;height:160px;margin:0 auto 12px}.contact-qr-image img{width:100%;height:100%;object-fit:contain}.contact-qr-section p{font-size:13px;color:#9ca3af}.contact-qr-card{display:flex;flex-direction:column;align-items:center;text-align:center}.contact-qr-image{width:120px;height:120px;margin:0 auto 8px}.contact-qr-image img{width:100%;height:100%;object-fit:contain}.contact-qr-text{font-size:15px;font-weight:600;color:#1f2937;margin:0 0 8px 0}.contact-qr-sub{font-size:12px;color:#9ca3af;margin:4px 0 0 0}</style>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="..//uploads/logo/logo_20260505_122045_69f9c47d515d1.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
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
                    <i class="fas fa-phone-alt"></i>
                    <span>CONTACT US</span>
                </div>
                <h1 class="page-header-title">联系我们</h1>
                <p class="page-header-subtitle">随时为您提供专业的资金服务咨询</p>
            </div>
        </section>

        <!-- 联系内容 - 可编辑区域 -->
        <section class="page-content">
            <div class="section-container">
                
                <!-- 联系信息卡片 -->
                <div class="editable-section" data-section="contact-info">
                    <div class="contact-info-grid">
                        <!-- 联系电话 -->
                        <div class="contact-info-card">
                            <div class="contact-info-icon" style="background: #10b981;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h3 class="contact-info-title">联系电话</h3>
                            <p class="contact-info-value">
                                <span>13552883008</span>
                            </p>
                            <p class="contact-info-note">7×24小时服务</p>
                        </div>

                        <!-- 公司地址 -->
                        <div class="contact-info-card">
                            <div class="contact-info-icon" style="background: #10b981;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="contact-info-title">公司地址</h3>
                            <p class="contact-info-value">
                                <strong>财富金融中心</strong><br>
                                北京市朝阳区呼家楼街道东三环中路5号
                            </p>
                        </div>

                        <!-- 微信二维码 -->
                        <div class="contact-info-card contact-qr-card">
                            <p class="contact-qr-text">微信咨询</p>
                            <div class="contact-qr-image">
                                <img src="/uploads/wechat-qr.png" alt="微信二维码" loading="lazy">
                            </div>
                            <p class="contact-qr-sub">扫码添加，即时沟通</p>
                        </div>

                        

                <!-- 联系详情 -->
                <div class="editable-section" data-section="contact-details">
                    <div class="contact-details-grid">
                        <!-- 左侧：联系表单 -->
                        <div class="contact-form-section">
                            <div class="contact-form-header">
                                <h2>在线咨询</h2>
                                <p>填写以下表单，我们将尽快与您联系</p>
                            </div>
                            <form class="contact-form-custom" id="contactForm">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">您的姓名 <span class="required">*</span></label>
                                        <input type="text" id="name" name="name" placeholder="请输入您的姓名" required>
                                        <span class="form-error" id="nameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">联系电话 <span class="required">*</span></label>
                                        <input type="tel" id="phone" name="phone" placeholder="请输入手机号码" required>
                                        <span class="form-error" id="phoneError"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">业务类型 <span class="required">*</span></label>
                                    <select id="serviceType" name="serviceType" required>
                                        <option value="">请选择业务类型</option>
                                        <option value="listed">上市公司类</option>
                                        <option value="baizhang">企业/个人摆账</option>
                                        <option value="deposit">银行存款类</option>
                                        <option value="receivable">应收账款融资</option>
                                        <option value="other">其他业务</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">需求描述</label>
                                    <textarea id="message" name="message" rows="4" placeholder="请简要描述您的资金需求..."></textarea>
                                </div>
                                <button type="submit" class="submit-btn">提交咨询</button>
                            </form>
                        </div>
                    </div>
                </div>

                </main>

                <footer class="footer">
        <div class="footer-container">
            <div class="footer-bottom">
                <p class="footer-copyright">© 2026 Yao资金网 宏都资本版权所有</p>
                <p class="footer-disclaimer">粤ICP备2026052915号</p>
            </div>
        </div>
    </footer>

    <script src="../admin/assets/cms.js" onerror="console.log('CMS not loaded')"></script>

    <script src="../js/main.js"></script>    <script src="../js/nav-loader.js?v=5"></script>
</body>
</html>

