<?php
$conn = new mysqli('localhost', 'root', '', 'hongdu');
if ($conn->connect_error) { die('Connection failed: ' . $conn->connect_error); }
$result = $conn->query('SHOW TABLES');
echo "Tables in database:\n";
while ($row = $result->fetch_array()) {
    echo '  ' . $row[0] . "\n";
}

// Check each relevant table structure
$tables = ['faq_categories', 'faq', 'cases', 'case_types'];
foreach ($tables as $table) {
    $check = $conn->query("SHOW TABLES LIKE '$table'");
    if ($check->num_rows > 0) {
        echo "\n--- Structure of $table ---\n";
        $cols = $conn->query("SHOW COLUMNS FROM $table");
        while ($col = $cols->fetch_assoc()) {
            echo "  {$col['Field']} ({$col['Type']})\n";
        }
    } else {
        echo "\n--- Table $table does NOT exist ---\n";
    }
}
$conn->close();
?>