<?php
/**
 * 案例评论提交 API
 * POST /api/case-comment-submit.php
 * Parameters: case_id, nickname, content
 */
require_once __DIR__ . '/config.php';
setApiHeaders();
handlePreflight();
requireMethod('POST');

$case_id = isset($_POST['case_id']) ? intval($_POST['case_id']) : 0;
$nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
$content_text = isset($_POST['content']) ? trim($_POST['content']) : '';

if ($case_id <= 0 || $content_text === '') {
    jsonError('参数不完整', 400);
}

if ($nickname === '') $nickname = '匿名';
if (mb_strlen($nickname) > 50) {
    jsonError('昵称过长', 400);
}
if (mb_strlen($content_text) < 2 || mb_strlen($content_text) > 2000) {
    jsonError('评论内容长度不合法（2-2000字）', 400);
}

$blocked = ['http://', 'https://', 'www.'];
foreach ($blocked as $b) {
    if (stripos($content_text, $b) !== false || stripos($nickname, $b) !== false) {
        jsonError('内容包含不当信息', 400);
    }
}

$ip = $_SERVER['REMOTE_ADDR'] ?? '';
try {
    $db = getDB();
    $stmt = $db->prepare("SELECT COUNT(*) FROM case_comments WHERE ip_address = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $stmt->bind_param('s', $ip);
    $stmt->execute();
    $count_res = $stmt->get_result()->fetch_row();
    $count = $count_res ? $count_res[0] : 0;
    if ($count >= 5) {
        jsonError('评论过于频繁，请稍后再试', 429);
    }

    // Check blacklist
    $stmt = $db->prepare("SELECT id FROM comment_blacklist WHERE (type = 'nickname' AND value = ?) OR (type = 'ip' AND value = ?)");
    $stmt->bind_param('ss', $nickname, $ip);
    $stmt->execute();
    if ($stmt->get_result()->fetch_row()) {
        jsonError('您的账号已被限制评论', 403);
    }

    // Check auto_approve setting
    $status = 0;
    $ar = $db->query("SELECT svalue FROM comment_settings WHERE skey = 'auto_approve'");
    if ($ar && $row = $ar->fetch_row()) {
        if ($row[0] === '1') $status = 1;
    }

    $stmt = $db->prepare("INSERT INTO case_comments (case_id, nickname, content, ip_address, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('isssi', $case_id, $nickname, $content_text, $ip, $status);
    $stmt->execute();

    $msg = $status ? '评论提交成功' : '评论提交成功，等待审核';
    jsonSuccess(['id' => $stmt->insert_id], ['message' => $msg]);
} catch (Exception $e) {
    jsonError('提交失败: ' . $e->getMessage());
}

