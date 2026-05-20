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
            if ($item['item_key'] === $key) {
                $val = $item['item_value'] ?? '';
                if ($val !== '') return $val;
                return $default;
            }
        }
    }
    return $default;
}

function fv_link($data, $group, $key, $default = '') {
    if (isset($data[$group])) {
        foreach ($data[$group] as $item) {
            if ($item['item_key'] === $key) {
                $val = $item['item_value'] ?? '';
                $url = $item['item_url'] ?? '';
                if ($val === '') return $url ? '<a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($default) . '</a>' : htmlspecialchars($default);
                if ($url) return '<a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($val) . '</a>';
                return htmlspecialchars($val);
            }
        }
    }
    return htmlspecialchars($default);
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
                    <div class="footer-logo"><img src="/uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"><?php echo htmlspecialchars(fv($footerData, 'brand', 'company_desc', '专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务')); ?></p>
                </div>

                <!-- 快速链接 -->
                <div class="footer-nav">
                    <h4 class="footer-nav-title">快捷导航</h4>
                    <ul class="footer-nav-list">
                        <?php foreach (fva($footerData, 'quick_links') as $link): ?>
                        <li><a href="<?php echo htmlspecialchars($link['item_url'] ?: '#'); ?>"><?php echo htmlspecialchars($link['item_value'] ?: $link['item_label']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                
                <?php
                $contacts = fva($footerData, 'contact');
                $hasContact = false;
                foreach ($contacts as $item) {
                    if (trim($item['item_value'] ?? '') !== '') { $hasContact = true; break; }
                }
                if ($hasContact):
                ?>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <?php foreach ($contacts as $item):
                            $val = trim($item['item_value'] ?? '');
                            if ($val === '') continue;
                            $icon = ($item['item_key'] === 'phone') ? 'fa-phone' : 
                                   (($item['item_key'] === 'email') ? 'fa-envelope' : 'fa-user');
                        ?>
                        <li><i class="fas <?php echo $icon; ?>"></i> <?php echo htmlspecialchars($val); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>

            <!-- 全国省份 -->
            <div class="footer-provinces">
                <div class="footer-provinces-inner">
                    <h4 class="footer-provinces-title">全国省份</h4>
                    <div class="footer-province-links">
<a href="/fenzhan/province-shanghai.html" class="footer-province-item">上海资金服务</a>
<a href="/fenzhan/province-yun-nan.html" class="footer-province-item">云南资金服务</a>
<a href="/fenzhan/province-nei-meng-gu.html" class="footer-province-item">内蒙古资金服务</a>
<a href="/fenzhan/province-beijing.html" class="footer-province-item">北京资金服务</a>
<a href="/fenzhan/province-ji-lin.html" class="footer-province-item">吉林资金服务</a>
<a href="/fenzhan/province-si-chuan.html" class="footer-province-item">四川资金服务</a>
<a href="/fenzhan/province-tianjin.html" class="footer-province-item">天津资金服务</a>
<a href="/fenzhan/province-ning-xia.html" class="footer-province-item">宁夏资金服务</a>
<a href="/fenzhan/province-an-hui.html" class="footer-province-item">安徽资金服务</a>
<a href="/fenzhan/province-shan-dong.html" class="footer-province-item">山东资金服务</a>
<a href="/fenzhan/province-shan-xi.html" class="footer-province-item">山西资金服务</a>
<a href="/fenzhan/province-guang-dong.html" class="footer-province-item">广东资金服务</a>
<a href="/fenzhan/province-guang-xi.html" class="footer-province-item">广西资金服务</a>
<a href="/fenzhan/province-xin-jiang.html" class="footer-province-item">新疆资金服务</a>
<a href="/fenzhan/province-jiang-su.html" class="footer-province-item">江苏资金服务</a>
<a href="/fenzhan/province-jiang-xi.html" class="footer-province-item">江西资金服务</a>
<a href="/fenzhan/province-he-bei.html" class="footer-province-item">河北资金服务</a>
<a href="/fenzhan/province-he-nan.html" class="footer-province-item">河南资金服务</a>
<a href="/fenzhan/province-zhe-jiang.html" class="footer-province-item">浙江资金服务</a>
<a href="/fenzhan/province-hai-nan.html" class="footer-province-item">海南资金服务</a>
<a href="/fenzhan/province-gang-ao-tai.html" class="footer-province-item">港澳台资金服务</a>
<a href="/fenzhan/province-hu-bei.html" class="footer-province-item">湖北资金服务</a>
<a href="/fenzhan/province-hu-nan.html" class="footer-province-item">湖南资金服务</a>
<a href="/fenzhan/province-gan-su.html" class="footer-province-item">甘肃资金服务</a>
<a href="/fenzhan/province-fu-jian.html" class="footer-province-item">福建资金服务</a>
<a href="/fenzhan/province-xi-zang.html" class="footer-province-item">西藏资金服务</a>
<a href="/fenzhan/province-gui-zhou.html" class="footer-province-item">贵州资金服务</a>
<a href="/fenzhan/province-liao-ning.html" class="footer-province-item">辽宁资金服务</a>
<a href="/fenzhan/province-chongqing.html" class="footer-province-item">重庆资金服务</a>
<a href="/fenzhan/province-shaan-xi.html" class="footer-province-item">陕西资金服务</a>
<a href="/fenzhan/province-qing-hai.html" class="footer-province-item">青海资金服务</a>
<a href="/fenzhan/province-hei-long-jiang.html" class="footer-province-item">黑龙江资金服务</a>
                    </div>
                </div>
            </div>

            <!-- 底部信息 -->
            <div class="footer-bottom">
                <p class="footer-copyright"><?php echo fv_link($footerData, 'bottom', 'copyright_text', '© 2026 Yao资金网 宏都资本版权所有'); ?></p>
                <p class="footer-disclaimer"><?php echo fv_link($footerData, 'bottom', 'disclaimer_text', '粤ICP备2026052915号'); ?></p>
            </div>
        </div>
    </footer

<?php
$dir = __DIR__ . '/../pages/';
$files = glob($dir . '*.html');
echo '<!-- Files: ' . count($files) . ' -->';
foreach ($files as $f) {
    $h = file_get_contents($f);
    $hasLoader = strpos($h, 'footer-loader.js') !== false;
    $emptyQL = strpos($h, 'footer-nav-list"></ul>') !== false;
    echo '<!-- ' . basename($f) . ': loader=' . ($hasLoader?'Y':'N') . ' emptyQL=' . ($emptyQL?'Y':'N') . ' -->';
}
?>
    </footer>