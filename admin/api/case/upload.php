<?php
/**
 * 案例图片/视频上传API
 * 支持图片和视频上传
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

// 获取上传类型
$uploadType = isset($_POST['type']) ? $_POST['type'] : 'image';

// 配置
$uploadDir = __DIR__ . '/../../../images/cases/';
$allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$allowedVideoTypes = ['video/mp4', 'video/webm', 'video/ogg'];
$maxImageSize = 10 * 1024 * 1024; // 10MB
$maxVideoSize = 100 * 1024 * 1024; // 100MB

// 确保上传目录存在
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// 检查是否有文件上传
$fileKey = $uploadType === 'video' ? 'video' : 'image';
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
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if ($uploadType === 'video') {
    if (!in_array($mimeType, $allowedVideoTypes)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '不支持的视频格式，只允许: MP4, WebM, OGG']);
        exit;
    }
    if ($file['size'] > $maxVideoSize) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '视频大小超过限制，最大允许: 100MB']);
        exit;
    }
} else {
    if (!in_array($mimeType, $allowedImageTypes)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '不支持的图片格式，只允许: JPG, PNG, GIF, WebP']);
        exit;
    }
    if ($file['size'] > $maxImageSize) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '图片大小超过限制，最大允许: 10MB']);
        exit;
    }
}

// 生成唯一文件名
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = 'case_' . date('Ymd') . '_' . uniqid() . '.' . $extension;
$targetPath = $uploadDir . $filename;

// 移动上传的文件
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    // 生成相对URL
    $url = 'images/cases/' . $filename;
    
    echo json_encode([
        'success' => true,
        'message' => '上传成功',
        'data' => [
            'filename' => $filename,
            'originalName' => $file['name'],
            'url' => $url,
            'fullUrl' => $url,
            'size' => $file['size'],
            'mimeType' => $mimeType,
            'type' => $uploadType
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '文件保存失败']);
}
