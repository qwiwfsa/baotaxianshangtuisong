<?php
/**
 * 统一数据库连接 - 自动适配本地和服务器环境
 */

// 数据库环境配置
if(in_array($_SERVER['SERVER_ADDR'] ?? '', ['127.0.0.1', '::1']) || ($_SERVER['HTTP_HOST'] ?? '') == 'localhost') {
    // 本地环境 (XAMPP)
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'hongdu');
} else {
    // 线上服务器 (宝塔面板)
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_USER', 'hongdu');
    define('DB_PASS', 'fdsajkl');
    define('DB_NAME', 'hongdu');
}

/**
 * 获取数据库连接（mysqli）
 * @return mysqli
 * @throws Exception
 */
function getDB() {
    static $conn = null;
    if($conn === null || !@$conn->ping()) {
        if($conn !== null) {
            @$conn->close();
        }
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn->set_charset('utf8mb4');
        if($conn->connect_error) {
            die(json_encode(['code'=>1, 'msg'=>'数据库连接失败: '.$conn->connect_error]));
        }
    }
    return $conn;
}
