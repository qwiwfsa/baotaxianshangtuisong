<?php
/**
 * 加载现有页面HTML内容
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
        jsonError('未找到页面文件');
    }

    // 提取body内容
    preg_match('/<body[^>]*>(.*?)<\/body>/is', $htmlContent, $matches);
    $bodyContent = isset($matches[1]) ? $matches[1] : $htmlContent;

    // 移除header和footer
    $bodyContent = preg_replace('/<header[^>]*>.*?<\/header>/is', '', $bodyContent);
    $bodyContent = preg_replace('/<footer[^>]*>.*?<\/footer>/is', '', $bodyContent);
    $bodyContent = preg_replace('/<nav[^>]*>.*?<\/nav>/is', '', $bodyContent);

    // 清理script标签
    $bodyContent = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $bodyContent);

    jsonSuccess([
        'html' => trim($bodyContent),
        'path' => $foundPath
    ]);

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
