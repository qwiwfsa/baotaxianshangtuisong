<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }

$page = max(1, intval($_GET["page"] ?? 1));
$limit = min(100, intval($_GET["limit"] ?? 30));
$offset = ($page - 1) * $limit;

$conn = getDbConnection();
$total = $conn->query("SELECT COUNT(*) FROM media_logs")->fetch_row()[0];
$r = $conn->query("SELECT * FROM media_logs ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
$logs = [];
while ($row = $r->fetch_assoc()) $logs[] = $row;
echo json_encode(["success"=>true,"data"=>$logs,"total"=>intval($total),"page"=>$page,"pages"=>ceil($total/$limit)], JSON_UNESCAPED_UNICODE);
