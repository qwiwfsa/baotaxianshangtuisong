<?php
/**
 * 手机端API统一配置
 * 共用hongdu数据库
 */

error_reporting(0);
ini_set('display_errors', 0);

require_once __DIR__ . '/../../config/db.php';

function setApiHeaders() {
    if (ob_get_level()) { ob_clean(); }
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Cache-Control: no-cache, no-store, must-revalidate');
}

function handlePreflight() {
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
}

function requireMethod($method) {
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => '方法不允许']);
        exit;
    }
}

function jsonSuccess($data, $extra = []) {
    $output = array_merge([
        'success' => true,
        'data' => $data,
        'timestamp' => time()
    ], $extra);
    echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function jsonError($message, $code = 500) {
    http_response_code($code);
    echo json_encode([
        'success' => false,
        'message' => $message,
        'code' => $code
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
