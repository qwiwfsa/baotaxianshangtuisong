<?php
/**
 * Dynamic Favicon - reads from admin logo-settings.json
 * Always serves the latest favicon, never cached
 */
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// Default favicon
$favicon_file = __DIR__ . '/uploads/logo/logo_20260516_071314_6a07a88a2cd5c.png';

// Read from admin settings
$settings_file = __DIR__ . '/admin/data/logo-settings.json';
if (file_exists($settings_file)) {
    $settings = json_decode(file_get_contents($settings_file), true);
    if ($settings && !empty($settings['favicon'])) {
        // JSON already decodes escaped slashes
        $path = $settings['favicon'];
        // Remove ./ or ../ prefix if present
        $path = ltrim($path, '.');
        $path = ltrim($path, '/');
        // Build full path
        $candidate = __DIR__ . '/' . $path;
        if (file_exists($candidate)) {
            $favicon_file = $candidate;
        }
    }
}

if (!file_exists($favicon_file)) {
    http_response_code(404);
    exit;
}

$ext = strtolower(pathinfo($favicon_file, PATHINFO_EXTENSION));
$mime_types = [
    'png' => 'image/png',
    'ico' => 'image/x-icon',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'svg' => 'image/svg+xml',
    'webp' => 'image/webp',
];
$mime = $mime_types[$ext] ?? 'image/png';

header('Content-Type: ' . $mime);
header('Content-Length: ' . filesize($favicon_file));
readfile($favicon_file);
