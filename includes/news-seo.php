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

// 文章内容变量
$article_title = '';
$article_content = '';
$article_date = '';
$article_views = 0;
$article_category = '';
$article_cover = '';
$article_tags = [];
$article_prev = null;
$article_next = null;
$related_articles = [];

if ($article_id > 0) {
    try {
        require_once __DIR__ . '/../config/db.php';
        $db = getDB();
        $stmt = $db->prepare("SELECT a.title, a.summary, a.content, a.created_at, a.view_count, a.cover_image, a.seo_title, a.seo_keywords, a.seo_description, c.name as category_name, a.category_id FROM cms_articles a LEFT JOIN cms_categories c ON a.category_id = c.id WHERE a.id = ? AND a.status = 'published' LIMIT 1");
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
            // 文章内容数据
            $article_title = $row['title'] ?? '';
            $article_content = $row['content'] ?? '';
            $article_date = !empty($row['created_at']) ? date('Y-m-d', strtotime($row['created_at'])) : '';
            $article_views = (int)($row['view_count'] ?? 0);
            $article_category = $row['category_name'] ?? '';
            $article_cover = $row['cover_image'] ?? '';
            $cat_id = isset($row['category_id']) ? $row['category_id'] : 0;
        }
        $stmt->close();

        // 获取标签
        $tagStmt = $db->prepare("SELECT t.name, t.slug FROM article_tags at JOIN tags t ON at.tag_id = t.id WHERE at.article_id = ?");
        $tagStmt->bind_param('i', $article_id);
        $tagStmt->execute();
        $tagResult = $tagStmt->get_result();
        while ($tag = $tagResult->fetch_assoc()) {
            $article_tags[] = $tag;
        }
        $tagStmt->close();

        // 上一篇/下一篇
        $prevStmt = $db->prepare("SELECT id, title FROM cms_articles WHERE id < ? AND status = 'published' ORDER BY id DESC LIMIT 1");
        $prevStmt->bind_param('i', $article_id);
        $prevStmt->execute();
        $prevResult = $prevStmt->get_result();
        $article_prev = $prevResult->fetch_assoc();
        $prevStmt->close();

        $nextStmt = $db->prepare("SELECT id, title FROM cms_articles WHERE id > ? AND status = 'published' ORDER BY id ASC LIMIT 1");
        $nextStmt->bind_param('i', $article_id);
        $nextStmt->execute();
        $nextResult = $nextStmt->get_result();
        $article_next = $nextResult->fetch_assoc();
        $nextStmt->close();

        // 相关文章（同分类，排除当前，取4篇）
        $cat_id = isset($row['category_id']) ? $row['category_id'] : 0;
        $relStmt = $db->prepare("SELECT id, title, summary, cover_image, created_at FROM cms_articles WHERE category_id = ? AND id != ? AND status = 'published' ORDER BY id DESC LIMIT 4");
        if ($relStmt) {
            $relStmt->bind_param('ii', $cat_id, $article_id);
            $relStmt->execute();
            $relResult = $relStmt->get_result();
            $related_articles = $relResult->fetch_all(MYSQLI_ASSOC);
            $relStmt->close();
        }
        if (count($related_articles) < 4) {
            $need = 4 - count($related_articles);
            $existing_ids = array_column($related_articles, 'id');
            $existing_ids[] = $article_id;
            $placeholders = implode(',', array_fill(0, count($existing_ids), '?'));
            $fallback = $db->prepare("SELECT id, title, summary, cover_image, created_at FROM cms_articles WHERE id NOT IN ($placeholders) AND status = 'published' ORDER BY id DESC LIMIT $need");
            if ($fallback) {
                $types = str_repeat('i', count($existing_ids));
                $fallback->bind_param($types, ...$existing_ids);
                $fallback->execute();
                $fallbackResult = $fallback->get_result();
                while ($row = $fallbackResult->fetch_assoc()) {
                    $related_articles[] = $row;
                }
                $fallback->close();
                $related_articles = array_slice($related_articles, 0, 4);
            }
        }

        $db->close();
    } catch (Exception $e) {}
}
?>
<link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">
<title><?php echo htmlspecialchars($seo_title); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($seo_description); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($seo_keywords); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($seo_url); ?>">
