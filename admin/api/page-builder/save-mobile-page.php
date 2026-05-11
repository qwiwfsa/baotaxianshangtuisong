<?php
/**
 * 保存手机端页面HTML内容
 */

require_once __DIR__ . '/../common.php';

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $pageId = $data['page_id'] ?? '';
    $html = $data['html'] ?? '';

    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    if (empty($html)) {
        jsonError('页面内容不能为空');
    }

    // 确定手机端页面文件路径
    $targetPath = __DIR__ . '/../../../mobile/' . $pageId;

    // 如果mobile目录不存在，创建它
    $mobileDir = __DIR__ . '/../../../mobile';
    if (!is_dir($mobileDir)) {
        mkdir($mobileDir, 0755, true);
    }

    // 备份原文件
    if (file_exists($targetPath)) {
        $backupPath = $targetPath . '.backup.' . date('YmdHis');
        copy($targetPath, $backupPath);
    }

    // 保存新内容
    $result = file_put_contents($targetPath, $html);

    if ($result === false) {
        jsonError('保存失败，请检查文件权限');
    }

    jsonSuccess([
        'message' => '手机端页面保存成功',
        'path' => $targetPath,
        'bytes' => $result
    ]);

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
