<?php
/**
 * City Template API - Get/Save the common city page template
 */
require_once __DIR__ . "/config.php";
header('Content-Type: application/json; charset=utf-8');

$conn = getDB();
$action = $_POST['action'] ?? $_GET['action'] ?? 'get';

if ($action === 'get') {
    $stmt = $conn->prepare("SELECT content FROM cms_sections WHERE page_id='city_template' AND section_id='body' LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $row ? $row['content'] : ''], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($action === 'save') {
    $content = $_POST['content'] ?? '';

    $stmt = $conn->prepare("SELECT id FROM cms_sections WHERE page_id='city_template' AND section_id='body'");
    $stmt->execute();
    $exists = $stmt->get_result()->fetch_assoc();

    if ($exists) {
        $stmt = $conn->prepare("UPDATE cms_sections SET content=? WHERE page_id='city_template' AND section_id='body'");
    } else {
        $stmt = $conn->prepare("INSERT INTO cms_sections (page_id, section_id, section_name, content, sort_order) VALUES ('city_template', 'body', 'City Common Template', ?, 0)");
    }
    $stmt->bind_param('s', $content);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'msg' => 'Template saved']);
    } else {
        echo json_encode(['success' => false, 'msg' => 'Save failed: ' . $conn->error]);
    }
    exit;
}

echo json_encode(['success' => false, 'msg' => 'Invalid action']);
