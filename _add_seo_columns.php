<?php
/**
 * 为FAQ模块和成功案例模块添加SEO字段（CLI版）
 */
// 强制本地数据库配置
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hongdu');

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
$conn->set_charset('utf8mb4');
if ($conn->connect_error) {
    die('数据库连接失败: ' . $conn->connect_error . "\n");
}

$results = [];

function columnExists($conn, $table, $col) {
    $r = $conn->query("SHOW COLUMNS FROM `$table` LIKE '$col'");
    return $r && $r->num_rows > 0;
}

// 1. faq_categories表
$table = 'faq_categories';
if (!columnExists($conn, $table, 'meta_title')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_title` VARCHAR(200) DEFAULT NULL COMMENT 'SEO标题' AFTER `cat_label`");
    $results[] = "$table.meta_title: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_title: 已存在";
if (!columnExists($conn, $table, 'meta_keywords')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_keywords` VARCHAR(500) DEFAULT NULL COMMENT 'SEO关键词' AFTER `meta_title`");
    $results[] = "$table.meta_keywords: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_keywords: 已存在";
if (!columnExists($conn, $table, 'meta_description')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_description` TEXT DEFAULT NULL COMMENT 'SEO描述' AFTER `meta_keywords`");
    $results[] = "$table.meta_description: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_description: 已存在";

// 2. faq表
$table = 'faq';
if (!columnExists($conn, $table, 'meta_title')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_title` VARCHAR(200) DEFAULT NULL COMMENT 'SEO标题' AFTER `answer`");
    $results[] = "$table.meta_title: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_title: 已存在";
if (!columnExists($conn, $table, 'meta_keywords')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_keywords` VARCHAR(500) DEFAULT NULL COMMENT 'SEO关键词' AFTER `meta_title`");
    $results[] = "$table.meta_keywords: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_keywords: 已存在";
if (!columnExists($conn, $table, 'meta_description')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_description` TEXT DEFAULT NULL COMMENT 'SEO描述' AFTER `meta_keywords`");
    $results[] = "$table.meta_description: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_description: 已存在";

// 3. cases表
$table = 'cases';
if (!columnExists($conn, $table, 'meta_title')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_title` VARCHAR(200) DEFAULT NULL COMMENT 'SEO标题' AFTER `image`");
    $results[] = "$table.meta_title: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_title: 已存在";
if (!columnExists($conn, $table, 'meta_keywords')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_keywords` VARCHAR(500) DEFAULT NULL COMMENT 'SEO关键词' AFTER `meta_title`");
    $results[] = "$table.meta_keywords: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_keywords: 已存在";
if (!columnExists($conn, $table, 'meta_description')) {
    $conn->query("ALTER TABLE `$table` ADD COLUMN `meta_description` TEXT DEFAULT NULL COMMENT 'SEO描述' AFTER `meta_keywords`");
    $results[] = "$table.meta_description: " . ($conn->error ? '失败: ' . $conn->error : '成功');
} else $results[] = "$table.meta_description: 已存在";

// 4. case-types.json - 确保包含SEO字段
$jsonFile = __DIR__ . '/admin/data/case-types.json';
if (file_exists($jsonFile)) {
    $types = json_decode(file_get_contents($jsonFile), true);
    if (is_array($types)) {
        $changed = false;
        foreach ($types as &$type) {
            if (!isset($type['meta_title'])) {
                $type['meta_title'] = '';
                $type['meta_keywords'] = '';
                $type['meta_description'] = '';
                $changed = true;
            }
        }
        if ($changed) {
            file_put_contents($jsonFile, json_encode($types, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $results[] = 'case-types.json: SEO字段已添加';
        } else {
            $results[] = 'case-types.json: SEO字段已存在';
        }
    }
}

$conn->close();

echo "执行结果:\n";
foreach ($results as $r) {
    echo "  - $r\n";
}
echo "\n完成!\n";
