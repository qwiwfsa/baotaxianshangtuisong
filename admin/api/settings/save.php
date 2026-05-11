<?php
/**
 * 网站设置 - 保存设置
 * POST请求
 * 参数：接收site-settings.json中的所有字段
 *   site_name, logo, subtitle, contact_phone, contact_email,
 *   address, icp, seo_keywords, seo_description, seo_title,
 *   baidu_token, stat_code, service_code, qywx_qrcode, wechat_qrcode
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError('仅支持POST请求', 405);
}

// 获取所有POST数据
$data = getAllPostParams();

// 读取现有设置
$settings = readDataFile('site-settings.json');
if (!is_array($settings)) {
    $settings = [];
}

// 允许更新的字段列表（白名单）
$allowedFields = [
    'site_name',
    'logo',
    'subtitle',
    'contact_phone',
    'contact_email',
    'address',
    'icp',
    'seo_keywords',
    'seo_description',
    'seo_title',
    'baidu_token',
    'stat_code',
    'service_code',
    'qywx_qrcode',
    'wechat_qrcode'
];

// 只更新白名单中的字段
foreach ($allowedFields as $field) {
    if (isset($data[$field])) {
        $settings[$field] = trim($data[$field]);
    }
}

// 写入文件
if (writeDataFile('site-settings.json', $settings)) {
    jsonSuccess($settings, '设置已保存');
} else {
    jsonError('写入失败，请检查目录权限');
}
