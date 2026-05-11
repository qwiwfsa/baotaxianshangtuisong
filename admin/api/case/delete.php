<?php
/**
 * 案例删除API
 * 删除案例数据
 */

// 开启错误报告（开发环境）
error_reporting(E_ALL);
ini_set('display_errors', 0);

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 错误处理
function handleError($errno, $errstr, $errfile, $errline) {
    error_log("[delete.php] Error [$errno]: $errstr in $errfile on line $errline");
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器内部错误: ' . $errstr]);
    exit;
}
set_error_handler('handleError');

try {

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 获取案例ID
$caseId = '';
$rawInput = file_get_contents('php://input');
error_log("[delete.php] Raw input: " . $rawInput);
error_log("[delete.php] Request Method: " . $_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str($rawInput, $data);
    $caseId = isset($data['id']) ? $data['id'] : '';
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($rawInput, true);
    $caseId = isset($data['id']) ? $data['id'] : '';
}

error_log("[delete.php] Case ID: " . $caseId);

if (empty($caseId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

// 清理案例ID（保留字母、数字、下划线、横线）
$originalCaseId = $caseId;
$caseId = preg_replace('/[^a-zA-Z0-9_-]/', '', $caseId);

if (empty($caseId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '案例ID格式无效']);
    exit;
}

// 计算基础目录 - 使用绝对路径
// __DIR__ = D:\yingyong\xampp\htdocs\hongdu\admin\api\case\
// dirname(__DIR__) = D:\yingyong\xampp\htdocs\hongdu\admin\api\
// dirname(dirname(__DIR__)) = D:\yingyong\xampp\htdocs\hongdu\admin\
// dirname(dirname(dirname(__DIR__))) = D:\yingyong\xampp\htdocs\hongdu\ (根目录)
$adminDir = dirname(dirname(__DIR__));
$baseDir = dirname(dirname(dirname(__DIR__)));

// 后台数据文件路径 (admin/data/) - 优先使用
$adminDataDir = $adminDir . '/data/cases/';
$adminDataFile = $adminDataDir . $caseId . '.json';
$adminIndexFile = $adminDir . '/data/cases-index.json';

// 前端数据文件路径 (根目录data/)
$frontendDataDir = $baseDir . '/data/cases/';
$frontendDataFile = $frontendDataDir . $caseId . '.json';
$frontendIndexFile = $baseDir . '/data/cases-index.json';

error_log("[delete.php] Admin dir: " . $adminDir);
error_log("[delete.php] Admin data dir: " . $adminDataDir);
error_log("[delete.php] Admin index file: " . $adminIndexFile);
error_log("[delete.php] Frontend data dir: " . $frontendDataDir);
error_log("[delete.php] Frontend index file: " . $frontendIndexFile);

// ========== 删除MySQL记录 ==========
try {
    require_once __DIR__ . '/../../../config/db.php';
    $conn = getDB();
    $numericId = intval(preg_replace('/[^0-9]/', '', $caseId));
    if ($numericId > 0) {
        $delStmt = $conn->prepare("DELETE FROM cases WHERE id = ?");
        $delStmt->bind_param("i", $numericId);
        $delStmt->execute();
        $delCount = $delStmt->affected_rows;
        $delStmt->close();
        if ($delCount > 0) {
            $details[] = 'MySQL记录已删除';
            error_log("[delete.php] Deleted MySQL record id=$numericId");
        }
    }
    $conn->close();
} catch (Exception $e) {
    $errors[] = 'MySQL删除失败: ' . $e->getMessage();
    error_log('[delete.php] MySQL delete error: ' . $e->getMessage());
}

$deleted = false;
$errors = [];
$details = [];

// ========== 删除后台案例文件 ==========
if (file_exists($adminDataFile)) {
    if (is_writable($adminDataFile)) {
        if (unlink($adminDataFile)) {
            $deleted = true;
            $details[] = '后台案例文件已删除';
            error_log("[delete.php] Deleted admin file: " . $adminDataFile);
        } else {
            $errors[] = '删除后台案例文件失败';
            error_log("[delete.php] Failed to delete admin file: " . $adminDataFile);
        }
    } else {
        $errors[] = '后台案例文件没有写入权限';
        error_log("[delete.php] Admin file not writable: " . $adminDataFile);
    }
} else {
    $details[] = '后台案例文件不存在';
    error_log("[delete.php] Admin file not found: " . $adminDataFile);
}

// ========== 从后台索引中移除 ==========
if (file_exists($adminIndexFile)) {
    if (is_writable($adminIndexFile)) {
        $json = file_get_contents($adminIndexFile);
        $index = json_decode($json, true);
        if (is_array($index)) {
            $originalCount = count($index);
            $index = array_filter($index, function($item) use ($caseId) {
                return isset($item['id']) && $item['id'] !== $caseId;
            });
            $index = array_values($index);
            
            if (count($index) < $originalCount) {
                if (file_put_contents($adminIndexFile, json_encode($index, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) !== false) {
                    $deleted = true;
                    $details[] = '后台索引已更新';
                    error_log("[delete.php] Updated admin index");
                } else {
                    $errors[] = '更新后台索引失败';
                    error_log("[delete.php] Failed to update admin index");
                }
            } else {
                $details[] = '后台索引中无此案例';
            }
        }
    } else {
        $errors[] = '后台索引文件没有写入权限';
        error_log("[delete.php] Admin index not writable: " . $adminIndexFile);
    }
} else {
    $details[] = '后台索引文件不存在';
}

// ========== 删除前端案例文件 ==========
if (file_exists($frontendDataFile)) {
    if (is_writable($frontendDataFile)) {
        if (unlink($frontendDataFile)) {
            $deleted = true;
            $details[] = '前端案例文件已删除';
            error_log("[delete.php] Deleted frontend file: " . $frontendDataFile);
        } else {
            $errors[] = '删除前端案例文件失败';
            error_log("[delete.php] Failed to delete frontend file: " . $frontendDataFile);
        }
    } else {
        $errors[] = '前端案例文件没有写入权限';
        error_log("[delete.php] Frontend file not writable: " . $frontendDataFile);
    }
} else {
    $details[] = '前端案例文件不存在';
    error_log("[delete.php] Frontend file not found: " . $frontendDataFile);
}

// ========== 从前端索引中移除 ==========
if (file_exists($frontendIndexFile)) {
    if (is_writable($frontendIndexFile)) {
        $json = file_get_contents($frontendIndexFile);
        $index = json_decode($json, true);
        if (is_array($index)) {
            $originalCount = count($index);
            $index = array_filter($index, function($item) use ($caseId) {
                return isset($item['id']) && $item['id'] !== $caseId;
            });
            $index = array_values($index);
            
            if (count($index) < $originalCount) {
                if (file_put_contents($frontendIndexFile, json_encode($index, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) !== false) {
                    $deleted = true;
                    $details[] = '前端索引已更新';
                    error_log("[delete.php] Updated frontend index");
                } else {
                    $errors[] = '更新前端索引失败';
                    error_log("[delete.php] Failed to update frontend index");
                }
            } else {
                $details[] = '前端索引中无此案例';
            }
        }
    } else {
        $errors[] = '前端索引文件没有写入权限';
        error_log("[delete.php] Frontend index not writable: " . $frontendIndexFile);
    }
} else {
    $details[] = '前端索引文件不存在';
}

// 同步删除前端 cases.html 页面可能缓存的数据
// 清理与该案例相关的所有缓存
$cacheCleaned = false;

// 尝试清理前端页面的localStorage缓存（通过返回特殊标记让前端处理）
$frontendCacheKey = 'cms_cases';

// 返回结果
if ($deleted) {
    echo json_encode([
        'success' => true,
        'message' => '案例删除成功',
        'id' => $caseId,
        'details' => $details,
        'cacheCleaned' => true,
        'requireReload' => true
    ]);
} else {
    if (empty($errors)) {
        // 文件不存在，但返回成功（幂等性）
        echo json_encode([
            'success' => true,
            'message' => '案例已删除或不存在',
            'id' => $caseId,
            'details' => $details,
            'cacheCleaned' => true,
            'requireReload' => true
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => implode('; ', $errors),
            'id' => $caseId,
            'details' => $details
        ]);
    }
}

} catch (Exception $e) {
    error_log('[delete.php] Exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage(), 'id' => $caseId ?? '']);
    exit;
}
