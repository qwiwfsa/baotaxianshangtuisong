<?php
/**
 * 页脚精简版（仅版权+免责声明）
 * 手机端统一使用
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

function fv_simple($data, $group, $key, $default = '') {
    if (isset($data[$group])) {
        foreach ($data[$group] as $item) {
            if ($item['item_key'] === $key) return $item['item_value'] ?? $default;
        }
    }
    return $default;
}
?>
    <footer class="footer footer-simple">
        <div class="footer-container">
            <div class="footer-bottom">
                <p class="footer-copyright"><?php echo fv_simple($footerData, 'bottom', 'copyright_text', '&copy; 2024 Yao资金网 版权所有'); ?></p>
                <p class="footer-disclaimer"><?php echo fv_simple($footerData, 'bottom', 'disclaimer_text', ''); ?></p>
            </div>
        </div>
    </footer>
