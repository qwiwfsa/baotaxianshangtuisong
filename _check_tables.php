<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=hongdu;charset=utf8mb4','root','');
    $stmt = $pdo->query('SHOW TABLES');
    $tables = [];
    while ($r = $stmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $r[0];
    }
    echo "All tables:\n";
    foreach ($tables as $t) echo "$t\n";
    
    // Check for faq or case related tables
    echo "\n--- FAQ/Case related ---\n";
    foreach ($tables as $t) {
        if (stripos($t, 'faq') !== false || stripos($t, 'case') !== false) {
            echo "$t\n";
            $s = $pdo->query("DESCRIBE `$t`");
            while ($r = $s->fetch(PDO::FETCH_ASSOC)) {
                echo "  " . $r['Field'] . " | " . $r['Type'] . " | " . ($r['Null']=='YES'?'NULL':'NOT NULL') . "\n";
            }
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
