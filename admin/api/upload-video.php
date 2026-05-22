<?php
/**
 * 视频上传API - 上传到阿里云服务器
 * 保存路径: /www/wwwroot/47.95.236.85/uploads/videos/
 */

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

// 配置 - 上传到本地uploads/videos目录
// __DIR__ = D:\yingyong\xampp\htdocs\hongdu\admin\api\
// 需要指向 D:\yingyong\xampp\htdocs\hongdu\uploads\videos\
$uploadDir = dirname(dirname(__DIR__)) . '/uploads/videos/';
$webPath = 'uploads/videos/';
$allowedTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime', 'video/x-msvideo'];
$maxFileSize = 50 * 1024 * 1024; // 50MB

// 确保上传目录存在
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => '创建上传目录失败']);
        exit;
    }
}

// 检查目录是否可写
if (!is_writable($uploadDir)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '上传目录没有写入权限']);
    exit;
}

// 检查是否有文件上传
$fileKey = isset($_FILES['video']) ? 'video' : 'file';
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

// 检查文件类型
// Use extension-based MIME detection (no fileinfo dependency)
$ext_v = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$extMimeMap = ['mp4'=>'video/mp4','webm'=>'video/webm','ogg'=>'video/ogg','mov'=>'video/quicktime','avi'=>'video/x-msvideo'];
$mimeType = isset($extMimeMap[$ext_v]) ? $extMimeMap[$ext_v] : 'video/mp4';

if (!in_array($mimeType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '不支持的文件类型，只允许: ' . implode(', ', $allowedTypes)]);
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
if (empty($extension)) {
    $extension = 'mp4'; // 默认扩展名
}
$filename = date('Ymd') . '_' . uniqid() . '.' . $extension;
$targetPath = $uploadDir . $filename;

// 移动上传的文件
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    // 生成相对路径URL
    $url = '/' . $webPath . $filename;
    
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
    echo json_encode(['success' => false, 'message' => '文件保存失败，目标路径: ' . $targetPath]);
}
