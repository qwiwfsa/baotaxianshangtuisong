<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }
if ($_SERVER["REQUEST_METHOD"] !== "POST") { echo json_encode(["success"=>false,"message"=>"POST only"]); exit; }

$folder_id = intval($_POST["folder_id"] ?? 0);
$folder_path = "";
if ($folder_id > 0) {
    $db = getDbConnection();
    $r = $db->query("SELECT slug FROM media_folders WHERE id = $folder_id");
    if ($row = $r->fetch_assoc()) $folder_path = "/" . $row["slug"];
}
$upload_dir = __DIR__ . "/../../uploads" . $folder_path;
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

$files = $_FILES["file"] ?? $_FILES["files"] ?? null;
if (!$files) { echo json_encode(["success"=>false,"message"=>"No file"]); exit; }
$names = is_array($files["name"]) ? $files["name"] : [$files["name"]];
$tmps = is_array($files["tmp_name"]) ? $files["tmp_name"] : [$files["tmp_name"]];
$errs = is_array($files["error"]) ? $files["error"] : [$files["error"]];
$sizes = is_array($files["size"]) ? $files["size"] : [$files["size"]];

$uploaded = []; $errlist = [];
$allowed = ["jpg","jpeg","png","gif","webp","svg","pdf","doc","docx","xls","xlsx","mp4","mp3","ico","bmp","csv","txt","zip"];
$db = getDbConnection();

for ($i = 0; $i < count($names); $i++) {
    if ($errs[$i] !== UPLOAD_ERR_OK) { $errlist[] = $names[$i]; continue; }
    $orig = $names[$i]; $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) { $errlist[] = $orig; continue; }

    $newname = date("Ymd_") . bin2hex(random_bytes(8)) . "." . $ext;
    $dest = $upload_dir . "/" . $newname;
    if (!move_uploaded_file($tmps[$i], $dest)) { $errlist[] = $orig; continue; }

    $fsize = filesize($dest); $rel = str_replace(__DIR__ . "/../../uploads", "", $dest);
    $mime = mime_content_type($dest) ?: "application/octet-stream";
    $db->query("INSERT INTO media (filename, original_name, file_path, file_type, file_size, folder_id) VALUES ('" . $db->real_escape_string($newname) . "', '" . $db->real_escape_string($orig) . "', '" . $db->real_escape_string($rel) . "', '" . $db->real_escape_string($mime) . "', $fsize, $folder_id)");
    $uploaded[] = ["id"=>$db->insert_id,"filename"=>$newname,"original_name"=>$orig,"url"=>"/uploads".$rel,"size"=>$fsize];
}
echo json_encode(["success"=>true,"data"=>["uploaded"=>$uploaded,"errors"=>$errlist]], JSON_UNESCAPED_UNICODE);
