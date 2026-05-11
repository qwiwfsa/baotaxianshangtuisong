<?php
/**
 * 留言管理 - 获取留言列表
 * GET请求
 * 参数：
 *   status   - 状态过滤（all=全部, unread=未读, read=已读），默认all
 *   source   - 来源过滤（all=全部, contact=联系表单, appointment=预约表单），默认all
 *   page     - 页码，默认1
 *   limit    - 每页条数，默认20
 *   keyword  - 搜索关键词（匹配姓名、内容、邮箱、电话）
 */

require_once dirname(__DIR__) . '/common.php';

// 只接受GET请求
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonError('仅支持GET请求', 405);
}

// 获取参数
$status = getGetParam('status', 'all');
$source = getGetParam('source', 'all');
$page = intval(getGetParam('page', 1));
$limit = intval(getGetParam('limit', 20));
$keyword = getGetParam('keyword', '');

// 限制有效值
if ($page < 1) $page = 1;
if ($limit < 1) $limit = 20;
if ($limit > 100) $limit = 100;

// 加载留言数据
$messages = readDataFile('messages.json');
if (!is_array($messages)) {
    $messages = [];
}

// 过滤
$filtered = [];
foreach ($messages as $msg) {
    // 状态过滤
    if ($status !== 'all' && $msg['status'] !== $status) {
        continue;
    }
    // 来源过滤
    if ($source !== 'all' && $msg['source'] !== $source) {
        continue;
    }
    // 关键词搜索
    if (!empty($keyword)) {
        $kw = strtolower($keyword);
        $match = false;
        if (stripos($msg['name'], $kw) !== false) $match = true;
        if (stripos($msg['content'], $kw) !== false) $match = true;
        if (stripos($msg['email'], $kw) !== false) $match = true;
        if (stripos($msg['phone'], $kw) !== false) $match = true;
        if (!$match) continue;
    }
    $filtered[] = $msg;
}

// 按时间降序排列（最新的在前）
usort($filtered, function($a, $b) {
    return strcmp($b['time'], $a['time']);
});

// 总记录数
$total = count($filtered);

// 分页
$offset = ($page - 1) * $limit;
$pageMessages = array_slice($filtered, $offset, $limit);

// 统计
$unreadCount = 0;
$readCount = 0;
foreach ($messages as $msg) {
    if ($msg['status'] === 'unread') $unreadCount++;
    else $readCount++;
}

// 返回数据
$data = [
    'list' => $pageMessages,
    'total' => $total,
    'page' => $page,
    'limit' => $limit,
    'total_pages' => max(1, ceil($total / $limit)),
    'stats' => [
        'total' => count($messages),
        'unread' => $unreadCount,
        'read' => $readCount
    ]
];

jsonSuccess($data);
