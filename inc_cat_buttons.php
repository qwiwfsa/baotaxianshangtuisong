<?php
// 从数据库读取分类并生成分类按钮HTML
require_once __DIR__ . '/config/db.php';
$conn = getDB();

$iconMap = [
    'liangzi' => 'fa-lightbulb',
    'guoqiao' => 'fa-exchange-alt',
    'baizhang' => 'fa-university',
    'receivable' => 'fa-file-invoice-dollar',
    'deposit' => 'fa-landmark',
    'general' => 'fa-info-circle'
];

$catResult = $conn->query("SELECT cat_key, cat_label, sort_order FROM faq_categories ORDER BY sort_order ASC");
if ($catResult) {
    while ($row = $catResult->fetch_assoc()) {
        $key = $row['cat_key'];
        $label = $row['cat_label'];
        $icon = isset($iconMap[$key]) ? $iconMap[$key] : 'fa-circle';
?>
                        <div class="faq-category-item" data-category="<?php echo htmlspecialchars($key); ?>">
                            <i class="fas <?php echo htmlspecialchars($icon); ?>"></i>
                            <span><?php echo htmlspecialchars($label); ?></span>
                        </div>
<?php
    }
}
?>