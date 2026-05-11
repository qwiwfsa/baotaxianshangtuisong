<?php
/**
 * CMS图片上传API - 简化版
 */

header('Content-Type: application/json; charset=utf-8');

// 捕获错误
error_reporting(E_ALL);
ini_set('display_errors', 0);

// 获取原始输出
$rawOutput = '';

// 配置
// 优先使用 uploads/ 目录（与前端一致）
$uploadDir = __DIR__ . '/../../uploads/';
$baseUrl = '/uploads/';

// 如果uploads目录不存在，回退到cms/uploads
if (!file_exists($uploadDir)) {
    $uploadDir = __DIR__ . '/../../cms/uploads/';
    $baseUrl = '/cms/uploads/';
}

$maxFileSize = 5 * 1024 * 1024; // 5MB

// 确保目录存在
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// 检查文件上传
$fileKey = isset($_FILES['image']) ? 'image' : 'file';
if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '上传失败，错误码: ' . ($_FILES[$fileKey]['error'] ?? '无文件')]);
    exit;
}

$file = $_FILES[$fileKey];

// 检查大小
if ($file['size'] > $maxFileSize) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '文件超过5MB']);
    exit;
}

// 生成文件名
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = date('Ymd') . '_' . uniqid() . '.' . $ext;
$targetPath = $uploadDir . $filename;

// 移动文件
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    // 返回相对路径，让前端统一处理
    $relativePath = 'uploads/' . $filename;
    echo json_encode([
        'success' => true,
        'message' => '上传成功',
        'data' => [
            'url' => $relativePath,
            'filename' => $filename
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '保存失败']);
}
