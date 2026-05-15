<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Yao资金网合规声明，说明我们的业务合规性、风险提示和法律声明。">
    <meta name="robots" content="noindex, follow">
    <title>合规声明 - Yao资金网</title>
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
        
        .risk-warning {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            border-radius: 8px;
            margin: 24px 0;
        }
        
        .risk-warning h3 {
            color: #92400e;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .risk-warning p,
        .risk-warning li {
            color: #78350f;
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
                <h1 class="legal-title">合规声明</h1>
                <p class="legal-date">最后更新日期：2024年4月20日</p>
            </header>
            
            <article class="legal-content">
                <section class="legal-section">
                    <h2>合规经营承诺</h2>
                    <p>Yao资金网严格遵守中华人民共和国相关法律法规，包括但不限于《中华人民共和国公司法》、《中华人民共和国合同法》、《中华人民共和国反洗钱法》等，坚持合规经营，规范运作。</p>
                    <p>我们承诺：</p>
                    <ul>
                        <li>所有业务活动均在法律框架内进行</li>
                        <li>严格遵守金融监管部门的各项规定</li>
                        <li>建立完善的内部合规管理制度</li>
                        <li>定期接受合规培训和审查</li>
                        <li>积极配合监管部门的检查和指导</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>业务范围说明</h2>
                    <p>Yao资金网主要从事以下业务：</p>
                    <ul>
                        <li>企业资金咨询与信息服务</li>
                        <li>过桥资金撮合服务</li>
                        <li>企业财务顾问服务</li>
                        <li>资金业务信息中介服务</li>
                    </ul>
                    <p><strong>重要声明：</strong>我们不从事吸收公众存款、发放贷款等需经金融监管部门批准的业务。我们提供的是资金业务咨询和信息服务，具体资金往来由合作金融机构或资金方与客户直接进行。</p>
                </section>

                <div class="risk-warning">
                    <h3><i class="fas fa-exclamation-triangle"></i> 风险提示</h3>
                    <p>使用我们的服务前，请您充分了解以下风险：</p>
                    <ul>
                        <li><strong>市场风险</strong>：资金业务受宏观经济、金融市场等多种因素影响，存在市场波动风险</li>
                        <li><strong>信用风险</strong>：交易对手可能存在违约风险</li>
                        <li><strong>流动性风险</strong>：资金安排可能因各种原因无法按时到位</li>
                        <li><strong>政策风险</strong>：相关法律法规和政策可能发生变化</li>
                        <li><strong>操作风险</strong>：业务流程中可能存在操作失误风险</li>
                    </ul>
                    <p><strong>请您根据自身风险承受能力谨慎决策，切勿超出自身承受能力进行交易。</strong></p>
                </div>

                <section class="legal-section">
                    <h2>客户准入标准</h2>
                    <p>为确保业务合规和风险可控，我们对客户实行严格的准入管理：</p>
                    
                    <h3>企业客户</h3>
                    <ul>
                        <li>依法设立并有效存续的企业法人</li>
                        <li>具有真实的业务背景和资金需求</li>
                        <li>信用状况良好，无重大不良记录</li>
                        <li>具备相应的还款能力和资金来源</li>
                        <li>能够提供真实、完整、有效的资料</li>
                    </ul>
                    
                    <h3>禁止性规定</h3>
                    <p>我们不为以下情形提供服务：</p>
                    <ul>
                        <li>用于非法目的或违反法律法规的资金需求</li>
                        <li>涉嫌洗钱、恐怖融资等违法活动</li>
                        <li>提供虚假资料或隐瞒重要事实</li>
                        <li>被列入失信被执行人名单</li>
                        <li>其他不符合合规要求的情形</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>反洗钱义务</h2>
                    <p>我们严格遵守《中华人民共和国反洗钱法》及相关法规，履行反洗钱义务：</p>
                    <ul>
                        <li>建立客户身份识别制度，核实客户身份信息</li>
                        <li>对大额和可疑交易进行监测和报告</li>
                        <li>保存客户身份资料和交易记录</li>
                        <li>配合反洗钱行政主管部门的调查</li>
                        <li>对员工进行反洗钱培训</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>信息安全</h2>
                    <p>我们高度重视客户信息安全：</p>
                    <ul>
                        <li>采用加密技术保护客户数据传输和存储安全</li>
                        <li>建立严格的内部信息访问控制制度</li>
                        <li>与员工签署保密协议，明确保密义务</li>
                        <li>未经客户授权，不向第三方披露客户信息</li>
                        <li>定期进行信息安全风险评估</li>
                    </ul>
                </section>

                <section class="legal-section">
                    <h2>免责声明</h2>
                    <p>本网站及其内容仅供参考，不构成任何投资建议或承诺。我们不对以下情况承担责任：</p>
                    <ul>
                        <li>因不可抗力导致的服务中断或延迟</li>
                        <li>因客户提供虚假信息导致的损失</li>
                        <li>因第三方原因导致的资金损失</li>
                        <li>因市场波动导致的投资损失</li>
                        <li>因客户自身决策失误导致的损失</li>
                    </ul>
                    <p>我们保留随时修改、暂停或终止部分或全部服务的权利，恕不另行通知。</p>
                </section>

                <section class="legal-section">
                    <h2>知识产权</h2>
                    <p>本网站所有内容（包括但不限于文字、图片、标识、设计等）的知识产权均归Yao资金网所有，受法律保护。未经我们书面许可，任何单位或个人不得擅自使用、复制、修改或传播。</p>
                </section>

                <section class="legal-section">
                    <h2>争议解决</h2>
                    <p>因本声明或我们的服务产生的任何争议，双方应首先通过友好协商解决。协商不成的，任何一方均可向Yao资金网所在地有管辖权的人民法院提起诉讼。</p>
                </section>

                <section class="legal-section">
                    <h2>联系我们</h2>
                    <p>如果您对本合规声明有任何疑问，或需要了解更详细的合规信息，请通过以下方式联系我们：</p>
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

