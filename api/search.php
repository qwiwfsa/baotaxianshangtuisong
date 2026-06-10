<?php
/**
 * 全站搜索 API
 * 跨表搜索新闻文章、案例、FAQ、分站城市和自定义页面
 *
 * GET /api/search.php?q=关键词
 *
 * 返回 JSON
 */

require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (mb_strlen($query) < 1) {
    jsonSuccess(['results' => [], 'total' => 0, 'query' => '']);
}

$db = getDB();
$escapedQuery = $db->real_escape_string($query);
$results = [];
$maxPerTable = 5; // 每类最多返回5条
$totalLimit = 10;  // 总结果最多10条

// 1. 搜索新闻文章 (cms_articles)
$sql = "SELECT id, title, 'article' AS type, CONCAT('/news-detail.php?id=', id) AS url,
        IFNULL(summary, '') AS summary, created_at AS date
        FROM cms_articles
        WHERE status = 'published'
        AND (title LIKE '%{$escapedQuery}%' OR summary LIKE '%{$escapedQuery}%' OR content LIKE '%{$escapedQuery}%')
        ORDER BY
            CASE WHEN title LIKE '%{$escapedQuery}%' THEN 0
                 WHEN summary LIKE '%{$escapedQuery}%' THEN 1
                 ELSE 2 END,
            updated_at DESC
        LIMIT {$maxPerTable}";
$r = $db->query($sql);
if ($r) {
    while ($row = $r->fetch_assoc()) {
        $row['summary'] = mb_substr(strip_tags($row['summary']), 0, 100);
        $results[] = $row;
    }
}

// 2. 搜索案例 (cases)
$sql = "SELECT id, title, 'case' AS type, CONCAT('/case-detail.php?id=', id) AS url,
        IFNULL(description, '') AS summary, created_at AS date
        FROM cases
        WHERE status = 1
        AND (title LIKE '%{$escapedQuery}%' OR description LIKE '%{$escapedQuery}%' OR content LIKE '%{$escapedQuery}%' OR company LIKE '%{$escapedQuery}%')
        ORDER BY
            CASE WHEN title LIKE '%{$escapedQuery}%' THEN 0 ELSE 1 END,
            updated_at DESC
        LIMIT {$maxPerTable}";
$r = $db->query($sql);
if ($r) {
    while ($row = $r->fetch_assoc()) {
        $row['summary'] = mb_substr(strip_tags($row['summary']), 0, 100);
        $results[] = $row;
    }
}

// 3. 搜索FAQ (faq)
$sql = "SELECT id, question AS title, 'faq' AS type, CONCAT('/faq_new.php#faq-', id) AS url,
        IFNULL(answer, '') AS summary, created_at AS date
        FROM faq
        WHERE is_active = 1
        AND (question LIKE '%{$escapedQuery}%' OR answer LIKE '%{$escapedQuery}%')
        ORDER BY sort_order ASC
        LIMIT {$maxPerTable}";
$r = $db->query($sql);
if ($r) {
    while ($row = $r->fetch_assoc()) {
        $row['summary'] = mb_substr(strip_tags($row['summary']), 0, 100);
        $results[] = $row;
    }
}

// 4. 搜索分站城市 (fenzhan_cities)
$sql = "SELECT id, CONCAT(city_name, ' - ', IFNULL(title, '')) AS title, 'city' AS type,
        CONCAT('/fenzhan/city-', slug, '.html') AS url,
        IFNULL(description, '') AS summary, created_at AS date
        FROM fenzhan_cities
        WHERE is_active = 1
        AND (city_name LIKE '%{$escapedQuery}%' OR slug LIKE '%{$escapedQuery}%' OR title LIKE '%{$escapedQuery}%' OR description LIKE '%{$escapedQuery}%')
        ORDER BY sort_order ASC, city_name ASC
        LIMIT {$maxPerTable}";
$r = $db->query($sql);
if ($r) {
    while ($row = $r->fetch_assoc()) {
        $row['summary'] = mb_substr(strip_tags($row['summary']), 0, 100);
        $results[] = $row;
    }
}

// 5. 搜索自定义页面 (pages)
$sql = "SELECT id, title, 'page' AS type, CONCAT('/page.php?slug=', slug) AS url,
        IFNULL(content, '') AS summary, created_at AS date
        FROM pages
        WHERE status = 1
        AND (title LIKE '%{$escapedQuery}%' OR content LIKE '%{$escapedQuery}%')
        ORDER BY sort_order ASC
        LIMIT {$maxPerTable}";
$r = $db->query($sql);
if ($r) {
    while ($row = $r->fetch_assoc()) {
        $row['summary'] = mb_substr(strip_tags($row['summary']), 0, 100);
        $results[] = $row;
    }
}

// 6. 搜索 CMS 页面
$sql = "SELECT id, title, 'cms_page' AS type,
        IF(custom_url != '', CONCAT('/', custom_url), CONCAT('/page.php?page_id=', page_id)) AS url,
        IFNULL(subtitle, '') AS summary, created_at AS date
        FROM cms_pages
        WHERE status = 'active'
        AND (title LIKE '%{$escapedQuery}%' OR subtitle LIKE '%{$escapedQuery}%' OR content LIKE '%{$escapedQuery}%')
        ORDER BY sort_order ASC
        LIMIT {$maxPerTable}";
$r = $db->query($sql);
if ($r) {
    while ($row = $r->fetch_assoc()) {
        $row['summary'] = mb_substr(strip_tags($row['summary']), 0, 100);
        $results[] = $row;
    }
}

// 按相关度排序：标题匹配优先
usort($results, function($a, $b) use ($query) {
    $aTitle = mb_stripos($a['title'], $query) !== false ? 0 : 1;
    $bTitle = mb_stripos($b['title'], $query) !== false ? 0 : 1;
    return $aTitle - $bTitle;
});

// 限制总数
$results = array_slice($results, 0, $totalLimit);

// 类型标签中文
$typeLabels = [
    'article' => '新闻资讯',
    'case'    => '成功案例',
    'faq'     => '常见问题',
    'city'    => '城市分站',
    'page'    => '页面',
    'cms_page'=> '页面'
];

foreach ($results as &$r) {
    $r['type_label'] = $typeLabels[$r['type']] ?? $r['type'];
}
unset($r);

jsonSuccess([
    'results' => $results,
    'total'   => count($results),
    'query'   => $query
]);
