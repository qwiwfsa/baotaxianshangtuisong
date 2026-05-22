<?php
/**
 * Media upload - basic upload + DB insert
 * Uses extension-based MIME detection (no fileinfo dependency)
 */
require_once __DIR__ . "/../config.php";
requireAdmin();
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

$upload_dir = __DIR__ . "/../../../uploads" . $folder_path;
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

$files = $_FILES["file"] ?? $_FILES["files"] ?? null;
if (!$files) { echo json_encode(["success"=>false,"message"=>"No file"]); exit; }

$names = is_array($files["name"]) ? $files["name"] : [$files["name"]];
$tmps  = is_array($files["tmp_name"]) ? $files["tmp_name"] : [$files["tmp_name"]];
$errs  = is_array($files["error"]) ? $files["error"] : [$files["error"]];
$sizes = is_array($files["size"]) ? $files["size"] : [$files["size"]];

$uploaded = [];
$errlist = [];
$allowed = ["jpg","jpeg","png","gif","webp","svg","pdf","doc","docx","xls","xlsx","mp4","mp3","ico","bmp","csv","txt","zip"];

$db = getDbConnection();

// MIME map - no fileinfo dependency
$mime_map = [
    "jpg"=>"image/jpeg","jpeg"=>"image/jpeg","png"=>"image/png",
    "gif"=>"image/gif","webp"=>"image/webp","svg"=>"image/svg+xml",
    "pdf"=>"application/pdf","doc"=>"application/msword",
    "docx"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "xls"=>"application/vnd.ms-excel",
    "xlsx"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "mp4"=>"video/mp4","mp3"=>"audio/mpeg","zip"=>"application/zip",
    "csv"=>"text/csv","txt"=>"text/plain","ico"=>"image/x-icon","bmp"=>"image/bmp",
];

for ($i = 0; $i < count($names); $i++) {
    if ($errs[$i] !== UPLOAD_ERR_OK) { $errlist[] = $names[$i]; continue; }
    $orig = $names[$i];
    $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) { $errlist[] = $orig . ":bad format"; continue; }

    $newname = date("Ymd_") . bin2hex(random_bytes(8)) . "." . $ext;
    $dest = $upload_dir . "/" . $newname;

    if (!move_uploaded_file($tmps[$i], $dest)) { $errlist[] = $orig; continue; }

    $fsize = filesize($dest);
    $rel = str_replace(__DIR__ . "/../../../uploads", "", $dest);
    $mime = isset($mime_map[$ext]) ? $mime_map[$ext] : "application/octet-stream";

    $width = $height = 0;
    $is_img = in_array($ext, ["jpg","jpeg","png","webp","gif","bmp"]);
    if ($is_img) {
        $info = @getimagesize($dest);
        if ($info) { $width = $info[0]; $height = $info[1]; }
    }

    $newname_esc = $db->real_escape_string($newname);
    $orig_esc = $db->real_escape_string($orig);
    $rel_esc = $db->real_escape_string($rel);
    $mime_esc = $db->real_escape_string($mime);

    $sql = "INSERT INTO media (filename, original_name, file_path, file_type, file_size, folder_id, width, height, webp_path, thumbnail_path, is_deleted, used_in) VALUES ('$newname_esc', '$orig_esc', '$rel_esc', '$mime_esc', $fsize, $folder_id, $width, $height, '', '', 0, '')";
    $db->query($sql);
    $mid = $db->insert_id;

    $ip = $_SERVER["REMOTE_ADDR"] ?? "";
    $db->query("INSERT INTO media_logs (media_id, action, detail, ip) VALUES ($mid, 'upload', '$orig_esc', '" . $db->real_escape_string($ip) . "')");

    $uploaded[] = [
        "id" => $mid,
        "filename" => $newname,
        "original_name" => $orig,
        "url" => "/uploads" . $rel,
        "thumb" => "",
        "size" => $fsize,
        "width" => $width,
        "height" => $height,
    ];
}

echo json_encode(["success"=>true, "data"=>["uploaded"=>$uploaded, "errors"=>$errlist]], JSON_UNESCAPED_UNICODE);
