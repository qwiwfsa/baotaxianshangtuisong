<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }

$conn = getDbConnection();
$method = $_SERVER["REQUEST_METHOD"];

if ($method === "GET") {
    $r = $conn->query("SELECT f.*, (SELECT COUNT(*) FROM media WHERE folder_id = f.id AND is_deleted = 0) as file_count FROM media_folders f ORDER BY f.sort_order, f.name");
    $folders = [];
    while ($row = $r->fetch_assoc()) $folders[] = $row;
    echo json_encode(["success"=>true,"data"=>$folders], JSON_UNESCAPED_UNICODE);
} elseif ($method === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    $name = trim($input["name"] ?? "");
    if (!$name) { echo json_encode(["success"=>false,"message"=>"Name required"]); exit; }
    $slug = preg_replace("/[^a-z0-9]/", "-", strtolower($name));
    $slug = trim($slug, "-") ?: "folder-" . time();
    $parent = intval($input["parent_id"] ?? 0);
    $conn->query("INSERT INTO media_folders (name, slug, parent_id) VALUES ('" . $conn->real_escape_string($name) . "', '" . $conn->real_escape_string($slug) . "', $parent)");
    $dir = __DIR__ . "/../../uploads/" . $slug;
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    echo json_encode(["success"=>true,"data"=>["id"=>$conn->insert_id,"name"=>$name,"slug"=>$slug]], JSON_UNESCAPED_UNICODE);
} elseif ($method === "DELETE") {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = intval($input["id"] ?? 0);
    if ($id <= 1) { echo json_encode(["success"=>false,"message"=>"Cannot delete default"]); exit; }
    $conn->query("UPDATE media SET folder_id = 1 WHERE folder_id = $id");
    $conn->query("DELETE FROM media_folders WHERE id = $id");
    echo json_encode(["success"=>true], JSON_UNESCAPED_UNICODE);
}
