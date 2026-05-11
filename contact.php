<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="联系我们 - 获取专业的资金服务咨询，电话：13552883008">
    <meta name="keywords" content="联系我们,Yao资金网电话,资金服务咨询,商务合作">
    <title>联系我们</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page-custom.css">
    <!-- 高德地图API - 请替换为自己的Key -->
    <script src="https://webapi.amap.com/maps?v=2.0&key=9ed402d0d11a77f467b97cbf0f551916&plugin=AMap.Marker"></script>
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
<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar">
                <li role="none"><a href="index.html" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                <li role="none"><a href="advantages.html" class="nav-link" role="menuitem">服务优势</a></li>
                <li role="none"><a href="news.php" class="nav-link" role="menuitem">行业资讯</a></li>
                <li role="none"><a href="faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                <li role="none"><a href="contact.html" class="nav-link active" role="menuitem">联系我们</a></li>
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
                                    <label class="form-label">电子邮箱</label>
                                    <input type="email" id="email" name="email" placeholder="请输入邮箱地址（选填）">
                                    <span class="form-error" id="emailError"></span>
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
                                <div class="form-group form-checkbox">
                                    <input type="checkbox" id="privacy" name="privacy" required>
                                    <label for="privacy">我已阅读并同意<a href="#">隐私政策</a>和<a href="#">服务条款</a></label>
                                    <span class="form-error" id="privacyError"></span>
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
                                    <img src="uploads/wechat-qr.png" alt="微信二维码" loading="lazy">
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

                <!-- 地图位置 -->
                <div class="editable-section" data-section="contact-map">
                    <div class="contact-map-section">
                        <div class="contact-map-header">
                            <h2><i class="fas fa-map-marked-alt"></i> 公司位置</h2>
                            <h3>财富金融中心</h3>
                            <p>北京市朝阳区呼家楼街道东三环中路5号</p>
                        </div>
                        <div class="contact-map-container">
                            <!-- 高德地图容器 -->
                            <div id="amap-container" style="width:100%;height:400px;border-radius:8px;"></div>
                        </div>
                        <div class="contact-map-info">
                            <div class="map-info-item">
                                <i class="fas fa-subway"></i>
                                <span>地铁：1号线/2号线建国门站B出口，步行约5分钟</span>
                            </div>
                            <div class="map-info-item">
                                <i class="fas fa-bus"></i>
                                <span>公交：金融街站，途经公交：1路、4路、52路、120路</span>
                            </div>
                            <div class="map-info-item">
                                <i class="fas fa-car"></i>
                                <span>自驾：大厦设有地下停车场，访客可免费停车2小时</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

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


    <script src="js/main.js"></script>
    
    <!-- 高德地图初始化 -->
    <script>
        // 高德地图初始化
        // 注意：需要将 YOUR_AMAP_KEY_HERE 替换为实际的高德地图API Key
        // 申请地址：https://lbs.amap.com/
        (function() {
            // 检查是否已加载高德地图API
            if (typeof AMap === 'undefined') {
                console.warn('高德地图API未加载，请检查API Key是否正确');
                document.getElementById('amap-container').innerHTML = 
                    '<div class="contact-map-placeholder" style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;">' +
                    '<i class="fas fa-exclamation-triangle" style="font-size:48px;color:#f59e0b;margin-bottom:16px;"></i>' +
                    '<p>地图加载失败</p>' +
                    '<p class="map-note">请在contact.html中配置高德地图API Key</p>' +
                    '</div>';
                return;
            }
            
            // 初始化地图
            // 北京市朝阳区呼家楼街道东三环中路5号 坐标
            var map = new AMap.Map('amap-container', {
                zoom: 16,
                center: [116.4628, 39.9289], // 东三环中路区域坐标
                viewMode: '2D',
                resizeEnable: true
            });
            
            // 添加标记点
            var marker = new AMap.Marker({
                position: [116.4628, 39.9289],
                title: '财富金融中心',
                label: {
                    content: 'Yao资金网 - 财富金融中心',
                    direction: 'top'
                }
            });
            marker.setMap(map);
            
            // 添加信息窗体
            var infoWindow = new AMap.InfoWindow({
                content: '<div style="padding:10px;"><h4 style="margin:0 0 5px;">财富金融中心</h4><p style="margin:0;font-size:12px;">北京市朝阳区呼家楼街道东三环中路5号</p></div>',
                offset: new AMap.Pixel(0, -30)
            });
            
            // 点击标记显示信息窗体
            marker.on('click', function() {
                infoWindow.open(map, marker.getPosition());
            });
            
            // 添加地图控件
            AMap.plugin(['AMap.ToolBar', 'AMap.Scale'], function() {
                map.addControl(new AMap.ToolBar({
                    position: 'RB'
                }));
                map.addControl(new AMap.Scale());
            });
        })();
    </script>
    
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
</body>
</html>

