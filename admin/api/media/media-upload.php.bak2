<?php
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

// Get settings
$settings = [];
$sr = $db->query("SELECT skey, svalue FROM media_settings");
while ($srow = $sr->fetch_assoc()) $settings[$srow["skey"]] = $srow["svalue"];

for ($i = 0; $i < count($names); $i++) {
    if ($errs[$i] !== UPLOAD_ERR_OK) { $errlist[] = $names[$i]; continue; }
    $orig = $names[$i]; $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) { $errlist[] = $orig . ":bad format"; continue; }

    $newname = date("Ymd_") . bin2hex(random_bytes(8)) . "." . $ext;
    $dest = $upload_dir . "/" . $newname;
    if (!move_uploaded_file($tmps[$i], $dest)) { $errlist[] = $orig; continue; }

    $fsize = filesize($dest);
    $rel = str_replace(__DIR__ . "/../../uploads", "", $dest);
    $mime = mime_content_type($dest) ?: "application/octet-stream";
    $width = $height = 0;
    $webp_path = $thumb_path = "";
    $is_img = in_array($ext, ["jpg","jpeg","png","webp","gif","bmp"]);

    // === IMAGE PROCESSING ===
    if ($is_img) {
        // Get dimensions
        $info = @getimagesize($dest);
        if ($info) { $width = $info[0]; $height = $info[1]; }

        // Remove EXIF
        if (($settings["exif_remove"] ?? "1") === "1" && extension_loaded("imagick")) {
            try { $img = new Imagick($dest); $img->stripImage(); $img->writeImage($dest); $img->destroy(); } catch (Exception $e) {}
        }

        // Resize if too large
        $maxW = intval($settings["max_width"] ?? 1920);
        $maxH = intval($settings["max_height"] ?? 1920);
        if (($width > $maxW || $height > $maxH) && function_exists("imagecreatetruecolor")) {
            $ratio = min($maxW / $width, $maxH / $height);
            $nw = intval($width * $ratio); $nh = intval($height * $ratio);
            $srcImg = null;
            if ($ext == "jpg" || $ext == "jpeg") $srcImg = @imagecreatefromjpeg($dest);
            elseif ($ext == "png") $srcImg = @imagecreatefrompng($dest);
            elseif ($ext == "webp") $srcImg = @imagecreatefromwebp($dest);
            if ($srcImg) {
                $dstImg = imagecreatetruecolor($nw, $nh);
                if ($ext == "png") { imagealphablending($dstImg, false); imagesavealpha($dstImg, true); }
                imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $nw, $nh, $width, $height);
                $q = intval($settings["compression_quality"] ?? 85);
                if ($ext == "jpg" || $ext == "jpeg") imagejpeg($dstImg, $dest, $q);
                elseif ($ext == "png") imagepng($dstImg, $dest, intval(9 - $q/12));
                elseif ($ext == "webp") imagewebp($dstImg, $dest, $q);
                imagedestroy($srcImg); imagedestroy($dstImg);
                $width = $nw; $height = $nh; $fsize = filesize($dest);
            }
        }

        // Compress (for jpg/png/webp that weren't already resized)
        if (($width <= $maxW && $height <= $maxH) && function_exists("imagecreatefromjpeg")) {
            $q = intval($settings["compression_quality"] ?? 85);
            $srcImg = null;
            if ($ext == "jpg" || $ext == "jpeg") $srcImg = @imagecreatefromjpeg($dest);
            elseif ($ext == "webp") $srcImg = @imagecreatefromwebp($dest);
            if ($srcImg && $ext != "png") {
                if ($ext == "webp") imagewebp($srcImg, $dest, $q);
                else imagejpeg($srcImg, $dest, $q);
                imagedestroy($srcImg);
                $fsize = filesize($dest);
            }
        }

        // Create thumbnail
        $tdir = $upload_dir . "/.thumbs";
        if (!is_dir($tdir)) mkdir($tdir, 0755, true);
        $thumb_file = $tdir . "/" . $newname;
        if ($width > 0 && function_exists("imagecreatetruecolor")) {
            $tw = 400; $th = intval($height * 400 / $width);
            $srcImg = null;
            if ($ext == "jpg" || $ext == "jpeg") $srcImg = @imagecreatefromjpeg($dest);
            elseif ($ext == "png") $srcImg = @imagecreatefrompng($dest);
            elseif ($ext == "webp") $srcImg = @imagecreatefromwebp($dest);
            if ($srcImg) {
                $dstImg = imagecreatetruecolor($tw, $th);
                imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $tw, $th, $width, $height);
                imagejpeg($dstImg, $thumb_file, 80);
                imagedestroy($srcImg); imagedestroy($dstImg);
                $thumb_path = str_replace(__DIR__ . "/../../uploads", "", $thumb_file);
            }
        }

        // Watermark
        if (($settings["watermark_enabled"] ?? "0") === "1" && function_exists("imagecreatefromjpeg")) {
            $wmText = $settings["watermark_text"] ?? "Yao";
            $srcImg = null;
            if ($ext == "jpg" || $ext == "jpeg") $srcImg = @imagecreatefromjpeg($dest);
            elseif ($ext == "png") $srcImg = @imagecreatefrompng($dest);
            elseif ($ext == "webp") $srcImg = @imagecreatefromwebp($dest);
            if ($srcImg) {
                $w = imagesx($srcImg); $h = imagesy($srcImg);
                $fs = max(10, intval($w / 40));
                $c = imagecolorallocatealpha($srcImg, 255, 255, 255, 70);
                $x = $w - ($fs * mb_strlen($wmText) * 0.7) - 20;
                $y = $h - $fs - 20;
                imagestring($srcImg, 5, intval($x), intval($y), $wmText, $c);
                $q = intval($settings["compression_quality"] ?? 85);
                if ($ext == "jpg" || $ext == "jpeg") imagejpeg($srcImg, $dest, $q);
                elseif ($ext == "png") imagepng($srcImg, $dest, 9);
                elseif ($ext == "webp") imagewebp($srcImg, $dest, $q);
                imagedestroy($srcImg);
                $fsize = filesize($dest);
            }
        }

        // WebP conversion
        if (($settings["webp_enabled"] ?? "1") === "1" && $ext != "webp" && $ext != "svg" && function_exists("imagecreatefromjpeg")) {
            $webp_file = preg_replace("/\.(jpg|jpeg|png)$/i", ".webp", $dest);
            $srcImg = null;
            if ($ext == "jpg" || $ext == "jpeg") $srcImg = @imagecreatefromjpeg($dest);
            elseif ($ext == "png") $srcImg = @imagecreatefrompng($dest);
            if ($srcImg) {
                imagepalettetotruecolor($srcImg);
                imagewebp($srcImg, $webp_file, 80);
                imagedestroy($srcImg);
                if (file_exists($webp_file)) $webp_path = str_replace(__DIR__ . "/../../uploads", "", $webp_file);
            }
        }
    }

    $sql = "INSERT INTO media (filename, original_name, file_path, file_type, file_size, folder_id, width, height, webp_path, thumbnail_path, is_deleted, used_in) VALUES ('"
        . $db->real_escape_string($newname) . "', '"
        . $db->real_escape_string($orig) . "', '"
        . $db->real_escape_string($rel) . "', '"
        . $db->real_escape_string($mime) . "', $fsize, $folder_id, $width, $height, '"
        . $db->real_escape_string($webp_path) . "', '"
        . $db->real_escape_string($thumb_path) . "', 0, '')";
    $db->query($sql);
    $mid = $db->insert_id;

    // Log
    $ip = $_SERVER["REMOTE_ADDR"] ?? "";
    $db->query("INSERT INTO media_logs (media_id, action, detail, ip) VALUES ($mid, 'upload', '" . $db->real_escape_string($orig) . "', '" . $db->real_escape_string($ip) . "')");

    $uploaded[] = ["id"=>$mid,"filename"=>$newname,"original_name"=>$orig,"url"=>"/uploads".$rel,"thumb"=>$thumb_path?"/uploads".$thumb_path:"","size"=>$fsize,"width"=>$width,"height"=>$height];
}
echo json_encode(["success"=>true,"data"=>["uploaded"=>$uploaded,"errors"=>$errlist]], JSON_UNESCAPED_UNICODE);
