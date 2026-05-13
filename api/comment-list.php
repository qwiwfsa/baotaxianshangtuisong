<?php
require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('GET');

$article_id = isset($_GET['article_id']) ? intval($_GET['article_id']) : 0;

if ($article_id <= 0) {
    jsonError('参数错误', 400);
}

try {
    $db = getDB();
    $stmt = $db->prepare("SELECT id, nickname, content, created_at FROM article_comments WHERE article_id = ? AND status = 1 ORDER BY created_at DESC LIMIT 100");
    $stmt->bind_param('i', $article_id);
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
