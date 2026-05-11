<?php
$conn = new mysqli('localhost', 'root', '', 'hongdu', 3306);
$result = $conn->query("SELECT id, title, category, image FROM cases ORDER BY id");
while ($r = $result->fetch_assoc()) {
    echo "MySQL ID: {$r['id']}, Title: {$r['title']}, Category: '{$r['category']}', Image: '{$r['image']}'" . PHP_EOL;
}
$conn->close();
