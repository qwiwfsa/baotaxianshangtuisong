<?php
/**
 * 页脚配置数据 API
 * GET: 获取页脚配置（支持按group筛选）
 * POST: 保存/删除页脚配置
 * 
 * === 部署步骤 ===
 * 1. 访问本文件自动创建 footer_settings 表及初始数据
 * 2. 后台管理页面：admin/footer-manager.html
 * 3. 前台渲染 include 文件：includes/footer.php
 * 4. 将前台所有含有 footer 的 .html 文件改为 .php，页脚位置替换为：
 *    <?php include 'includes/footer.php'; ?>
 * 5. 编码：UTF-8
 */

require_once __DIR__ . '/../../config/db.php';

/**
 * 初始化 footer_settings 表及默认数据
 */
function initFooterTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS footer_settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        group_key VARCHAR(50) NOT NULL COMMENT '配置分组',
        item_key VARCHAR(50) NOT NULL COMMENT '配置键名',
        item_label VARCHAR(100) NOT NULL COMMENT '配置标签(中文说明)',
        item_value TEXT COMMENT '配置值',
        item_url VARCHAR(500) DEFAULT '' COMMENT '链接URL(仅链接类型)',
        sort_order INT DEFAULT 0 COMMENT '排序',
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
        UNIQUE KEY uk_group_item (group_key, item_key)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='页脚配置表';";
    
    $conn->query($sql);

    // 检查是否已有数据
    $check = $conn->query("SELECT COUNT(*) as cnt FROM footer_settings");
    $row = $check->fetch_assoc();
    if ($row['cnt'] > 0) return;

    // 预设默认数据
    $defaults = [
        ['brand', 'company_desc', '企业简介文案', '专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务', '', 0],
        ['quick_links', 'link_1', '首页', '首页', '/', 1],
        ['quick_links', 'link_2', '服务项目', '服务项目', 'services.html', 2],
        ['quick_links', 'link_3', '成功案例', '成功案例', 'cases.html', 3],
        ['quick_links', 'link_4', '公司优势', '公司优势', 'advantages.html', 4],
        ['quick_links', 'link_5', '行业资讯', '行业资讯', 'news.html', 5],
        ['service_links', 'svc_1', '上市公司融资', '上市公司融资', 'services.html', 1],
        ['service_links', 'svc_2', '企业/个人摆账', '企业/个人摆账', 'services.html', 2],
        ['service_links', 'svc_3', '银行存款', '银行存款', 'services.html', 3],
        ['service_links', 'svc_4', '应收账款融资', '应收账款融资', 'services.html', 4],
        ['contact', 'phone', '手机号', '13552883008', '', 1],
        ['contact', 'contact_person', '联系人', '王先生', '', 2],
        ['contact', 'email', '邮箱', 'wanglizhongguo@126.com', '', 3],
        ['bottom', 'copyright_text', '版权声明文字', '&copy; 2024 Yao资金网 版权所有', '', 1],
        ['bottom', 'disclaimer_text', '风险提示免责文案', '投资有风险，理财需谨慎。本网站内容仅供参考，不构成投资建议。', '', 2],
    ];

    $stmt = $conn->prepare("INSERT INTO footer_settings (group_key, item_key, item_label, item_value, item_url, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($defaults as $d) {
        $stmt->bind_param("sssssi", $d[0], $d[1], $d[2], $d[3], $d[4], $d[5]);
        $stmt->execute();
    }
    $stmt->close();
}

// ========================================
// 主逻辑
// ========================================

$conn = getDB();
initFooterTable($conn);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ========== POST 处理 ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    // --- 删除单条 ---
    if ($action === 'delete') {
        $itemKey = isset($_POST['item_key']) ? $_POST['item_key'] : '';
        $groupKey = isset($_POST['group_key']) ? $_POST['group_key'] : '';
        if (!$itemKey || !$groupKey) {
            echo json_encode(['code' => 1, 'msg' => '缺少参数']);
            exit;
        }
        $stmt = $conn->prepare("DELETE FROM footer_settings WHERE group_key=? AND item_key=?");
        $stmt->bind_param("ss", $groupKey, $itemKey);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
        exit;
    }
    
    // --- 批量保存（新增/更新） ---
    if ($action === 'save_batch') {
        $dataJson = isset($_POST['data']) ? $_POST['data'] : '';
        if (!$dataJson) {
            echo json_encode(['code' => 1, 'msg' => '缺少数据']);
            exit;
        }
        $items = json_decode($dataJson, true);
        if (!is_array($items) || count($items) === 0) {
            echo json_encode(['code' => 1, 'msg' => '数据格式错误']);
            exit;
        }
        
        $count = 0;
        $stmtUpsert = $conn->prepare(
            "INSERT INTO footer_settings (group_key, item_key, item_label, item_value, item_url, sort_order)
             VALUES (?, ?, ?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE item_label=VALUES(item_label), item_value=VALUES(item_value), item_url=VALUES(item_url), sort_order=VALUES(sort_order)"
        );
        
        $sort = 0;
        foreach ($items as $item) {
            $gk = $item['group_key'] ?? '';
            $ik = $item['item_key'] ?? '';
            $il = $item['item_label'] ?? $ik;
            $iv = $item['item_value'] ?? '';
            $iu = $item['item_url'] ?? '';
            $so = isset($item['sort_order']) ? intval($item['sort_order']) : $sort;
            $sort++;
            
            if (!$gk || !$ik) continue;
            
            $stmtUpsert->bind_param("sssssi", $gk, $ik, $il, $iv, $iu, $so);
            $stmtUpsert->execute();
            $count++;
        }
        $stmtUpsert->close();
        
        echo json_encode(['code' => 0, 'count' => $count, 'msg' => '保存成功']);
        exit;
    }
    
    echo json_encode(['code' => 1, 'msg' => '未知操作']);
    exit;
}

// ========== GET 处理 ==========
$groupKey = isset($_GET['group']) ? $_GET['group'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'get') {
    // 单条记录
    $g = $_GET['group_key'] ?? '';
    $k = $_GET['item_key'] ?? '';
    if (!$g || !$k) {
        echo json_encode(['code' => 1, 'msg' => '缺少参数']);
        exit;
    }
    $stmt = $conn->prepare("SELECT * FROM footer_settings WHERE group_key=? AND item_key=?");
    $stmt->bind_param("ss", $g, $k);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
    echo json_encode(['code' => 0, 'data' => $data], JSON_UNESCAPED_UNICODE);
    exit;
}

// 按 group_key 查询
if ($groupKey) {
    $stmt = $conn->prepare("SELECT * FROM footer_settings WHERE group_key=? ORDER BY sort_order ASC");
    $stmt->bind_param("s", $groupKey);
} else {
    $stmt = $conn->prepare("SELECT * FROM footer_settings ORDER BY FIELD(group_key,'brand','quick_links','service_links','contact','bottom'), sort_order ASC");
}
$stmt->execute();
$result = $stmt->get_result();

$data = [];
$grouped = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $gk = $row['group_key'];
    if (!isset($grouped[$gk])) $grouped[$gk] = [];
    $grouped[$gk][] = $row;
}
$stmt->close();

echo json_encode([
    'code' => 0,
    'data' => $data,
    'grouped' => $grouped
], JSON_UNESCAPED_UNICODE);
