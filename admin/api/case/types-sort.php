<?php
/**
 * 案例业务类型排序API - JSON文件版
 * 批量更新业务类型排序
 * 与 types.php 使用相同JSON文件存储
 */

set_time_limit(5);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理OPTIONS预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 内存缓存 - 用于当前请求内多次读取
static $typesCache = null;
static $cacheTime = 0;
const CACHE_TTL = 2; // 缓存有效期2秒

// JSON文件路径
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

// 记录错误日志
function logError($message, $data = null) {
    $logFile = __DIR__ . '/../logs/api-error.log';
    $logDir = dirname($logFile);
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message";
    if ($data !== null) {
        $logMessage .= " | Data: " . json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    $logMessage .= " | Request: " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'] . "\n";
    @error_log($logMessage, 3, $logFile);
}

// 读取业务类型数据（带缓存优化）
function loadTypes($jsonFile, $defaultTypes) {
    global $typesCache, $cacheTime;

    // 检查内存缓存是否有效
    $now = time();
    if ($typesCache !== null && ($now - $cacheTime) < CACHE_TTL) {
        return $typesCache;
    }

    // 检查文件是否存在，不存在则创建默认数据
    if (!file_exists($jsonFile)) {
        // 如果文件不存在，创建默认数据
        saveTypes($jsonFile, $defaultTypes);
        $typesCache = $defaultTypes;
        $cacheTime = $now;
        return $defaultTypes;
    }

    // 使用文件锁读取，避免并发问题
    $fp = @fopen($jsonFile, 'r');
    if (!$fp) {
        logError("Failed to open types file", $jsonFile);
        $typesCache = $defaultTypes;
        $cacheTime = $now;
        return $defaultTypes;
    }

    // 尝试获取共享锁（非阻塞）
    if (!@flock($fp, LOCK_SH | LOCK_NB)) {
        // 如果无法获取锁，直接返回默认数据
        @fclose($fp);
        logError("Could not acquire read lock", $jsonFile);
        $typesCache = $defaultTypes;
        $cacheTime = $now;
        return $defaultTypes;
    }

    $content = file_get_contents($jsonFile);
    @flock($fp, LOCK_UN);
    @fclose($fp);

    if ($content === false) {
        logError("Failed to read types file", $jsonFile);
        $typesCache = $defaultTypes;
        $cacheTime = $now;
        return $defaultTypes;
    }

    $types = json_decode($content, true);
    if ($types === null) {
        logError("Failed to parse types JSON", $content);
        $typesCache = $defaultTypes;
        $cacheTime = $now;
        return $defaultTypes;
    }

    // 更新缓存
    $typesCache = $types;
    $cacheTime = $now;

    return $types;
}

// 保存业务类型数据（带缓存更新）
function saveTypes($jsonFile, $types) {
    global $typesCache, $cacheTime;

    $dir = dirname($jsonFile);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }

    $json = json_encode($types, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        logError("Failed to encode types JSON", $types);
        return false;
    }

    // 使用临时文件写入，然后重命名，确保原子操作
    $tempFile = $jsonFile . '.tmp' . uniqid();
    $result = file_put_contents($tempFile, $json, LOCK_EX);
    if ($result === false) {
        logError("Failed to write temp types file", $tempFile);
        @unlink($tempFile);
        return false;
    }

    // 重命名为正式文件
    if (!@rename($tempFile, $jsonFile)) {
        logError("Failed to rename temp file", ['temp' => $tempFile, 'target' => $jsonFile]);
        @unlink($tempFile);
        return false;
    }

    // 更新内存缓存
    $typesCache = $types;
    $cacheTime = time();

    return true;
}

try {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method !== 'POST' && $method !== 'PUT') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => '请求方法不允许: ' . $method]);
        exit;
    }

    // 获取排序数据
    $rawData = file_get_contents('php://input');
    logError("Sort API data", $rawData);

    $data = json_decode($rawData, true);

    if (!$data || !isset($data['types']) || !is_array($data['types'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '缺少排序数据']);
        exit;
    }

    $sortedTypes = $data['types'];

    // 加载现有类型
    $types = loadTypes($jsonFile, $defaultTypes);

    // 构建ID到sort_order的映射表
    $orderMap = [];
    foreach ($sortedTypes as $index => $type) {
        $id = isset($type['id']) ? intval($type['id']) : 0;
        if ($id > 0) {
            $orderMap[$id] = $index + 1; // 从1开始编号
        }
    }

    // 更新每个type的sort_order
    $updatedCount = 0;
    foreach ($types as &$type) {
        $id = isset($type['id']) ? intval($type['id']) : 0;
        if ($id > 0 && isset($orderMap[$id])) {
            $type['sort_order'] = $orderMap[$id];
            $updatedCount++;
        }
    }
    unset($type);

    // 按新的sort_order重新排序
    usort($types, function($a, $b) {
        $orderA = isset($a['sort_order']) ? $a['sort_order'] : 0;
        $orderB = isset($b['sort_order']) ? $b['sort_order'] : 0;
        return $orderA - $orderB;
    });

    // 保存到JSON文件
    if (saveTypes($jsonFile, $types)) {
        logError("Sort saved to JSON file", "$updatedCount items updated");
        echo json_encode(['success' => true, 'message' => "排序更新成功 ($updatedCount 项)", 'mode' => 'json']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => '排序保存失败，无法写入文件']);
    }

} catch (Exception $e) {
    logError("Exception", $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
}
