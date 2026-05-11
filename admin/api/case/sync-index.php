<?php
/**
 * 索引同步修复工具
 * 清理索引中不存在对应文件的案例记录
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
    error_log("[sync-index.php] Error [$errno]: $errstr in $errfile on line $errline");
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

// 数据目录
$adminDir = dirname(dirname(__DIR__));
$dataDir = $adminDir . '/data/cases/';
$indexFile = $adminDir . '/data/cases-index.json';

$result = [
    'success' => false,
    'message' => '',
    'beforeCount' => 0,
    'afterCount' => 0,
    'removedCount' => 0,
    'removedIds' => []
];

// 检查索引文件是否存在
if (!file_exists($indexFile)) {
    $result['message'] = '索引文件不存在';
    echo json_encode($result);
    exit;
}

// 读取索引
$json = file_get_contents($indexFile);
$cases = json_decode($json, true);

if (!is_array($cases)) {
    $result['message'] = '索引文件格式无效';
    echo json_encode($result);
    exit;
}

$result['beforeCount'] = count($cases);

// 验证每个案例是否存在对应的文件
$validCases = [];
$removedIds = [];

foreach ($cases as $case) {
    if (!isset($case['id'])) {
        continue;
    }
    
    $caseFile = $dataDir . $case['id'] . '.json';
    if (file_exists($caseFile)) {
        $validCases[] = $case;
    } else {
        $removedIds[] = $case['id'];
        error_log("[sync-index.php] 删除无效索引条目: " . $case['id']);
    }
}

$result['removedCount'] = count($removedIds);
$result['removedIds'] = $removedIds;
$result['afterCount'] = count($validCases);

// 如果有无效条目，更新索引文件
if (count($removedIds) > 0) {
    if (file_put_contents($indexFile, json_encode($validCases, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) !== false) {
        $result['success'] = true;
        $result['message'] = '索引同步成功，已清理 ' . count($removedIds) . ' 个无效条目';
    } else {
        $result['message'] = '更新索引文件失败';
    }
} else {
    $result['success'] = true;
    $result['message'] = '索引已是最新，无需清理';
}

echo json_encode($result);

} catch (Exception $e) {
    error_log('[sync-index.php] Exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
    exit;
}
