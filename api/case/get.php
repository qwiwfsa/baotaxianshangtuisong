<?php
/**
 * 后台案例获取API（JSON文件存储）
 * GET /api/case/get.php?id=xxx
 */

// 开启错误报告
error_reporting(E_ALL);
ini_set('display_errors', 0);

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 错误处理
function handleError($errno, $errstr, $errfile, $errline) {
    error_log("[case/get.php] Error [$errno]: $errstr in $errfile on line $errline");
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器内部错误']);
    exit;
}
set_error_handler('handleError');

try {

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 只允许GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 获取案例ID
$caseId = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($caseId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

// 清理ID
$caseId = preg_replace('/[^a-zA-Z0-9_-]/', '', $caseId);

// 数据目录
$dataDir = __DIR__ . '/../../data/cases/';
$dataFile = $dataDir . $caseId . '.json';

// 检查文件是否存在
if (!file_exists($dataFile)) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => '案例不存在']);
    exit;
}

// 读取案例数据
$json = file_get_contents($dataFile);
$caseData = json_decode($json, true);

if (!$caseData) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '案例数据解析失败']);
    exit;
}

echo json_encode([
    'success' => true,
    'case' => $caseData
]);

} catch (Exception $e) {
    error_log('[case/get.php] Exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
    exit;
}
