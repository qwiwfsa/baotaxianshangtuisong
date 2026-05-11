<?php
/**
 * 前台获取Logo设置API
 * 只读取logo-settings.json返回JSON数据
 */

// CORS 跨域头
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// 数据文件路径
$dataFile = dirname(__DIR__) . '/data/logo-settings.json';

// 默认Logo设置
$defaults = [
    'header_logo' => 'images/logo.png',
    'footer_logo' => 'images/logo.png',
    'favicon' => 'images/favicon.ico',
    'admin_logo' => 'images/logo.png',
    'updated_at' => ''
];

if (!file_exists($dataFile)) {
    echo json_encode([
        'code' => 0,
        'msg' => 'success',
        'data' => $defaults
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$content = file_get_contents($dataFile);
$settings = json_decode($content, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($settings)) {
    $settings = $defaults;
}

// 统一处理路径：改为绝对路径以 / 开头，确保前台所有页面（含子目录）都能正确显示
$baseUrl = '/';
$pathFields = ['header_logo', 'footer_logo', 'favicon', 'admin_logo'];
foreach ($pathFields as $field) {
    if (!empty($settings[$field])) {
        $path = $settings[$field];
        // 替换反斜杠为正斜杠
        $path = str_replace('\\', '/', $path);
        // 去掉 ../ 或 ./ 前缀
        while (strpos($path, '../') === 0 || strpos($path, './') === 0) {
            if (strpos($path, '../') === 0) {
                $path = substr($path, 3);
            } else {
                $path = substr($path, 2);
            }
        }
        // 加上绝对路径前缀
        $path = $baseUrl . ltrim($path, '/');
        $settings[$field] = $path;
    }
}

echo json_encode([
    'code' => 0,
    'msg' => 'success',
    'data' => $settings
], JSON_UNESCAPED_UNICODE);
