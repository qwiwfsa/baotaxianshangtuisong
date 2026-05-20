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
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <?php foreach (fva($footerData, 'quick_links') as $link): ?>
                        <li><a href="<?php echo htmlspecialchars($link['item_url'] ?: '#'); ?>"><?php echo htmlspecialchars($link['item_value'] ?: $link['item_label']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- 业务链接 -->
                

                
            </div>

            <!-- 全国省份 -->
            <div class="footer-provinces">
                <div class="footer-provinces-inner">
                    <h4 class="footer-provinces-title">全国省份</h4>
                    <div class="footer-province-links">
<?php
$provinces = isset($footerData["provinces"]) ? $footerData["provinces"] : [];
if (empty($provinces)) {
    $provinces = [
        ["item_value"=>"上海资金服务","item_url"=>"/fenzhan/province-shanghai.html"],
        ["item_value"=>"云南资金服务","item_url"=>"/fenzhan/province-yun-nan.html"],
        ["item_value"=>"内蒙古资金服务","item_url"=>"/fenzhan/province-nei-meng-gu.html"],
        ["item_value"=>"北京资金服务","item_url"=>"/fenzhan/province-beijing.html"],
        ["item_value"=>"吉林资金服务","item_url"=>"/fenzhan/province-ji-lin.html"],
        ["item_value"=>"四川资金服务","item_url"=>"/fenzhan/province-si-chuan.html"],
        ["item_value"=>"天津资金服务","item_url"=>"/fenzhan/province-tianjin.html"],
        ["item_value"=>"宁夏资金服务","item_url"=>"/fenzhan/province-ning-xia.html"],
        ["item_value"=>"安徽资金服务","item_url"=>"/fenzhan/province-an-hui.html"],
        ["item_value"=>"山东资金服务","item_url"=>"/fenzhan/province-shan-dong.html"],
        ["item_value"=>"山西资金服务","item_url"=>"/fenzhan/province-shan-xi.html"],
        ["item_value"=>"广东资金服务","item_url"=>"/fenzhan/province-guang-dong.html"],
        ["item_value"=>"广西资金服务","item_url"=>"/fenzhan/province-guang-xi.html"],
        ["item_value"=>"新疆资金服务","item_url"=>"/fenzhan/province-xin-jiang.html"],
        ["item_value"=>"江苏资金服务","item_url"=>"/fenzhan/province-jiang-su.html"],
        ["item_value"=>"江西资金服务","item_url"=>"/fenzhan/province-jiang-xi.html"],
        ["item_value"=>"河北资金服务","item_url"=>"/fenzhan/province-he-bei.html"],
        ["item_value"=>"河南资金服务","item_url"=>"/fenzhan/province-he-nan.html"],
        ["item_value"=>"浙江资金服务","item_url"=>"/fenzhan/province-zhe-jiang.html"],
        ["item_value"=>"海南资金服务","item_url"=>"/fenzhan/province-hai-nan.html"],
        ["item_value"=>"港澳台资金服务","item_url"=>"/fenzhan/province-gang-ao-tai.html"],
        ["item_value"=>"湖北资金服务","item_url"=>"/fenzhan/province-hu-bei.html"],
        ["item_value"=>"湖南资金服务","item_url"=>"/fenzhan/province-hu-nan.html"],
        ["item_value"=>"甘肃资金服务","item_url"=>"/fenzhan/province-gan-su.html"],
        ["item_value"=>"福建资金服务","item_url"=>"/fenzhan/province-fu-jian.html"],
        ["item_value"=>"西藏资金服务","item_url"=>"/fenzhan/province-xi-zang.html"],
        ["item_value"=>"贵州资金服务","item_url"=>"/fenzhan/province-gui-zhou.html"],
        ["item_value"=>"辽宁资金服务","item_url"=>"/fenzhan/province-liao-ning.html"],
        ["item_value"=>"重庆资金服务","item_url"=>"/fenzhan/province-chongqing.html"],
        ["item_value"=>"陕西资金服务","item_url"=>"/fenzhan/province-shaan-xi.html"],
        ["item_value"=>"青海资金服务","item_url"=>"/fenzhan/province-qing-hai.html"],
        ["item_value"=>"黑龙江资金服务","item_url"=>"/fenzhan/province-hei-long-jiang.html"],
    ];
}
foreach ($provinces as $p):
    $pname = $p["item_value"] ?? $p["name"] ?? "";
    $purl = $p["item_url"] ?? ("/fenzhan/province-" . ($p["slug"] ?? "") . ".html");
?>
<a href="<?php echo htmlspecialchars($purl); ?>" class="footer-province-item"><?php echo htmlspecialchars($pname); ?></a>
<?php endforeach; ?>
                    </div>
                </div>
            </div>


            <div class="footer-bottom">
                <p class="footer-copyright"><?php echo fv_link($footerData, 'bottom', 'copyright_text', '&copy; 2024 Yao资金网 版权所有'); ?></p>
                <p class="footer-disclaimer" style="font-size:11px;color:#9ca3af;margin:0"><?php echo fv_link($footerData, 'bottom', 'disclaimer_text', '投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。'); ?></p>
            </div>
        </div>
    
    
    </footer>