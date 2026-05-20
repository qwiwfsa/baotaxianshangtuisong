<?php
require_once __DIR__ . '/../../api/config.php';
if (!function_exists('getDbConnection')) {
function getDbConnection() { return getDB(); }
}

function requireAdmin() {
    $logged = isset($_COOKIE['cms_logged_in']) ? $_COOKIE['cms_logged_in'] : '';
    if ($logged === 'true') return true;
    http_response_code(403);
    echo json_encode(array('success'=>false,'message'=>'Access denied'));
    exit;
}
