<?php
$conn = new mysqli('localhost', 'root', '', 'hongdu', 3306);
$result = $conn->query("SELECT id, title, image, content FROM cases WHERE id IN (2, 11)");
while ($r = $result->fetch_assoc()) {
    echo "--- ID: {$r['id']} ---" . PHP_EOL;
    echo "Title: {$r['title']}" . PHP_EOL;
    echo "Image: |{$r['image']}|" . PHP_EOL;
    $content = json_decode($r['content'], true);
    if ($content) {
        echo "Content coverImage: " . ($content['coverImage'] ?? '(none)') . PHP_EOL;
        echo "Content images: " . (isset($content['images']) ? json_encode($content['images'], JSON_UNESCAPED_UNICODE) : '(none)') . PHP_EOL;
    } else {
        echo "Content: (invalid JSON)" . PHP_EOL;
        echo "Raw: {$r['content']}" . PHP_EOL;
    }
}
$conn->close();
