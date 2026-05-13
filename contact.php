<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="联系我们 - 获取专业的资金服务咨询，电话：13552883008">
    <meta name="keywords" content="联系我们,Yao资金网电话,资金服务咨询,商务合作">
    <title>联系我们</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/page-custom.css">
    

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
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar">
                <li role="none"><a href="/" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="/services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="/cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                <li role="none"><a href="/advantages.html" class="nav-link" role="menuitem">服务优势</a></li>
                <li role="none"><a href="/news.php" class="nav-link" role="menuitem">行业资讯</a></li>
                <li role="none"><a href="/faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                <li role="none"><a href="/contact.html" class="nav-link active" role="menuitem">联系我们</a></li>
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

                        <!-- 电子邮箱 -->
                        <div class="contact-info-card">
                            <div class="contact-info-icon" style="background: var(--color-accent);">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="contact-info-title">电子邮箱</h3>
                            <p class="contact-info-value">
                                <a href="mailto:wanglizhongguo@126.com">wanglizhongguo@126.com</a>
                            </p>
                            <p class="contact-info-desc">商务合作咨询</p>
                            <p class="contact-info-note">24小时内回复</p>
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

                        <!-- 微信咨询 -->
                        <div class="contact-info-card">
                            <div class="contact-info-icon" style="background: #8b5cf6;">
                                <i class="fab fa-weixin"></i>
                            </div>
                            <h3 class="contact-info-title">微信咨询</h3>
                            <p class="contact-info-value">扫码添加微信</p>
                            <p class="contact-info-desc">即时沟通更便捷</p>
                            <p class="contact-info-note">7×24小时在线</p>
                        </div>
                    </div>
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
                                                                <button type="submit" class="form-submit" id="submitBtn">
                                    <span class="btn-text">提交咨询</span>
                                    <span class="btn-loading" hidden>
                                        <i class="fas fa-spinner fa-spin"></i> 提交中...
                                    </span>
                                </button>
                            </form>
                        </div>

                        <!-- 右侧：微信二维码和地图 -->
                        <div class="contact-side-section">
                            <!-- 微信二维码 -->
                            <div class="contact-qr-card">
                                <h3>扫码添加微信</h3>
                                <div class="contact-qr-image">
                                    <img src="/uploads/wechat-qr.png" alt="微信二维码" loading="lazy">
                                </div>
                                <p>微信扫一扫，添加好友咨询</p>
                            </div>

                            <!-- 工作时间 -->
                            <div class="contact-hours-card">
                                <h3><i class="fas fa-clock"></i> 工作时间</h3>
                                <div class="contact-hours-item">
                                    <span class="day">周一至周五</span>
                                    <span class="time">9:00 - 18:00</span>
                                </div>
                                <div class="contact-hours-item">
                                    <span class="day">周六</span>
                                    <span class="time">9:00 - 12:00</span>
                                </div>
                                <div class="contact-hours-item">
                                    <span class="day">周日</span>
                                    <span class="time">休息</span>
                                </div>
                                <p class="contact-hours-note"><i class="fas fa-info-circle"></i> 紧急需求可随时联系</p>
                            </div>
                        </div>
                    </div>
                </div>


    </main>

    <!-- 右侧浮动电话按钮 -->
    <div class="phone-float" id="phoneFloat" aria-label="电话咨询">
        <div class="phone-float-ripple"></div>
        <div class="phone-float-ripple"></div>
        <div class="phone-float-ripple"></div>
        <button class="phone-float-btn" id="phoneFloatBtn" aria-label="拨打电话" title="点击拨打电话">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
        <div class="phone-float-display" id="phoneFloatDisplay">
            <span class="phone-float-number">13552883008</span>
        </div>
    </div>

    <!-- 页脚 -->
<?php include 'includes/footer.php'; ?>


    <script src="/js/main.js"></script>
    
    
    <!-- 浮动电话按钮脚本 -->
    <script>
        (function() {
            const phoneFloatBtn = document.getElementById('phoneFloatBtn');
            const phoneFloatDisplay = document.getElementById('phoneFloatDisplay');
            let isDisplayVisible = false;
            
            if (phoneFloatBtn && phoneFloatDisplay) {
                // 点击按钮切换显示/隐藏
                phoneFloatBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    isDisplayVisible = !isDisplayVisible;
                    phoneFloatDisplay.classList.toggle('active', isDisplayVisible);
                });
                
                // 点击页面其他地方隐藏
                document.addEventListener('click', function() {
                    if (isDisplayVisible) {
                        isDisplayVisible = false;
                        phoneFloatDisplay.classList.remove('active');
                    }
                });
                
                // 阻止电话显示区域点击事件冒泡
                phoneFloatDisplay.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // 点击电话号码不跳转（仅显示）
                phoneFloatDisplay.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
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

    <!-- 在线咨询表单提交 -->
    <script>
    (function() {
        var form = document.getElementById('contactForm');
        var btn = document.getElementById('submitBtn');
        if (!form) return;

        var serviceLabels = {
            'listed': '上市公司摆账',
            'baizhang': '企业/个人摆账',
            'deposit': '银行存款冲量',
            'receivable': '应收账款质押',
            'other': '其他业务'
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (btn.disabled) return;

            // Clear previous errors
            document.querySelectorAll('.form-error').forEach(function(el) {
                el.textContent = '';
                el.style.display = 'none';
            });

            var name = document.getElementById('name').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var serviceType = document.getElementById('serviceType').value;
            var message = document.getElementById('message').value.trim();

            // Validate
            var hasError = false;
            if (!name) {
                var err = document.getElementById('nameError');
                if (err) { err.textContent = '请输入您的姓名'; err.style.display = 'block'; }
                hasError = true;
            }
            if (!phone) {
                var err = document.getElementById('phoneError');
                if (err) { err.textContent = '请输入联系电话'; err.style.display = 'block'; }
                hasError = true;
            } else if (!/^1[3-9]\d{9}$/.test(phone)) {
                var err = document.getElementById('phoneError');
                if (err) { err.textContent = '请输入有效的手机号码'; err.style.display = 'block'; }
                hasError = true;
            }
            if (hasError) return;

            // Build content
            var serviceLabel = serviceLabels[serviceType] || serviceType || '未选择';
            var content = '业务类型: ' + serviceLabel;
            if (message) content += '\n备注: ' + message;

            btn.disabled = true;
            btn.querySelector('.btn-text').textContent = '提交中...';
            btn.querySelector('.btn-loading').hidden = false;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'admin/api/message/submit.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                btn.disabled = false;
                btn.querySelector('.btn-text').textContent = '提交咨询';
                btn.querySelector('.btn-loading').hidden = true;

                try {
                    var resp = JSON.parse(xhr.responseText);
                    if (resp.code === 0) {
                        form.reset();
                        showContactSuccess(resp.msg || '提交成功，我们将会尽快与您联系');
                    } else {
                        showContactError(resp.msg || '提交失败，请稍后再试');
                    }
                } catch(e) {
                    showContactError('网络异常，请稍后再试');
                }
            };
            xhr.onerror = function() {
                btn.disabled = false;
                btn.querySelector('.btn-text').textContent = '提交咨询';
                btn.querySelector('.btn-loading').hidden = true;
                showContactError('网络请求失败，请检查网络后重试');
            };
            xhr.send('name=' + encodeURIComponent(name) + '&phone=' + encodeURIComponent(phone) + '&content=' + encodeURIComponent(content) + '&source=contact');
        });

        function showContactSuccess(msg) {
            var old = document.querySelector('.contact-success-toast');
            if (old) old.remove();
            var toast = document.createElement('div');
            toast.className = 'contact-success-toast';
            toast.innerHTML = '<i class="fas fa-check-circle"></i> ' + msg;
            toast.style.cssText = 'position:fixed;top:100px;left:50%;transform:translateX(-50%);background:#10b981;color:white;padding:16px 28px;border-radius:12px;font-size:16px;z-index:9999;box-shadow:0 8px 30px rgba(0,0,0,0.2);max-width:90%;text-align:center;animation:contactFadeIn 0.3s ease;';
            document.body.appendChild(toast);
            setTimeout(function() { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.5s'; setTimeout(function() { toast.remove(); }, 500); }, 4000);
        }

        function showContactError(msg) {
            var errDiv = document.getElementById('submitErrorDisplay') || (function() {
                var d = document.createElement('div');
                d.id = 'submitErrorDisplay';
                d.style.cssText = 'color:#ef4444;font-size:14px;margin-top:12px;text-align:center;';
                var btn = document.getElementById('submitBtn');
                btn.parentNode.insertBefore(d, btn.nextSibling);
                return d;
            })();
            errDiv.textContent = msg;
            setTimeout(function() { errDiv.textContent = ''; }, 4000);
        }
    })();
    </script>
    <style>
        @keyframes contactFadeIn { from { opacity: 0; transform: translateX(-50%) translateY(-20px); } to { opacity: 1; transform: translateX(-50%) translateY(0); } }
    </style>

</body>
</html>

