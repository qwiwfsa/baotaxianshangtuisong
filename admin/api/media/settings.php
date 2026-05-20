<?php
require_once __DIR__ . "/../config.php";
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(200); exit; }

$conn = getDbConnection();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $r = $conn->query("SELECT skey, svalue FROM media_settings");
    $settings = [];
    while ($row = $r->fetch_assoc()) $settings[$row["skey"]] = $row["svalue"];
    echo json_encode(["success"=>true,"data"=>$settings], JSON_UNESCAPED_UNICODE);
} else {
    $input = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("INSERT INTO media_settings (skey, svalue) VALUES (?, ?) ON DUPLICATE KEY UPDATE svalue = VALUES(svalue)");
    foreach ($input as $key => $val) {
        $stmt->bind_param("ss", $key, $val);
        $stmt->execute();
    }
    echo json_encode(["success"=>true], JSON_UNESCAPED_UNICODE);
}
