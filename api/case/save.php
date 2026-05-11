<?php
/**
 * 后台案例保存/更新API（JSON文件存储）
 * POST /api/case/save.php
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
    error_log("[case/save.php] Error [$errno]: $errstr in $errfile on line $errline");
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
$caseData = json_decode($input, true);

if (!$caseData || !isset($caseData['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

// 数据目录
$dataDir = __DIR__ . '/../../data/cases/';
$indexFile = __DIR__ . '/../../data/cases-index.json';

// 确保目录存在
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// 清理ID，防止目录遍历
$caseId = preg_replace('/[^a-zA-Z0-9_-]/', '', $caseData['id']);
$dataFile = $dataDir . $caseId . '.json';

// 设置时间戳
$caseData['lastModified'] = date('c');
if (!isset($caseData['createdAt'])) {
    $caseData['createdAt'] = $caseData['lastModified'];
}

// 保存案例数据到JSON文件
$json = json_encode($caseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
if (file_put_contents($dataFile, $json) === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '文件保存失败']);
    exit;
}

// 更新索引文件
$index = [];
if (file_exists($indexFile)) {
    $indexJson = file_get_contents($indexFile);
    $index = json_decode($indexJson, true);
    if (!is_array($index)) {
        $index = [];
    }
}

// 在索引中查找或添加
$found = false;
foreach ($index as &$entry) {
    if ($entry['id'] === $caseId) {
        $entry['title'] = isset($caseData['title']) ? $caseData['title'] : '';
        $entry['type'] = isset($caseData['type']) ? $caseData['type'] : '';
        $entry['amount'] = isset($caseData['amount']) ? $caseData['amount'] : '';
        $entry['summary'] = isset($caseData['summary']) ? $caseData['summary'] : '';
        $entry['image'] = isset($caseData['images']) && count($caseData['images']) > 0 ? $caseData['images'][0] : '';
        $entry['coverImage'] = $entry['image'];
        $entry['images'] = isset($caseData['images']) ? $caseData['images'] : [];
        $entry['status'] = isset($caseData['status']) ? $caseData['status'] : 'draft';
        $entry['lastModified'] = $caseData['lastModified'];
        $found = true;
        break;
    }
}
unset($entry);

if (!$found) {
    $index[] = [
        'id' => $caseId,
        'title' => isset($caseData['title']) ? $caseData['title'] : '',
        'type' => isset($caseData['type']) ? $caseData['type'] : '',
        'amount' => isset($caseData['amount']) ? $caseData['amount'] : '',
        'summary' => isset($caseData['summary']) ? $caseData['summary'] : '',
        'image' => isset($caseData['images']) && count($caseData['images']) > 0 ? $caseData['images'][0] : '',
        'coverImage' => isset($caseData['images']) && count($caseData['images']) > 0 ? $caseData['images'][0] : '',
        'images' => isset($caseData['images']) ? $caseData['images'] : [],
        'status' => isset($caseData['status']) ? $caseData['status'] : 'draft',
        'lastModified' => $caseData['lastModified']
    ];
}

// 写入索引文件
file_put_contents($indexFile, json_encode($index, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

// 返回成功
echo json_encode([
    'success' => true,
    'message' => '案例保存成功',
    'id' => $caseId
]);

} catch (Exception $e) {
    error_log('[case/save.php] Exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
    exit;
}
