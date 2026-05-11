<?php
/**
 * FAQ数据 API
 * GET: 获取FAQ列表
 */

require_once __DIR__ . '/../../config/db.php';

/**
 * 初始化 faq 表及faq_categories表
 */
function initTables($conn) {
    // 创建faq表
    $conn->query("CREATE TABLE IF NOT EXISTS faq (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL COMMENT 'FAQ分类',
        question TEXT NOT NULL COMMENT '问题',
        answer TEXT NOT NULL COMMENT '答案(支持HTML)',
        sort_order INT DEFAULT 0 COMMENT '排序',
        is_active TINYINT(1) DEFAULT 1 COMMENT '是否启用',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
        INDEX idx_category (category),
        INDEX idx_active (is_active)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FAQ常见问题表';");

    // 创建faq_categories表
    $conn->query("CREATE TABLE IF NOT EXISTS faq_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cat_key VARCHAR(50) NOT NULL UNIQUE COMMENT '分类键名',
        cat_label VARCHAR(100) NOT NULL COMMENT '分类显示名',
        sort_order INT DEFAULT 0 COMMENT '排序',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='FAQ分类配置表';");

    // 检查faq表是否已有数据
    $check = $conn->query("SELECT COUNT(*) as cnt FROM faq");
    $row = $check->fetch_assoc();
    if ($row['cnt'] > 0) return;

    // 预设默认FAQ数据
    $defaults = [
        ['liangzi', '什么是亮资服务？', '<p>亮资服务是指企业在投标、合作洽谈等场景中，需要向对方展示自身资金实力时，由专业机构提供的资金证明服务。</p>', 1],
        ['liangzi', '亮资需要多长时间？', '<p>一般情况下，亮资服务可在1-3个工作日内完成，具体时间根据金额大小和银行要求而定。</p>', 2],
        ['guoqiao', '过桥资金的利率是多少？', '<p>过桥资金利率根据金额、期限、风险等因素综合确定，一般在月息1%-3%之间，具体费率需根据实际情况评估。</p>', 1],
        ['guoqiao', '过桥资金最长可以使用多久？', '<p>过桥资金通常为短期资金周转，使用期限一般在1-6个月，最长不超过1年。</p>', 2],
        ['baizhang', '摆账业务的资金安全吗？', '<p>我们提供的摆账服务资金来源合法合规，全程由银行监管，确保资金安全。同时会签订正规合同，保障双方权益。</p>', 1],
        ['baizhang', '摆账需要提供什么资料？', '<p>一般需要提供：营业执照、法人身份证、公司章程、银行开户许可证等基础资料，具体要求根据摆账金额和银行要求而定。</p>', 2],
        ['receivable', '应收账款融资的额度是多少？', '<p>应收账款融资额度一般为应收账款金额的50%-80%，具体比例根据应收账款质量、账期、买方信用等因素确定。</p>', 1],
        ['deposit', '银行存款业务有什么优势？', '<p>我们与多家银行建立了长期合作关系，可以为客户争取更优惠的存款利率，同时提供专业的资金管理建议。</p>', 1],
        ['general', '你们的服务费用如何收取？', '<p>服务费用根据业务类型、金额大小、服务期限等因素综合确定，具体费用在签订合同前会明确告知，绝无隐形收费。</p>', 1],
        ['general', '如何联系你们？', '<p>您可以通过以下方式联系我们：<br>电话：13552883008<br>邮箱：wanglizhongguo@126.com<br>或直接在网站上点击"立即咨询"按钮。</p>', 2],
    ];

    $stmt = $conn->prepare("INSERT INTO faq (category, question, answer, sort_order) VALUES (?, ?, ?, ?)");
    foreach ($defaults as $d) {
        $stmt->bind_param("sssi", $d[0], $d[1], $d[2], $d[3]);
        $stmt->execute();
    }
    $stmt->close();
}

/**
 * 插入默认分类到faq_categories表
 */
function initDefaultCategories($conn, $defaultCategories) {
    $cStmt = $conn->prepare("INSERT IGNORE INTO faq_categories (cat_key, cat_label, sort_order) VALUES (?, ?, ?)");
    foreach ($defaultCategories as $cat) {
        $cStmt->bind_param("ssi", $cat['key'], $cat['label'], $cat['sort_order']);
        $cStmt->execute();
    }
    $cStmt->close();
}

// ========================================
// 主逻辑
// ========================================

$conn = getDB();
initTables($conn);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ========== GET 处理 ==========
$category = isset($_GET['category']) ? $_GET['category'] : '';

if ($category) {
    $stmt = $conn->prepare("SELECT * FROM faq WHERE category=? AND is_active=1 ORDER BY sort_order ASC");
    $stmt->bind_param("s", $category);
} else {
    $stmt = $conn->prepare("SELECT * FROM faq WHERE is_active=1 ORDER BY FIELD(category,'liangzi','guoqiao','baizhang','receivable','deposit','general'), sort_order ASC");
}
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$stmt->close();

// ========== 获取分类配置 ==========
$stmt = $conn->query("SELECT cat_key, cat_label, sort_order, seo_title, seo_keywords, seo_description FROM faq_categories ORDER BY sort_order ASC");
$categories = [];
$categoriesOrder = [];
if ($stmt) {
    while ($row = $stmt->fetch_assoc()) {
        $categories[$row['cat_key']] = $row['cat_label'];
        $categoriesOrder[] = [
            'key' => $row['cat_key'],
            'label' => $row['cat_label'],
            'sort_order' => intval($row['sort_order']),
            'seo_title' => $row['seo_title'] ?? '',
            'seo_keywords' => $row['seo_keywords'] ?? '',
            'seo_description' => $row['seo_description'] ?? ''
        ];
    }
    $stmt->close();
}

if (empty($categories)) {
    // 默认分类
    $categories = [
        'liangzi' => '亮资业务',
        'bridge' => '过桥资金',
        'baizhang' => '摆账业务',
        'receivable' => '应收账款',
        'deposit' => '银行存款',
        'general' => '一般问题'
    ];
    $categoriesOrder = [
        ['key' => 'liangzi', 'label' => '亮资业务', 'sort_order' => 0, 'seo_title' => '', 'seo_keywords' => '', 'seo_description' => ''],
        ['key' => 'guoqiao', 'label' => '过桥资金', 'sort_order' => 1, 'seo_title' => '', 'seo_keywords' => '', 'seo_description' => ''],
        ['key' => 'baizhang', 'label' => '摆账业务', 'sort_order' => 2, 'seo_title' => '', 'seo_keywords' => '', 'seo_description' => ''],
        ['key' => 'receivable', 'label' => '应收账款', 'sort_order' => 3, 'seo_title' => '', 'seo_keywords' => '', 'seo_description' => ''],
        ['key' => 'deposit', 'label' => '银行存款', 'sort_order' => 4, 'seo_title' => '', 'seo_keywords' => '', 'seo_description' => ''],
        ['key' => 'general', 'label' => '一般问题', 'sort_order' => 5, 'seo_title' => '', 'seo_keywords' => '', 'seo_description' => '']
    ];
    // 写入默认到数据库
    initDefaultCategories($conn, $categoriesOrder);
}

echo json_encode([
    'code' => 0,
    'data' => $data,
    'categories' => $categories,
    'categories_order' => $categoriesOrder
], JSON_UNESCAPED_UNICODE);
