<?php
require_once 'api/config.php';
header('Content-Type: text/plain; charset=utf-8');

try {
    $pdo = getDB();
    
    // 检查所有文章
    $stmt = $pdo->query('SELECT id, title, status, created_at FROM cms_articles ORDER BY id');
    $all = $stmt->fetchAll();
    echo "=== 所有文章 (" . count($all) . "篇) ===\n";
    foreach($all as $a) {
        echo "ID: {$a['id']} | 标题: " . mb_substr($a['title'], 0, 30) . " | 状态: {$a['status']}\n";
    }
    
    echo "\n=== 已发布文章 ===\n";
    $stmt = $pdo->query("SELECT id, title, status FROM cms_articles WHERE status = 'published' ORDER BY id");
    $published = $stmt->fetchAll();
    foreach($published as $a) {
        echo "ID: {$a['id']} | 标题: " . mb_substr($a['title'], 0, 30) . "\n";
    }
    
} catch (Exception $e) {
    echo "错误: " . $e->getMessage();
}
