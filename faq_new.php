<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Yao资金网常见问题 - 解答您关于资金业务的常见疑问">
    <meta name="keywords" content="常见问题,亮资业务,过桥资金,摆账业务,应收账款融资,FAQ">
    <title>常见问题 - Yao资金网</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page-custom.css">
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
                    // PHP handles title
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
                    // PHP handles title
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
<a href="/" class="logo" aria-label="Yao资金网首页"><img src="uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
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
                    <i class="fas fa-question-circle"></i>
                    <span>FAQ</span>
                </div>
                <h1 class="page-header-title">常见问题</h1>
                <p class="page-header-subtitle">解答您关于资金业务的常见疑问</p>
            </div>
        </section>

        <!-- FAQ内容 - 可编辑区域 -->
        <section class="page-content">
            <div class="section-container">
                
                <!-- FAQ搜索 -->
                <div class="editable-section" data-section="faq-search">
                    <div class="faq-search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" class="faq-search-input" placeholder="搜索问题关键词...">
                        <button class="faq-search-btn">搜索</button>
                    </div>
                </div>

                <!-- FAQ分类 -->
                <div class="editable-section" data-section="faq-categories">
                    <div class="faq-categories" id="faqCategoryButtons">
                        <div class="faq-category-item active" data-category="all">
                            <i class="fas fa-th-large"></i>
                            <span>全部问题</span>
                        </div>
                        <!-- 动态生成分类按钮 -->
                    </div>
                </div>

                <!-- FAQ列表 -->
                <div class="editable-section" data-section="faq-list">
                    <div class="faq-custom-container">
                        <!-- 亮资业务 -->
                        <div class="faq-custom-category" data-category="liangzi">
                            <h3 class="faq-custom-category-title">
                                <i class="fas fa-lightbulb"></i>
                                亮资业务
                            </h3>
                            <div class="faq-custom-list">
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>什么是亮资业务？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>亮资业务是指企业在参与招投标、项目洽谈、商务合作等场景时，需要向对方展示资金实力的服务。我们提供大额资金在客户账户中展示，证明企业具备相应的资金履约能力。</p>
                                        <p>亮资业务通常分为时点亮资和时期亮资两种形式：</p>
                                        <ul>
                                            <li><strong>时点亮资</strong>：在特定时间点展示资金，通常用于投标现场、商务谈判等场景</li>
                                            <li><strong>时期亮资</strong>：在一段时间内保持资金在账，通常用于项目履约保证金、合同履约等</li>
                                        </ul>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>亮资业务需要多长时间？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>根据客户需求，亮资业务可分为时点亮资和时期亮资：</p>
                                        <ul>
                                            <li><strong>时点亮资</strong>：通常在1-3个工作日内完成，资金在约定时间点展示</li>
                                            <li><strong>时期亮资</strong>：根据约定期限，从几天到数月不等，资金在约定期限内保持在账</li>
                                        </ul>
                                        <p>具体时长需要根据客户的具体需求和业务场景来确定。</p>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>亮资业务收费如何计算？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>亮资业务收费主要根据以下因素综合确定：</p>
                                        <ul>
                                            <li>资金规模：展示的资金金额大小</li>
                                            <li>亮资时长：展示资金的时间长度</li>
                                            <li>操作复杂程度：是否需要跨行、异地等操作</li>
                                            <li>时效要求：是否需要加急处理</li>
                                        </ul>
                                        <p>具体费用需要根据实际情况评估，欢迎来电咨询获取详细报价。</p>
                                    </div>
                                </details>
                            </div>
                        </div>

                        <!-- 过桥资金 -->
                        <div class="faq-custom-category" data-category="bridge">
                            <h3 class="faq-custom-category-title">
                                <i class="fas fa-exchange-alt"></i>
                                过桥资金
                            </h3>
                            <div class="faq-custom-list">
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>过桥资金适用于哪些场景？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>过桥资金主要适用于以下场景：</p>
                                        <ul>
                                            <li><strong>银行贷款续贷</strong>：原贷款到期，新贷款尚未放款期间的临时周转</li>
                                            <li><strong>股票解质押</strong>：上市公司股东解除股票质押时的临时资金需求</li>
                                            <li><strong>募集账户归还</strong>：上市公司募集资金归还时的临时周转</li>
                                            <li><strong>企业并购</strong>：并购交易中的临时资金安排</li>
                                            <li><strong>项目保证金</strong>：招投标、履约保证金等临时资金需求</li>
                                            <li><strong>资金周转</strong>：企业短期资金周转困难时的临时支持</li>
                                        </ul>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>申请过桥资金需要什么条件？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>申请过桥资金通常需要提供以下资料：</p>
                                        <ul>
                                            <li>企业营业执照、组织机构代码证</li>
                                            <li>法定代表人身份证明</li>
                                            <li>财务报表（近三个月）</li>
                                            <li>资金用途说明</li>
                                            <li>还款来源证明（如银行批贷函、应收账款证明等）</li>
                                            <li>抵押担保资料（如有）</li>
                                        </ul>
                                        <p>具体资料清单根据业务类型有所不同，我们的客户经理会根据您的具体情况提供详细的资料清单。</p>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>过桥资金多久可以放款？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>资料齐全且审核通过后，最快可在当日放款。一般情况下，从申请到放款需要1-3个工作日。</p>
                                        <p>放款速度主要取决于：</p>
                                        <ul>
                                            <li>资料准备的完整程度</li>
                                            <li>审核流程的复杂程度</li>
                                            <li>资金调度的安排</li>
                                        </ul>
                                        <p>对于紧急需求，我们提供加急服务，可在最短时间内完成放款。</p>
                                    </div>
                                </details>
                            </div>
                        </div>

                        <!-- 摆账业务 -->
                        <div class="faq-custom-category" data-category="baizhang">
                            <h3 class="faq-custom-category-title">
                                <i class="fas fa-university"></i>
                                摆账业务
                            </h3>
                            <div class="faq-custom-list">
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>摆账和亮资有什么区别？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>摆账和亮资虽然都涉及资金展示，但在操作方式和应用场景上有所不同：</p>
                                        <table class="faq-custom-table">
                                            <tr>
                                                <th>对比项</th>
                                                <th>摆账</th>
                                                <th>亮资</th>
                                            </tr>
                                            <tr>
                                                <td>主要用途</td>
                                                <td>财务报表优化、审计、年检</td>
                                                <td>向第三方展示资金实力</td>
                                            </tr>
                                            <tr>
                                                <td>展示对象</td>
                                                <td>审计机构、监管部门</td>
                                                <td>合作方、招标方等</td>
                                            </tr>
                                            <tr>
                                                <td>时间要求</td>
                                                <td>通常需要保持一定时期</td>
                                                <td>时点或短期展示</td>
                                            </tr>
                                            <tr>
                                                <td>操作方式</td>
                                                <td>资金存入账户并保持</td>
                                                <td>资金展示后可能转出</td>
                                            </tr>
                                        </table>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>摆账业务安全吗？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>我们严格按照法律法规和监管要求开展业务，确保摆账业务的安全性：</p>
                                        <ul>
                                            <li><strong>合规操作</strong>：所有业务操作均符合相关法律法规要求</li>
                                            <li><strong>合同保障</strong>：所有操作均有正规合同保障，明确双方权利义务</li>
                                            <li><strong>资金安全</strong>：资金存放在正规银行账户，安全有保障</li>
                                            <li><strong>信息保密</strong>：客户信息严格保密，不会泄露给第三方</li>
                                        </ul>
                                        <p>建议客户选择正规、有资质的资金服务机构合作，确保业务安全。</p>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>摆账业务有哪些类型？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>根据客户需求和用途，摆账业务主要分为以下类型：</p>
                                        <ul>
                                            <li><strong>时点摆账</strong>：在特定时间点（如月末、季末、年末）保持资金在账</li>
                                            <li><strong>日均摆账</strong>：在一段时间内保持日均存款余额达标</li>
                                            <li><strong>定期摆账</strong>：以定期存款形式摆账，期限灵活</li>
                                            <li><strong>实缴验资</strong>：用于企业注册资本实缴验资</li>
                                            <li><strong>资金证明</strong>：用于开具资金证明、银行保函等</li>
                                        </ul>
                                    </div>
                                </details>
                            </div>
                        </div>

                        <!-- 应收账款融资 -->
                        <div class="faq-custom-category" data-category="receivable">
                            <h3 class="faq-custom-category-title">
                                <i class="fas fa-file-invoice-dollar"></i>
                                应收账款融资
                            </h3>
                            <div class="faq-custom-list">
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>什么样的应收账款可以融资？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>一般来说，以下类型的应收账款更容易获得融资：</p>
                                        <ul>
                                            <li>与核心企业（国企、央企、上市公司等）产生的应收账款</li>
                                            <li>账期在6个月以内的应收账款</li>
                                            <li>贸易背景真实、合同发票齐全的应收账款</li>
                                            <li>付款方信用良好的应收账款</li>
                                        </ul>
                                        <p>我们接受云信、商票等多种形式的应收账款融资申请，具体可融资额度需要根据应收账款的具体情况评估。</p>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>应收账款融资额度如何确定？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>融资额度主要根据以下因素综合评估：</p>
                                        <ul>
                                            <li><strong>应收账款金额</strong>：融资金额通常不超过应收账款面额</li>
                                            <li><strong>付款方信用等级</strong>：国企、央企、上市公司等信用等级高，融资比例高</li>
                                            <li><strong>账期长短</strong>：账期越短，融资比例越高</li>
                                            <li><strong>历史交易记录</strong>：长期合作客户可享受更高融资比例</li>
                                        </ul>
                                        <p>一般可融资金额为应收账款面额的70%-95%，具体比例根据实际情况确定。</p>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>云信票据融资有什么优势？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>云信票据融资相比传统融资方式具有以下优势：</p>
                                        <ul>
                                            <li><strong>准入宽松</strong>：对融资企业资质要求相对宽松</li>
                                            <li><strong>不看征信</strong>：不查询企业征信记录</li>
                                            <li><strong>包容执行</strong>：可接受有执行诉讼记录的企业</li>
                                            <li><strong>灵活流转</strong>：云信票据可拆分、可流转、可支付</li>
                                            <li><strong>融资便捷</strong>：审批流程简单，放款速度快</li>
                                            <li><strong>成本可控</strong>：融资成本透明，综合成本较低</li>
                                        </ul>
                                    </div>
                                </details>
                            </div>
                        </div>

                        <!-- 一般问题 -->
                        <div class="faq-custom-category" data-category="general">
                            <h3 class="faq-custom-category-title">
                                <i class="fas fa-info-circle"></i>
                                一般问题
                            </h3>
                            <div class="faq-custom-list">
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>Yao资金网的服务流程是怎样的？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>我们的服务流程如下：</p>
                                        <ol>
                                            <li><strong>需求沟通</strong>：了解客户资金需求，评估业务可行性</li>
                                            <li><strong>资料审核</strong>：风控审核，确立操作性</li>
                                            <li><strong>账户新开</strong>：账户激活后，签署协议控材料</li>
                                            <li><strong>进款和出款</strong>：出款后归还材料，协议撕毁结束</li>
                                        </ol>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>如何联系Yao资金网？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>您可以通过以下方式联系我们：</p>
                                        <ul>
                                            <li><strong>电话咨询</strong>：13552883008（王总）</li>
                                            <li><strong>邮箱联系</strong>：wanglizhongguo@126.com</li>
                                            <li><strong>微信咨询</strong>：扫描网站右侧二维码添加微信</li>
                                            <li><strong>在线留言</strong>：通过网站联系页面留言</li>
                                        </ul>
                                        <p>我们的工作时间为周一至周五 9:00-18:00，紧急需求可随时联系。</p>
                                    </div>
                                </details>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span>业务合作需要哪些资质？</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <p>根据业务类型不同，所需资质也有所不同：</p>
                                        <ul>
                                            <li><strong>企业客户</strong>：营业执照、法人身份证、财务报表等</li>
                                            <li><strong>上市公司</strong>：除基本资质外，可能需要董事会决议等</li>
                                            <li><strong>个人客户</strong>：身份证、收入证明、资产证明等</li>
                                        </ul>
                                        <p>具体资质要求请咨询我们的客户经理，我们会根据您的业务类型提供详细的资料清单。</p>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 更多问题 -->
                <div class="editable-section" data-section="faq-more">
                    <div class="faq-more-box">
                        <div class="faq-more-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="faq-more-content">
                            <h3>还有其他问题？</h3>
                            <p>欢迎随时联系我们的专业顾问，我们将竭诚为您解答</p>
                        </div>
                        <div class="contact-button-wrapper">
                            <button class="btn btn-primary" id="faqConsultBtn">
                                <i class="fas fa-phone-alt"></i>
                                联系我们
                            </button>
                            <span id="faqPhoneDisplay" style="display:none;font-size:18px;font-weight:700;color:#1e3a8a;letter-spacing:2px;white-space:nowrap;">13552883008</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- 右侧边浮动电话按钮 -->
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
    </div>

    <!-- 动态加载FAQ数据 -->
    <script>
        // 从localStorage加载后台保存的FAQ数据
        (function() {
            // 加载分类
            let categoryLabels = {};
            const savedCategories = localStorage.getItem('cms_faq_categories');
            if (savedCategories) {
                categoryLabels = JSON.parse(savedCategories);
            } else {
                // 默认分类
                categoryLabels = {
                    'liangzi': '亮资业务',
                    'bridge': '过桥资金',
                    'baizhang': '摆账业务',
                    'receivable': '应收账款',
                    'deposit': '银行存款',
                    'general': '一般问题'
                };
            }
            
            // 分类图标映射
            const categoryIcons = {
                'liangzi': 'fa-lightbulb',
                'bridge': 'fa-exchange-alt',
                'baizhang': 'fa-university',
                'receivable': 'fa-file-invoice-dollar',
                'deposit': 'fa-landmark',
                'general': 'fa-info-circle'
            };
            
            // 动态生成分类按钮
            const categoryButtonsContainer = document.getElementById('faqCategoryButtons');
            if (categoryButtonsContainer) {
                let buttonsHtml = `
                    <div class="faq-category-item active" data-category="all">
                        <i class="fas fa-th-large"></i>
                        <span>全部问题</span>
                    </div>
                `;
                
                Object.keys(categoryLabels).forEach(cat => {
                    const catName = categoryLabels[cat];
                    const catIcon = categoryIcons[cat] || 'fa-circle';
                    buttonsHtml += `
                        <div class="faq-category-item" data-category="${cat}">
                            <i class="fas ${catIcon}"></i>
                            <span>${catName}</span>
                        </div>
                    `;
                });
                
                categoryButtonsContainer.innerHTML = buttonsHtml;
                
                // 重新绑定分类点击事件
                bindCategoryEvents();
            }
            
            // 绑定分类点击事件
            function bindCategoryEvents() {
                document.querySelectorAll('.faq-category-item').forEach(item => {
                    item.addEventListener('click', function() {
                        document.querySelectorAll('.faq-category-item').forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                        
                        const category = this.dataset.category;
                        filterFAQByCategory(category);
                    });
                });
            }
            
            // 按分类筛选FAQ
            function filterFAQByCategory(category) {
                const categories = document.querySelectorAll('.faq-custom-category');
                categories.forEach(cat => {
                    if (category === 'all' || cat.dataset.category === category) {
                        cat.style.display = 'block';
                    } else {
                        cat.style.display = 'none';
                    }
                });
            }
            
            const savedFAQ = localStorage.getItem('cms_faqs');
            if (savedFAQ) {
                try {
                    const faqs = JSON.parse(savedFAQ);
                    console.log('加载后台FAQ数据:', faqs);
                    console.log('加载分类:', categoryLabels);
                    
                    // 按分类分组
                    const groupedFAQs = {};
                    faqs.forEach(faq => {
                        const cat = faq.category || 'general';
                        if (!groupedFAQs[cat]) {
                            groupedFAQs[cat] = [];
                        }
                        groupedFAQs[cat].push(faq);
                    });
                    
                    // 使用后台分类顺序，包括空分类
                    const container = document.querySelector('.faq-custom-container');
                    if (container) {
                        let html = '';
                        let hasContent = false;
                        
                        // 遍历所有分类（包括没有FAQ的分类）
                        Object.keys(categoryLabels).forEach(cat => {
                            const catName = categoryLabels[cat];
                            const catIcon = categoryIcons[cat] || 'fa-question';
                            const catFAQs = groupedFAQs[cat] || [];
                            
                            html += `
                                <div class="faq-custom-category" data-category="${cat}">
                                    <h3 class="faq-custom-category-title">
                                        <i class="fas ${catIcon}"></i>
                                        ${catName}
                                    </h3>
                                    <div class="faq-custom-list">
                            `;
                            
                            if (catFAQs.length > 0) {
                                hasContent = true;
                                catFAQs.forEach((faq) => {
                                    html += `
                                        <details class="faq-custom-item">
                                            <summary class="faq-custom-question">
                                                <span>${faq.question}</span>
                                                <i class="fas fa-chevron-down"></i>
                                            </summary>
                                            <div class="faq-custom-answer">
                                                ${faq.answer}
                                            </div>
                                        </details>
                                    `;
                                });
                            } else {
                                html += '<p style="padding: 20px; color: #9ca3af; text-align: center;">该分类下暂无问题</p>';
                            }
                            
                            html += '</div></div>';
                        });
                        
                        // 如果后台有数据，替换显示
                        if (hasContent || Object.keys(categoryLabels).length > 0) {
                            container.innerHTML = html;
                        }
                    }
                } catch (e) {
                    console.log('FAQ数据解析失败:', e);
                }
            }
        })();
    </script>

    <!-- 页脚 -->
<?php include 'includes/footer.php'; ?>


    <script src="js/main.js"></script>
    <script>
        // 显示/隐藏电话号码
        function showPhoneNumber() {
            const phoneDisplay = document.getElementById('phone-display');
            if (phoneDisplay.style.display === 'none') {
                phoneDisplay.style.display = 'inline-block';
            } else {
                phoneDisplay.style.display = 'none';
            }
        }
    </script>
    <script>
        // FAQ分类切换
        document.addEventListener('DOMContentLoaded', function() {
            const categoryItems = document.querySelectorAll('.faq-category-item');
            const faqCategories = document.querySelectorAll('.faq-custom-category');

            categoryItems.forEach(item => {
                item.addEventListener('click', function() {
                    const category = this.dataset.category;
                    
                    // 更新分类状态
                    categoryItems.forEach(ci => ci.classList.remove('active'));
                    this.classList.add('active');
                    
                    // 显示/隐藏FAQ分类
                    if (category === 'all') {
                        faqCategories.forEach(fc => {
                            fc.style.display = 'block';
                            setTimeout(() => {
                                fc.style.opacity = '1';
                                fc.style.transform = 'translateY(0)';
                            }, 50);
                        });
                    } else {
                        faqCategories.forEach(fc => {
                            if (fc.dataset.category === category) {
                                fc.style.display = 'block';
                                setTimeout(() => {
                                    fc.style.opacity = '1';
                                    fc.style.transform = 'translateY(0)';
                                }, 50);
                            } else {
                                fc.style.opacity = '0';
                                fc.style.transform = 'translateY(20px)';
                                setTimeout(() => {
                                    fc.style.display = 'none';
                                }, 300);
                            }
                        });
                    }
                });
            });
        });
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

        // 联系我们按钮交互：点击按钮→按钮隐藏，仅显示号码；点击页面空白处→号码隐藏，按钮恢复
        (function() {
            const btn = document.getElementById('faqConsultBtn');
            const phone = document.getElementById('faqPhoneDisplay');
            if (!btn || !phone) return;
            
            let isPhoneVisible = false;

            btn.addEventListener('click', function(e) {
                e.stopPropagation(); // 阻止事件冒泡，避免触发document的点击处理
                btn.style.display = 'none';
                phone.style.display = 'inline';
                isPhoneVisible = true;
            });

            document.addEventListener('click', function(e) {
                if (!isPhoneVisible) return;
                // 点击发生在contact-button-wrapper内部时不处理（已在btn点击时阻断了）
                const wrapper = document.querySelector('.contact-button-wrapper');
                if (wrapper && wrapper.contains(e.target)) return;
                
                phone.style.display = 'none';
                btn.style.display = ''; // 恢复默认display（由CSS类控制）
                isPhoneVisible = false;
            });
        })();
    </script>
</body>
</html>

