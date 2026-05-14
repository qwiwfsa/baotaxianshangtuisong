<?php
/**
 * CMS图片上传API
 * 支持图片上传、保存到uploads目录
 */

// 捕获所有错误并返回JSON
error_reporting(E_ALL);
ini_set('display_errors', 0);
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'PHP错误: ' . $errstr]);
    exit;
});

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

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

// 配置 - 统一使用 uploads/ 目录
$uploadDir = __DIR__ . '/../../uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

// 确保上传目录存在
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// 检查是否有文件上传
// 支持 image 和 file 两种字段名
$fileKey = isset($_FILES['image']) ? 'image' : 'file';
if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] === UPLOAD_ERR_NO_FILE) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '没有上传文件']);
    exit;
}

$file = $_FILES[$fileKey];

// 检查上传错误
if ($file['error'] !== UPLOAD_ERR_OK) {
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE => '文件大小超过服务器限制',
        UPLOAD_ERR_FORM_SIZE => '文件大小超过表单限制',
        UPLOAD_ERR_PARTIAL => '文件上传不完整',
        UPLOAD_ERR_NO_FILE => '没有文件被上传',
        UPLOAD_ERR_NO_TMP_DIR => '缺少临时文件夹',
        UPLOAD_ERR_CANT_WRITE => '文件写入失败',
        UPLOAD_ERR_EXTENSION => '上传被扩展阻止'
    ];
    $errorMessage = isset($errorMessages[$file['error']]) ? $errorMessages[$file['error']] : '上传失败';
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $errorMessage]);
    exit;
}

// 检查文件类型（使用扩展名验证，兼容无fileinfo扩展的环境）
$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$extMap = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'webp' => 'image/webp'];
$mimeType = isset($extMap[$extension]) ? $extMap[$extension] : $file['type'];

if (!in_array($mimeType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '不支持的文件类型，只允许: JPG, PNG, GIF, WebP']);
    exit;
}

// 检查文件大小
if ($file['size'] > $maxFileSize) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '文件大小超过限制，最大允许: ' . ($maxFileSize / 1024 / 1024) . 'MB']);
    exit;
}

// 生成唯一文件名
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = date('Ymd') . '_' . uniqid() . '.' . $extension;
$targetPath = $uploadDir . $filename;

// 移动上传的文件
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    // 生成URL - 统一使用 uploads/ 目录
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $baseDir = dirname(dirname(dirname($_SERVER['SCRIPT_NAME'])));
    $url = $baseDir . '/uploads/' . $filename;
    
    echo json_encode([
        'success' => true,
        'message' => '上传成功',
        'data' => [
            'filename' => $filename,
            'originalName' => $file['name'],
            'url' => $url,
            'size' => $file['size'],
            'mimeType' => $mimeType
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '文件保存失败']);
}
