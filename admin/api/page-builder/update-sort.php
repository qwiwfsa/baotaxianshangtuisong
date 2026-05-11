<?php
/**
 * 批量更新模块排序
 */

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();

    $data = getAllPostParams();
    $modules = isset($data['modules']) ? $data['modules'] : [];

    if (empty($modules) || !is_array($modules)) {
        jsonError('模块数据无效');
    }

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("UPDATE page_builder_modules SET sort_order=?, updated_at=NOW() WHERE id=?");

        foreach ($modules as $module) {
            $moduleId = intval($module['id']);
            $sortOrder = intval($module['sort_order']);
            $stmt->bind_param("ii", $sortOrder, $moduleId);
            $stmt->execute();
        }

        $stmt->close();
        $conn->commit();

        jsonSuccess(null, '排序更新成功');

    } catch (Exception $e) {
        $conn->rollback();
        jsonError('更新失败: ' . $e->getMessage());
    }

    $conn->close();

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
