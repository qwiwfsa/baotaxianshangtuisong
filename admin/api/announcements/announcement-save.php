<?php
require_once __DIR__ . "/../config.php";
requireAdmin();
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }
if ($_SERVER["REQUEST_METHOD"] !== "POST") { echo json_encode(["success"=>false,"message"=>"POST only"]); exit; }
$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data["id"] ?? 0);
$title = $data["title"] ?? "";
$content = $data["content"] ?? "";
$status = intval($data["status"] ?? 1);
$priority = intval($data["priority"] ?? 0);
$category = $data["category"] ?? "general";
$publish_at = ($data["publish_at"] ?? "") ?: null;
$expire_at = ($data["expire_at"] ?? "") ?: null;

$conn = getDbConnection();
if ($id > 0) {
    $stmt = $conn->prepare("UPDATE announcements SET title=?, content=?, status=?, priority=?, category=?, publish_at=?, expire_at=?, updated_at=NOW() WHERE id=?");
    $stmt->bind_param("ssiisssi", $title, $content, $status, $priority, $category, $publish_at, $expire_at, $id);
} else {
    $stmt = $conn->prepare("INSERT INTO announcements (title, content, status, priority, category, publish_at, expire_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiisss", $title, $content, $status, $priority, $category, $publish_at, $expire_at);
}
$stmt->execute();
echo json_encode(["success"=>true, "data"=>["id"=>$id ?: $conn->insert_id]], JSON_UNESCAPED_UNICODE);
