<?php
require_once __DIR__ . '/../config.php';
setApiHeaders();
handlePreflight();

$db = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $result = $db->query("SELECT skey, svalue FROM comment_settings");
    $settings = [];
    while ($row = $result->fetch_assoc()) {
        $settings[$row['skey']] = $row['svalue'];
    }
    jsonSuccess($settings);
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    foreach (['auto_approve'] as $key) {
        if (isset($input[$key])) {
            $val = (string)$input[$key];
            $stmt = $db->prepare("INSERT INTO comment_settings (skey, svalue) VALUES (?, ?) ON DUPLICATE KEY UPDATE svalue = ?");
            $stmt->bind_param('sss', $key, $val, $val);
            $stmt->execute();
        }
    }
    jsonSuccess([], ['message' => '已保存']);
}
