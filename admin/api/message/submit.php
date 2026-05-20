<?php
/**
 * 留言提交API - 前端联系表单提交
 * POST请求
 * 参数：
 *   name     - 姓名（必填）
 *   phone    - 电话（必填）
 *   email    - 邮箱（选填）
 *   content  - 咨询内容（选填）
 *   source   - 来源页面（选填，默认contact）
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError('仅支持POST请求', 405);
}

// 获取参数
$name = getPostParam('name', '');
$phone = getPostParam('phone', '');
$email = getPostParam('email', '');
$content = getPostParam('content', '');
$source = getPostParam('source', 'contact');

// 验证必填字段
if (empty($name)) {
    jsonError('请输入您的姓名');
}

if (empty($phone)) {
    jsonError('请输入联系电话');
}

// 验证手机号格式
$phoneRegex = '/^1[3-9]\d{9}$/';
if (!preg_match($phoneRegex, $phone)) {
    jsonError('请输入有效的手机号码');
}

// 加载现有留言
$messages = readDataFile('messages.json');
if (!is_array($messages)) {
    $messages = [];
}

// 创建新留言
$newMessage = [
    'id' => uniqid(),
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'content' => $content,
    'source' => $source,
    'status' => 'unread',
    'time' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// 添加到留言列表
$messages[] = $newMessage;

// 保存到文件
if (writeDataFile('messages.json', $messages)) {
    jsonSuccess(['id' => $newMessage['id']], '提交成功，我们会尽快与您联系');
} else {
    jsonError('保存失败，请稍后重试');
}
