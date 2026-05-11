<?php
/**
 * 发布页面 - 将编辑器内容渲染为HTML
 */

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();

    $data = getAllPostParams();
    $pageId = isset($data['page_id']) ? trim($data['page_id']) : '';

    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    // 获取页面所有模块
    $stmt = $conn->prepare("SELECT module_type, module_data FROM page_builder_modules WHERE page_id=? AND is_active=1 ORDER BY sort_order ASC");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $result = $stmt->get_result();

    $html = '';

    while ($row = $result->fetch_assoc()) {
        $moduleType = $row['module_type'];
        $moduleData = json_decode($row['module_data'], true);

        // 根据模块类型渲染HTML
        $html .= renderModule($moduleType, $moduleData);
    }

    $stmt->close();

    // 保存生成的HTML到文件
    $outputPath = __DIR__ . '/../../../pages/' . $pageId . '.html';
    $fullHtml = generateFullPage($pageId, $html);

    if (file_put_contents($outputPath, $fullHtml)) {
        jsonSuccess(['html_path' => $outputPath], '发布成功');
    } else {
        jsonError('保存HTML文件失败');
    }

    $conn->close();

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}

/**
 * 渲染单个模块
 */
function renderModule($type, $data) {
    switch ($type) {
        case 'banner':
            return renderBanner($data);
        case 'text':
            return renderText($data);
        case 'image':
            return renderImage($data);
        case 'card':
            return renderCard($data);
        case 'video':
            return renderVideo($data);
        case 'custom':
            return renderCustom($data);
        default:
            return '';
    }
}

/**
 * 渲染Banner轮播
 */
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
        $html .= '<img src="' . $image . '" alt="' . $title . '">';
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

/**
 * 渲染文本模块
 */
function renderText($data) {
    $title = htmlspecialchars($data['title'] ?? '');
    $content = $data['content'] ?? '';
    $align = $data['align'] ?? 'left';

    $html = '<div class="text-module" style="text-align: ' . $align . ';">';
    if ($title) {
        $html .= '<h2 class="module-title">' . $title . '</h2>';
    }
    if ($content) {
        $html .= '<div class="module-content">' . $content . '</div>';
    }
    $html .= '</div>';

    return $html;
}

/**
 * 渲染图片模块
 */
function renderImage($data) {
    $src = htmlspecialchars($data['src'] ?? '');
    $alt = htmlspecialchars($data['alt'] ?? '');
    $layout = $data['layout'] ?? 'normal';
    $width = $data['width'] ?? '100%';

    $html = '<div class="image-module layout-' . $layout . '">';
    $html .= '<img src="' . $src . '" alt="' . $alt . '" style="width: ' . $width . ';">';
    $html .= '</div>';

    return $html;
}

/**
 * 渲染卡片模块
 */
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
        if ($image) {
            $html .= '<div class="card-image"><img src="' . $image . '" alt="' . $title . '"></div>';
        }
        $html .= '<div class="card-body">';
        if ($title) {
            $html .= '<h3 class="card-title">' . $title . '</h3>';
        }
        if ($description) {
            $html .= '<p class="card-description">' . $description . '</p>';
        }
        if ($link) {
            $html .= '<a href="' . $link . '" class="card-link">查看详情 →</a>';
        }
        $html .= '</div>';
        $html .= '</div>';
    }

    $html .= '</div>';
    return $html;
}

/**
 * 渲染视频模块
 */
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

/**
 * 渲染自定义HTML模块
 */
function renderCustom($data) {
    return $data['html'] ?? '';
}

/**
 * 生成完整HTML页面
 */
function generateFullPage($pageId, $content) {
    return '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($pageId) . '</title>
    <link rel="stylesheet" href="/assets/css/page-builder.css">
</head>
<body>
    <div class="page-content">
        ' . $content . '
    </div>
    <script src="/assets/js/page-builder.js"></script>
</body>
</html>';
}
