<?php
$conn = new mysqli('localhost', 'root', '', 'hongdu', 3306);
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . PHP_EOL;
    exit;
}

$result = $conn->query('SELECT COUNT(*) as cnt FROM cases');
$row = $result->fetch_assoc();
echo "Total cases in MySQL: " . $row['cnt'] . PHP_EOL;

$result = $conn->query('SELECT id, title, category, image, content FROM cases ORDER BY updated_at DESC LIMIT 5');
while ($r = $result->fetch_assoc()) {
    $content = json_decode($r['content'], true);
    $coverImage = $content['coverImage'] ?? $r['image'] ?? '(none)';
    echo "id: {$r['id']}, cat: {$r['category']}, img: {$r['image']}, coverImage: $coverImage" . PHP_EOL;
}
$conn->close();
