<?php
/**
 * 网站公共内容模板
 * 首页所有模块内容集中管理，主站/城市分站共用
 * 城市分站自动注入城市名称变量
 *
 * 用法:
 *   $content = loadHomepageContent();
 *   renderServicesSection($content, $cityName);
 *   renderAdvantagesSection($content);
 *   renderFaqSection($content, $phone);
 *   renderContactSection($cityName, $phone);
 *   renderBankLogosSection();
 */

require_once __DIR__ . "/../config/db.php";

/**
 * 从CMS加载首页内容数据
 */
function loadHomepageContent() {
    static $cache = null;
    if ($cache !== null) return $cache;
    try {
        $conn = getDB();
        $stmt = $conn->prepare("SELECT content FROM cms_pages WHERE page_id = ? AND status = 'active'");
        $pageId = 'index';
        $stmt->bind_param("s", $pageId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $data = json_decode($row['content'], true);
            $cache = is_array($data) ? $data : [];
        } else {
            $cache = [];
        }
        $stmt->close();
    } catch (Exception $e) {
        $cache = [];
    }
    return $cache;
}

/**
 * 渲染核心业务领域区域
 * 城市分站自动在每个<li>前注入城市名称
 */
function renderServicesSection($content, $cityName = "") {
    $escapedCity = htmlspecialchars($cityName, ENT_QUOTES, "UTF-8");
    $servicesTitle = $content['servicesTitle'] ?? '核心业务领域';
    $servicesSubtitle = $content['servicesSubtitle'] ?? "";
    $displayTitle = $escapedCity ? $escapedCity . $servicesTitle : $servicesTitle;
    $displaySubtitle = $escapedCity ? $escapedCity . '地区' . $servicesSubtitle : $servicesSubtitle;
?>
    <section class="services" id="services" aria-labelledby="services-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">OUR SERVICES</div>
                <h2 class="section-title" id="services-title"><?php echo $displayTitle; ?></h2>
                <p class="section-subtitle"><?php echo $displaySubtitle; ?></p>
            </div>
            <div class="services-grid">
<?php for ($i = 1; $i <= 4; $i++):
    $titleKey = "service{$i}Title";
    $contentKey = "service{$i}Content";
    $serviceTitle = $content[$titleKey] ?? "";
    $serviceContent = $content[$contentKey] ?? "";
    if (!$serviceTitle) continue;
?>
                <article class="service-card" style="opacity:0;transform:translateY(20px);transition:opacity 0.5s,transform 0.5s;">
                    <h3 class="service-title"><?php echo htmlspecialchars($serviceTitle); ?></h3>
<?php
        if ($escapedCity && $serviceContent) {
            echo str_replace("<li>", "<li>" . $escapedCity, $serviceContent);
        } else {
            echo $serviceContent;
        }
?>
                </article>
<?php endfor; ?>
            </div>
            <div class="service-details" id="serviceDetails">
                <div class="detail-card" style="opacity:0;transform:translateY(20px);transition:opacity 0.5s,transform 0.5s;">
                    <h4 class="detail-title"><i class="fas fa-star" aria-hidden="true"></i> 核心优势</h4>
                    <ul class="detail-list">
                        <li>资金实力雄厚，单笔可提供数亿至数十亿资金支持</li>
                        <li>操作灵活，可根据客户需求定制个性化方案</li>
                        <li>审批快速，资料齐全后最快当日放款</li>
                        <li>合规安全，严格遵循金融监管要求</li>
                    </ul>
                </div>
                <div class="detail-card" style="opacity:0;transform:translateY(20px);transition:opacity 0.5s,transform 0.5s;">
                    <h4 class="detail-title"><i class="fas fa-calculator" aria-hidden="true"></i> 收费说明</h4>
                    <ul class="detail-list">
                        <li>按实际使用天数计费，透明无隐藏费用</li>
                        <li>根据资金规模、期限、风险等级综合定价</li>
                        <li>长期合作客户享受优惠费率</li>
                        <li>具体费用以双方签署协议为准</li>
                    </ul>
                </div>
                <div class="detail-card" style="opacity:0;transform:translateY(20px);transition:opacity 0.5s,transform 0.5s;">
                    <h4 class="detail-title"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> 风险提示</h4>
                    <ul class="detail-list">
                        <li>资金业务存在市场风险，请根据自身情况谨慎决策</li>
                        <li>请确保提供真实、完整的资料信息</li>
                        <li>严格遵守合同约定，按时归还资金</li>
                        <li>投资有风险，入市需谨慎</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php
}

/**
 * 渲染核心优势区域
 */
function renderAdvantagesSection($content) {
    $advantagesTitle = $content['advantagesTitle'] ?? '我们的核心优势';
    $advantagesSubtitle = $content['advantagesSubtitle'] ?? '专业 高效 安全 可靠';
?>
    <section class="advantages" id="advantages" aria-labelledby="advantages-title">
        <div class="section-container">
            <div class="section-header">
                <h2 class="advantages-title" id="advantages-title"><?php echo htmlspecialchars($advantagesTitle); ?></h2>
                <p class="advantages-subtitle"><?php echo htmlspecialchars($advantagesSubtitle); ?></p>
            </div>
            <div class="advantages-content">
                <div class="advantages-visual">
                    <div class="advantages-image-wrapper">
                        <div class="advantages-icon-main"><i class="fas fa-thumbs-up"></i></div>
                        <div class="advantages-stats">
                            <div class="advantages-stat"><span class="advantages-stat-number">500+</span><span class="advantages-stat-label">服务企业</span></div>
                            <div class="advantages-stat"><span class="advantages-stat-number">99%</span><span class="advantages-stat-label">客户满意度</span></div>
                        </div>
                    </div>
                </div>
                <div class="advantages-features">
                    <div class="advantages-feature">
                        <div class="advantages-check"><i class="fas fa-check"></i></div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">丰富的行业经验</h3>
                            <p class="advantages-feature-desc">深耕资金业务十余年，积累了丰富的行业经验和资源网络，能够为客户提供最专业的服务。</p>
                        </div>
                    </div>
                    <div class="advantages-feature">
                        <div class="advantages-check"><i class="fas fa-check"></i></div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">强大的资金实力</h3>
                            <p class="advantages-feature-desc">累计管理资金规模超100亿元，单笔可提供数亿至数十亿资金支持。</p>
                        </div>
                    </div>
                    <div class="advantages-feature">
                        <div class="advantages-check"><i class="fas fa-check"></i></div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">专业的服务团队</h3>
                            <p class="advantages-feature-desc">核心团队成员均来自国内知名金融机构，平均从业经验超过15年。</p>
                        </div>
                    </div>
                    <div class="advantages-feature">
                        <div class="advantages-check"><i class="fas fa-check"></i></div>
                        <div class="advantages-feature-content">
                            <h3 class="advantages-feature-title">完善的风控体系</h3>
                            <p class="advantages-feature-desc">建立了完善的风险控制体系，严格遵循合规要求，确保每笔业务安全可控。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}

/**
 * 渲染FAQ常见问题区域
 */
function renderFaqSection($content, $phone = "") {
    $faqTitle = $content['faqTitle'] ?? '常见问题';
    $faqSubtitle = $content['faqSubtitle'] ?? '解答您关于资金业务的常见疑问';
    $escapedPhone = htmlspecialchars($phone ?: '13552883008', ENT_QUOTES, "UTF-8");
?>
    <section class="faq" id="faq" aria-labelledby="faq-title">
        <div class="section-container">
            <div class="section-header">
                <div class="section-label">FAQ</div>
                <h2 class="section-title" id="faq-title"><?php echo htmlspecialchars($faqTitle); ?></h2>
                <p class="section-subtitle"><?php echo htmlspecialchars($faqSubtitle); ?></p>
            </div>
            <div id="faqDynamicContainer" class="faq-container">
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-lightbulb"></i> 亮资业务</h3>
                    <div class="faq-list">
                        <details class="faq-item"><summary class="faq-question">什么是亮资服务？</summary><div class="faq-answer"><p>亮资服务是指企业在投标、合作洽谈等场景中，需要向对方展示自身资金实力时，由专业机构提供的资金证明服务。</p></div></details>
                        <details class="faq-item"><summary class="faq-question">亮资需要多长时间？</summary><div class="faq-answer"><p>一般情况下，亮资服务可在1-3个工作日内完成，具体时间根据金额大小和银行要求而定。</p></div></details>
                    </div>
                </div>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-exchange-alt"></i> 过桥资金</h3>
                    <div class="faq-list">
                        <details class="faq-item"><summary class="faq-question">过桥资金的利率是多少？</summary><div class="faq-answer"><p>过桥资金利率根据金额、期限、风险等因素综合确定，一般在月息1%-3%之间。</p></div></details>
                        <details class="faq-item"><summary class="faq-question">过桥资金最长可以使用多久？</summary><div class="faq-answer"><p>过桥资金通常为短期资金周转，使用期限一般在1-6个月，最长不超过1年。</p></div></details>
                    </div>
                </div>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-university"></i> 摆账业务</h3>
                    <div class="faq-list">
                        <details class="faq-item"><summary class="faq-question">摆账业务的资金安全吗？</summary><div class="faq-answer"><p>我们提供的摆账服务资金来源合法合规，全程由银行监管，确保资金安全。</p></div></details>
                        <details class="faq-item"><summary class="faq-question">摆账需要提供什么资料？</summary><div class="faq-answer"><p>一般需要提供：营业执照、法人身份证、公司章程、银行开户许可证等基础资料。</p></div></details>
                    </div>
                </div>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-file-invoice-dollar"></i> 应收账款融资</h3>
                    <div class="faq-list">
                        <details class="faq-item"><summary class="faq-question">应收账款融资的额度是多少？</summary><div class="faq-answer"><p>应收账款融资额度一般为应收账款金额的50%-80%。</p></div></details>
                    </div>
                </div>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-piggy-bank"></i> 银行存款</h3>
                    <div class="faq-list">
                        <details class="faq-item"><summary class="faq-question">银行存款业务有什么优势？</summary><div class="faq-answer"><p>我们与多家银行建立了长期合作关系，可以为客户争取更优惠的存款利率。</p></div></details>
                    </div>
                </div>
                <div class="faq-category">
                    <h3 class="faq-category-title"><i class="fas fa-question-circle"></i> 一般问题</h3>
                    <div class="faq-list">
                        <details class="faq-item"><summary class="faq-question">如何联系你们？</summary><div class="faq-answer"><p>电话：<?php echo $escapedPhone; ?><br>邮箱：wanglizhongguo@126.com</p></div></details>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}

/**
 * 渲染联系电话区域（城市分站用）
 */
function renderContactSection($cityName, $phone) {
    $escapedCity = htmlspecialchars($cityName, ENT_QUOTES, "UTF-8");
    $escapedPhone = htmlspecialchars($phone, ENT_QUOTES, "UTF-8");
?>
    <section class="services" style="padding:40px 0;">
        <div class="section-container" style="text-align:center;">
            <div style="background:linear-gradient(135deg,#1a365d,#2d4a7a);color:white;border-radius:12px;padding:40px 20px;">
                <h2 style="font-size:28px;margin-bottom:16px;"><?php echo $escapedCity; ?>业务咨询</h2>
                <p style="font-size:16px;margin-bottom:24px;opacity:0.9;">专业团队为您提供全方位的资金解决方案</p>
                <div style="font-size:32px;font-weight:700;letter-spacing:2px;">
                    <i class="fas fa-phone-alt" style="margin-right:12px;"></i><?php echo $escapedPhone; ?>
                </div>
            </div>
        </div>
    </section>
<?php
}

/**
 * 渲染合作银行区域
 */
function renderBankLogosSection() {
?>
    <section class="bank-logos-section">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">合作银行</h2>
                <p class="section-subtitle">与多家银行建立深度合作关系</p>
            </div>
            <div class="bank-logos-wrapper">
                <img src="/uploads/合作银行logo.jpg" alt="合作银行" class="bank-logos-image">
            </div>
        </div>
    </section>
<?php
}
