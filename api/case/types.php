<?php
/**
 * 前端业务类型API
 * 供前端页面读取业务类型列表
 */

// 开启错误报告（开发环境）
error_reporting(E_ALL);
ini_set('display_errors', 0);

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() - 3600) . ' GMT');

// 错误处理
function handleError($errno, $errstr, $errfile, $errline) {
    error_log("[types.php] Error [$errno]: $errstr in $errfile on line $errline");
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

    // 业务类型数据文件路径
    $jsonFile = __DIR__ . '/../../admin/data/case-types.json';

    // 默认业务类型数据
    $defaultTypes = [
        ['id' => 1, 'name' => '过桥', 'description' => '企业短期资金周转过桥服务', 'color' => '#3b82f6', 'sort_order' => 1, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
        ['id' => 2, 'name' => '摆账', 'description' => '企业摆账、显账服务', 'color' => '#10b981', 'sort_order' => 2, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
        ['id' => 3, 'name' => '亮资', 'description' => '企业亮资、资金证明服务', 'color' => '#f59e0b', 'sort_order' => 3, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
        ['id' => 4, 'name' => '冲量', 'description' => '银行存款冲量服务', 'color' => '#ef4444', 'sort_order' => 4, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
        ['id' => 5, 'name' => '定增', 'description' => '上市公司定向增发服务', 'color' => '#8b5cf6', 'sort_order' => 5, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
        ['id' => 6, 'name' => '应收账款', 'description' => '应收账款融资服务', 'color' => '#06b6d4', 'sort_order' => 6, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => '']
    ];

    $types = [];

    // 读取业务类型数据
    if (file_exists($jsonFile)) {
        $content = file_get_contents($jsonFile);
        if ($content !== false) {
            $types = json_decode($content, true);
            if (!is_array($types)) {
                $types = [];
            }
        }
    }

    // 如果没有数据，使用默认数据
    if (empty($types)) {
        $types = $defaultTypes;
    }

    // 按sort_order排序
    usort($types, function($a, $b) {
        $orderA = isset($a['sort_order']) ? $a['sort_order'] : 0;
        $orderB = isset($b['sort_order']) ? $b['sort_order'] : 0;
        return $orderA - $orderB;
    });

    // 返回数据
    echo json_encode([
        'success' => true,
        'data' => $types,
        'total' => count($types)
    ]);

} catch (Exception $e) {
    error_log('[types.php] Exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
    exit;
}
