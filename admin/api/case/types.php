<?php
/**
 * 案例业务类型管理API - JSON文件版 (优化版)
 * 获取、创建、更新、删除业务类型
 * 使用JSON文件存储，无需数据库
 * 
 * 优化点：
 * 1. 添加内存缓存，减少文件读取次数
 * 2. 添加超时处理
 * 3. 优化错误处理
 */

// 设置执行时间限制，防止长时间等待
set_time_limit(5);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
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
    ['id' => 1, 'name' => '过桥', 'description' => '企业短期资金周转过桥服务', 'color' => '#3b82f6', 'sort_order' => 1, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
    ['id' => 2, 'name' => '摆账', 'description' => '企业摆账、显账服务', 'color' => '#10b981', 'sort_order' => 2, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
    ['id' => 3, 'name' => '亮资', 'description' => '企业亮资、资金证明服务', 'color' => '#f59e0b', 'sort_order' => 3, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
    ['id' => 4, 'name' => '冲量', 'description' => '银行存款冲量服务', 'color' => '#ef4444', 'sort_order' => 4, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
    ['id' => 5, 'name' => '定增', 'description' => '上市公司定向增发服务', 'color' => '#8b5cf6', 'sort_order' => 5, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => ''],
    ['id' => 6, 'name' => '应收账款', 'description' => '应收账款融资服务', 'color' => '#06b6d4', 'sort_order' => 6, 'meta_title' => '', 'meta_keywords' => '', 'meta_description' => '']
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

// 生成唯一ID
function generateId($types) {
    $maxId = 0;
    foreach ($types as $type) {
        if (isset($type['id']) && $type['id'] > $maxId) {
            $maxId = $type['id'];
        }
    }
    return $maxId + 1;
}

try {
    $method = $_SERVER['REQUEST_METHOD'];
    
    // 添加响应时间头，帮助调试
    $startTime = microtime(true);
    
    switch ($method) {
        case 'GET':
            // 获取业务类型列表
            $types = loadTypes($jsonFile, $defaultTypes);
            // 按sort_order排序
            usort($types, function($a, $b) {
                $orderA = isset($a['sort_order']) ? $a['sort_order'] : 0;
                $orderB = isset($b['sort_order']) ? $b['sort_order'] : 0;
                return $orderA - $orderB;
            });
            
            $responseTime = round((microtime(true) - $startTime) * 1000, 2);
            header("X-Response-Time: {$responseTime}ms");
            
            echo json_encode(['success' => true, 'data' => $types, 'mode' => 'json', 'response_time_ms' => $responseTime]);
            break;
            
        case 'POST':
            // 创建业务类型
            $rawData = file_get_contents('php://input');
            logError("POST data", $rawData);
            $data = json_decode($rawData, true);
            
            if (!$data || !isset($data['name']) || trim($data['name']) === '') {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => '业务类型名称不能为空']);
                break;
            }
            
            $types = loadTypes($jsonFile, $defaultTypes);
            
            $name = trim($data['name']);
            $description = isset($data['description']) ? trim($data['description']) : '';
            $color = isset($data['color']) ? trim($data['color']) : '#3b82f6';
            $meta_title = isset($data['meta_title']) ? trim($data['meta_title']) : '';
            $meta_keywords = isset($data['meta_keywords']) ? trim($data['meta_keywords']) : '';
            $meta_description = isset($data['meta_description']) ? trim($data['meta_description']) : '';
            
            // 检查名称是否已存在
            foreach ($types as $type) {
                if ($type['name'] === $name) {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => '业务类型名称已存在']);
                    break 2;
                }
            }
            
            // 计算新的sort_order
            $maxOrder = 0;
            foreach ($types as $type) {
                if (isset($type['sort_order']) && $type['sort_order'] > $maxOrder) {
                    $maxOrder = $type['sort_order'];
                }
            }
            
            $newType = [
                'id' => generateId($types),
                'name' => $name,
                'description' => $description,
                'color' => $color,
                'sort_order' => $maxOrder + 1,
                'meta_title' => $meta_title,
                'meta_keywords' => $meta_keywords,
                'meta_description' => $meta_description
            ];
            
            $types[] = $newType;
            
            if (saveTypes($jsonFile, $types)) {
                echo json_encode(['success' => true, 'message' => '业务类型创建成功', 'data' => $newType]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => '保存失败，无法写入文件']);
            }
            break;
            
        case 'PUT':
            // 更新业务类型
            $rawData = file_get_contents('php://input');
            logError("PUT data", $rawData);
            $data = json_decode($rawData, true);
            
            if (!$data || !isset($data['id']) || intval($data['id']) <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => '缺少有效的业务类型ID']);
                break;
            }
            
            $types = loadTypes($jsonFile, $defaultTypes);
            
            $id = intval($data['id']);
            $name = isset($data['name']) ? trim($data['name']) : '';
            $description = isset($data['description']) ? trim($data['description']) : '';
            $color = isset($data['color']) ? trim($data['color']) : '#3b82f6';
            $meta_title = isset($data['meta_title']) ? trim($data['meta_title']) : null;
            $meta_keywords = isset($data['meta_keywords']) ? trim($data['meta_keywords']) : null;
            $meta_description = isset($data['meta_description']) ? trim($data['meta_description']) : null;
            $sort_order = isset($data['sort_order']) ? intval($data['sort_order']) : null;
            
            // 只传了sort_order时（排序操作），不校验name
            if (!(isset($data['sort_order']) && count($data) <= 2)) {
                if (!isset($data['name']) || trim($data['name']) === '') {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => '业务类型名称不能为空']);
                    break;
                }
            }
            
            // 查找要更新的类型
            $found = false;
            
            // 检查名称是否与其他类型冲突
            foreach ($types as $type) {
                if ($type['name'] === $name && $type['id'] !== $id) {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => '业务类型名称已存在']);
                    break 2;
                }
            }
            
            // 更新类型
            $pureSort = isset($data['sort_order']) && count($data) <= 2;
            foreach ($types as &$type) {
                if ($type['id'] === $id) {
                    if (!$pureSort) {
                        $type['name'] = $name;
                        $type['description'] = $description;
                        $type['color'] = $color;
                        if ($meta_title !== null) $type['meta_title'] = $meta_title;
                        if ($meta_keywords !== null) $type['meta_keywords'] = $meta_keywords;
                        if ($meta_description !== null) $type['meta_description'] = $meta_description;
                    }
                    if ($sort_order !== null) {
                        $type['sort_order'] = $sort_order;
                    }
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => '未找到要更新的业务类型']);
                break;
            }
            
            if (saveTypes($jsonFile, $types)) {
                echo json_encode(['success' => true, 'message' => '业务类型更新成功']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => '保存失败，无法写入文件']);
            }
            break;
            
        case 'DELETE':
            // 删除业务类型
            $id = 0;
            
            // 尝试从URL参数获取id
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
            }
            
            // 尝试从JSON body获取id
            if ($id <= 0) {
                $rawData = file_get_contents('php://input');
                logError("DELETE data", $rawData);
                if (!empty($rawData)) {
                    $data = json_decode($rawData, true);
                    if ($data && isset($data['id'])) {
                        $id = intval($data['id']);
                    }
                }
            }
            
            logError("DELETE id", $id);
            
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => '缺少业务类型ID']);
                break;
            }
            
            $types = loadTypes($jsonFile, $defaultTypes);
            
            // 查找并删除类型
            $found = false;
            $newTypes = [];
            foreach ($types as $type) {
                if ($type['id'] === $id) {
                    $found = true;
                    continue; // 跳过要删除的类型
                }
                $newTypes[] = $type;
            }
            
            if (!$found) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => '未找到要删除的业务类型']);
                break;
            }
            
            if (saveTypes($jsonFile, $newTypes)) {
                echo json_encode(['success' => true, 'message' => '业务类型删除成功']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => '保存失败，无法写入文件']);
            }
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => '不支持的请求方法: ' . $method]);
    }
    
} catch (Exception $e) {
    logError("Exception", $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
}
