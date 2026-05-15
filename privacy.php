<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Yao资金网隐私政策，说明我们如何收集、使用和保护您的个人信息。">
    <meta name="robots" content="noindex, follow">
    <title>隐私政策 - Yao资金网</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .legal-page {
            padding: 120px 0 80px;
            background: var(--bg-secondary);
            min-height: 100vh;
        }
        
        .legal-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .legal-header {
            text-align: center;
            margin-bottom: 48px;
        }
        
        .legal-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 16px;
        }
        
        .legal-date {
            font-size: 14px;
            color: var(--text-muted);
        }
        
        .legal-content {
            background: white;
            padding: 48px;
            border-radius: 24px;
            box-shadow: var(--shadow-card);
        }
        
        .legal-section {
            margin-bottom: 32px;
        }
        
        .legal-section:last-child {
            margin-bottom: 0;
        }
        
        .legal-section h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--border-light);
        }
        
        .legal-section h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 20px 0 12px;
        }
        
        .legal-section p {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 12px;
        }
        
        .legal-section ul {
            list-style: disc;
            padding-left: 24px;
            margin-bottom: 16px;
        }
        
        .legal-section li {
            font-size: 15px;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 8px;
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
            .legal-page {
                padding: 100px 0 60px;
            }
            
            .legal-title {
                font-size: 28px;
            }
            
            .legal-content {
                padding: 28px;
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

    <main class="legal-page">
        <div class="legal-container">
            <header class="legal-header">
                <h1 class="legal-title">隐私政策</h1>
                <p class="legal-date">最后更新日期：2024年4月20日</p>
            </header>
            
            <article class="legal-content">
                <section class="legal-section">
                    <h2>引言</h2>
                    <p>Yao资金网（以下简称"我们"或"公司"）高度重视用户的隐私保护。本隐私政策旨在向您说明我们如何收集、使用、存储和保护您的个人信息。请您在使用我们的服务前仔细阅读本政策。</p>
                    <p>使用我们的服务即表示您同意本隐私政策的条款。如果您不同意本政策的任何内容，请停止使用我们的服务。</p>
                </section>

                <section class="legal-section">
                    <h2>信息收集</h2>
                    <p>我们可能在以下情况下收集您的个人信息：</p>
                    <ul>
                        <li>当您通过网站表单、电话、邮件或其他方式联系我们时</li>
                        <li>当您咨询我们的服务或申请业务合作时</li>
                        <li>当您订阅我们的资讯或参加我们的活动时</li>
                        <li>当您使用我们的网站服务时（通过cookies等技术自动收集）</li>
                    </ul>
                    
                    <h3>收集的信息类型</h3>
                    <ul>
                        <li><strong>联系信息</strong>：姓名、电话号码、电子邮箱、公司名称、职位等</li>
                        <li><strong>业务信息</strong>：企业类型、资金需求、业务类型等</li>
                        <li><strong>技术信息</strong>：IP地址、浏览器类型、访问时间、浏览页面等</li>
                        <li><strong>沟通记录</strong>：与我们的通话记录、邮件往来、咨询内容等</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>信息使用</h2>
                    <p>我们收集您的个人信息主要用于以下目的：</p>
                    <ul>
                        <li>为您提供资金业务咨询和服务</li>
                        <li>处理您的业务申请和需求</li>
                        <li>与您沟通业务进展和相关事宜</li>
                        <li>改进我们的服务质量和用户体验</li>
                        <li>发送您可能感兴趣的行业资讯和服务信息</li>
                        <li>遵守法律法规和监管要求</li>
                        <li>保护我们的合法权益</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>信息保护</h2>
                    <p>我们采取严格的安全措施保护您的个人信息：</p>
                    <ul>
                        <li>使用加密技术保护数据传输安全</li>
                        <li>建立严格的内部数据访问控制制度</li>
                        <li>定期对系统进行安全检测和漏洞修复</li>
                        <li>对员工进行隐私保护和数据安全培训</li>
                        <li>与第三方合作时签署保密协议</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>信息共享</h2>
                    <p>我们承诺不会向无关第三方出售您的个人信息。仅在以下情况下可能共享您的信息：</p>
                    <ul>
                        <li>获得您的明确同意</li>
                        <li>为提供服务所必需的合作方（如银行、金融机构等）</li>
                        <li>根据法律法规或政府机关的要求</li>
                        <li>为保护我们的合法权益或公共安全</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>Cookie使用</h2>
                    <p>我们的网站使用Cookies和类似技术来改善用户体验。Cookies是存储在您设备上的小型文本文件，用于：</p>
                    <ul>
                        <li>记住您的偏好设置</li>
                        <li>分析网站流量和用户行为</li>
                        <li>优化网站性能和内容</li>
                    </ul>
                    <p>您可以通过浏览器设置拒绝或删除Cookies，但这可能影响网站的某些功能。</p>
                </section>

                <section class="legal-section">
                    <h2>您的权利</h2>
                    <p>根据相关法律法规，您对个人信息享有以下权利：</p>
                    <ul>
                        <li><strong>知情权</strong>：了解我们如何处理您的个人信息</li>
                        <li><strong>访问权</strong>：查询我们持有的您的个人信息</li>
                        <li><strong>更正权</strong>：要求更正不准确的个人信息</li>
                        <li><strong>删除权</strong>：在特定情况下要求删除您的个人信息</li>
                        <li><strong>限制处理权</strong>：要求限制对您个人信息的处理</li>
                        <li><strong>反对权</strong>：反对我们基于合法利益处理您的信息</li>
                    </ul>
                    <p>如需行使上述权利，请通过本政策末尾的联系方式与我们联系。</p>
                </section>

                <section class="legal-section">
                    <h2>信息保留</h2>
                    <p>我们仅在实现本政策所述目的所必需的期限内保留您的个人信息，除非法律要求或允许更长的保留期限。超过保留期限后，我们将安全地删除或匿名化您的个人信息。</p>
                </section>

                <section class="legal-section">
                    <h2>政策更新</h2>
                    <p>我们可能会不时更新本隐私政策。更新后的政策将在网站上公布，并注明最后更新日期。重大变更时，我们将通过适当方式通知您。</p>
                </section>

                <section class="legal-section">
                    <h2>联系我们</h2>
                    <p>如果您对本隐私政策有任何疑问、意见或投诉，请通过以下方式联系我们：</p>
                    <ul>
                        <li>电话：13552883008</li>
                        <li>邮箱：wanglizhongguo@126.com</li>
                        <li>地址：北京市朝阳区金融街88号</li>
                    </ul>
                </section>
            </article>
            
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

