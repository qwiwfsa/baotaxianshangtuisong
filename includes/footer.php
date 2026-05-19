<?php
/**
 * 页脚 - 服务端直接渲染（无闪烁）
 * 桌面端统一使用
 */
require_once __DIR__ . '/../config/db.php';

$conn = getDB();
$result = $conn->query("SELECT * FROM footer_settings ORDER BY FIELD(group_key,'brand','quick_links','service_links','contact','bottom'), sort_order ASC");
$footerData = [];
while ($row = $result->fetch_assoc()) {
    $gk = $row['group_key'];
    if (!isset($footerData[$gk])) $footerData[$gk] = [];
    $footerData[$gk][] = $row;
}
$result->close();

function fv_link($data, $group, $key, $default = '') {
    if (isset($data[$group])) {
        foreach ($data[$group] as $item) {
            if ($item['item_key'] === $key) {
                $val = $item['item_value'] ?? $default;
                $url = $item['item_url'] ?? '';
                if ($url) return '<a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($val) . '</a>';
                return htmlspecialchars($val);
            }
        }
    }
    return htmlspecialchars($default);
}

function fv($data, $group, $key, $default = '') {
    if (isset($data[$group])) {
        foreach ($data[$group] as $item) {
            if ($item['item_key'] === $key) return $item['item_value'] ?? $default;
        }
    }
    return $default;
}

$brandDesc = fv($footerData, 'brand', 'company_desc', '专业资金业务服务商，提供上市公司商票业务、冲量打款、应收账款保理等全方位资金服务');
$quickLinks = isset($footerData['quick_links']) ? $footerData['quick_links'] : [];
$copyright = fv($footerData, 'bottom', 'copyright_text', '&copy; 2026 Yao资金居间 成都时资版权所有');
$copyrightUrl = fv($footerData, 'bottom', 'copyright_text_url', '');
$disclaimer = fv($footerData, 'bottom', 'disclaimer_text', '蜀ICP备2026052915号');
$disclaimerUrl = fv($footerData, 'bottom', 'disclaimer_text_url', '');

// Fallback quick links if empty
if (empty($quickLinks)) {
    $quickLinks = [
        ['item_value' => '杭州', 'item_url' => 'https://yaozijin.com/fenzhan/hangzhou.html'],
        ['item_value' => '重庆', 'item_url' => 'https://yaozijin.com/fenzhan/chongqing.html'],
        ['item_value' => '成都', 'item_url' => 'https://yaozijin.com/fenzhan/chengdu.html'],
        ['item_value' => '更多城市', 'item_url' => '#'],
        ['item_value' => '网站地图', 'item_url' => '/sitemap.xml'],
    ];
}
?>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="/uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金居间" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"><?php echo $brandDesc; ?></p>
                </div>

                <div class="footer-nav footer-nav-horizontal" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快捷导航</h4>
                    <ul class="footer-nav-list" style="flex-direction:row;flex-wrap:wrap;gap:20px">
                        <?php foreach ($quickLinks as $link): ?>
                        <li><a href="<?php echo htmlspecialchars($link['item_url'] ?? '#'); ?>"><?php echo htmlspecialchars($link['item_value'] ?? $link['item_label'] ?? ''); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <?php
                        $contacts = isset($footerData['contact']) ? $footerData['contact'] : [];
                        $hasContact = false;
                        if (!empty($contacts)):
                            foreach ($contacts as $item):
                                $val = $item['item_value'] ?? '';
                                if ($val !== '') $hasContact = true;
                            endforeach;
                        endif;
                        if ($hasContact):
                            foreach ($contacts as $item):
                                $icon = ($item['item_key'] === 'phone') ? 'fa-phone' : 
                                       (($item['item_key'] === 'email') ? 'fa-envelope' : 'fa-user');
                                $val = $item['item_value'] ?? '';
                                if ($val !== ''):
                        ?>
                        <li><i class="fas <?php echo $icon; ?>"></i> <?php echo htmlspecialchars($val); ?></li>
                        <?php endif; endforeach; else: ?>
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                        <?php endif; ?>
                    </ul>
                </div>

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

            
<div class="footer-bottom">
                <p class="footer-copyright"><?php echo fv_link($footerData, 'bottom', 'copyright_text', '© 2026 Yao资金网 宏都资本版权所有'); ?></p>
                <p class="footer-disclaimer"><?php echo fv_link($footerData, 'bottom', 'disclaimer_text', '粤ICP备2026052915号'); ?></p>
            </div>
        </div>
    </footer>