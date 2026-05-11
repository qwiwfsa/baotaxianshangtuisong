<?php
// 数据库动态渲染FAQ分类和条目（只输出分类内容，不输出容器标签）
require_once __DIR__ . '/config/db.php';
$conn = getDB();

// 获取分类（按排序顺序）
$cats = [];
$catResult = $conn->query("SELECT cat_key, cat_label, sort_order FROM faq_categories ORDER BY sort_order ASC");
if ($catResult) {
    while ($row = $catResult->fetch_assoc()) {
        $cats[] = $row;
    }
}

// 分类图标映射
$iconMap = [
    'liangzi' => 'fa-lightbulb',
    'guoqiao' => 'fa-exchange-alt',
    'baizhang' => 'fa-university',
    'receivable' => 'fa-file-invoice-dollar',
    'deposit' => 'fa-landmark',
    'general' => 'fa-info-circle'
];

// 获取FAQ条目
$faqItems = [];
$faqResult = $conn->query("SELECT id, category, question, answer, sort_order FROM faq WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
if ($faqResult) {
    while ($row = $faqResult->fetch_assoc()) {
        $faqItems[$row['category']][] = $row;
    }
}

foreach ($cats as $cat):
    $key = $cat['cat_key'];
    $label = $cat['cat_label'];
    $icon = isset($iconMap[$key]) ? $iconMap[$key] : 'fa-circle';
    $items = isset($faqItems[$key]) ? $faqItems[$key] : [];
?>
                        <!-- <?php echo htmlspecialchars($label); ?> -->
                        <div class="faq-custom-category" data-category="<?php echo htmlspecialchars($key); ?>">
                            <h3 class="faq-custom-category-title">
                                <i class="fas <?php echo htmlspecialchars($icon); ?>"></i>
                                <?php echo htmlspecialchars($label); ?>
                            </h3>
                            <div class="faq-custom-list">
<?php foreach ($items as $item): ?>
                                <details class="faq-custom-item">
                                    <summary class="faq-custom-question">
                                        <span><?php echo htmlspecialchars($item['question']); ?></span>
                                        <i class="fas fa-chevron-down"></i>
                                    </summary>
                                    <div class="faq-custom-answer">
                                        <?php echo $item['answer']; ?>
                                    </div>
                                </details>
<?php endforeach; ?>
                            </div>
                        </div>
<?php endforeach; ?>
