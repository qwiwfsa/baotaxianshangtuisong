<?php
/**
 * 网站设置 - 获取设置
 * GET请求
 * 返回所有网站基础设置
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonError('仅支持GET请求', 405);
}

// 读取设置
$settings = readDataFile('site-settings.json');
if (!is_array($settings)) {
    $settings = [];
}

jsonSuccess($settings);
