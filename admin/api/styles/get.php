<?php
/**
 * 站点样式 - 获取样式配置
 * GET请求
 * 参数: group (可选) - 按分组获取样式
 * 返回所有样式配置
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonError('仅支持GET请求', 405);
}

// 获取数据库连接
require_once dirname(dirname(dirname(__DIR__))) . '/config/db.php';

$group = isset($_GET['group']) ? trim($_GET['group']) : '';

$conn = getDB();

if ($group) {
    $stmt = $conn->prepare("SELECT style_key, style_value, group_name FROM site_styles WHERE group_name = ?");
    $stmt->bind_param('s', $group);
} else {
    $stmt = $conn->prepare("SELECT style_key, style_value, group_name FROM site_styles");
}

$stmt->execute();
$result = $stmt->get_result();

$styles = [];
$styleMap = [];
while ($row = $result->fetch_assoc()) {
    // Check if value is JSON
    $value = $row['style_value'];
    $decoded = json_decode($value, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $styleMap[$row['style_key']] = $decoded;
    } else {
        $styleMap[$row['style_key']] = $value;
    }
    $styles[$row['group_name']][$row['style_key']] = $styleMap[$row['style_key']];
}

$stmt->close();

// Parse the JSON style config specially for news_page_styles
if (isset($styleMap['news_page_styles']) && is_array($styleMap['news_page_styles'])) {
    $styleMap['news_page_styles'] = $styleMap['news_page_styles'];
}

jsonSuccess([
    'flat' => $styleMap,
    'grouped' => $styles
]);
