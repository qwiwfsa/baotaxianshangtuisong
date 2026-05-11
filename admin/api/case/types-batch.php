<?php
/**
 * 案例业务类型 - 批量排序API
 * 接收完整的排序数组，一次性更新所有类型排序
 */

set_time_limit(5);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '仅支持POST']);
    exit;
}

$jsonFile = __DIR__ . '/../../data/case-types.json';

// 默认业务类型数据
$defaultTypes = [
    ['id' => 1, 'name' => '过桥', 'description' => '企业短期资金周转过桥服务', 'color' => '#3b82f6', 'sort_order' => 1],
    ['id' => 2, 'name' => '摆账', 'description' => '企业摆账、显账服务', 'color' => '#10b981', 'sort_order' => 2],
    ['id' => 3, 'name' => '亮资', 'description' => '企业亮资、资金证明服务', 'color' => '#f59e0b', 'sort_order' => 3],
    ['id' => 4, 'name' => '冲量', 'description' => '银行存款冲量服务', 'color' => '#ef4444', 'sort_order' => 4],
    ['id' => 5, 'name' => '定增', 'description' => '上市公司定向增发服务', 'color' => '#8b5cf6', 'sort_order' => 5],
    ['id' => 6, 'name' => '应收账款', 'description' => '应收账款融资服务', 'color' => '#06b6d4', 'sort_order' => 6]
];

$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

if (!$data || !isset($data['orders']) || !is_array($data['orders'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少orders参数']);
    exit;
}

// 读取当前类型数据
$types = [];
if (file_exists($jsonFile)) {
    $content = file_get_contents($jsonFile);
    $types = json_decode($content, true);
}
if (!is_array($types) || empty($types)) {
    $types = $defaultTypes;
}

// 构建ID到排序的映射
$orderMap = [];
foreach ($data['orders'] as $item) {
    if (isset($item['id']) && isset($item['sort_order'])) {
        $orderMap[intval($item['id'])] = intval($item['sort_order']);
    }
}

// 更新每个类型的sort_order
foreach ($types as &$type) {
    $id = intval($type['id']);
    if (isset($orderMap[$id])) {
        $type['sort_order'] = $orderMap[$id];
    }
}
unset($type);

// 按sort_order重新排序
usort($types, function($a, $b) {
    $oa = isset($a['sort_order']) ? $a['sort_order'] : 0;
    $ob = isset($b['sort_order']) ? $b['sort_order'] : 0;
    return $oa - $ob;
});

// 写入文件
$dir = dirname($jsonFile);
if (!is_dir($dir)) {
    @mkdir($dir, 0755, true);
}

$json = json_encode($types, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$tempFile = $jsonFile . '.tmp.' . uniqid();
$result = file_put_contents($tempFile, $json, LOCK_EX);
if ($result === false) {
    @unlink($tempFile);
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '写入临时文件失败']);
    exit;
}

if (!@rename($tempFile, $jsonFile)) {
    @unlink($tempFile);
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '重命名文件失败']);
    exit;
}

echo json_encode(['success' => true, 'message' => '排序更新成功', 'data' => $types]);
