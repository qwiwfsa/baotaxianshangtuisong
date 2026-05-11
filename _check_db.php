<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=hongdu;charset=utf8mb4', 'root', '');
    $tables = ['faq_categories','faq_questions','case_types','cases'];
    foreach ($tables as $t) {
        echo "=== $t ===\n";
        $stmt = $pdo->query("DESCRIBE `$t`");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['Field'] . ' | ' . $row['Type'] . ' | ' . ($row['Null']=='YES'?'NULL':'NOT NULL') . ' | ' . ($row['Default']??'') . "\n";
        }
        echo "\n";
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
