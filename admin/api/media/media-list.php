<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }

$conn = getDbConnection();

// Handle POST for updating file metadata
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    $id = intval($input["id"] ?? 0);
    if (!$id) { echo json_encode(["success"=>false]); exit; }
    if (isset($input["alt_text"])) $conn->query("UPDATE media SET alt_text = '" . $conn->real_escape_string($input["alt_text"]) . "' WHERE id = $id");
    if (isset($input["title"])) $conn->query("UPDATE media SET title = '" . $conn->real_escape_string($input["title"]) . "' WHERE id = $id");
    if (isset($input["folder_id"])) $conn->query("UPDATE media SET folder_id = " . intval($input["folder_id"]) . " WHERE id = $id");
    echo json_encode(["success"=>true], JSON_UNESCAPED_UNICODE);
    exit;
}

// GET: list files
$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
$limit = isset($_GET["limit"]) ? min(100, intval($_GET["limit"])) : 30;
$offset = ($page - 1) * $limit;
$folder = isset($_GET["folder"]) ? intval($_GET["folder"]) : 0;
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$type = isset($_GET["type"]) ? $_GET["type"] : "";
$recycle = isset($_GET["recycle"]) ? intval($_GET["recycle"]) : 0;

$where = $recycle ? "WHERE m.is_deleted = 1" : "WHERE m.is_deleted = 0";
if ($folder > 0) $where .= " AND m.folder_id = " . $folder;
if ($search) {
    $s = $conn->real_escape_string($search);
    $where .= " AND (m.original_name LIKE '%$s%' OR m.filename LIKE '%$s%' OR m.alt_text LIKE '%$s%')";
}
if ($type === "image") $where .= " AND m.file_type LIKE 'image/%'";
elseif ($type === "document") $where .= " AND m.file_type NOT LIKE 'image/%' AND m.file_type NOT LIKE 'video/%'";
elseif ($type === "video") $where .= " AND m.file_type LIKE 'video/%'";

$total = $conn->query("SELECT COUNT(*) FROM media m $where")->fetch_row()[0];
$result = $conn->query("SELECT m.*, f.name as folder_name FROM media m LEFT JOIN media_folders f ON m.folder_id = f.id $where ORDER BY m.created_at DESC LIMIT $limit OFFSET $offset");

$files = [];
while ($row = $result->fetch_assoc()) {
    $row["url"] = "/uploads" . $row["file_path"];
    $row["thumb"] = $row["thumbnail_path"] ? ("/uploads" . $row["thumbnail_path"]) : "";
    $row["size_formatted"] = formatBytes($row["file_size"]);
    $files[] = $row;
}

function formatBytes($b) {
    if ($b < 1024) return $b . "B";
    if ($b < 1048576) return round($b/1024,1) . "KB";
    return round($b/1048576,1) . "MB";
}

echo json_encode(["success"=>true,"data"=>$files,"total"=>intval($total),"page"=>$page,"pages"=>ceil($total/$limit)], JSON_UNESCAPED_UNICODE);
