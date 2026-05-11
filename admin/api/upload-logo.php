<?php
/**
 * Logo上传API
 * 上传Logo图片到 uploads/logo/ 目录
 * 返回上传后的文件URL
 */

require_once __DIR__ . '/common.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError('只支持POST请求', 405);
}

// 检查是否有文件上传
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $errorCode = isset($_FILES['file']) ? $_FILES['file']['error'] : '无文件';
    jsonError('文件上传失败，错误代码: ' . $errorCode);
}

$file = $_FILES['file'];

// 验证文件类型
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml', 'image/x-icon', 'image/vnd.microsoft.icon'];
$maxFileSize = 2 * 1024 * 1024; // 2MB

if (!in_array($file['type'], $allowedTypes)) {
    jsonError('不支持的文件类型，允许: JPG, PNG, GIF, WebP, SVG, ICO');
}

if ($file['size'] > $maxFileSize) {
    jsonError('文件大小超过限制（最大2MB）');
}

// 创建上传目录
$uploadDir = dirname(__DIR__, 2) . '/uploads/logo';
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        jsonError('无法创建上传目录');
    }
}

// 生成文件名
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
if (empty($ext)) {
    $mimeMap = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
        'image/svg+xml' => 'svg',
        'image/x-icon' => 'ico',
        'image/vnd.microsoft.icon' => 'ico'
    ];
    $ext = isset($mimeMap[$file['type']]) ? $mimeMap[$file['type']] : 'png';
}

$filename = 'logo_' . date('Ymd_His') . '_' . uniqid() . '.' . $ext;
$destPath = $uploadDir . '/' . $filename;

// 移动上传文件
if (!move_uploaded_file($file['tmp_name'], $destPath)) {
    jsonError('文件保存失败');
}

// 返回相对路径
$url = 'uploads/logo/' . $filename;

jsonSuccess([
    'url' => $url,
    'filename' => $filename,
    'size' => $file['size'],
    'type' => $file['type']
], '上传成功');
