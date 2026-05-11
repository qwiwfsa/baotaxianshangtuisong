<?php
// Direct migration script - bypasses config/env detection
header('Content-Type: application/json; charset=utf-8');

$conn = new mysqli('127.0.0.1', 'root', '', 'hongdu', 3306);
$conn->set_charset('utf8mb4');

$migrations = [
    "ALTER TABLE faq_categories ADD COLUMN seo_title VARCHAR(255) DEFAULT '' AFTER sort_order",
    "ALTER TABLE faq_categories ADD COLUMN seo_keywords TEXT AFTER seo_title",
    "ALTER TABLE faq_categories ADD COLUMN seo_description TEXT AFTER seo_keywords",
    "ALTER TABLE faq ADD COLUMN seo_title VARCHAR(255) DEFAULT '' AFTER is_active",
    "ALTER TABLE faq ADD COLUMN seo_keywords TEXT AFTER seo_title",
    "ALTER TABLE faq ADD COLUMN seo_description TEXT AFTER seo_keywords",
    "ALTER TABLE cases ADD COLUMN seo_title VARCHAR(255) DEFAULT '' AFTER content",
    "ALTER TABLE cases ADD COLUMN seo_keywords TEXT AFTER seo_title",
    "ALTER TABLE cases ADD COLUMN seo_description TEXT AFTER seo_keywords",
];

$results = [];
foreach ($migrations as $sql) {
    try {
        $conn->query($sql);
        $results[] = ['ok', substr($sql, 0, 60)];
    } catch (mysqli_sql_exception $e) {
        $results[] = [$e->getCode() == 1060 ? 'exists' : 'error', $e->getMessage()];
    }
}

$conn->close();
echo json_encode(['success' => true, 'results' => $results], JSON_UNESCAPED_UNICODE);
