<?php
/**
 * 页脚前台渲染文件
 * 从数据库读取配置并渲染完整页脚HTML
 * 
 * 使用方式：
 * 在 .php 页面中页脚位置写入： <?php include 'includes/footer.php'; ?>
 * 
 * 编码：UTF-8
 */

require_once __DIR__ . '/../config/db.php';

$conn = getDB();

// 获取所有页脚配置，按分组和排序排列
$result = $conn->query("SELECT * FROM footer_settings ORDER BY FIELD(group_key,'brand','quick_links','service_links','contact','bottom'), sort_order ASC");

$footerData = [];
while ($row = $result->fetch_assoc()) {
    $gk = $row['group_key'];
    if (!isset($footerData[$gk])) $footerData[$gk] = [];
    $footerData[$gk][] = $row;
}
$result->close();

// 安全取数辅助
function fv($data, $group, $key, $default = '') {
    if (isset($data[$group])) {
        foreach ($data[$group] as $item) {
            if ($item['item_key'] === $key) return $item['item_value'] ?? $default;
        }
    }
    return $default;
}

function fva($data, $group) {
    return $data[$group] ?? [];
}

// ========================================
// 渲染 HTML
// ========================================
?>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <!-- 品牌信息 -->
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo/biaoqianlogo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"><?php echo htmlspecialchars(fv($footerData, 'brand', 'company_desc', '专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务')); ?></p>
                </div>

                <!-- 快速链接 -->
                <div class="footer-nav">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <?php foreach (fva($footerData, 'quick_links') as $link): ?>
                        <li><a href="<?php echo htmlspecialchars($link['item_url'] ?: '#'); ?>"><?php echo htmlspecialchars($link['item_value'] ?: $link['item_label']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- 业务链接 -->
                <div class="footer-nav">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <?php
                        $serviceLinks = fva($footerData, 'service_links');
                        // 如果数据库有业务链接就用业务链接，否则用默认列表
                        if (!empty($serviceLinks)):
                        ?>
                        <?php foreach ($serviceLinks as $link): ?>
                        <li><a href="<?php echo htmlspecialchars($link['item_url'] ?: '#'); ?>"><?php echo htmlspecialchars($link['item_value'] ?: $link['item_label']); ?></a></li>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <li><a href="news.php">行业资讯</a></li>
                        <li><a href="faq.html">常见问题</a></li>
                        <li><a href="contact.html">联系我们</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- 联系方式 -->
                <div class="footer-nav">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <?php
                        $contacts = fva($footerData, 'contact');
                        $phone = fv($footerData, 'contact', 'phone', '13552883008');
                        $person = fv($footerData, 'contact', 'contact_person', '王总');
                        $email = fv($footerData, 'contact', 'email', 'wanglizhongguo@126.com');
                        ?>
                        <li><i class="fas fa-phone"></i> <?php echo htmlspecialchars($phone); ?></li>
                        <li><i class="fas fa-user"></i> <?php echo htmlspecialchars($person); ?></li>
                        <li><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($email); ?></li>
                    </ul>
                </div>
            </div>

            <!-- 底部信息 -->
            <div class="footer-bottom">
                <p class="footer-copyright"><?php echo fv($footerData, 'bottom', 'copyright_text', '&copy; 2024 Yao资金网 版权所有'); ?></p>
                <p class="footer-disclaimer"><?php echo fv($footerData, 'bottom', 'disclaimer_text', '投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。'); ?></p>
            </div>
        </div>
    </footer>
