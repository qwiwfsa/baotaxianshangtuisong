<?php
/**
 * 同步桌面端页面到移动端和平板端
 * 当桌面端页面更新后，自动同步到移动端和平板端
 */

require_once __DIR__ . '/common.php';

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $pageId = $data['page_id'] ?? '';

    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    // 需要同步的页面列表
    $syncPages = ['cases.html', 'news.html', 'news-detail.html', 'faq.html'];

    if (!in_array($pageId, $syncPages)) {
        jsonSuccess(['message' => '该页面不需要同步']);
    }

    // 源文件路径
    $sourcePath = __DIR__ . '/../../' . $pageId;

    if (!file_exists($sourcePath)) {
        jsonError('源文件不存在');
    }

    // 读取源文件内容
    $content = file_get_contents($sourcePath);

    // 同步到移动端
    $mobilePath = __DIR__ . '/../../mobile/' . $pageId;
    $mobileContent = $content;

    // 修复移动端的资源路径
    $mobileContent = preg_replace('/href="css\//', 'href="../css/', $mobileContent);
    $mobileContent = preg_replace('/src="images\//', 'src="../images/', $mobileContent);
    $mobileContent = preg_replace('/href="admin\//', 'href="../admin/', $mobileContent);
    $mobileContent = preg_replace('/src="js\//', 'src="../js/', $mobileContent);
    $mobileContent = preg_replace('/href="uploads\//', 'href="../uploads/', $mobileContent);
    $mobileContent = preg_replace('/src="\.\/uploads\//', 'src="../uploads/', $mobileContent);

    // 修复API路径
    $mobileContent = preg_replace("/basePath \+ 'api\//", "basePath + '../admin/api/", $mobileContent);

    file_put_contents($mobilePath, $mobileContent);

    // 同步到平板端
    $tabletPath = __DIR__ . '/../../tablet/' . $pageId;
    $tabletContent = $content;

    // 修复平板端的资源路径
    $tabletContent = preg_replace('/href="css\//', 'href="../css/', $tabletContent);
    $tabletContent = preg_replace('/src="images\//', 'src="../images/', $tabletContent);
    $tabletContent = preg_replace('/href="admin\//', 'href="../admin/', $tabletContent);
    $tabletContent = preg_replace('/src="js\//', 'src="../js/', $tabletContent);
    $tabletContent = preg_replace('/href="uploads\//', 'href="../uploads/', $tabletContent);
    $tabletContent = preg_replace('/src="\.\/uploads\//', 'src="../uploads/', $tabletContent);

    // 修复API路径
    $tabletContent = preg_replace("/basePath \+ 'api\//", "basePath + '../admin/api/", $tabletContent);

    file_put_contents($tabletPath, $tabletContent);

    jsonSuccess([
        'message' => '页面已同步到移动端和平板端',
        'mobile_path' => $mobilePath,
        'tablet_path' => $tabletPath
    ]);

} catch (Exception $e) {
    jsonError('同步失败: ' . $e->getMessage());
}
