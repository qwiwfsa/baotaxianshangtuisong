<?php
require_once __DIR__ . "/../config.php";
requireAdmin();
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }

$input = json_decode(file_get_contents("php://input"), true);
$ids = $input["ids"] ?? [];
$action = $input["action"] ?? "";
if (!is_array($ids)) $ids = [$ids];

$conn = getDbConnection();
$done = 0;
foreach ($ids as $id) {
    $id = intval($id);
    if ($action === "publish") { $conn->query("UPDATE announcements SET status = 1 WHERE id = $id"); $done++; }
    elseif ($action === "unpublish") { $conn->query("UPDATE announcements SET status = 0 WHERE id = $id"); $done++; }
    elseif ($action === "top") { $conn->query("UPDATE announcements SET priority = 99 WHERE id = $id"); $done++; }
    elseif ($action === "untop") { $conn->query("UPDATE announcements SET priority = 0 WHERE id = $id"); $done++; }
    elseif ($action === "delete") { $conn->query("DELETE FROM announcements WHERE id = $id"); $done++; }
}
echo json_encode(["success"=>true,"message"=>"$done processed"], JSON_UNESCAPED_UNICODE);
