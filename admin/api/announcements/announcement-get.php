<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if (!$id) { echo json_encode(["success" => false, "message" => "Invalid ID"]); exit; }

$conn = getDbConnection();
// Increment view count
$conn->query("UPDATE announcements SET view_count = COALESCE(view_count, 0) + 1 WHERE id = $id");

$r = $conn->query("SELECT * FROM announcements WHERE id = $id");
if ($row = $r->fetch_assoc()) {
    echo json_encode(["success"=>true,"data"=>$row], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["success"=>false,"message"=>"Not found"]);
}
