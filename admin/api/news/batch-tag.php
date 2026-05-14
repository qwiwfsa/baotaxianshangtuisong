<?php
/**
 * 批量给文章添加标签 API
 * POST { ids: [], tag_ids: [] }
 * 对每篇文章，增量添加标签（不覆盖已有标签）
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '仅支持 POST 请求']);
    exit;
}

try {
    $conn = getDbConnection();
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data || empty($data['ids']) || !is_array($data['ids']) || empty($data['tag_ids']) || !is_array($data['tag_ids'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '参数错误：请提供 ids 和 tag_ids']);
        exit;
    }

    $articleIds = array_map('intval', $data['ids']);
    $tagIds = array_map('intval', $data['tag_ids']);
    $articleIds = array_filter($articleIds, function($v) { return $v > 0; });
    $tagIds = array_filter($tagIds, function($v) { return $v > 0; });

    if (empty($articleIds) || empty($tagIds)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => '参数错误：文章ID或标签ID不能为空']);
        exit;
    }

    $addedCount = 0;
    $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM article_tags WHERE article_id = ? AND tag_id = ?");
    $stmtInsert = $conn->prepare("INSERT IGNORE INTO article_tags (article_id, tag_id) VALUES (?, ?)");

    foreach ($articleIds as $aid) {
        foreach ($tagIds as $tid) {
            // 检查是否已存在
            $stmtCheck->bind_param("ii", $aid, $tid);
            $stmtCheck->execute();
            $stmtCheck->bind_result($exists);
            $stmtCheck->fetch();
            $stmtCheck->free_result();

            if ($exists == 0) {
                $stmtInsert->bind_param("ii", $aid, $tid);
                $stmtInsert->execute();
                $addedCount++;
            }
        }
    }

    $stmtCheck->close();
    $stmtInsert->close();
    $conn->close();

    echo json_encode([
        'success' => true,
        'message' => "成功添加 {$addedCount} 个标签关联",
        'data' => [
            'article_count' => count($articleIds),
            'tag_count' => count($tagIds),
            'added_count' => $addedCount
        ]
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '批量添加标签失败: ' . $e->getMessage()]);
}
