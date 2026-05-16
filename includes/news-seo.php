<?php
/**
 * 文章详情页SEO - 自动读取后台设置的SEO数据
 * Title格式: 后台SEO标题 | 文章标题 - Yao资金网
 */

$article_id = intval($_GET['id'] ?? 0);
$site_name = 'Yao资金网';

// 默认值
$seo_title = '文章详情 - ' . $site_name;
$seo_keywords = '行业资讯,金融知识,融资服务';
$seo_description = $site_name . '行业资讯中心 - 了解最新行业动态和专业资讯';
$seo_url = 'https://www.yaozijin.com/news-detail.php?id=' . $article_id;

if ($article_id > 0) {
    try {
        require_once __DIR__ . '/../config/db.php';
        $db = getDB();
        $stmt = $db->prepare("SELECT title, summary, seo_title, seo_keywords, seo_description FROM cms_articles WHERE id = ? AND status = 'published' LIMIT 1");
        $stmt->bind_param('i', $article_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            // SEO标题优先，否则用文章标题
            if (!empty($row['seo_title'])) {
                $seo_title = $row['seo_title'];
            } else {
                $seo_title = $row['title'] . ' - ' . $site_name;
            }
            // SEO关键词
            if (!empty($row['seo_keywords'])) {
                $seo_keywords = $row['seo_keywords'];
            }
            // SEO描述优先，否则用文章简介
            if (!empty($row['seo_description'])) {
                $seo_description = $row['seo_description'];
            } elseif (!empty($row['summary'])) {
                $seo_description = strip_tags($row['summary']);
            }
        }
        $stmt->close();
        $db->close();
    } catch (Exception $e) {}
}
?>
<link rel="icon" href="/favicon.ico?v=20260502" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico?v=20260502" type="image/x-icon">
<title><?php echo htmlspecialchars($seo_title); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($seo_description); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($seo_keywords); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($seo_url); ?>">
