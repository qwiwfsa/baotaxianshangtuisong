<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$logged = $_COOKIE['cms_logged_in'] ?? '';
echo json_encode([
    'code' => 0,
    'success' => true,
    'data' => [
        'authenticated' => $logged === 'true',
        'user' => $logged === 'true' ? 'admin' : null
    ]
], JSON_UNESCAPED_UNICODE);
