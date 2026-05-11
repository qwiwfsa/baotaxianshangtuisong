<?php
// 检查重复分类名称
header('Content-Type: text/plain; charset=utf-8');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'hongdu';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// 检查重复名称
$result = $conn->query("SELECT name, COUNT(*) as count FROM cms_categories GROUP BY name HAVING count > 1");
if ($result->num_rows > 0) {
    echo "发现重复的分类名称：\n";
    while ($row = $result->fetch_assoc()) {
        echo "- {$row['name']}: {$row['count']}个\n";
    }
} else {
    echo "没有发现重复的分类名称\n";
}

echo "\n所有分类列表：\n";
echo "========================================\n";
$result = $conn->query("SELECT id, name, sort_order FROM cms_categories ORDER BY id ASC");
while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | 名称: {$row['name']}\n";
}

$conn->close();
