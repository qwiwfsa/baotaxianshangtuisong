<?php
/**
 * API诊断脚本
 * 用于检查服务器配置和API状态
 */

header('Content-Type: text/html; charset=utf-8');

echo "<h1>API诊断报告</h1>";
echo "<p>生成时间: " . date('Y-m-d H:i:s') . "</p>";
echo "<hr>";

// 1. PHP版本
echo "<h2>1. PHP版本</h2>";
echo "<p>PHP版本: " . phpversion() . "</p>";

// 2. 扩展检查
echo "<h2>2. 扩展检查</h2>";
$extensions = ['mysqli', 'json', 'mbstring'];
echo "<ul>";
foreach ($extensions as $ext) {
    $loaded = extension_loaded($ext);
    $color = $loaded ? 'green' : 'red';
    $status = $loaded ? '✓ 已加载' : '✗ 未加载';
    echo "<li style='color:$color'>$ext: $status</li>";
}
echo "</ul>";

// 3. 请求信息
echo "<h2>3. 请求信息</h2>";
echo "<ul>";
echo "<li>请求方法: " . $_SERVER['REQUEST_METHOD'] . "</li>";
echo "<li>请求URI: " . $_SERVER['REQUEST_URI'] . "</li>";
echo "<li>Content-Type: " . ($_SERVER['CONTENT_TYPE'] ?? '未设置') . "</li>";
echo "</ul>";

// 4. 测试输入流
echo "<h2>4. 输入流测试</h2>";
$rawInput = file_get_contents('php://input');
echo "<p>原始输入: " . (empty($rawInput) ? '(空)' : htmlspecialchars($rawInput)) . "</p>";

// 5. 测试JSON解析
echo "<h2>5. JSON解析测试</h2>";
$testJson = '{"id":1,"name":"测试"}';
$parsed = json_decode($testJson, true);
if (json_last_error() === JSON_ERROR_NONE) {
    echo "<p style='color:green'>✓ JSON解析正常</p>";
    echo "<pre>" . print_r($parsed, true) . "</pre>";
} else {
    echo "<p style='color:red'>✗ JSON解析失败: " . json_last_error_msg() . "</p>";
}

// 6. 数据库连接测试
echo "<h2>6. 数据库连接测试</h2>";
try {
    require_once __DIR__ . '/../config.php';
    $conn = getDbConnection();
    echo "<p style='color:green'>✓ 数据库连接成功</p>";
    
    // 检查表
    $result = $conn->query("SHOW TABLES LIKE 'cms_case_types'");
    if ($result->num_rows > 0) {
        echo "<p style='color:green'>✓ 表 cms_case_types 存在</p>";
    } else {
        echo "<p style='color:red'>✗ 表 cms_case_types 不存在</p>";
    }
    
    $conn->close();
} catch (Exception $e) {
    echo "<p style='color:red'>✗ 数据库连接失败: " . $e->getMessage() . "</p>";
}

// 7. 文件权限检查
echo "<h2>7. 文件权限检查</h2>";
$apiDir = __DIR__;
$logsDir = dirname($apiDir) . '/logs';
echo "<ul>";
echo "<li>API目录 ($apiDir): " . (is_writable($apiDir) ? '<span style="color:green">可写</span>' : '<span style="color:orange">不可写</span>') . "</li>";
echo "<li>日志目录 ($logsDir): " . (is_dir($logsDir) ? (is_writable($logsDir) ? '<span style="color:green">存在且可写</span>' : '<span style="color:orange">存在但不可写</span>') : '<span style="color:orange">不存在</span>') . "</li>";
echo "</ul>";

// 8. 测试实际请求
echo "<h2>8. 模拟API调用测试</h2>";

// 模拟GET请求
echo "<h3>GET 测试</h3>";
try {
    $conn = getDbConnection();
    $result = $conn->query("SELECT * FROM cms_case_types ORDER BY sort_order ASC LIMIT 3");
    $types = [];
    while ($row = $result->fetch_assoc()) {
        $types[] = $row;
    }
    echo "<p style='color:green'>✓ GET查询成功，返回 " . count($types) . " 条记录</p>";
    $conn->close();
} catch (Exception $e) {
    echo "<p style='color:red'>✗ GET查询失败: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p>诊断完成</p>";
