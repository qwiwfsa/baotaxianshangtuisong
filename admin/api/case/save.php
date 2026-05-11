<?php
/**
 * 案例保存API - 统一写入MySQL（主数据源）
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

require_once __DIR__ . '/../../../config/db.php';

$jsonInput = file_get_contents('php://input');
$data = json_decode($jsonInput, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的JSON数据']);
    exit;
}

// ========== 提取数据 ==========
$caseId = isset($data['id']) ? intval(preg_replace('/[^0-9]/', '', $data['id'])) : 0;
$title = $data['title'] ?? '';
$category = $data['type'] ?? '';
$company = $data['city'] ?? '';
$amount = $data['amount'] ?? '';
$period = $data['period'] ?? '';
$description = $data['summary'] ?? '';
$image = $data['image'] ?? $data['coverImage'] ?? '';
$seo_title = $data['seo_title'] ?? '';
$seo_keywords = $data['seo_keywords'] ?? '';
$seo_description = $data['seo_description'] ?? '';

// images 处理
$images = $data['images'] ?? [];
if (!is_array($images)) $images = [$images];
if (empty($image) && !empty($images)) {
    $image = is_array($images) ? $images[0] : $images;
}

$status = (isset($data['status']) && $data['status'] === 'published') ? 1 : 0;

$content = json_encode([
    'detail' => $data['detail'] ?? $description,
    'highlights' => $data['highlights'] ?? [],
    'highlightTitle' => $data['highlightTitle'] ?? '',
    'process' => $data['process'] ?? [],
    'images' => $images,
    'coverImage' => $data['coverImage'] ?? $image,
    'hasVideo' => $data['hasVideo'] ?? false,
    'video' => $data['video'] ?? '',
    'original_id' => $data['id'] ?? ''
], JSON_UNESCAPED_UNICODE);

try {
    $conn = getDB();
    $isNew = false;

    if ($caseId > 0) {
        // 检查是否已存在
        $check = $conn->prepare("SELECT id FROM cases WHERE id = ?");
        $check->bind_param("i", $caseId);
        $check->execute();
        $exists = $check->get_result()->fetch_assoc();
        $check->close();

        if ($exists) {
            // 更新
            $stmt = $conn->prepare("UPDATE cases SET title=?, category=?, company=?, amount=?, period=?, description=?, image=?, content=?, status=?, updated_at=NOW() WHERE id=?");
            $stmt->bind_param("sssssssssi", $title, $category, $company, $amount, $period, $description, $image, $content, $status, $caseId);
        } else {
            // ID存在但不在表中 -> INSERT
            $isNew = true;
            $stmt = $conn->prepare("INSERT INTO cases (id, title, category, company, amount, period, description, image, content, status, seo_title, seo_keywords, seo_description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
            $stmt->bind_param("issssssssisss", $caseId, $title, $category, $company, $amount, $period, $description, $image, $content, $status, $seo_title, $seo_keywords, $seo_description);
        }
    } else {
        // 新建：自增ID
        $isNew = true;
        $stmt = $conn->prepare("INSERT INTO cases (title, category, company, amount, period, description, image, content, status, seo_title, seo_keywords, seo_description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssssssssisss", $title, $category, $company, $amount, $period, $description, $image, $content, $status, $seo_title, $seo_keywords, $seo_description);
    }

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => '保存失败: ' . $stmt->error]);
        $stmt->close();
        $conn->close();
        exit;
    }

    // 获取插入的ID
    if ($isNew) {
        $caseId = $stmt->insert_id;
    }

    $stmt->close();

    // ========== 也同步写入JSON文件（辅助，便于前端直接读取） ==========
    $now = date('Y-m-d H:i:s');
    $dataDir = dirname(dirname(__DIR__)) . '/data/cases/';
    $indexFile = dirname(dirname(__DIR__)) . '/data/cases-index.json';
    
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }

    $caseArr = [
        'id' => (string)$caseId,
        'title' => $title,
        'type' => $category,
        'city' => $company,
        'amount' => $amount,
        'period' => $period,
        'summary' => $description,
        'detail' => $data['detail'] ?? $description,
        'image' => $image,
        'coverImage' => $data['coverImage'] ?? $image,
        'images' => $images,
        'highlights' => $data['highlights'] ?? [],
        'process' => $data['process'] ?? [],
        'hasVideo' => $data['hasVideo'] ?? false,
        'video' => $data['video'] ?? '',
        'status' => $status ? 'published' : 'draft',
        'createdAt' => $now,
        'lastModified' => $now
    ];
    @file_put_contents($dataDir . $caseId . '.json', json_encode($caseArr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    // 更新索引
    $idx = [];
    if (file_exists($indexFile)) {
        $idx = json_decode(file_get_contents($indexFile), true);
        if (!is_array($idx)) $idx = [];
    }
    $idx = array_filter($idx, fn($c) => $c['id'] !== (string)$caseId);
    $idx[] = [
        'id' => (string)$caseId,
        'title' => $title,
        'type' => $category,
        'city' => $company,
        'amount' => $amount,
        'image' => $image,
        'coverImage' => $data['coverImage'] ?? $image,
        'images' => $images,
        'status' => $status ? 'published' : 'draft',
        'summary' => $description,
        'lastModified' => $now
    ];
    @file_put_contents($indexFile, json_encode(array_values($idx), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    // ========== 返回 ==========
    echo json_encode([
        'success' => true,
        'message' => $isNew ? '案例新建成功' : '案例更新成功',
        'case' => [
            'id' => (string)$caseId,
            'title' => $title,
            'type' => $category,
            'city' => $company,
            'amount' => $amount,
            'period' => $period,
            'summary' => $description,
            'detail' => $data['detail'] ?? $description,
            'image' => $image,
            'coverImage' => $data['coverImage'] ?? $image,
            'images' => $images,
            'highlights' => $data['highlights'] ?? [],
            'process' => $data['process'] ?? [],
            'hasVideo' => $data['hasVideo'] ?? false,
            'video' => $data['video'] ?? '',
            'status' => $status ? 'published' : 'draft',
            'lastModified' => $now
        ]
    ], JSON_UNESCAPED_UNICODE);

    $conn->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '服务器错误: ' . $e->getMessage()]);
}
