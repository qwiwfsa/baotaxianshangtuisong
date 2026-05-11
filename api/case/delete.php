<?php
/**
 * 后台案例删除API（JSON文件存储）
 * POST /api/case/delete.php
 */

// 开启错误报告
error_reporting(E_ALL);
ini_set('display_errors', 0);

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 错误处理
function handleError($errno, $errstr, $errfile, $errline) {
    error_log("[case/delete.php] Error [$errno]: $errstr in $errfile on line $errline");
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

// 只允许POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 读取POST数据
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

// 清理ID
$caseId = preg_replace('/[^a-zA-Z0-9_-]/', '', $data['id']);

// 数据目录
$dataDir = __DIR__ . '/../../data/cases/';
$dataFile = $dataDir . $caseId . '.json';
$indexFile = __DIR__ . '/../../data/cases-index.json';

$deleted = false;

// 删除案例数据文件
if (file_exists($dataFile)) {
    unlink($dataFile);
    $deleted = true;
}

// 从索引中移除
if (file_exists($indexFile)) {
    $indexJson = file_get_contents($indexFile);
    $index = json_decode($indexJson, true);
    if (is_array($index)) {
        $newIndex = [];
        foreach ($index as $entry) {
            if ($entry['id'] !== $caseId) {
                $newIndex[] = $entry;
            }
        }
        file_put_contents($indexFile, json_encode($newIndex, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}

if ($deleted) {
    echo json_encode([
        'success' => true,
        'message' => '案例删除成功'
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => '案例不存在'
    ]);
}

} catch (Exception $e) {
    error_log('[case/delete.php] Exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
    exit;
}
