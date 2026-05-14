<?php
header('Content-Type: application/json; charset=utf-8');
$result = array(
    'method' => $_SERVER['REQUEST_METHOD'],
    'content_type' => isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : 'N/A',
    'post' => $_POST,
    'get' => $_GET,
);
echo json_encode($result, JSON_UNESCAPED_UNICODE);
