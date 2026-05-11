<?php
require_once 'config/db.php';
try {
    $db = getDB();
    $result = $db->query('SHOW TABLES');
    echo "数据库表列表：\n";
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        echo '- ' . $row[0] . "\n";
    }
    
    // 检查cases表
    $result = $db->query("SELECT COUNT(*) as count FROM cases");
    $row = $result->fetch_assoc();
    echo "\ncases表记录数: " . $row['count'] . "\n";
    
    // 检查cms_articles表
    $result = $db->query("SELECT COUNT(*) as count FROM cms_articles");
    $row = $result->fetch_assoc();
    echo "cms_articles表记录数: " . $row['count'] . "\n";
    
} catch (Exception $e) {
    echo '错误：' . $e->getMessage();
}
