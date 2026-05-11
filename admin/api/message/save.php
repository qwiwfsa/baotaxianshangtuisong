<?php
/**
 * 留言管理 - 保存/标记已读/删除
 * POST请求
 * 参数：
 *   id       - 留言ID
 *   action   - 操作类型（mark_read=标记已读, delete=删除, update=更新留言内容）
 *   name     - 姓名（action=update时）
 *   email    - 邮箱（action=update时）
 *   phone    - 电话（action=update时）
 *   content  - 内容（action=update时）
 *   status   - 状态（action=update时）
 *   source   - 来源（action=update时）
 *   time     - 时间（action=update时，可选）
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError('仅支持POST请求', 405);
}

$action = getPostParam('action', '');
$id = getPostParam('id', '');

// 加载留言数据
$messages = readDataFile('messages.json');
if (!is_array($messages)) {
    $messages = [];
}

switch ($action) {
    case 'mark_read':
        // 标记已读
        if (empty($id)) {
            jsonError('缺少留言ID');
        }
        $found = false;
        foreach ($messages as &$msg) {
            if ($msg['id'] === $id) {
                $msg['status'] = 'read';
                $found = true;
                break;
            }
        }
        unset($msg);
        if (!$found) {
            jsonError('留言不存在');
        }
        if (writeDataFile('messages.json', $messages)) {
            jsonSuccess(null, '已标记为已读');
        } else {
            jsonError('写入失败');
        }
        break;

    case 'delete':
        // 删除留言
        if (empty($id)) {
            jsonError('缺少留言ID');
        }
        $found = false;
        $newMessages = [];
        foreach ($messages as $msg) {
            if ($msg['id'] === $id) {
                $found = true;
                continue;
            }
            $newMessages[] = $msg;
        }
        if (!$found) {
            jsonError('留言不存在');
        }
        if (writeDataFile('messages.json', $newMessages)) {
            jsonSuccess(null, '已删除');
        } else {
            jsonError('写入失败');
        }
        break;

    case 'update':
        // 更新留言内容（修改留言信息）
        if (empty($id)) {
            jsonError('缺少留言ID');
        }
        $found = false;
        foreach ($messages as &$msg) {
            if ($msg['id'] === $id) {
                if (getPostParam('name') !== null) $msg['name'] = getPostParam('name');
                if (getPostParam('email') !== null) $msg['email'] = getPostParam('email');
                if (getPostParam('phone') !== null) $msg['phone'] = getPostParam('phone');
                if (getPostParam('content') !== null) $msg['content'] = getPostParam('content');
                if (getPostParam('status') !== null) $msg['status'] = getPostParam('status');
                if (getPostParam('source') !== null) $msg['source'] = getPostParam('source');
                if (getPostParam('time') !== null) $msg['time'] = getPostParam('time');
                $found = true;
                break;
            }
        }
        unset($msg);
        if (!$found) {
            jsonError('留言不存在');
        }
        if (writeDataFile('messages.json', $messages)) {
            jsonSuccess(null, '已更新');
        } else {
            jsonError('写入失败');
        }
        break;

    default:
        jsonError('无效的action参数（可选值：mark_read, delete, update）');
}
