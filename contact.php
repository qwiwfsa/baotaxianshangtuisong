<?php
require_once __DIR__ . '/includes/logo.php';
require_once __DIR__ . '/device-detect.php';

DeviceDetector::redirect();
header("Cache-Control: no-cache, no-store, must-revalidate");header("Pragma: no-cache");header("Expires: 0");?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.yaozijin.com/contact.html">
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="联系我们 - 获取专业的资金服务咨询，电话：13552883008">
    <meta name="keywords" content="联系我们,Yao资金网电话,资金服务咨询,商务合作">
    <title>联系我们</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
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
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img src="<?php echo $header_logo; ?>" alt="Yao资金网" style="height:48px;width:auto;"></a>
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

<!-- 全国分站地图 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script>
<script>
(function() {
    // 省份城市数据
    var cityData = {"云南": [{"name": "昆明", "slug": "kunming"}, {"name": "曲靖", "slug": "qujing"}, {"name": "玉溪", "slug": "yuxi"}, {"name": "保山", "slug": "baoshan"}, {"name": "昭通", "slug": "zhaotong"}, {"name": "丽江", "slug": "lijiang"}, {"name": "普洱", "slug": "puer"}, {"name": "临沧", "slug": "lincang"}, {"name": "楚雄", "slug": "chuxiong"}, {"name": "红河", "slug": "honghe"}, {"name": "文山", "slug": "wenshan"}, {"name": "西双版纳", "slug": "xishuangbanna"}, {"name": "大理", "slug": "dali"}, {"name": "德宏", "slug": "dehong"}, {"name": "怒江", "slug": "nujiang"}, {"name": "迪庆", "slug": "diqing"}], "内蒙古": [{"name": "呼和浩特", "slug": "huhehaote"}, {"name": "包头", "slug": "baotou"}, {"name": "乌海", "slug": "wuhai"}, {"name": "赤峰", "slug": "chifeng"}, {"name": "通辽", "slug": "tongliao"}, {"name": "鄂尔多斯", "slug": "eerduosi"}, {"name": "呼伦贝尔", "slug": "hulunbeier"}, {"name": "巴彦淖尔", "slug": "bayannaoer"}, {"name": "乌兰察布", "slug": "wulanchabu"}, {"name": "兴安盟", "slug": "xinganmeng"}, {"name": "锡林郭勒", "slug": "xilinguole"}, {"name": "阿拉善", "slug": "alashan"}], "吉林": [{"name": "长春", "slug": "changchun"}, {"name": "吉林", "slug": "jilin"}, {"name": "四平", "slug": "siping"}, {"name": "辽源", "slug": "liaoyuan"}, {"name": "通化", "slug": "tonghua"}, {"name": "白山", "slug": "baishan"}, {"name": "松原", "slug": "songyuan"}, {"name": "白城", "slug": "baicheng"}, {"name": "延边", "slug": "yanbian"}], "四川": [{"name": "成都", "slug": "chengdu"}, {"name": "自贡", "slug": "zigong"}, {"name": "攀枝花", "slug": "panzhihua"}, {"name": "泸州", "slug": "luzhou"}, {"name": "德阳", "slug": "deyang"}, {"name": "绵阳", "slug": "mianyang"}, {"name": "广元", "slug": "guangyuan"}, {"name": "遂宁", "slug": "suining"}, {"name": "内江", "slug": "neijiang"}, {"name": "乐山", "slug": "leshan"}, {"name": "南充", "slug": "nanchong"}, {"name": "眉山", "slug": "meishan"}, {"name": "宜宾", "slug": "yibin"}, {"name": "广安", "slug": "guangan"}, {"name": "达州", "slug": "dazhou"}, {"name": "雅安", "slug": "yaan"}, {"name": "巴中", "slug": "bazhong"}, {"name": "资阳", "slug": "ziyang"}, {"name": "阿坝", "slug": "aba"}, {"name": "甘孜", "slug": "ganzi"}, {"name": "凉山", "slug": "liangshan"}], "宁夏": [{"name": "银川", "slug": "yinchuan"}, {"name": "石嘴山", "slug": "shizuishan"}, {"name": "吴忠", "slug": "wuzhong"}, {"name": "固原", "slug": "guyuan"}, {"name": "中卫", "slug": "zhongwei"}], "安徽": [{"name": "合肥", "slug": "hefei"}, {"name": "芜湖", "slug": "wuhu"}, {"name": "蚌埠", "slug": "bengbu"}, {"name": "淮南", "slug": "huainan"}, {"name": "马鞍山", "slug": "maanshan"}, {"name": "淮北", "slug": "huaibei"}, {"name": "铜陵", "slug": "tongling"}, {"name": "安庆", "slug": "anqing"}, {"name": "黄山", "slug": "huangshan"}, {"name": "滁州", "slug": "chuzhou"}, {"name": "阜阳", "slug": "fuyang"}, {"name": "六安", "slug": "luan"}, {"name": "亳州", "slug": "bozhou"}, {"name": "池州", "slug": "chizhou"}, {"name": "宣城", "slug": "xuancheng"}], "山东": [{"name": "济南", "slug": "jinan"}, {"name": "青岛", "slug": "qingdao"}, {"name": "淄博", "slug": "zibo"}, {"name": "枣庄", "slug": "zaozhuang"}, {"name": "东营", "slug": "dongying"}, {"name": "烟台", "slug": "yantai"}, {"name": "潍坊", "slug": "weifang"}, {"name": "济宁", "slug": "jining"}, {"name": "泰安", "slug": "taian"}, {"name": "威海", "slug": "weihai"}, {"name": "日照", "slug": "rizhao"}, {"name": "临沂", "slug": "linyi"}, {"name": "德州", "slug": "dezhou"}, {"name": "聊城", "slug": "liaocheng"}, {"name": "滨州", "slug": "binzhou"}, {"name": "菏泽", "slug": "heze"}], "山西": [{"name": "太原", "slug": "taiyuan"}, {"name": "大同", "slug": "datong"}, {"name": "阳泉", "slug": "yangquan"}, {"name": "长治", "slug": "changzhi"}, {"name": "晋城", "slug": "jincheng"}, {"name": "朔州", "slug": "shuozhou"}, {"name": "晋中", "slug": "jinzhong"}, {"name": "运城", "slug": "yuncheng"}, {"name": "忻州", "slug": "xinzhou"}, {"name": "临汾", "slug": "linfen"}, {"name": "吕梁", "slug": "lyuliang"}], "广东": [{"name": "广州", "slug": "guangzhou"}, {"name": "韶关", "slug": "shaoguan"}, {"name": "深圳", "slug": "shenzhen"}, {"name": "珠海", "slug": "zhuhai"}, {"name": "汕头", "slug": "shantou"}, {"name": "佛山", "slug": "foshan"}, {"name": "江门", "slug": "jiangmen"}, {"name": "湛江", "slug": "zhanjiang"}, {"name": "茂名", "slug": "maoming"}, {"name": "肇庆", "slug": "zhaoqing"}, {"name": "惠州", "slug": "huizhou"}, {"name": "梅州", "slug": "meizhou"}, {"name": "汕尾", "slug": "shanwei"}, {"name": "河源", "slug": "heyuan"}, {"name": "阳江", "slug": "yangjiang"}, {"name": "清远", "slug": "qingyuan"}, {"name": "东莞", "slug": "dongguan"}, {"name": "中山", "slug": "zhongshan"}, {"name": "潮州", "slug": "chaozhou"}, {"name": "揭阳", "slug": "jieyang"}, {"name": "云浮", "slug": "yunfu"}], "广西": [{"name": "南宁", "slug": "nanning"}, {"name": "柳州", "slug": "liuzhou"}, {"name": "桂林", "slug": "guilin"}, {"name": "梧州", "slug": "wuzhou"}, {"name": "北海", "slug": "beihai"}, {"name": "防城港", "slug": "fangchenggang"}, {"name": "钦州", "slug": "qinzhou"}, {"name": "贵港", "slug": "guigang"}, {"name": "玉林", "slug": "yulin"}, {"name": "百色", "slug": "baise"}, {"name": "贺州", "slug": "hezhou"}, {"name": "河池", "slug": "hechi"}, {"name": "来宾", "slug": "laibin"}, {"name": "崇左", "slug": "chongzuo"}], "新疆": [{"name": "乌鲁木齐", "slug": "wulumuqi"}, {"name": "克拉玛依", "slug": "kelamayi"}, {"name": "吐鲁番", "slug": "tulufan"}, {"name": "哈密", "slug": "hami"}, {"name": "昌吉", "slug": "changji"}, {"name": "博尔塔拉", "slug": "boertala"}, {"name": "巴音郭楞", "slug": "bayinguoleng"}, {"name": "阿克苏", "slug": "akesu"}, {"name": "克孜勒苏", "slug": "kezilesu"}, {"name": "喀什", "slug": "kashi"}, {"name": "和田", "slug": "hetian"}, {"name": "伊犁", "slug": "yili"}, {"name": "塔城", "slug": "tacheng"}, {"name": "阿勒泰", "slug": "aletai"}, {"name": "石河子", "slug": "shihezi"}, {"name": "阿拉尔", "slug": "alaer"}, {"name": "图木舒克", "slug": "tumushuke"}, {"name": "五家渠", "slug": "wujiaqu"}, {"name": "北屯", "slug": "beitun"}, {"name": "铁门关", "slug": "tiemenguan"}, {"name": "双河", "slug": "shuanghe"}, {"name": "可克达拉", "slug": "kekedala"}, {"name": "昆玉", "slug": "kunyu"}, {"name": "胡杨河", "slug": "huyanghe"}, {"name": "新星", "slug": "xinxing"}], "江苏": [{"name": "南京", "slug": "nanjing"}, {"name": "无锡", "slug": "wuxi"}, {"name": "徐州", "slug": "xuzhou"}, {"name": "常州", "slug": "changzhou"}, {"name": "苏州", "slug": "suzhou"}, {"name": "南通", "slug": "nantong"}, {"name": "连云港", "slug": "lianyungang"}, {"name": "淮安", "slug": "huaian"}, {"name": "盐城", "slug": "yancheng"}, {"name": "扬州", "slug": "yangzhou"}, {"name": "镇江", "slug": "zhenjiang"}, {"name": "泰州", "slug": "taizhou"}, {"name": "宿迁", "slug": "suqian"}], "江西": [{"name": "南昌", "slug": "nanchang"}, {"name": "景德镇", "slug": "jingdezhen"}, {"name": "萍乡", "slug": "pingxiang"}, {"name": "九江", "slug": "jiujiang"}, {"name": "新余", "slug": "xinyu"}, {"name": "鹰潭", "slug": "yingtan"}, {"name": "赣州", "slug": "ganzhou"}, {"name": "吉安", "slug": "jian"}, {"name": "上饶", "slug": "shangrao"}], "河北": [{"name": "石家庄", "slug": "shijiazhuang"}, {"name": "唐山", "slug": "tangshan"}, {"name": "秦皇岛", "slug": "qinhuangdao"}, {"name": "邯郸", "slug": "handan"}, {"name": "邢台", "slug": "xingtai"}, {"name": "保定", "slug": "baoding"}, {"name": "张家口", "slug": "zhangjiakou"}, {"name": "承德", "slug": "chengde"}, {"name": "沧州", "slug": "cangzhou"}, {"name": "廊坊", "slug": "langfang"}, {"name": "衡水", "slug": "hengshui"}], "河南": [{"name": "郑州", "slug": "zhengzhou"}, {"name": "开封", "slug": "kaifeng"}, {"name": "洛阳", "slug": "luoyang"}, {"name": "平顶山", "slug": "pingdingshan"}, {"name": "安阳", "slug": "anyang"}, {"name": "鹤壁", "slug": "hebi"}, {"name": "新乡", "slug": "xinxiang"}, {"name": "焦作", "slug": "jiaozuo"}, {"name": "濮阳", "slug": "puyang"}, {"name": "许昌", "slug": "xuchang"}, {"name": "漯河", "slug": "tahe"}, {"name": "三门峡", "slug": "sanmenxia"}, {"name": "南阳", "slug": "nanyang"}, {"name": "商丘", "slug": "shangqiu"}, {"name": "信阳", "slug": "xinyang"}, {"name": "周口", "slug": "zhoukou"}, {"name": "驻马店", "slug": "zhumadian"}, {"name": "济源", "slug": "jiyuan"}], "浙江": [{"name": "杭州", "slug": "hangzhou"}, {"name": "宁波", "slug": "ningbo"}, {"name": "温州", "slug": "wenzhou"}, {"name": "嘉兴", "slug": "jiaxing"}, {"name": "湖州", "slug": "huzhou"}, {"name": "绍兴", "slug": "shaoxing"}, {"name": "金华", "slug": "jinhua"}, {"name": "衢州", "slug": "quzhou"}, {"name": "舟山", "slug": "zhoushan"}, {"name": "丽水", "slug": "lishui"}, {"name": "台州", "slug": "taizhou-zj"}], "海南": [{"name": "海口", "slug": "haikou"}, {"name": "三亚", "slug": "sanya"}, {"name": "三沙", "slug": "sansha"}, {"name": "儋州", "slug": "danzhou"}], "港澳台": [{"name": "香港", "slug": "hongkong"}, {"name": "澳门", "slug": "macau"}, {"name": "台湾", "slug": "taiwan"}], "湖北": [{"name": "武汉", "slug": "wuhan"}, {"name": "黄石", "slug": "huangshi"}, {"name": "十堰", "slug": "shiyan"}, {"name": "宜昌", "slug": "yichang"}, {"name": "襄阳", "slug": "xiangyang"}, {"name": "鄂州", "slug": "ezhou"}, {"name": "荆门", "slug": "jingmen"}, {"name": "孝感", "slug": "xiaogan"}, {"name": "荆州", "slug": "jingzhou"}, {"name": "黄冈", "slug": "huanggang"}, {"name": "咸宁", "slug": "xianning"}, {"name": "随州", "slug": "suizhou"}, {"name": "恩施", "slug": "enshi"}, {"name": "仙桃", "slug": "xiantao"}, {"name": "潜江", "slug": "qianjiang"}, {"name": "天门", "slug": "tianmen"}, {"name": "神农架", "slug": "shennongjia"}], "湖南": [{"name": "长沙", "slug": "changsha"}, {"name": "株洲", "slug": "zhuzhou"}, {"name": "湘潭", "slug": "xiangtan"}, {"name": "衡阳", "slug": "hengyang"}, {"name": "邵阳", "slug": "shaoyang"}, {"name": "岳阳", "slug": "yueyang"}, {"name": "常德", "slug": "changde"}, {"name": "张家界", "slug": "zhangjiajie"}, {"name": "益阳", "slug": "yiyang"}, {"name": "郴州", "slug": "chenzhou"}, {"name": "永州", "slug": "yongzhou"}, {"name": "怀化", "slug": "huaihua"}, {"name": "娄底", "slug": "loudi"}, {"name": "湘西", "slug": "xiangxi"}], "甘肃": [{"name": "兰州", "slug": "lanzhou"}, {"name": "嘉峪关", "slug": "jiayuguan"}, {"name": "金昌", "slug": "jinchang"}, {"name": "白银", "slug": "baiyin"}, {"name": "天水", "slug": "tianshui"}, {"name": "武威", "slug": "wuwei"}, {"name": "张掖", "slug": "zhangye"}, {"name": "平凉", "slug": "pingliang"}, {"name": "酒泉", "slug": "jiuquan"}, {"name": "庆阳", "slug": "qingyang"}, {"name": "定西", "slug": "dingxi"}, {"name": "陇南", "slug": "longnan"}, {"name": "临夏", "slug": "linxia"}, {"name": "甘南", "slug": "gannan"}], "直辖市": [{"name": "北京", "slug": "beijing"}, {"name": "上海", "slug": "shanghai"}, {"name": "天津", "slug": "tianjin"}, {"name": "重庆", "slug": "chongqing"}], "福建": [{"name": "福州", "slug": "fuzhou"}, {"name": "厦门", "slug": "xiamen"}, {"name": "莆田", "slug": "putian"}, {"name": "三明", "slug": "sanming"}, {"name": "泉州", "slug": "quanzhou"}, {"name": "漳州", "slug": "zhangzhou"}, {"name": "南平", "slug": "nanping"}, {"name": "龙岩", "slug": "longyan"}, {"name": "宁德", "slug": "ningde"}], "西藏": [{"name": "拉萨", "slug": "lasa"}, {"name": "日喀则", "slug": "rikaze"}, {"name": "昌都", "slug": "changdu"}, {"name": "林芝", "slug": "linzhi"}, {"name": "山南", "slug": "shannan"}, {"name": "那曲", "slug": "naqu"}, {"name": "阿里", "slug": "ali"}], "贵州": [{"name": "贵阳", "slug": "guiyang"}, {"name": "六盘水", "slug": "liupanshui"}, {"name": "遵义", "slug": "zunyi"}, {"name": "安顺", "slug": "anshun"}, {"name": "毕节", "slug": "bijie"}, {"name": "铜仁", "slug": "tongren"}, {"name": "黔西南", "slug": "qianxinan"}, {"name": "黔东南", "slug": "qiandongnan"}, {"name": "黔南", "slug": "qiannan"}], "辽宁": [{"name": "沈阳", "slug": "shenyang"}, {"name": "大连", "slug": "dalian"}, {"name": "鞍山", "slug": "anshan"}, {"name": "抚顺", "slug": "fushun"}, {"name": "本溪", "slug": "benxi"}, {"name": "丹东", "slug": "dandong"}, {"name": "锦州", "slug": "jinzhou"}, {"name": "营口", "slug": "yingkou"}, {"name": "阜新", "slug": "fuxin"}, {"name": "辽阳", "slug": "liaoyang"}, {"name": "盘锦", "slug": "panjin"}, {"name": "铁岭", "slug": "tieling"}, {"name": "朝阳", "slug": "chaoyang"}, {"name": "葫芦岛", "slug": "huludao"}], "陕西": [{"name": "西安", "slug": "xian"}, {"name": "铜川", "slug": "tongchuan"}, {"name": "宝鸡", "slug": "baoji"}, {"name": "咸阳", "slug": "xianyang"}, {"name": "渭南", "slug": "weinan"}, {"name": "延安", "slug": "yanan"}, {"name": "汉中", "slug": "hanzhong"}, {"name": "安康", "slug": "ankang"}, {"name": "商洛", "slug": "shangluo"}], "青海": [{"name": "西宁", "slug": "xining"}, {"name": "海东", "slug": "haidong"}, {"name": "海北", "slug": "haibei"}, {"name": "黄南", "slug": "huangnan"}, {"name": "海南", "slug": "hainan"}, {"name": "果洛", "slug": "guoluo"}, {"name": "玉树", "slug": "yushu"}, {"name": "海西", "slug": "haixi"}], "黑龙江": [{"name": "哈尔滨", "slug": "haerbin"}, {"name": "齐齐哈尔", "slug": "qiqihaer"}, {"name": "鸡西", "slug": "jixi"}, {"name": "鹤岗", "slug": "hegang"}, {"name": "双鸭山", "slug": "shuangyashan"}, {"name": "大庆", "slug": "daqing"}, {"name": "伊春", "slug": "yichun"}, {"name": "佳木斯", "slug": "jiamusi"}, {"name": "七台河", "slug": "qitaihe"}, {"name": "牡丹江", "slug": "mudanjiang"}, {"name": "黑河", "slug": "heihe"}, {"name": "绥化", "slug": "suihua"}, {"name": "大兴安岭", "slug": "daxinganling"}]};

    // 直辖市拆分到各自城市名下
    var munCities = cityData['\u76f4\u8f96\u5e02'];
    if (munCities) {
        munCities.forEach(function(c) { cityData[c.name] = [c]; });
    }

    // 省份名称映射 (ECharts 省份名 -> 数据库中省份名)
    var provinceMap = {
        '北京市': '北京',
        '天津市': '天津',
        '上海市': '上海',
        '重庆市': '重庆',
        '河北省': '河北',
        '山西省': '山西',
        '辽宁省': '辽宁',
        '吉林省': '吉林',
        '黑龙江省': '黑龙江',
        '江苏省': '江苏',
        '浙江省': '浙江',
        '安徽省': '安徽',
        '福建省': '福建',
        '江西省': '江西',
        '山东省': '山东',
        '河南省': '河南',
        '湖北省': '湖北',
        '湖南省': '湖南',
        '广东省': '广东',
        '海南省': '海南',
        '四川省': '四川',
        '贵州省': '贵州',
        '云南省': '云南',
        '陕西省': '陕西',
        '甘肃省': '甘肃',
        '青海省': '青海',
        '台湾省': '港澳台',
        '内蒙古自治区': '内蒙古',
        '广西壮族自治区': '广西',
        '西藏自治区': '西藏',
        '宁夏回族自治区': '宁夏',
        '新疆维吾尔自治区': '新疆',
        '香港特别行政区': '港澳台',
        '澳门特别行政区': '港澳台'
    };

    var mapChart = null;
    var chartDom = document.getElementById('chinaMapContainer');

    function initMap() {
        if (!chartDom || typeof echarts === 'undefined') {
            setTimeout(initMap, 500);
            return;
        }

        // Load GeoJSON via fetch
        fetch('https://geo.datav.aliyun.com/areas_v3/bound/100000_full.json')
            .then(function(r) { return r.json(); })
            .then(function(geoJson) {
                renderMap(geoJson);
            })
            .catch(function() {
                // Fallback: try script tag
                var s = document.createElement('script');
                s.src = 'https://geo.datav.aliyun.com/areas_v3/bound/100000_full.json';
                s.onload = function() {
                    if (window.chinaGeoJson) renderMap(window.chinaGeoJson);
                };
                document.head.appendChild(s);
            });
    }

    function renderMap(geoJson) {
        echarts.registerMap('china', geoJson);

        var mapData = [];
        var hasClickData = {};

        geoJson.features.forEach(function(feature) {
            var name = feature.properties.name;
            var provName = provinceMap[name] || name;
            var cities = cityData[provName];
            if (cities && cities.length > 0) {
                mapData.push({name: name, value: cities.length});
                hasClickData[name] = cities;
            } else {
                mapData.push({name: name, value: 0});
            }
        });

        var option = {
            tooltip: {
                trigger: 'item',
                backgroundColor: 'rgba(255,255,255,0.95)',
                borderColor: '#e5e7eb',
                borderWidth: 1,
                padding: [12, 16],
                textStyle: { color: '#333', fontSize: 13 },
                formatter: function(params) {
                    var cities = hasClickData[params.name];
                    if (cities && cities.length > 0) {
                        var list = cities.slice(0, 10).map(function(c) {
                            return '<a href="/fenzhan/?slug=' + c.slug + '" style="color:#3b82f6;text-decoration:none;display:inline-block;margin:2px 8px 2px 0;white-space:nowrap;">' + c.name + '</a>';
                        }).join('');
                        if (cities.length > 10) {
                            list += '<span style="color:#9ca3af;">...等' + cities.length + '个城市</span>';
                        }
                        return '<div style="font-weight:600;font-size:15px;margin-bottom:6px;color:#1e3a8a;">' + params.name + '</div>'
                            + '<div style="font-size:13px;color:#6b7280;margin-bottom:4px;">服务城市:</div>'
                            + '<div style="line-height:1.8;">' + list + '</div>'
                            + '<div style="margin-top:6px;padding-top:6px;border-top:1px solid #e5e7eb;text-align:center;">'
                            + '<a href="/fenzhan/?slug=' + cities[0].slug + '" style="color:#1e3a8a;font-weight:500;font-size:13px;">查看详情 →</a>'
                            + '</div>';
                    }
                    return '<div style="color:#9ca3af;">' + params.name + '<br>暂无服务覆盖</div>';
                }
            },
            visualMap: {
                min: 0,
                max: 25,
                text: ['多', '少'],
                textStyle: { color: '#6b7280', fontSize: 12 },
                inRange: { color: ['#e0e7ff', '#93c5fd', '#3b82f6', '#1d4ed8', '#1e3a8a'] },
                show: false
            },
            series: [{
                name: '服务覆盖',
                type: 'map',
                map: 'china',
                roam: true,
                selectedMode: false,
                label: { show: true, fontSize: 10, color: '#374151' },
                itemStyle: {
                    borderColor: '#fff',
                    borderWidth: 1.5,
                    areaColor: '#e5e7eb'
                },
                emphasis: {
                    label: { show: true, fontSize: 12, fontWeight: 'bold', color: '#1e3a8a' },
                    itemStyle: {
                        areaColor: '#93c5fd',
                        shadowBlur: 10,
                        shadowColor: 'rgba(59,130,246,0.3)'
                    }
                },
                data: mapData
            }]
        };

        mapChart = echarts.init(chartDom);
        mapChart.setOption(option);

        mapChart.on('click', function(params) {
            var cities = hasClickData[params.name];
            if (cities && cities.length > 0) {
                window.location.href = '/fenzhan/?slug=' + cities[0].slug;
            }
        });

        window.addEventListener('resize', function() {
            if (mapChart) mapChart.resize();
        });
    }

    initMap();
})();
</script>

</body>
</html>

