<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'hongdu');
define('DB_PASS', 'fdsajkl');
define('DB_NAME', 'hongdu');

function getDB() {
    static $conn = null;
    if($conn === null || !@$conn->ping()) {
        if($conn !== null) {
            @$conn->close();
        }
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        $conn->set_charset('utf8mb4');
        if($conn->connect_error) {
            die(json_encode(['code'=>1, 'msg'=>'error']));
        }
    }
    return $conn;
}
