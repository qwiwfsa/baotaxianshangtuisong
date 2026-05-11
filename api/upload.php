<?php
/**
 * 文件上传API（稳健版）
 * - 目录不存在自动创建（多级备选）
 * - 数据库保存失败不影响文件上传（真正的软依赖）
 */

require_once 'config.php';

// 上传目录（按优先级尝试）
$uploadDirs = [];

// 主目录：项目根目录下的 uploads
$uploadDirs[] = __DIR__ . '/../uploads/';

// 备选1：当前目录下的 uploads
$uploadDirs[] = __DIR__ . '/uploads/';

// 备选2：上级目录下的 uploads
$uploadDirs[] = __DIR__ . '/../../uploads/';

// 最终确定的可用目录
$uploadDir = null;

foreach ($uploadDirs as $dir) {
    if (is_dir($dir)) {
        // 目录已存在，确认可写
        if (is_writable($dir)) {
            $uploadDir = $dir;
            break;
        }
    } else {
        // 尝试创建目录
        @mkdir($dir, 0755, true);
        clearstatcache();
        if (is_dir($dir) && is_writable($dir)) {
            $uploadDir = $dir;
            break;
        }
    }
}

// 实在没有可用目录
if ($uploadDir === null) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => '上传目录不可用，请在宝塔面板检查 /api/ 目录下是否存在 uploads/ 目录及其写入权限'
    ]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
    error('只支持POST请求', 405);
}

// 检查是否有文件上传（支持 file 和 image 两种字段名）
if (!isset($_FILES['file']) && !isset($_FILES['image'])) {
    error('没有上传文件');
}

$file = isset($_FILES['file']) ? $_FILES['file'] : $_FILES['image'];

// 检查上传错误
if ($file['error'] !== UPLOAD_ERR_OK) {
    error('上传失败: ' . $file['error']);
}

// 检查文件大小 (最大10MB)
$maxSize = 10 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    error('文件太大，最大支持10MB');
}

// 允许的文件类型
$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/gif' => 'gif',
    'image/webp' => 'webp',
    'application/pdf' => 'pdf',
    'video/mp4' => 'mp4'
];

$fileType = $file['type'];
if (!isset($allowedTypes[$fileType])) {
    error('不支持的文件类型: ' . $fileType);
}

// 生成唯一文件名
$extension = $allowedTypes[$fileType];
$filename = uniqid() . '_' . time() . '.' . $extension;
$filepath = $uploadDir . $filename;

// 移动上传的文件
if (!move_uploaded_file($file['tmp_name'], $filepath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => '文件保存失败，请检查uploads目录权限']);
    exit;
}

// 计算相对URL路径（从项目根目录算起）
$relativePath = 'uploads/' . $filename;

// 数据库保存（真正软依赖——文件已上传，数据库失败不影响）
// 注意：getDB() 在 config.php 中出错会 exit，所以我们直接写 PDO 连接
$dbSaved = false;
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare("INSERT INTO media (filename, original_name, file_path, file_type, file_size) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $filename,
        $file['name'],
        $relativePath,
        $fileType,
        $file['size']
    ]);
    
    $id = $pdo->lastInsertId();
    $dbSaved = true;
} catch (Exception $e) {
    // 数据库保存失败，不影响文件上传结果
    $dbSaved = false;
}

// 统一返回成功
http_response_code(200);
$result = [
    'success' => true,
    'data' => [
        'filename' => $filename,
        'original_name' => $file['name'],
        'url' => $relativePath,
        'size' => $file['size']
    ]
];

if ($dbSaved) {
    $result['data']['id'] = $id;
} else {
    $result['warning'] = '文件已上传，但数据库记录失败';
}

echo json_encode($result);
exit;
