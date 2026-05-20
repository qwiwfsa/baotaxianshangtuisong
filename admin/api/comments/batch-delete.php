<?php
require_once __DIR__ . '/../config.php';
setApiHeaders();
handlePreflight();
requireMethod('POST');

$input = json_decode(file_get_contents('php://input'), true);
$ids = isset($input['ids']) ? $input['ids'] : [];

if (empty($ids) || !is_array($ids)) {
    jsonError('参数错误', 400);
}

$ids = array_map('intval', $ids);
$ids = array_filter($ids, function($v) { return $v > 0; });

if (empty($ids)) {
    jsonError('参数错误', 400);
}

$placeholders = implode(',', array_fill(0, count($ids), '?'));
$types = str_repeat('i', count($ids));

try {
    $db = getDB();
    $stmt = $db->prepare("DELETE FROM article_comments WHERE id IN ($placeholders)");
    $stmt->bind_param($types, ...$ids);
    $stmt->execute();
    $deleted = $stmt->affected_rows;
    jsonSuccess(['deleted' => $deleted], ['message' => "成功删除{$deleted}条评论"]);
} catch (Exception $e) {
    jsonError('删除失败: ' . $e->getMessage());
}
