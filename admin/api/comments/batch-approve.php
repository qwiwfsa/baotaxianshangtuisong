<?php
require_once __DIR__ . '/../config.php';
setApiHeaders();
handlePreflight();
requireMethod('POST');

$input = json_decode(file_get_contents('php://input'), true);
$ids = isset($input['ids']) ? $input['ids'] : [];
$status = isset($input['status']) ? intval($input['status']) : 1;

if (empty($ids) || !is_array($ids) || !in_array($status, [1, 2])) {
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
    $stmt = $db->prepare("UPDATE article_comments SET status = ? WHERE id IN ($placeholders)");
    $all_params = array_merge([$status], $ids);
    $all_types = 'i' . $types;
    $stmt->bind_param($all_types, ...$all_params);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    jsonSuccess(['updated' => $affected], ['message' => "已处理{$affected}条评论"]);
} catch (Exception $e) {
    jsonError('操作失败: ' . $e->getMessage());
}
