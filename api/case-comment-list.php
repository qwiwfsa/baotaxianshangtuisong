<?php
/**
 * 案例评论列表 API
 * GET /api/case-comment-list.php?case_id=X
 */
require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

$case_id = isset($_GET['case_id']) ? intval($_GET['case_id']) : 0;

if ($case_id <= 0) {
    jsonError('参数错误', 400);
}

try {
    $db = getDB();
    $stmt = $db->prepare("SELECT id, nickname, content, created_at FROM case_comments WHERE case_id = ? AND status = 1 ORDER BY created_at DESC LIMIT 100");
    $stmt->bind_param('i', $case_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            'id' => intval($row['id']),
            'nickname' => htmlspecialchars($row['nickname'], ENT_QUOTES, 'UTF-8'),
            'content' => htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'),
            'created_at' => date('Y-m-d H:i', strtotime($row['created_at']))
        ];
    }

    jsonSuccess($comments);
} catch (Exception $e) {
    jsonError('获取评论失败');
}

