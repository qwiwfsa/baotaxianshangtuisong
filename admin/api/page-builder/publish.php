<?php
/**
 * 发布页面 - 将编辑后模块渲染为HTML
 */
require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();
    $data = getAllPostParams();
    $pageId = isset($data['page_id']) ? trim($data['page_id']) : '';
    if (empty($pageId)) { jsonError('页面ID不能为空'); }

    $stmt = $conn->prepare("SELECT module_type, module_data FROM page_builder_modules WHERE page_id=? AND is_active=1 ORDER BY sort_order ASC");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $result = $stmt->get_result();
    $html = '';

    while ($row = $result->fetch_assoc()) {
        $moduleType = $row['module_type'];
        $moduleData = json_decode($row['module_data'], true);
        $html .= renderModule($moduleType, $moduleData);
    }
    $stmt->close();

    $outputPath = __DIR__ . '/../../../pages/' . $pageId . '.html';
    $fullHtml = generateFullPage($pageId, $html);
    if (file_put_contents($outputPath, $fullHtml)) {
        jsonSuccess(['html_path' => $outputPath], '发布成功');
    } else {
        jsonError('写入HTML文件失败');
    }
    $conn->close();
} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}

function renderModule($type, $data) {
    switch ($type) {
        case 'banner': return renderBanner($data);
        case 'text':   return renderText($data);
        case 'image':  return renderImage($data);
        case 'card':   return renderCard($data);
        case 'video':  return renderVideo($data);
        case 'custom': return renderCustom($data);
        default:       return '';
    }
}

function isPlaceholderUrl($url) {
    return empty($url) || strpos($url, '{{') !== false;
}

function renderBanner($data) {
    $height = isset($data['height']) ? intval($data['height']) : 500;
    $autoplay = isset($data['autoplay']) ? $data['autoplay'] : true;
    $items = isset($data['items']) ? $data['items'] : [];
    $html = '<div class="banner-slider" style="height: ' . $height . 'px;" data-autoplay="' . ($autoplay ? 'true' : 'false') . '">';
    foreach ($items as $item) {
        $image = htmlspecialchars($item['image'] ?? '');
        $title = htmlspecialchars($item['title'] ?? '');
        $subtitle = htmlspecialchars($item['subtitle'] ?? '');
        $link = htmlspecialchars($item['link'] ?? '');
        $html .= '<div class="banner-slide">';
        if (isPlaceholderUrl($image)) {
            $html .= '<div class="img-placeholder img-placeholder-banner"><i class="fas fa-image"></i><span>' . ($title ?: 'Banner') . '</span></div>';
        } else {
            $html .= '<img src="' . $image . '" alt="' . $title . '" class="banner-img">';
        }
        if ($title || $subtitle) {
            $html .= '<div class="banner-content">';
            if ($title) $html .= '<h2>' . $title . '</h2>';
            if ($subtitle) $html .= '<p>' . $subtitle . '</p>';
            if ($link) $html .= '<a href="' . $link . '" class="banner-btn">了解更多</a>';
            $html .= '</div>';
        }
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;
}

function renderText($data) {
    $title = htmlspecialchars($data['title'] ?? '');
    $content = $data['content'] ?? '';
    $align = $data['align'] ?? 'left';
    $html = '<div class="text-module" style="text-align: ' . $align . ';">';
    if ($title) $html .= '<h2 class="module-title">' . $title . '</h2>';
    if ($content) $html .= '<div class="module-content">' . $content . '</div>';
    $html .= '</div>';
    return $html;
}

function renderImage($data) {
    $src = htmlspecialchars($data['src'] ?? '');
    $alt = htmlspecialchars($data['alt'] ?? '');
    $layout = $data['layout'] ?? 'normal';
    $width = $data['width'] ?? '100%';
    $html = '<div class="image-module layout-' . $layout . '">';
    if (isPlaceholderUrl($src)) {
        $html .= '<div class="img-placeholder img-placeholder-image"><i class="fas fa-image"></i><span>' . ($alt ?: '图片') . '</span></div>';
    } else {
        $html .= '<img src="' . $src . '" alt="' . $alt . '" style="width: ' . $width . ';" class="image-module-img">';
    }
    $html .= '</div>';
    return $html;
}

function renderCard($data) {
    $columns = isset($data['columns']) ? intval($data['columns']) : 3;
    $items = isset($data['items']) ? $data['items'] : [];
    $style = $data['style'] ?? 'modern';
    $html = '<div class="card-grid card-style-' . $style . '" style="grid-template-columns: repeat(' . $columns . ', 1fr);">';
    foreach ($items as $item) {
        $image = htmlspecialchars($item['image'] ?? '');
        $title = htmlspecialchars($item['title'] ?? '');
        $description = htmlspecialchars($item['description'] ?? '');
        $link = htmlspecialchars($item['link'] ?? '');
        $html .= '<div class="card-item">';
        if (isPlaceholderUrl($image)) {
            $html .= '<div class="card-image card-image-placeholder"><i class="fas fa-image"></i><span>' . ($title ?: '图片') . '</span></div>';
        } else {
            $html .= '<div class="card-image"><img src="' . $image . '" alt="' . $title . '" class="card-img"></div>';
        }
        $html .= '<div class="card-body">';
        if ($title) $html .= '<h3 class="card-title">' . $title . '</h3>';
        if ($description) $html .= '<p class="card-description">' . $description . '</p>';
        if ($link) $html .= '<a href="' . $link . '" class="card-link">查看详情 →</a>';
        $html .= '</div>';
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;
}

function renderVideo($data) {
    $src = htmlspecialchars($data['src'] ?? '');
    $poster = htmlspecialchars($data['poster'] ?? '');
    $autoplay = isset($data['autoplay']) ? $data['autoplay'] : false;
    $html = '<div class="video-module">';
    $html .= '<video controls' . ($autoplay ? ' autoplay' : '') . ($poster ? ' poster="' . $poster . '"' : '') . '>';
    $html .= '<source src="' . $src . '" type="video/mp4">';
    $html .= '您的浏览器不支持视频播放';
    $html .= '</video>';
    $html .= '</div>';
    return $html;
}

function renderCustom($data) {
    return $data['html'] ?? '';
}

function generateFullPage($pageId, $content) {
    return '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($pageId) . '</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/page-builder.css">
    <style>
        .page-content { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .img-placeholder { display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#9ca3af; flex-direction:column; gap:8px; font-size:14px; }
        .img-placeholder i { font-size:32px; }
        .img-placeholder-banner { width:100%; height:100%; min-height:300px; }
        .img-placeholder-image { width:100%; min-height:200px; }
        .card-image.card-image-placeholder { display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#9ca3af; flex-direction:column; gap:8px; font-size:14px; min-height:180px; }
        .card-image.card-image-placeholder i { font-size:36px; }
        .banner-img, .image-module-img, .card-img { max-width:100%; }
    </style>
</head>
<body>
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航栏">
        <div class="navbar-container">
            <a href="/" class="logo" aria-label="Yao资金网"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu">
                <li role="none"><a href="/" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="/services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="/cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                <li role="none"><a href="/advantages.html" class="nav-link" role="menuitem">核心优势</a></li>
                <li role="none"><a href="/faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                <li role="none"><a href="/contact.html" class="nav-link" role="menuitem">联系我们</a></li>
            </ul>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单"><span></span><span></span><span></span></button>
        </div>
    </nav>
    <main id="main-content"><div class="page-content">' . $content . '</div></main>
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="点击电话"><i class="fas fa-phone-alt"></i></button>
        <div class="chat-widget-phone-display"><span class="chat-widget-phone-text">13552883008</span></div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand"><div class="footer-logo"><img src="/uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金网" style="height:48px;width:auto;"></div><p class="footer-desc"></p></div>
                <div class="footer-nav" data-footer-group="quick_links"><h4 class="footer-nav-title">快速导航</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="service_links"><h4 class="footer-nav-title">服务项目</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="contact"><h4 class="footer-nav-title">联系方式</h4><ul class="footer-nav-list"></ul></div>
            </div>
            <div class="footer-bottom"><p class="footer-copyright"></p><p class="footer-disclaimer"></p></div>
        </div>
    </footer>
    <script>document.addEventListener("error",function(e){if(e.target.tagName==="IMG"){e.target.style.display="none";var p=e.target.parentElement;if(p&&!p.querySelector(".img-placeholder")){var d=document.createElement("div");d.className="img-placeholder";d.innerHTML="<i class=\"fas fa-image\"></i><span>Image Error</span>";p.appendChild(d)}}},true);</script>
    <script src="/js/footer-loader.js"></script>
    <script src="/assets/js/page-builder.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>';
}
