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

    // 获取所有已审核评论（包括回复）
    $stmt = $db->prepare("SELECT id, parent_id, nickname, content, created_at FROM article_comments WHERE article_id = ? AND status = 1 ORDER BY created_at ASC");
    $stmt->bind_param('i', $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $allComments = [];
    while ($row = $result->fetch_assoc()) {
        $allComments[] = [
            'id' => intval($row['id']),
            'parent_id' => $row['parent_id'] ? intval($row['parent_id']) : null,
            'nickname' => htmlspecialchars($row['nickname'], ENT_QUOTES, 'UTF-8'),
            'content' => htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'),
            'created_at' => date('Y-m-d H:i', strtotime($row['created_at']))
        ];
    }

    // 构建树形结构：顶级评论 + replies
    $commentMap = [];
    $rootComments = [];

    foreach ($allComments as $c) {
        $c['replies'] = [];
        $commentMap[$c['id']] = $c;
    }

    foreach ($commentMap as $id => &$c) {
        if ($c['parent_id'] && isset($commentMap[$c['parent_id']])) {
            $commentMap[$c['parent_id']]['replies'][] = &$c;
        } else {
            // 去掉 parent_id 遗留指向（parent 被删除等）
            $c['parent_id'] = null;
            $rootComments[] = &$c;
        }
    }
    unset($c);

    jsonSuccess($rootComments);
} catch (Exception $e) {
    jsonError('获取评论失败');
}
