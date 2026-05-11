<?php
/**
 * 诊断脚本：检查数据库中的实际数据
 */

require_once __DIR__ . '/api/config.php';

header('Content-Type: text/html; charset=utf-8');

$conn = getDbConnection();
initDatabase($conn);

$stmt = $conn->prepare("SELECT page_id, page_name, title, subtitle, content, last_modified FROM cms_pages WHERE page_id = 'index'");
$stmt->execute();
$result = $stmt->get_result();

echo "<h1>数据库诊断</h1>";

if ($result->num_rows === 0) {
    echo "<p>数据库中没有index页面的数据</p>";
} else {
    $row = $result->fetch_assoc();
    echo "<h2>页面信息</h2>";
    echo "<p><strong>Page ID:</strong> " . htmlspecialchars($row['page_id']) . "</p>";
    echo "<p><strong>Page Name:</strong> " . htmlspecialchars($row['page_name']) . "</p>";
    echo "<p><strong>Title:</strong> " . htmlspecialchars($row['title']) . "</p>";
    echo "<p><strong>Subtitle:</strong> " . htmlspecialchars($row['subtitle']) . "</p>";
    echo "<p><strong>Last Modified:</strong> " . htmlspecialchars($row['last_modified']) . "</p>";

    echo "<h2>内容JSON</h2>";
    $content = json_decode($row['content'], true);
    echo "<pre>" . htmlspecialchars(json_encode($content, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) . "</pre>";

    echo "<h2>统计数据字段</h2>";
    echo "<ul>";
    for ($i = 1; $i <= 4; $i++) {
        $numKey = "stat{$i}Number";
        $labelKey = "stat{$i}Label";
        echo "<li><strong>stat{$i}Number:</strong> " . (isset($content[$numKey]) ? htmlspecialchars($content[$numKey]) : '未设置') . "</li>";
        echo "<li><strong>stat{$i}Label:</strong> " . (isset($content[$labelKey]) ? htmlspecialchars($content[$labelKey]) : '未设置') . "</li>";
    }
    echo "</ul>";
}

$stmt->close();
$conn->close();
?>
