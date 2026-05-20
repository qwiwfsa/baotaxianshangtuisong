<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }

$page = max(1, intval($_GET["page"] ?? 1));
$limit = min(100, intval($_GET["limit"] ?? 20));
$offset = ($page - 1) * $limit;
$category = trim($_GET["category"] ?? "");
$status = $_GET["status"] ?? "";

$conn = getDbConnection();
$where = "WHERE 1=1";
if ($category) { $s = $conn->real_escape_string($category); $where .= " AND category = '$s'"; }
if ($status !== "") { $where .= " AND status = " . intval($status); }

$total = $conn->query("SELECT COUNT(*) FROM announcements $where")->fetch_row()[0];
$r = $conn->query("SELECT * FROM announcements $where ORDER BY priority DESC, created_at DESC LIMIT $limit OFFSET $offset");
$data = [];
while ($row = $r->fetch_assoc()) {
    $row["content_short"] = mb_strlen(strip_tags($row["content"])) > 80 ? mb_substr(strip_tags($row["content"]), 0, 80) . "..." : strip_tags($row["content"]);
    $data[] = $row;
}
echo json_encode(["success"=>true,"data"=>$data,"total"=>intval($total),"page"=>$page,"pages"=>ceil($total/$limit)], JSON_UNESCAPED_UNICODE);
