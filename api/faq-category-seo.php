<?php
/**
 * FAQ分类SEO数据API
 * GET ?cat=分类key 返回该分类的SEO信息
 * 用于前台分类切换时动态更新页面title和meta标签
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../config/db.php';

$cat = isset($_GET['cat']) ? trim($_GET['cat']) : '';

try {
    $conn = getDB();

    $data = [
        'seo_title' => '',
        'seo_keywords' => '',
        'seo_description' => '',
        'cat_label' => ''
    ];

    if ($cat) {
        $stmt = $conn->prepare("SELECT cat_label, seo_title, seo_keywords, seo_description FROM faq_categories WHERE cat_key = ?");
        $stmt->bind_param("s", $cat);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data['cat_label'] = $row['cat_label'] ?: $cat;
            $data['seo_title'] = $row['seo_title'] ?: ($data['cat_label'] . ' - 常见问题');
            $data['seo_keywords'] = $row['seo_keywords'] ?: ($data['cat_label'] . ',常见问题,FAQ');
            $data['seo_description'] = $row['seo_description'] ?: ('Yao资金网' . $data['cat_label'] . '常见问题解答');
        }
        $stmt->close();
    }

    $conn->close();

    echo json_encode([
        'code' => 0,
        'msg' => 'success',
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode([
        'code' => 1,
        'msg' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
