<?php
/**
 * 案例详情获取API
 * 主数据源：MySQL；fallback：JSON文件
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

$caseId = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($caseId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少案例ID']);
    exit;
}

$caseId = preg_replace('/[^0-9a-zA-Z_-]/', '', $caseId);
$numericId = intval(preg_replace('/[^0-9]/', '', $caseId));

$caseData = null;

// ========== 1. MySQL（主数据源） ==========
if ($numericId > 0) {
    try {
        require_once __DIR__ . '/../../../config/db.php';
        $conn = getDB();
        $stmt = $conn->prepare("SELECT * FROM cases WHERE id = ?");
        $bindId = $numericId;
        $stmt->bind_param("i", $bindId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();

        if ($row) {
            $contentData = [];
            if (!empty($row['content'])) {
                $parsed = json_decode($row['content'], true);
                if (is_array($parsed)) $contentData = $parsed;
            }

            $caseData = [
                'id' => (string)$row['id'],
                'title' => $row['title'],
                'type' => $row['category'],
                'city' => $row['company'],
                'amount' => $row['amount'],
                'period' => $row['period'],
                'summary' => $row['description'],
                'detail' => $contentData['detail'] ?? $row['description'] ?? '',
                'image' => $row['image'],
                'coverImage' => $contentData['coverImage'] ?? $row['image'] ?? '',
                'images' => $contentData['images'] ?? [],
                'highlights' => $contentData['highlights'] ?? [],
                'highlightTitle' => $contentData['highlightTitle'] ?? '',
                'process' => $contentData['process'] ?? [],
                'hasVideo' => $contentData['hasVideo'] ?? false,
                'video' => $contentData['video'] ?? '',
                'status' => $row['status'] ? 'published' : 'draft',
                'createdAt' => $row['created_at'] ?? '',
                'lastModified' => $row['updated_at'] ?? '',
                '_source' => 'mysql'
            ];
        }
    } catch (Exception $e) {
        error_log('[get.php] MySQL读取失败: ' . $e->getMessage());
    }
}

// ========== 2. JSON fallback ==========
if (!$caseData) {
    $dataDir = dirname(dirname(__DIR__)) . '/data/cases/';
    // 尝试多种文件名（前端可能传纯数字或case_xx格式）
    $candidates = [$caseId, 'case_' . $caseId, $numericId, 'case_' . $numericId];
    $candidates = array_unique(array_filter($candidates));
    foreach ($candidates as $c) {
        $f = $dataDir . $c . '.json';
        if (file_exists($f)) {
            $caseData = json_decode(file_get_contents($f), true);
            if ($caseData) {
                $caseData['_source'] = 'json';
                break;
            }
        }
    }
}

// ========== 3. 返回 ==========
if ($caseData) {
    echo json_encode(['success' => true, 'case' => $caseData], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => '案例不存在']);
}
