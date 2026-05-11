<?php
/**
 * 公用函数 - API通用接口
 */

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// 数据目录路径
define('DATA_DIR', dirname(__DIR__) . '/data');

/**
 * 读取JSON数据文件
 */
function readDataFile($filename) {
    $path = DATA_DIR . '/' . $filename;
    if (!file_exists($path)) {
        file_put_contents($path, '{}', LOCK_EX);
        return [];
    }
    $content = file_get_contents($path);
    $data = json_decode($content, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return [];
    }
    return $data;
}

/**
 * 写入JSON数据文件
 */
function writeDataFile($filename, $data) {
    $path = DATA_DIR . '/' . $filename;
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0755, true);
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return file_put_contents($path, $json, LOCK_EX) !== false;
}

/**
 * 返回成功响应
 */
function jsonSuccess($data = null, $msg = 'success') {
    $result = ['code' => 0, 'msg' => $msg];
    if ($data !== null) {
        $result['data'] = $data;
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * 返回错误响应
 */
function jsonError($msg = 'error', $code = 1) {
    echo json_encode(['code' => $code, 'msg' => $msg], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * 获取POST参数（支持JSON body）
 */
function getPostParam($key, $default = null) {
    $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    if (strpos($contentType, 'application/json') !== false) {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($data[$key])) {
            return $data[$key];
        }
        return $default;
    }
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

/**
 * 获取GET参数
 */
function getGetParam($key, $default = null) {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

/**
 * 获取所有POST参数（JSON body或form data）
 */
function getAllPostParams() {
    $contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
    if (strpos($contentType, 'application/json') !== false) {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $data;
        }
    }
    return $_POST;
}
