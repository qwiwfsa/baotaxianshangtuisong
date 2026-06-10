<?php
require_once __DIR__ . '/includes/logo.php';
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
require_once __DIR__ . '/includes/page-seo.php';

$slug = trim($_GET['slug'] ?? '');
if (!preg_match('/^[a-z0-9-]+$/', $slug)) {
    header('HTTP/1.0 404 Not Found');
    exit('404');
}

try {
    require_once __DIR__ . '/config/db.php';
    $db = getDB();

    $stmt = $db->prepare("SELECT id, name, seo_title, seo_keywords, seo_description FROM cms_categories WHERE slug = ? LIMIT 1");
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $catResult = $stmt->get_result();
    $category = $catResult->fetch_assoc();
    $stmt->close();

    if (!$category) {
        header('HTTP/1.0 404 Not Found');
        exit('404');
    }

    $catId = (int)$category['id'];
    $catName = htmlspecialchars($category['name']);
    $page_title = !empty($category['seo_title']) ? $category['seo_title'] : $catName . ' - Yao资金网';
    $page_keywords = !empty($category['seo_keywords']) ? $category['seo_keywords'] : $catName . ',行业资讯,融资服务';
    $page_description = !empty($category['seo_description']) ? $category['seo_description'] : $catName . '相关资讯与业务介绍';

    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = 10;
    $offset = ($page - 1) * $perPage;

    $countStmt = $db->prepare("SELECT COUNT(*) as cnt FROM cms_articles WHERE category_id = ? AND status = 'published'");
    $countStmt->bind_param('i', $catId);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalCnt = $countResult->fetch_assoc()['cnt'];
    $countStmt->close();
    $totalPages = max(1, ceil($totalCnt / $perPage));

    $artStmt = $db->prepare("SELECT id, title, summary, content, cover_image, created_at FROM cms_articles WHERE category_id = ? AND status = 'published' ORDER BY created_at DESC LIMIT ?, ?");
    $artStmt->bind_param('iii', $catId, $offset, $perPage);
    $artStmt->execute();
    $artResult = $artStmt->get_result();
    $articles = $artResult->fetch_all(MYSQLI_ASSOC);
    $artStmt->close();
    $db->close();
} catch (Exception $e) {
    header('HTTP/1.0 500 Internal Server Error');
    exit('500');
}

function renderCard($a) {
    $title = htmlspecialchars($a['title'] ?: '');
    $summary = $a['summary'] ?: mb_substr(strip_tags($a['content'] ?? ''), 0, 100) . '...';
    $summary = htmlspecialchars($summary);
    $date = date('Y-m-d', strtotime($a['created_at']));
    $id = (int)$a['id'];
    $cover = (!empty($a['cover_image']) && strlen($a['cover_image']) > 10) ? $a['cover_image'] : null;
    $imgHtml = $cover
        ? '<div style="flex:0 0 170px;width:170px;height:128px;overflow:hidden;border-radius:6px"><img src="' . htmlspecialchars($cover) . '" alt="' . $title . '" style="width:100%;height:100%;object-fit:cover;display:block" loading="lazy"></div>'
        : '<div style="flex:0 0 170px;width:170px;height:128px;background:#f3f4f6;border-radius:6px"></div>';
    return '
        <article style="display:flex;gap:24px;align-items:stretch;padding:20px 0;border-bottom:1px solid #f0f0f0">
            ' . $imgHtml . '
            <div style="flex:1;display:flex;flex-direction:column;justify-content:center;padding-right:20px">
                <h3 style="margin:0 0 10px;font-size:20px;font-weight:600;line-height:1.5"><a href="news-detail.php?id=' . $id . '" style="color:#1e293b;text-decoration:none;letter-spacing:1px">' . $title . '</a></h3>
                <p style="margin:0 0 14px;font-size:15px;color:#8e959f;line-height:1.7;letter-spacing:1px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:51px">' . $summary . '</p>
                <div style="display:flex;align-items:center">
                    <a href="news-detail.php?id=' . $id . '" style="font-size:14px;color:#1e3a8a;text-decoration:none">查看详情 &rarr;</a>
                    <time style="font-size:14px;color:#b0b4ba;margin-left:auto;padding-right:20px">' . $date . '</time>
                </div>
            </div>
        </article>';
}

function renderPagination($page, $totalPages, $slug) {
    if ($totalPages <= 1) return '';
    $prevDisabled = ($page <= 1) ? ' disabled' : '';
    $nextDisabled = ($page >= $totalPages) ? ' disabled' : '';
    $prevPage = max(1, $page - 1);
    $nextPage = min($totalPages, $page + 1);
    $html  = '<a href="/category/' . $slug . '/?page=' . $prevPage . '" class="pagination-btn' . $prevDisabled . '">上一页</a>';
    $html .= '<span class="pagination-current">' . $page . ' / ' . $totalPages . '</span>';
    $html .= '<a href="/category/' . $slug . '/?page=' . $nextPage . '" class="pagination-btn' . $nextDisabled . '">下一页</a>';
    return $html;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.yaozijin.com/category/<?php echo $slug; ?>/<?php echo $page > 1 ? '?page=' . $page : ''; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="icon" href="<?php echo htmlspecialchars($favicon_path); ?>" type="image/x-icon">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.min.css?v=20260519">
    <link rel="stylesheet" href="css/page-custom.css?v=20260519">
    <script>(function(){var xhr=new XMLHttpRequest();xhr.open('GET','admin/api/fetch-logo.php?t='+Date.now(),true);xhr.onload=function(){if(xhr.status>=200&&xhr.status<400){try{var resp=JSON.parse(xhr.responseText);if(resp.code===0&&resp.data){function fixPath(p){return p;}if(resp.data.header_logo){var hl=document.querySelector('.logo img');if(hl)hl.src=fixPath(resp.data.header_logo);}if(resp.data.footer_logo){var fl=document.querySelector('.footer-logo img');if(fl)fl.src=fixPath(resp.data.footer_logo);}if(resp.data.favicon){var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}lk.href=fixPath(resp.data.favicon);}}}catch(e){}}};xhr.send();})();</script>
    <meta name="baidu-site-verification" content="codeva-XY6IaVM2X4" />
    <meta name="360-site-verification" content="f310464a017d0090a59ed60edaa367e6" />
    <meta name="sogou_site_verification" content="hZk3RVI5el" />
    <meta name="shenma-site-verification" content="2c7c0059f1eb0bc344ff6f62104c6ee9_1779306988"/>
    <meta name="bytedance-verification-code" content="ax5xO1GtSFCBiE8fTWSz" />
    <meta name="msvalidate.01" content="A2A0A42C6A6A5562D58FA90EF4B0CCE6" />
<script>(function(){var el = document.createElement("script");el.src = "https://lf1-cdn-tos.bytegoofy.com/goofy/ttzz/push.js?3b035154874e19e664d8240b09e14e83e00fbc766c8f9a62fe69bf1753ce8548bc434964556b7d7129e9b750ed197d397efd7b0c6c715c1701396e1af40cec962b8d7c8c6655c9b00211740aa8a98e2e";el.id = "ttzz";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(el, s);})(window)</script>
<script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?93b7f42bd69c99e574dac7e18f9ab573";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>
    <?php require_once __DIR__ . '/includes/logo.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>

    <main id="main-content">
        <section class="page-header">
            <div class="page-header-container">
                <div class="page-header-badge"><i class="fas fa-folder"></i><span>CATEGORY</span></div>
                <h1 class="page-header-title"><?php echo $catName; ?></h1>
                <p class="page-header-subtitle"><?php echo htmlspecialchars($page_description); ?></p>
            </div>
        </section>
        <section class="page-content">
            <div class="section-container">
                <?php if (!empty($articles)): ?>
                <div class="news-list-container">
                    <?php foreach ($articles as $a): echo renderCard($a); endforeach; ?>
                </div>
                <div class="news-pagination"><?php echo renderPagination($page, $totalPages, $slug); ?></div>
                <?php else: ?>
                <div class="news-empty" style="text-align:center;padding:60px 20px;color:#9ca3af;"><p>暂无文章</p></div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false"><i class="fas fa-phone-alt" aria-hidden="true"></i></button>
    </div>
    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/main.min.js?v=20260519"></script>
</body>
</html>