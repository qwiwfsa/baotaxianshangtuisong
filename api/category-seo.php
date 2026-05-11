<?php
/**
 * 通用分类SEO数据API
 * GET ?type=news&id=分类ID  返回分类SEO信息
 * GET ?type=faq&id=分类ID   返回FAQ分类SEO信息（兼容旧接口）
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

$type = isset($_GET['type']) ? trim($_GET['type']) : 'news';
$catId = isset($_GET['id']) ? intval($_GET['id']) : 0;

try {
    $conn = getDB();

    $data = [
        'seo_title' => '',
        'seo_keywords' => '',
        'seo_description' => '',
        'cat_name' => ''
    ];

    if ($catId > 0 && $type === 'news') {
        $stmt = $conn->prepare("SELECT name, seo_title, seo_keywords, seo_description FROM cms_categories WHERE id = ?");
        $stmt->bind_param("i", $catId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data['cat_name'] = $row['name'] ?: '';
            $data['seo_title'] = $row['seo_title'] ?: '';
            $data['seo_keywords'] = $row['seo_keywords'] ?: '';
            $data['seo_description'] = $row['seo_description'] ?: '';
        }
        $stmt->close();
    } elseif ($catId > 0 && $type === 'faq') {
        $stmt = $conn->prepare("SELECT cat_label, seo_title, seo_keywords, seo_description FROM faq_categories WHERE id = ?");
        $stmt->bind_param("i", $catId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $data['cat_name'] = $row['cat_label'] ?: '';
            $data['seo_title'] = $row['seo_title'] ?: '';
            $data['seo_keywords'] = $row['seo_keywords'] ?: '';
            $data['seo_description'] = $row['seo_description'] ?: '';
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
