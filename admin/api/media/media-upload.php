<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}
$uploadDir = __DIR__ . '/../../../uploads/media/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
$response = ['success' => false, 'message' => 'No file uploaded'];
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $origName = basename($_FILES['file']['name']);
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp','svg','ico','pdf','doc','docx','xls','xlsx','mp4','webm'];
    if (!in_array($ext, $allowed)) {
        echo json_encode(['success' => false, 'message' => 'File type not allowed']);
        exit;
    }
    $filename = uniqid('media_') . '.' . $ext;
    $filepath = $uploadDir . $filename;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
        $relativePath = '/uploads/media/' . $filename;
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];
        try {
            $conn = getDbConnection();
            $stmt = $conn->prepare("INSERT INTO media (filename, original_name, file_path, file_type, file_size) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $filename, $origName, $relativePath, $fileType, $fileSize);
            $stmt->execute();
            $id = $conn->insert_id;
            $stmt->close();
            $response = [
                'success' => true,
                'data' => ['id' => $id, 'filename' => $filename, 'original_name' => $origName, 'file_path' => $relativePath, 'file_type' => $fileType, 'file_size' => $fileSize]
            ];
        } catch (Exception $e) {
            $response = ['success' => false, 'message' => 'DB error: ' . $e->getMessage()];
        }
    } else {
        $response = ['success' => false, 'message' => 'Failed to save file'];
    }
} else {
    $errCode = isset($_FILES['file']) ? $_FILES['file']['error'] : 'no file';
    $response = ['success' => false, 'message' => 'Upload error: ' . $errCode];
}
echo json_encode($response);
