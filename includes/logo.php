<?php
/**
 * Logo动态加载 - 从logo-settings.json读取
 * 使用方式: require_once __DIR__ . '/includes/logo.php';
 * 变量: $header_logo, $footer_logo, $favicon
 */
function getLogoData() {
    static $logoData = null;
    if ($logoData !== null) return $logoData;

    $jsonFile = __DIR__ . '/../admin/data/logo-settings.json';
    $defaults = [
        'header_logo' => '/uploads/logo/logo_20260505_122045_69f9c47d515d1.png',
        'footer_logo' => '/uploads/logo/logo_20260502_190529_69f62ed969290.png',
        'favicon' => '/uploads/logo/logo_20260516_071314_6a07a88a2cd5c.png',
    ];

    if (file_exists($jsonFile)) {
        $data = json_decode(file_get_contents($jsonFile), true);
        if ($data && is_array($data)) {
            foreach (['header_logo', 'footer_logo', 'favicon'] as $key) {
                if (!empty($data[$key])) {
                    $path = str_replace('\\', '/', $data[$key]);
                    // Normalize path
                    $path = preg_replace('#^\.?/#', '/', $path);
                    if (strpos($path, '/') !== 0) $path = '/' . $path;
                    $defaults[$key] = $path;
                }
            }
        }
    }

    $logoData = $defaults;
    return $logoData;
}

$logoData = getLogoData();
$header_logo = $logoData['header_logo'];
$footer_logo = $logoData['footer_logo'];
$favicon = '/favicon-v2.png';
