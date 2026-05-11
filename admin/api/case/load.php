<?php
/**
 * 案例详情加载API
 * 从JSON文件加载案例数据
 */

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 获取案例ID
$caseId = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($caseId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

// 清理案例ID，防止目录遍历
$caseId = preg_replace('/[^a-zA-Z0-9_-]/', '', $caseId);

// 数据文件路径
$dataDir = __DIR__ . '/../../data/cases/';
$dataFile = $dataDir . $caseId . '.json';

// 如果文件不存在，返回默认结构
if (!file_exists($dataFile)) {
    // 返回默认案例结构
    $defaultData = [
        'id' => $caseId,
        'title' => '',
        'type' => '过桥',
        'city' => '北京',
        'summary' => '',
        'amount' => '',
        'period' => '',
        'year' => date('Y'),
        'image' => '',
        'images' => [],
        'hasVideo' => false,
        'video' => '',
        'detail' => '',
        'highlights' => [],
        'status' => 'draft',
        'lastModified' => date('Y-m-d H:i:s')
    ];
    
    echo json_encode([
        'success' => true,
        'case' => $defaultData,
        'exists' => false
    ]);
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

// 确保所有字段存在
$caseData = array_merge([
    'id' => $caseId,
    'title' => '',
    'type' => '过桥',
    'city' => '北京',
    'summary' => '',
    'amount' => '',
    'period' => '',
    'year' => date('Y'),
    'image' => '',
    'images' => [],
    'hasVideo' => false,
    'video' => '',
    'detail' => '',
    'highlights' => [],
    'status' => 'draft'
], $caseData);

echo json_encode([
    'success' => true,
    'case' => $caseData,
    'exists' => true
]);
