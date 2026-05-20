<?php
/**
 * Server-side pre-render of news content
 * Eliminates flicker by rendering initial content in HTML
 */
require_once __DIR__ . '/../config/db.php';
$newsDB = getDB();

// Fetch categories
$catRes = $newsDB->query("SELECT id, name FROM cms_categories ORDER BY sort_order ASC, id ASC");
$allCategories = [];
while ($r = $catRes->fetch_assoc()) { $allCategories[] = $r; }
$catRes->close();

// Fetch articles for first page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$perPage = 10;
$offset = ($page - 1) * $perPage;

$where = "WHERE status='published'";
if ($categoryId > 0) {
    $where .= " AND category_id = " . $categoryId;
}

$totalRes = $newsDB->query("SELECT COUNT(*) as cnt FROM cms_articles $where");
$totalRow = $totalRes->fetch_assoc();
$totalCnt = $totalRow['cnt'];
$totalPages = max(1, ceil($totalCnt / $perPage));
$totalRes->close();

$artRes = $newsDB->query("SELECT id, title, summary, content, cover_image, created_at FROM cms_articles $where ORDER BY created_at DESC LIMIT $offset, $perPage");
$allArticles = [];
while ($r = $artRes->fetch_assoc()) { $allArticles[] = $r; }
$artRes->close();

function isValidImage($image) {
    if (!$image || !is_string($image)) return false;
    if (strlen($image) < 10) return false;
    if (strpos($image, 'data:image') === 0) return strlen($image) > 100;
    return true;
}

function getCoverImage($article) {
    if (!empty($article['cover_image']) && isValidImage($article['cover_image'])) {
        return $article['cover_image'];
    }
    return null;
}

function renderArticleCard($article, $page) {
    $title = htmlspecialchars($article['title'] ?: '无标题');
    $summary = $article['summary'] ?: mb_substr(strip_tags($article['content'] ?? ''), 0, 100) . '...';
    $summary = htmlspecialchars($summary);
    $date = date('Y-m-d', strtotime($article['created_at']));
    $articleId = (int)$article['id'];
    $cover = getCoverImage($article);

    $imageHtml = $cover
        ? '<div style="flex:0 0 170px;width:170px;height:128px;overflow:hidden;border-radius:6px"><img src="' . htmlspecialchars($cover) . '" alt="' . $title . '" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy"></div>'
        : '<div style="flex:0 0 170px;width:170px;height:128px;background:#f3f4f6;border-radius:6px"></div>';

    return '
        <article style="display:flex;gap:24px;align-items:stretch;padding:20px 0;border-bottom:1px solid #f0f0f0;margin-bottom:0">
            ' . $imageHtml . '
            <div style="flex:1;display:flex;flex-direction:column;justify-content:center;padding-right:20px">
                <h3 style="margin:0 0 10px 0;font-size:20px;font-weight:600;line-height:1.5"><a href="news-detail.php?id=' . $articleId . '&page=' . $page . '" style="color:#1e293b;text-decoration:none;letter-spacing:1px">' . $title . '</a></h3>
                <p style="margin:0 0 14px 0;font-size:15px;color:#8e959f;line-height:1.7;letter-spacing:1px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:51px">' . $summary . '</p>
                <div style="display:flex;align-items:center">
                    <a href="news-detail.php?id=' . $articleId . '&page=' . $page . '" style="font-size:14px;color:#1e3a8a;text-decoration:none">查看详情 →</a>
                    <time style="font-size:14px;color:#b0b4ba;margin-left:auto;padding-right:20px">' . $date . '</time>
                </div>
            </div>
        </article>';
}

function renderPagination($page, $totalPages) {
    if ($totalPages <= 1) return '';
    $html = '';
    if ($page > 1) {
        $html .= '<button class="pagination-btn" onclick="goToPage(' . ($page - 1) . ')">上一页</button>';
    } else {
        $html .= '<button class="pagination-btn disabled" onclick="goToPage(1)">上一页</button>';
    }
    $html .= '<span class="pagination-current">' . $page . ' / ' . $totalPages . '</span>';
    if ($page < $totalPages) {
        $html .= '<button class="pagination-btn" onclick="goToPage(' . ($page + 1) . ')">下一页</button>';
    } else {
        $html .= '<button class="pagination-btn disabled" onclick="goToPage(' . $totalPages . ')">下一页</button>';
    }
    return $html;
}
// Encode data for JS
$categoriesJson = json_encode($allCategories, JSON_UNESCAPED_UNICODE);
$articlesJson = json_encode($allArticles, JSON_UNESCAPED_UNICODE);
$preRenderData = json_encode([
    'page' => $page,
    'totalPages' => $totalPages,
    'totalCnt' => $totalCnt,
    'categoryId' => $categoryId
], JSON_UNESCAPED_UNICODE);
$newsDB->close();


