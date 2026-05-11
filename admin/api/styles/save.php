<?php
/**
 * 站点样式 - 保存样式配置
 * POST请求
 * 参数：接收JSON body
 *   {
 *     "group": "news",
 *     "styles": {
 *       "news_page_styles": {...},
 *       "news_cover_width": "180"
 *     }
 *   }
 * 或直接传入key/value对
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError('仅支持POST请求', 405);
}

// 获取数据库连接
require_once dirname(dirname(dirname(__DIR__))) . '/config/db.php';

$data = getAllPostParams();

$conn = getDB();

// 模式1: 批量保存 (传入 group + styles 对象)
if (isset($data['group']) && isset($data['styles']) && is_array($data['styles'])) {
    $group = trim($data['group']);
    $styles = $data['styles'];
    
    $stmt = $conn->prepare("INSERT INTO site_styles (style_key, style_value, group_name) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE style_value=VALUES(style_value), group_name=VALUES(group_name)");
    
    $count = 0;
    foreach ($styles as $key => $value) {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        $stmt->bind_param('sss', $key, $value, $group);
        if ($stmt->execute()) {
            $count++;
        }
    }
    $stmt->close();
    
    jsonSuccess(['saved' => $count], "已保存 {$count} 项样式配置");
}

// 模式2: 传统保存 (传入 style_key + style_value)
$allowedFields = [
    'news_page_styles', 'news_cover_width', 'news_cover_height', 
    'news_title_fontsize', 'news_summary_fontsize', 'news_summary_lines',
    'news_readmore_fontsize', 'news_card_padding', 'news_summary_minheight'
];

$saved = 0;
$stmt = $conn->prepare("INSERT INTO site_styles (style_key, style_value, group_name) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE style_value=VALUES(style_value), group_name=VALUES(group_name)");

$defaultGroup = 'news';
foreach ($data as $key => $value) {
    if (in_array($key, $allowedFields)) {
        if (is_array($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        $stmt->bind_param('sss', $key, $value, $defaultGroup);
        if ($stmt->execute()) {
            $saved++;
        }
    }
}
$stmt->close();

if ($saved > 0) {
    jsonSuccess(['saved' => $saved], "已保存 {$saved} 项样式配置");
} else {
    jsonError('没有可保存的样式字段');
}
