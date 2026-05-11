<?php
/**
 * 动态样式生成器 - 根据数据库配置生成CSS
 * 
 * 用法：<link rel="stylesheet" href="admin/api/styles/dynamic-css.php?group=news">
 * 或者嵌入：<style><?php include 'admin/api/styles/dynamic-css.php'; ?></style>
 */

header('Content-Type: text/css; charset=utf-8');
header('Cache-Control: public, max-age=300');

require_once dirname(__DIR__, 3) . '/config/db.php';

// 解析样式
function parseStyleValue($value) {
    $decoded = json_decode($value, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        return $decoded;
    }
    return $value;
}

$conn = getDB();
$result = $conn->query("SELECT style_key, style_value FROM site_styles WHERE group_name = 'news'");

$styles = [];
while ($row = $result->fetch_assoc()) {
    $styles[$row['style_key']] = parseStyleValue($row['style_value']);
}
$conn->close();

// 从JSON配置提取
$pageStyles = isset($styles['news_page_styles']) && is_array($styles['news_page_styles']) 
    ? $styles['news_page_styles'] 
    : [];

?>
/* === 行业资讯页面动态样式 === */
.news-list .news-item {
    padding: <?= $styles['news_card_padding'] ?? '20px 18px' ?>;
}
.news-list .news-thumb img {
    width: <?= $pageStyles['cover_image']['width'] ?? $styles['news_cover_width'] ?? 180 ?>px;
    height: <?= $pageStyles['cover_image']['height'] ?? $styles['news_cover_height'] ?? 120 ?>px;
    object-fit: cover;
}
.news-list .news-title {
    font-size: <?= $pageStyles['title']['fontSize'] ?? $styles['news_title_fontsize'] ?? 17 ?>px;
}
.news-list .news-summary {
    font-size: <?= $pageStyles['summary']['fontSize'] ?? $styles['news_summary_fontsize'] ?? 15 ?>px;
    display: -webkit-box;
    -webkit-line-clamp: <?= $pageStyles['summary']['lines'] ?? $styles['news_summary_lines'] ?? 2 ?>;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: <?= $styles['news_summary_minheight'] ?? $pageStyles['summaryMinHeight'] ?? 48 ?>px;
}
.news-list .read-more {
    font-size: <?= $pageStyles['readMore']['fontSize'] ?? $styles['news_readmore_fontsize'] ?? 13 ?>px;
}
