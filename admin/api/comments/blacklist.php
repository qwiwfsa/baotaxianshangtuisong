<?php
require_once __DIR__ . '/../config.php';
setApiHeaders();
handlePreflight();

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    if ($search !== '') {
        $stmt = $db->prepare("SELECT * FROM comment_blacklist WHERE value LIKE ? ORDER BY created_at DESC");
        $s = '%' . $search . '%';
        $stmt->bind_param('s', $s);
    } else {
        $stmt = $db->prepare("SELECT * FROM comment_blacklist ORDER BY created_at DESC");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    jsonSuccess($data);
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = isset($input['action']) ? $input['action'] : '';

    // Delete action
    if ($action === 'delete') {
        $id = isset($input['id']) ? intval($input['id']) : 0;
        if ($id <= 0) jsonError('参数错误', 400);
        $stmt = $db->prepare("DELETE FROM comment_blacklist WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        jsonSuccess([], ['message' => '已移除']);
    }

    // Add action (default)
    $type = isset($input['type']) ? trim($input['type']) : '';
    $value = isset($input['value']) ? trim($input['value']) : '';
    if (!in_array($type, ['nickname', 'ip']) || $value === '') {
        jsonError('参数错误', 400);
    }
    // Check duplicate
    $stmt = $db->prepare("SELECT id FROM comment_blacklist WHERE type = ? AND value = ?");
    $stmt->bind_param('ss', $type, $value);
    $stmt->execute();
    if ($stmt->get_result()->fetch_row()) {
        jsonError('该记录已存在', 400);
    }
    $stmt = $db->prepare("INSERT INTO comment_blacklist (type, value) VALUES (?, ?)");
    $stmt->bind_param('ss', $type, $value);
    $stmt->execute();
    jsonSuccess(['id' => $stmt->insert_id], ['message' => '已添加']);
}
