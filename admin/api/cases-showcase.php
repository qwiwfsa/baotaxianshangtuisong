<?php
/**
 * 案例展示API - 统一获取已发布案例
 * 调用 api/cases.php 并格式化为统一响应
 */
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

try {
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 6;
    
    // 调用 cases.php 获取数据
    $casesUrl = __DIR__ . '/../../api/cases.php';
    $resp = @file_get_contents($casesUrl);
    
    if ($resp) {
        $data = json_decode($resp, true);
        if ($data && isset($data['success']) && $data['success'] && isset($data['cases'])) {
            $list = array_slice($data['cases'], 0, $limit);
            echo json_encode(['code' => 0, 'msg' => 'success', 'data' => $list, 'total' => count($data['cases'])], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    echo json_encode(['code' => 0, 'msg' => 'success', 'data' => [], 'total' => 0], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    echo json_encode(['code' => -1, 'msg' => $e->getMessage(), 'data' => []], JSON_UNESCAPED_UNICODE);
}
