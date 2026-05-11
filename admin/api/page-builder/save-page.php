<?php
/**
 * 保存页面HTML内容
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

    // 确定页面文件路径
    $targetPath = __DIR__ . '/../../../' . $pageId;

    // 如果文件不存在，尝试添加.html扩展名
    if (!file_exists($targetPath) && !str_ends_with($pageId, '.html')) {
        $targetPath = __DIR__ . '/../../../' . $pageId . '.html';
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

    // 需要同步的页面列表
    $syncPages = ['cases.html', 'news.html', 'news-detail.html', 'faq.html'];

    // 如果是需要同步的页面，自动同步到移动端和平板端
    if (in_array($pageId, $syncPages) || in_array($pageId . '.html', $syncPages)) {
        $actualPageId = str_ends_with($pageId, '.html') ? $pageId : $pageId . '.html';

        // 同步到移动端
        $mobilePath = __DIR__ . '/../../../mobile/' . $actualPageId;
        $mobileContent = $html;

        // 修复移动端的资源路径
        $mobileContent = preg_replace('/href="css\//', 'href="../css/', $mobileContent);
        $mobileContent = preg_replace('/src="images\//', 'src="../images/', $mobileContent);
        $mobileContent = preg_replace('/href="admin\//', 'href="../admin/', $mobileContent);
        $mobileContent = preg_replace('/src="js\//', 'src="../js/', $mobileContent);
        $mobileContent = preg_replace('/href="uploads\//', 'href="../uploads/', $mobileContent);
        $mobileContent = preg_replace('/src="\.\/uploads\//', 'src="../uploads/', $mobileContent);

        // 修复API路径 - 注意cases.php在api/目录，不是admin/api/
        $mobileContent = preg_replace("/basePath \+ 'api\//", "basePath + '../api/", $mobileContent);
        $mobileContent = preg_replace("/'api\/news-list\.php/", "'../api/news-list.php", $mobileContent);
        $mobileContent = preg_replace("/'api\/case-detail\.php/", "'../api/case-detail.php", $mobileContent);

        @file_put_contents($mobilePath, $mobileContent);

        // 同步到平板端
        $tabletPath = __DIR__ . '/../../../tablet/' . $actualPageId;
        $tabletContent = $html;

        // 修复平板端的资源路径
        $tabletContent = preg_replace('/href="css\//', 'href="../css/', $tabletContent);
        $tabletContent = preg_replace('/src="images\//', 'src="../images/', $tabletContent);
        $tabletContent = preg_replace('/href="admin\//', 'href="../admin/', $tabletContent);
        $tabletContent = preg_replace('/src="js\//', 'src="../js/', $tabletContent);
        $tabletContent = preg_replace('/href="uploads\//', 'href="../uploads/', $tabletContent);
        $tabletContent = preg_replace('/src="\.\/uploads\//', 'src="../uploads/', $tabletContent);

        // 修复API路径
        $tabletContent = preg_replace("/basePath \+ 'api\//", "basePath + '../api/", $tabletContent);
        $tabletContent = preg_replace("/'api\/news-list\.php/", "'../api/news-list.php", $tabletContent);
        $tabletContent = preg_replace("/'api\/case-detail\.php/", "'../api/case-detail.php", $tabletContent);

        @file_put_contents($tabletPath, $tabletContent);
    }

    jsonSuccess([
        'message' => '页面保存成功',
        'path' => $targetPath,
        'bytes' => $result,
        'synced' => in_array($pageId, $syncPages) || in_array($pageId . '.html', $syncPages)
    ]);

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
