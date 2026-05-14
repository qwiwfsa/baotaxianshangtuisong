<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once dirname(__FILE__) . '/config.php';
setApiHeaders();
$result = array(
    'POST' => $_POST,
    'method' => $_SERVER['REQUEST_METHOD'],
    'content_type' => isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'NONE',
);
echo json_encode($result, JSON_UNESCAPED_UNICODE);
