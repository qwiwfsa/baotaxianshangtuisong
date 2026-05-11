<?php
/**
 * API测试文件
 * 用于测试PHP服务器是否正常运行
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

echo json_encode([
    'status' => 'ok',
    'message' => 'API is working',
    'time' => date('Y-m-d H:i:s'),
    'php_version' => PHP_VERSION
]);
