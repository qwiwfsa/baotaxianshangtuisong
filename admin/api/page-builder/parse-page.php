<?php
/**
 * 智能解析HTML页面为可编辑模块
 */

require_once __DIR__ . '/../common.php';

try {
    $pageId = getGetParam('page_id', '');

    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    // 查找页面HTML文件
    $possiblePaths = [
        __DIR__ . '/../../../' . $pageId . '.html',
        __DIR__ . '/../../../pages/' . $pageId . '.html',
        __DIR__ . '/../../../' . $pageId . '.php',
    ];

    $htmlContent = '';
    $foundPath = '';

    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            $htmlContent = file_get_contents($path);
            $foundPath = $path;
            break;
        }
    }

    if (empty($htmlContent)) {
        jsonSuccess(['modules' => [], 'message' => '页面不存在']);
    }

    // 提取body内容
    preg_match('/<body[^>]*>(.*?)<\/body>/is', $htmlContent, $matches);
    $bodyContent = isset($matches[1]) ? $matches[1] : $htmlContent;

    // 移除header、footer、nav
    $bodyContent = preg_replace('/<header[^>]*>.*?<\/header>/is', '', $bodyContent);
    $bodyContent = preg_replace('/<footer[^>]*>.*?<\/footer>/is', '', $bodyContent);
    $bodyContent = preg_replace('/<nav[^>]*>.*?<\/nav>/is', '', $bodyContent);
    $bodyContent = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $bodyContent);

    // 解析为模块
    $modules = parseHTMLToModules($bodyContent);

    jsonSuccess([
        'modules' => $modules,
        'path' => $foundPath,
        'preview_html' => $bodyContent
    ]);

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}

/**
 * 解析HTML为模块数组
 */
function parseHTMLToModules($html) {
    $modules = [];
    $sortOrder = 0;

    // 使用DOMDocument解析HTML
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $xpath = new DOMXPath($dom);

    // 查找main标签内的所有section
    $sections = $xpath->query('//main//section');

    // 如果没有找到main中的section，查找所有section
    if ($sections->length === 0) {
        $sections = $xpath->query('//section');
    }

    // 如果还是没有，查找所有顶级div
    if ($sections->length === 0) {
        $sections = $xpath->query('//body/div[@class]');
    }

    if ($sections->length > 0) {
        foreach ($sections as $section) {
            // 跳过导航栏、页脚等
            $className = $section->getAttribute('class');
            if (strpos($className, 'nav') !== false ||
                strpos($className, 'footer') !== false ||
                strpos($className, 'header') !== false ||
                strpos($className, 'chat-widget') !== false) {
                continue;
            }

            $module = parseSectionToModule($section, $sortOrder++, $xpath);
            if ($module) {
                $modules[] = $module;
            }
        }
    } else {
        // 如果没有明确的section，将整个内容作为一个自定义模块
        $modules[] = [
            'module_type' => 'custom',
            'module_data' => [
                'html' => trim($html)
            ],
            'sort_order' => 0
        ];
    }

    return $modules;
}

/**
 * 解析单个section为模块
 */
function parseSectionToModule($section, $sortOrder, $xpath) {
    $dom = $section->ownerDocument;
    $className = $section->getAttribute('class');

    // 检查是否是轮播图
    if (strpos($className, 'banner') !== false ||
        strpos($className, 'slider') !== false ||
        strpos($className, 'swiper') !== false ||
        strpos($className, 'carousel') !== false) {

        $images = $xpath->query('.//img', $section);
        $items = [];

        foreach ($images as $img) {
            $items[] = [
                'image' => $img->getAttribute('src'),
                'title' => $img->getAttribute('alt'),
                'subtitle' => '',
                'link' => ''
            ];
        }

        if (count($items) > 0) {
            return [
                'module_type' => 'banner',
                'module_data' => [
                    'height' => 500,
                    'autoplay' => true,
                    'items' => $items
                ],
                'sort_order' => $sortOrder
            ];
        }
    }

    // 检查是否是卡片网格
    $cards = $xpath->query('.//*[contains(@class, "card") or contains(@class, "item") or contains(@class, "box")]', $section);
    if ($cards->length >= 2) {
        $items = [];

        foreach ($cards as $card) {
            $img = $xpath->query('.//img', $card)->item(0);
            $title = $xpath->query('.//*[self::h1 or self::h2 or self::h3 or self::h4 or contains(@class, "title")]', $card)->item(0);
            $desc = $xpath->query('.//*[contains(@class, "desc") or contains(@class, "text") or self::p]', $card)->item(0);

            $items[] = [
                'image' => $img ? $img->getAttribute('src') : '',
                'title' => $title ? trim($title->textContent) : '',
                'description' => $desc ? trim($desc->textContent) : '',
                'link' => ''
            ];
        }

        if (count($items) > 0) {
            return [
                'module_type' => 'card',
                'module_data' => [
                    'columns' => min(count($items), 3),
                    'style' => 'modern',
                    'items' => $items
                ],
                'sort_order' => $sortOrder
            ];
        }
    }

    // 检查是否是视频
    $video = $xpath->query('.//video', $section)->item(0);
    if ($video) {
        $source = $xpath->query('.//source', $video)->item(0);
        return [
            'module_type' => 'video',
            'module_data' => [
                'src' => $source ? $source->getAttribute('src') : '',
                'poster' => $video->getAttribute('poster'),
                'autoplay' => $video->hasAttribute('autoplay')
            ],
            'sort_order' => $sortOrder
        ];
    }

    // 检查是否主要是单张图片
    $images = $xpath->query('.//img', $section);
    if ($images->length === 1 && strlen(trim($section->textContent)) < 50) {
        $img = $images->item(0);
        return [
            'module_type' => 'image',
            'module_data' => [
                'src' => $img->getAttribute('src'),
                'alt' => $img->getAttribute('alt'),
                'layout' => 'normal',
                'width' => '100%'
            ],
            'sort_order' => $sortOrder
        ];
    }

    // 默认作为自定义HTML保留完整内容
    return [
        'module_type' => 'custom',
        'module_data' => [
            'html' => $dom->saveHTML($section)
        ],
        'sort_order' => $sortOrder
    ];
}
