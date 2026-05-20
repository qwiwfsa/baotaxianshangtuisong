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
if (!$ids || !$action) { echo json_encode(["success"=>false]); exit; }
if (!is_array($ids)) $ids = [$ids];

$conn = getDbConnection();
$done = 0;
foreach ($ids as $id) {
    $id = intval($id);
    if ($action === "move") {
        $fid = intval($input["folder_id"] ?? 0);
        $conn->query("UPDATE media SET folder_id = $fid WHERE id = $id");
        $done++;
    } elseif ($action === "delete") {
        $conn->query("UPDATE media SET is_deleted = 1, deleted_at = NOW() WHERE id = $id");
        $done++;
    } elseif ($action === "restore") {
        $conn->query("UPDATE media SET is_deleted = 0, deleted_at = NULL WHERE id = $id");
        $done++;
    } elseif ($action === "permanent_delete") {
        $r = $conn->query("SELECT file_path, webp_path, thumbnail_path FROM media WHERE id = $id");
        if ($row = $r->fetch_assoc()) {
            $up = __DIR__ . "/../../uploads";
            @unlink($up . $row["file_path"]);
            if ($row["webp_path"]) @unlink($up . $row["webp_path"]);
            if ($row["thumbnail_path"]) @unlink($up . $row["thumbnail_path"]);
        }
        $conn->query("DELETE FROM media WHERE id = $id");
        $done++;
    }
}
echo json_encode(["success"=>true,"message"=>"$done processed"], JSON_UNESCAPED_UNICODE);
