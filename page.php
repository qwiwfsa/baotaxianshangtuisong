<?php
/**
 * 动态页面渲染器
 * 用法: page.php?page_id=xxx 或 page.php?slug=xxx
 * 预览: page.php?page_id=xxx&preview=1
 */
require_once 'config/db.php';
$db = getDB();

// 获取页面参数
$pageId = isset($_GET['page_id']) ? trim($_GET['page_id']) : '';
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$isPreview = isset($_GET['preview']);

// 通过 slug 查找 page_id
if (!$pageId && $slug) {
    $stmt = $db->prepare("SELECT page_id FROM cms_pages WHERE custom_url = ?");
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $r = $stmt->get_result();
    if ($r->num_rows > 0) {
        $pageId = $r->fetch_assoc()['page_id'];
    }
    $stmt->close();
}

if (!$pageId) {
    header('HTTP/1.0 404 Not Found');
    echo '<!DOCTYPE html><html lang="zh-CN"><head><meta charset="UTF-8"><title>页面不存在</title></head><body style="text-align:center;padding:60px"><h1>404</h1><p>页面不存在或已被删除</p><a href="/">返回首页</a><?php include __DIR__ . "/includes/footer.php"; ?>
</body></html>';
    exit;
}

// 获取页面信息
$pageInfo = null;
$stmt = $db->prepare("SELECT * FROM cms_pages WHERE page_id = ? AND status = 'active'");
$stmt->bind_param('s', $pageId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $pageInfo = $result->fetch_assoc();
}
$stmt->close();

if (!$pageInfo && !$isPreview) {
    header('HTTP/1.0 404 Not Found');
    echo '<!DOCTYPE html><html lang="zh-CN"><head><meta charset="UTF-8"><title>页面不存在</title></head><body style="text-align:center;padding:60px"><h1>404</h1><p>页面已被禁用或不存在</p><a href="/">返回首页</a><?php include __DIR__ . "/includes/footer.php"; ?>
</body></html>';
    exit;
}

// 获取模块
$modules = [];
$stmt = $db->prepare("SELECT * FROM page_builder_modules WHERE page_id = ? AND is_active = 1 ORDER BY sort_order ASC");
$stmt->bind_param('s', $pageId);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $row['module_data'] = json_decode($row['module_data'], true) ?: [];
    $modules[] = $row;
}
$stmt->close();
$db->close();

// SEO 元数据
$pageTitle = $pageInfo ? ($pageInfo['seo_title'] ?: $pageInfo['title'] ?: $pageInfo['page_name']) : '预览页面';
$seoKeywords = $pageInfo['seo_keywords'] ?? '';
$seoDescription = $pageInfo['seo_description'] ?? '';
header("Cache-Control: no-cache, no-store, must-revalidate");header("Pragma: no-cache");header("Expires: 0");?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($seoDescription ?: '专业资金业务服务'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($seoKeywords ?: '企业摆账,过桥短拆,银行冲量'); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seoDescription); ?>">
    <meta property="og:type" content="website">
    <title><?php echo htmlspecialchars($pageTitle); ?> | Yao资金网</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/page-custom.css?v=20260519">
    <link rel="stylesheet" href="css/style.css?v=20260519">
    <link rel="icon" href="uploads/logo/logo_20260516_071314_6a07a88a2cd5c.png">
    <!-- SEO动态加载 -->
    <script>
    (function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'admin/api/fetch-seo.php?page=page.php&t=' + Date.now(), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    if (data && data.code === 0 && data.data) {
                        var seo = data.data;
                        // PHP handles title
                        if (seo.meta_keywords) { var kw = document.querySelector('meta[name="keywords"]'); if (kw) kw.content = seo.meta_keywords; }
                        if (seo.meta_description) { var desc = document.querySelector('meta[name="description"]'); if (desc) desc.content = seo.meta_description; }
                    }
                } catch(e) {}
            }
        };
        xhr.send();
    })();
    </script>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
            <a href="index.html" class="logo" aria-label="Yao资金网首页">
                <img src="uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;">
            </a>
            <ul class="nav-menu" role="menubar"><?php include __DIR__ . "/includes/nav.php"; ?></ul>
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索"><i class="fas fa-search"></i></button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单"><span></span><span></span><span></span></button>
        </div>
    </nav>
    <script>

    <main id="main-content">
        <section class="page-builder-content" style="padding:60px 0;min-height:60vh">
            <div class="section-container <?php echo !$isPreview ? '' : 'preview-mode'; ?>">
                <?php if ($pageInfo && !$isPreview): ?>
                <div class="section-header" style="margin-bottom:40px">
                    <h1 class="section-title"><?php echo htmlspecialchars($pageInfo['title'] ?: $pageInfo['page_name']); ?></h1>
                    <?php if ($pageInfo['subtitle']): ?>
                    <p class="section-subtitle"><?php echo htmlspecialchars($pageInfo['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php
                foreach ($modules as $module) {
                    $data = $module['module_data'];
                    $styles = $data['styles'] ?? [];
                    $inlineStyle = buildInlineStyle($styles, $data);
                    $cssClass = $styles['css_class'] ?? '';

                    echo '<div class="pb-module pb-module-' . $module['module_type'] . ' ' . htmlspecialchars($cssClass) . '" style="' . $inlineStyle . '" data-module-type="' . $module['module_type'] . '" data-module-id="' . $module['id'] . '">';

                    switch ($module['module_type']) {
                        case 'heading':
                            renderHeading($data);
                            break;
                        case 'richtext':
                            renderRichtext($data);
                            break;
                        case 'image':
                            renderImage($data);
                            break;
                        case 'image-cards':
                            renderImageCards($data);
                            break;
                        case 'button':
                            renderButton($data);
                            break;
                        case 'list':
                            renderList($data);
                            break;
                        case 'tags':
                            renderTags($data);
                            break;
                        case 'city-stations':
                            renderCityStations($data);
                            break;
                        case 'custom-html':
                            renderCustomHtml($data);
                            break;
                        default:
                            echo '<!-- Unknown module type: ' . $module['module_type'] . ' -->';
                    }

                    echo '</div>';
                }

                if (empty($modules)) {
                    echo '<div style="text-align:center;padding:40px;color:#64748b"><i class="fas fa-pencil-alt" style="font-size:32px;opacity:0.3;margin-bottom:12px;display:block"></i><p>此页面尚无内容模块</p></div>';
                }
                ?>
            </div>
        </section>
    </main>

    
<?php include __DIR__ . "/includes/footer.php"; ?>
</body>
</html>
<?php

// ===== 渲染函数 =====

function buildInlineStyle($styles, $data) {
    $s = '';
    $m = $styles['margin'] ?? [];
    if (!empty($m['top'])) $s .= 'margin-top:' . intval($m['top']) . 'px;';
    if (!empty($m['right'])) $s .= 'margin-right:' . intval($m['right']) . 'px;';
    if (!empty($m['bottom'])) $s .= 'margin-bottom:' . intval($m['bottom']) . 'px;';
    if (!empty($m['left'])) $s .= 'margin-left:' . intval($m['left']) . 'px;';
    $p = $styles['padding'] ?? [];
    if (!empty($p['top'])) $s .= 'padding-top:' . intval($p['top']) . 'px;';
    if (!empty($p['right'])) $s .= 'padding-right:' . intval($p['right']) . 'px;';
    if (!empty($p['bottom'])) $s .= 'padding-bottom:' . intval($p['bottom']) . 'px;';
    if (!empty($p['left'])) $s .= 'padding-left:' . intval($p['left']) . 'px;';
    if (!empty($styles['bg_color'])) $s .= 'background-color:' . $styles['bg_color'] . ';';
    if (!empty($styles['text_color'])) $s .= 'color:' . $styles['text_color'] . ';';
    if (!empty($styles['text_align'])) $s .= 'text-align:' . $styles['text_align'] . ';';
    return $s;
}

function renderHeading($data) {
    $level = intval($data['level'] ?? 2);
    $level = max(1, min(4, $level));
    $title = htmlspecialchars($data['title'] ?? '');
    $subtitle = htmlspecialchars($data['subtitle'] ?? '');
    $tag = "h$level";
    echo "<$tag class=\"section-title\">$title</$tag>";
    if ($subtitle) echo '<p class="section-subtitle">' . $subtitle . '</p>';
}

function renderRichtext($data) {
    $content = $data['content'] ?? '';
    echo '<div class="richtext-content" style="max-width:800px;margin:0 auto;line-height:1.8;word-wrap:break-word">' . $content . '</div>';
}

function renderImage($data) {
    $url = htmlspecialchars($data['url'] ?? '');
    $alt = htmlspecialchars($data['alt'] ?? '');
    $width = intval($data['width'] ?? 0);
    $link = htmlspecialchars($data['link'] ?? '');
    $caption = htmlspecialchars($data['caption'] ?? '');
    if (!$url) return;
    $img = '<img src="' . $url . '" alt="' . $alt . '" style="max-width:100%;border-radius:8px;' . ($width ? 'width:' . $width . 'px;' : '') . '">';
    if ($link) $img = '<a href="' . $link . '">' . $img . '</a>';
    echo '<div style="text-align:center">' . $img . '</div>';
    if ($caption) echo '<p style="text-align:center;color:var(--text-muted);font-size:13px;margin-top:8px">' . $caption . '</p>';
}

function renderImageCards($data) {
    $cols = intval($data['columns'] ?? 3);
    $cols = max(2, min(4, $cols));
    $cards = $data['cards'] ?? [];
    if (empty($cards)) return;
    $gap = intval($data['gap'] ?? 16);
    echo '<div class="services-grid" style="grid-template-columns:repeat(' . $cols . ', 1fr);gap:' . $gap . 'px">';
    foreach ($cards as $card) {
        $img = htmlspecialchars($card['image'] ?? '');
        $title = htmlspecialchars($card['title'] ?? '');
        $desc = htmlspecialchars($card['description'] ?? '');
        $link = htmlspecialchars($card['link'] ?? '');
        echo '<article class="service-card">';
        if ($img) echo '<img src="' . $img . '" alt="' . $title . '" style="width:100%;height:200px;object-fit:cover;border-radius:6px;margin-bottom:12px">';
        if ($title) echo '<h3 class="service-title">' . $title . '</h3>';
        if ($desc) echo '<p style="color:var(--text-secondary);font-size:14px;line-height:1.6">' . $desc . '</p>';
        if ($link) echo '<a href="' . $link . '" class="btn btn-outline" style="margin-top:12px">了解更多</a>';
        echo '</article>';
    }
    echo '</div>';
}

function renderButton($data) {
    $text = htmlspecialchars($data['text'] ?? '按钮');
    $link = htmlspecialchars($data['link'] ?? '#');
    $style = $data['style'] ?? 'primary';
    $size = $data['size'] ?? 'md';
    $align = $data['align'] ?? 'center';
    $customBg = $data['custom_bg'] ?? '';
    $customColor = $data['custom_color'] ?? '';

    $btnClass = 'btn';
    if ($style === 'primary') $btnClass .= ' btn-primary';
    elseif ($style === 'secondary') $btnClass .= ' btn-outline';
    else $btnClass .= ' btn-outline';

    $sizeStyles = '';
    if ($size === 'sm') $sizeStyles = 'padding:6px 16px;font-size:13px';
    elseif ($size === 'lg') $sizeStyles = 'padding:14px 28px;font-size:16px';
    else $sizeStyles = 'padding:10px 22px;font-size:14px';

    $extraStyles = $sizeStyles;
    if ($customBg) $extraStyles .= ';background:' . $customBg;
    if ($customColor) $extraStyles .= ';color:' . $customColor;

    echo '<div style="text-align:' . $align . '"><a href="' . $link . '" class="btn ' . $btnClass . '" style="display:inline-block;' . $extraStyles . '">' . $text . '</a></div>';
}

function renderList($data) {
    $listType = $data['type'] ?? 'news';
    $layout = $data['layout'] ?? 'grid';
    $cols = intval($data['columns'] ?? 3);
    $count = intval($data['count'] ?? 6);

    // 模拟数据（实际应该从数据库读取）
    $items = [];
    $icons = ['news' => 'fas fa-newspaper', 'service' => 'fas fa-briefcase', 'case' => 'fas fa-trophy'];
    $icon = $icons[$listType] ?? 'fas fa-file-alt';
    $titles = ['news' => '行业动态', 'service' => '业务服务', 'case' => '成功案例'];

    for ($i = 1; $i <= $count; $i++) {
        $items[] = [
            'title' => ($titles[$listType] ?? '列表项') . ' ' . $i,
            'desc' => '这是' . ($titles[$listType] ?? '列表') . '的描述内容，展示相关信息摘要。',
            'date' => '2026-05-' . str_pad($i, 2, '0', STR_PAD_LEFT)
        ];
    }

    if ($layout === 'list') {
        echo '<div style="max-width:800px;margin:0 auto">';
        foreach ($items as $item) {
            echo '<div style="display:flex;align-items:center;padding:12px 16px;border-bottom:1px solid var(--border-light);gap:12px">';
            echo '<i class="' . $icon . '" style="color:var(--color-primary);font-size:16px"></i>';
            echo '<div style="flex:1"><strong style="font-size:14px">' . htmlspecialchars($item['title']) . '</strong>';
            echo '<p style="color:var(--text-muted);font-size:12px;margin-top:2px">' . htmlspecialchars($item['desc']) . '</p></div>';
            echo '<span style="color:var(--text-light);font-size:12px;white-space:nowrap">' . $item['date'] . '</span>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="services-grid" style="grid-template-columns:repeat(' . $cols . ', 1fr)">';
        foreach ($items as $item) {
            echo '<article class="service-card">';
            echo '<div style="font-size:24px;color:var(--color-primary);margin-bottom:12px"><i class="' . $icon . '"></i></div>';
            echo '<h3 class="service-title">' . htmlspecialchars($item['title']) . '</h3>';
            echo '<p style="color:var(--text-secondary);font-size:13px;line-height:1.6">' . htmlspecialchars($item['desc']) . '</p>';
            echo '</article>';
        }
        echo '</div>';
    }
}

function renderTags($data) {
    $tags = $data['tags'] ?? [];
    if (empty($tags)) return;
    $style = $data['style'] ?? 'badge';
    echo '<div style="display:flex;flex-wrap:wrap;gap:8px;justify-content:center">';
    foreach ($tags as $tag) {
        $text = htmlspecialchars($tag['text'] ?? '');
        $link = htmlspecialchars($tag['link'] ?? '');
        if (!$text) continue;
        if ($style === 'pill') {
            $s = 'padding:4px 14px;border-radius:20px;background:var(--color-primary);color:white;font-size:12px;text-decoration:none;display:inline-block';
        } elseif ($style === 'outline') {
            $s = 'padding:4px 14px;border-radius:20px;border:1px solid var(--color-primary);color:var(--color-primary);font-size:12px;text-decoration:none;display:inline-block';
        } else {
            $s = 'padding:4px 12px;border-radius:6px;background:var(--color-gray-100);color:var(--text-secondary);font-size:12px;text-decoration:none;display:inline-block';
        }
        if ($link) echo '<a href="' . $link . '" style="' . $s . '">' . $text . '</a>';
        else echo '<span style="' . $s . '">' . $text . '</span>';
    }
    echo '</div>';
}

function renderCityStations($data) {
    $cities = $data['cities'] ?? [];
    if (empty($cities)) return;
    $cols = intval($data['columns'] ?? 4);
    $layout = $data['layout'] ?? 'grid';
    if ($layout === 'inline') {
        echo '<div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center">';
        foreach ($cities as $city) {
            $name = htmlspecialchars($city['name'] ?? '');
            $link = htmlspecialchars($city['link'] ?? '#');
            echo '<a href="' . $link . '" style="padding:8px 16px;background:var(--bg-secondary);border-radius:6px;color:var(--text-secondary);text-decoration:none;font-size:13px">' . $name . '</a>';
        }
        echo '</div>';
    } else {
        echo '<div class="services-grid" style="grid-template-columns:repeat(' . $cols . ', 1fr)">';
        foreach ($cities as $city) {
            $name = htmlspecialchars($city['name'] ?? '');
            $link = htmlspecialchars($city['link'] ?? '#');
            echo '<div class="service-card" style="padding:20px;text-align:center">';
            echo '<i class="fas fa-map-marker-alt" style="font-size:24px;color:var(--color-accent);margin-bottom:8px;display:block"></i>';
            echo '<h4 style="font-size:15px;margin-bottom:4px">' . $name . '</h4>';
            echo '<a href="' . $link . '" style="font-size:12px;color:var(--color-primary);text-decoration:none">查看详情 →</a>';
            echo '</div>';
        }
        echo '</div>';
    }
}

function renderCustomHtml($data) {
    $html = $data['html'] ?? '';
    echo $html;
}
