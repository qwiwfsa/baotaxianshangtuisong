<?php
require_once 'api/config.php';
$pdo = getDB();
$stmt = $pdo->query('SELECT id, title, status FROM cms_articles ORDER BY id');
$articles = $stmt->fetchAll();
echo 'cms_articles表文章数: ' . count($articles) . "\n";
foreach($articles as $a) {
    echo 'ID: ' . $a['id'] . ' | 标题: ' . mb_substr($a['title'], 0, 30) . ' | 状态: ' . $a['status'] . "\n";
}
