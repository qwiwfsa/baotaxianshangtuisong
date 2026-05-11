<?php
/**
 * 获取页面所有模块
 */

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();

    $pageId = getGetParam('page_id', '');

    if (empty($pageId)) {
        jsonError('页面ID不能为空');
    }

    $stmt = $conn->prepare("SELECT id, module_type, module_data, sort_order, is_active, created_at, updated_at FROM page_builder_modules WHERE page_id=? AND is_active=1 ORDER BY sort_order ASC");
    $stmt->bind_param("s", $pageId);
    $stmt->execute();
    $result = $stmt->get_result();

    $modules = [];
    while ($row = $result->fetch_assoc()) {
        $row['module_data'] = json_decode($row['module_data'], true);
        $modules[] = $row;
    }

    $stmt->close();
    $conn->close();

    jsonSuccess(['modules' => $modules]);

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
