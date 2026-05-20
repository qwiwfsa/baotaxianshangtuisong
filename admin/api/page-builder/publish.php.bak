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
        case 'button': return renderButton($data);
        case 'card':   return renderCard($data);
        case 'carousel': return renderCarousel($data);
        case 'imageText': return renderImageText($data);
        case 'container': return renderContainer($data);
        case 'columns': return renderColumns($data);
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
function renderButton($data) {
    $text = htmlspecialchars($data['text'] ?? '点击按钮');
    $link = htmlspecialchars($data['link'] ?? '#');
    $type = $data['type'] ?? 'primary';
    $size = $data['size'] ?? 'medium';
    $align = $data['align'] ?? 'center';
    $target = !empty($data['newWindow']) ? 'target="_blank"' : '';
    $html = '<div class="button-module" style="text-align: ' . $align . ';">';
    $html .= '<a href="' . $link . '" class="btn btn-' . $type . ' btn-' . $size . '" ' . $target . '>' . $text . '</a>';
    $html .= '</div>';
    return $html;
}
function renderCarousel($data) {
    $items = isset($data['items']) ? $data['items'] : [];
    $height = isset($data['height']) ? intval($data['height']) : 400;
    $autoplay = isset($data['autoplay']) ? $data['autoplay'] : true;
    $interval = isset($data['interval']) ? intval($data['interval']) : 5;
    $showDots = isset($data['showDots']) ? $data['showDots'] : true;
    $showArrows = isset($data['showArrows']) ? $data['showArrows'] : true;
    $html = '<div class="carousel-module" style="position:relative;height:' . $height . 'px;overflow:hidden;" data-autoplay="' . ($autoplay ? 'true' : 'false') . '" data-interval="' . $interval . '">';
    foreach ($items as $i => $item) {
        $image = htmlspecialchars($item['image'] ?? '');
        $title = htmlspecialchars($item['title'] ?? '');
        $html .= '<div class="carousel-slide" data-index="' . $i . '" style="position:absolute;inset:0;transition:opacity 0.5s;' . ($i > 0 ? 'opacity:0;pointer-events:none;' : '') . '">';
        if (empty($image) || strpos($image, '{{') !== false) {
            $html .= '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f3f4f6;color:#9ca3af;flex-direction:column;"><i class="fas fa-image" style="font-size:48px;margin-bottom:12px;"></i><span>' . ($title ?: '轮播图') . '</span></div>';
        } else {
            $html .= '<img src="' . $image . '" alt="' . $title . '" style="width:100%;height:100%;object-fit:cover;">';
        }
        $html .= '</div>';
    }
    if ($showDots && count($items) > 1) {
        $html .= '<div style="position:absolute;bottom:16px;left:50%;transform:translateX(-50%);display:flex;gap:8px;">';
        foreach ($items as $i => $item) {
            $html .= '<span data-index="' . $i . '" style="width:10px;height:10px;border-radius:50%;background:' . ($i === 0 ? '#fff' : 'rgba(255,255,255,0.5)') . ';cursor:pointer;"></span>';
        }
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;
}
function renderImageText($data) {
    $image = htmlspecialchars($data['image'] ?? '');
    $title = htmlspecialchars($data['title'] ?? '');
    $content = $data['content'] ?? '';
    $layout = $data['layout'] ?? 'image-left';
    $imageWidth = $data['imageWidth'] ?? '40%';
    $flexDirection = $layout === 'image-right' ? 'row-reverse' : ($layout === 'image-top' ? 'column' : 'row');
    $html = '<div class="image-text-module" style="display:flex;flex-direction:' . $flexDirection . ';gap:24px;align-items:center;">';
    $html .= '<div style="flex:0 0 ' . $imageWidth . ';max-width:100%;">';
    if (empty($image) || strpos($image, '{{') !== false) {
        $html .= '<div style="padding:60px 20px;background:#f3f4f6;display:flex;align-items:center;justify-content:center;border:2px dashed #d1d5db;border-radius:8px;color:#9ca3af;flex-direction:column;"><i class="fas fa-image" style="font-size:36px;margin-bottom:8px;"></i><span>' . ($title ?: '图片') . '</span></div>';
    } else {
        $html .= '<img src="' . $image . '" alt="' . $title . '" style="width:100%;border-radius:8px;">';
    }
    $html .= '</div>';
    $html .= '<div style="flex:1;">';
    if ($title) $html .= '<h3>' . $title . '</h3>';
    if ($content) $html .= '<div>' . $content . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
function renderContainer($data) {
    $width = $data['width'] ?? '100%';
    $padding = $data['padding'] ?? '24px';
    $bgColor = $data['bgColor'] ?? '#ffffff';
    $borderRadius = $data['borderRadius'] ?? '0';
    $bgStyle = '';
    if (!empty($data['bgImage']) && strpos($data['bgImage'], '{{') === false) {
        $bgStyle = 'background-image:url("' . htmlspecialchars($data['bgImage']) . '");background-size:cover;background-position:center;';
    } else {
        $bgStyle = 'background-color:' . $bgColor . ';';
    }
    $children = $data['childrenContent'] ?? '';
    return '<div class="container-module" style="width:' . $width . ';padding:' . $padding . ';' . $bgStyle . 'border-radius:' . $borderRadius . ';">' . $children . '</div>';
}

function renderColumns($data) {
    $columns = isset($data['columns']) ? intval($data['columns']) : 2;
    $gap = $data['gap'] ?? '24px';
    $equalHeight = isset($data['equalHeight']) && $data['equalHeight'] ? 'align-items:stretch;' : '';
    $html = '<div class="columns-module" style="display:grid;grid-template-columns:repeat(' . $columns . ',1fr);gap:' . $gap . ';' . $equalHeight . '">';
    for ($i = 0; $i < $columns; $i++) {
        $colContent = $data['column' . $i . 'Content'] ?? '';
        $html .= '<div class="column-item" style="min-height:50px;">' . $colContent . '</div>';
    }
    $html .= '</div>';
    return $html;
}
function generateFullPage($pageId, $content) {
    return '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($pageId) . '</title>
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
    <link rel="stylesheet" href="/css/page-custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/page-builder.css">
    <style>
        .page-content { max-width: 1200px; margin: 0 auto; padding: 20px; padding-top: 84px; }
        .img-placeholder { display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#9ca3af; flex-direction:column; gap:8px; font-size:14px; }
        .img-placeholder i { font-size:32px; }
        .img-placeholder-banner { width:100%; height:100%; min-height:300px; }
        .img-placeholder-image { width:100%; min-height:200px; }
        .card-image.card-image-placeholder { display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#9ca3af; flex-direction:column; gap:8px; font-size:14px; min-height:180px; }
        .card-image.card-image-placeholder i { font-size:36px; }
        .banner-img, .image-module-img, .card-img { max-width:100%; }
    </style>
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open("GET","admin/api/fetch-logo.php?t="+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p&&p.charAt(0)==="/"?p.substring(1):p;}
                        if(resp.data.header_logo){
                            var hl=document.querySelector(".logo img");
                            if(hl)hl.src=fixPath(resp.data.header_logo);
                        }
                        if(resp.data.footer_logo){
                            var fl=document.querySelector(".footer-logo img");
                            if(fl)fl.src=fixPath(resp.data.footer_logo);
                        }
                    }
                }catch(e){}
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
            <a href="/" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar" id="dynamicNavMenu"></ul>
            <button class="search-toggle" id="searchToggle" aria-label="搜索网站" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
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
                <div class="footer-brand"><div class="footer-logo"><img src="/uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></div><p class="footer-desc"></p></div>
                <div class="footer-nav" data-footer-group="quick_links"><h4 class="footer-nav-title">快速导航</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="service_links"><h4 class="footer-nav-title">服务项目</h4><ul class="footer-nav-list"></ul></div>
                <div class="footer-nav" data-footer-group="contact"><h4 class="footer-nav-title">联系方式</h4><ul class="footer-nav-list"></ul></div>
            </div>
            <div class="footer-bottom"><p class="footer-copyright"></p><p class="footer-disclaimer"></p></div>
        </div>
    </footer>
    <script>document.addEventListener("error",function(e){if(e.target.tagName==="IMG"){e.target.style.display="none";var p=e.target.parentElement;if(p&&!p.querySelector(".img-placeholder")){var d=document.createElement("div");d.className="img-placeholder";d.innerHTML="<i class=\'fas fa-image\'></i><span>Image Error</span>";p.appendChild(d)}}},true);</script>
    <script src="/js/footer-loader.js"></script>
    <script src="/assets/js/page-builder.js"></script>
    <script src="/js/nav-loader.js?v=2"></script>
    <script src="/js/main.js"></script>
</body>
</html>';
}
