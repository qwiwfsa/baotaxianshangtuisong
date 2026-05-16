<?php
/**
 * Logo settings API for frontend
 * Returns logo paths from logo-settings.json
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$dataFile = dirname(__DIR__) . '/data/logo-settings.json';

$defaults = [
    'header_logo' => 'images/logo.png',
    'footer_logo' => 'images/logo.png',
    'favicon' => '/favicon-v2.png',
    'admin_logo' => 'images/logo.png',
    'updated_at' => ''
];

if (!file_exists($dataFile)) {
    echo json_encode(['code' => 0, 'msg' => 'success', 'data' => $defaults], JSON_UNESCAPED_UNICODE);
    exit;
}

$content = file_get_contents($dataFile);
$settings = json_decode($content, true);

if (json_last_error() !== JSON_ERROR_NONE || !is_array($settings)) {
    $settings = $defaults;
}

// Normalize paths
$baseUrl = '/';
$pathFields = ['header_logo', 'footer_logo', 'admin_logo'];
foreach ($pathFields as $field) {
    if (!empty($settings[$field])) {
        $path = str_replace(chr(92), '/', $settings[$field]);
        while (strpos($path, '../') === 0 || strpos($path, './') === 0) {
            $path = (strpos($path, '../') === 0) ? substr($path, 3) : substr($path, 2);
        }
        $settings[$field] = $baseUrl . ltrim($path, '/');
    }
}

// Favicon always from dynamic endpoint
$settings['favicon'] = '/favicon-v2.png';

echo json_encode(['code' => 0, 'msg' => 'success', 'data' => $settings], JSON_UNESCAPED_UNICODE);
