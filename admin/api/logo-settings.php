<?php
/**
 * Logo设置API - 上传/保存/获取Logo
 * 支持4种Logo：主Logo(header)、底部Logo(footer)、favicon、admin Logo
 */

// 引入公共函数
require_once __DIR__ . '/common.php';

// 获取请求方法
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    case 'OPTIONS':
        http_response_code(204);
        break;
    default:
        jsonError('不支持的请求方法', 405);
}

/**
 * GET - 获取Logo设置
 */
function handleGet() {
    $settings = readLogoSettings();
    jsonSuccess($settings, '获取成功');
}

/**
 * POST - 保存Logo设置
 */
function handlePost() {
    $data = getAllPostParams();
    
    if (empty($data)) {
        jsonError('无效的请求数据');
    }
    
    // 当前设置
    $settings = readLogoSettings();
    
    // 更新字段（只更新传入的字段）
    $fields = ['header_logo', 'footer_logo', 'favicon', 'admin_logo'];
    foreach ($fields as $field) {
        if (isset($data[$field])) {
            $settings[$field] = trim($data[$field]);
        }
    }
    
    // 保存
    if (saveLogoSettings($settings)) {
        jsonSuccess($settings, 'Logo设置保存成功');
    } else {
        jsonError('保存失败');
    }
}

/**
 * 读取Logo设置
 */
function readLogoSettings() {
    $defaults = [
        'header_logo' => '',
        'footer_logo' => '',
        'favicon' => '',
        'admin_logo' => '',
        'updated_at' => ''
    ];
    
    return readDataFile('logo-settings.json');
}

/**
 * 保存Logo设置
 */
function saveLogoSettings($data) {
    $data['updated_at'] = date('Y-m-d H:i:s');
    return writeDataFile('logo-settings.json', $data);
}
