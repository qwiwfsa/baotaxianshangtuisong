<?php
/**
 * City Districts API - Get/Save districts for a city
 */
require_once __DIR__ . "/config.php";
header('Content-Type: application/json; charset=utf-8');

$conn = getDB();
$action = $_POST['action'] ?? $_GET['action'] ?? 'list';
$city = $_POST['city'] ?? $_GET['city'] ?? '';

if ($action === 'list') {
    if ($city) {
        $stmt = $conn->prepare("SELECT id, city_name, district_name, sort_order FROM city_districts WHERE city_name = ? ORDER BY sort_order ASC");
        $stmt->bind_param('s', $city);
        $stmt->execute();
        $result = $stmt->get_result();
        $districts = [];
        while ($row = $result->fetch_assoc()) {
            $districts[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $districts]);
    } else {
        $stmt = $conn->query("SELECT DISTINCT city_name FROM city_districts ORDER BY city_name ASC");
        $cities = [];
        while ($row = $stmt->fetch_assoc()) {
            $cities[] = $row['city_name'];
        }
        echo json_encode(['success' => true, 'data' => $cities]);
    }
    exit;
}

if ($action === 'save') {
    $districts = $_POST['districts'] ?? '';
    if (!$city || !$districts) {
        echo json_encode(['success' => false, 'msg' => 'Missing city or districts']);
        exit;
    }
    $list = json_decode($districts, true);
    if (!is_array($list)) {
        echo json_encode(['success' => false, 'msg' => 'Invalid districts format']);
        exit;
    }

    $conn->begin_transaction();
    try {
        $del = $conn->prepare("DELETE FROM city_districts WHERE city_name = ?");
        $del->bind_param('s', $city);
        $del->execute();
        $del->close();

        $ins = $conn->prepare("INSERT INTO city_districts (city_name, district_name, sort_order) VALUES (?, ?, ?)");
        foreach ($list as $i => $name) {
            $name = trim($name);
            if (!$name) continue;
            $ins->bind_param('ssi', $city, $name, $i);
            $ins->execute();
        }
        $ins->close();
        $conn->commit();
        echo json_encode(['success' => true, 'msg' => 'Districts saved']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'msg' => 'Save failed: ' . $e->getMessage()]);
    }
    exit;
}

echo json_encode(['success' => false, 'msg' => 'Invalid action']);
