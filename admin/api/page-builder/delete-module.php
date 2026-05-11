<?php
/**
 * 删除页面模块
 */

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();

    $data = getAllPostParams();
    $moduleId = isset($data['module_id']) ? intval($data['module_id']) : 0;

    if ($moduleId <= 0) {
        jsonError('模块ID无效');
    }

    // 软删除：设置is_active=0
    $stmt = $conn->prepare("UPDATE page_builder_modules SET is_active=0, updated_at=NOW() WHERE id=?");
    $stmt->bind_param("i", $moduleId);

    if ($stmt->execute()) {
        jsonSuccess(null, '删除成功');
    } else {
        jsonError('删除失败: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
