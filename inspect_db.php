<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=hongdu;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query('SHOW TABLES');
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables in hongdu: " . implode(", ", $tables) . "\n\n";
    
    if (in_array('cases', $tables)) {
        $stmt = $pdo->query('DESCRIBE cases');
        echo "cases table schema:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "  {$row['Field']} {$row['Type']} {$row['Null']} {$row['Key']} {$row['Default']}\n";
        }
        echo "\n";
        
        $stmt = $pdo->query('SELECT * FROM cases');
        $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Total cases: " . count($all) . "\n";
        foreach ($all as $r) {
            echo "  id={$r['id']} title={$r['title']} status={$r['status']}\n";
        }
    } else {
        echo "cases table does NOT exist in hongdu DB!\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
