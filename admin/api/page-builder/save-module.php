<?php
/**
 * 保存页面模块
 */

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();

    // 获取POST数据
    $data = getAllPostParams();

    $pageId = isset($data['page_id']) ? trim($data['page_id']) : '';
    $moduleId = isset($data['module_id']) ? intval($data['module_id']) : 0;
    $moduleType = isset($data['module_type']) ? trim($data['module_type']) : '';
    $moduleData = isset($data['module_data']) ? $data['module_data'] : [];
    $sortOrder = isset($data['sort_order']) ? intval($data['sort_order']) : 0;

    if (empty($pageId) || empty($moduleType)) {
        jsonError('页面ID和模块类型不能为空');
    }

    // 转换模块数据为JSON
    $moduleDataJson = json_encode($moduleData, JSON_UNESCAPED_UNICODE);

    if ($moduleId > 0) {
        // 更新现有模块
        $stmt = $conn->prepare("UPDATE page_builder_modules SET module_type=?, module_data=?, sort_order=?, updated_at=NOW() WHERE id=? AND page_id=?");
        $stmt->bind_param("ssiss", $moduleType, $moduleDataJson, $sortOrder, $moduleId, $pageId);
    } else {
        // 插入新模块
        $stmt = $conn->prepare("INSERT INTO page_builder_modules (page_id, module_type, module_data, sort_order) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $pageId, $moduleType, $moduleDataJson, $sortOrder);
    }

    if ($stmt->execute()) {
        $resultId = $moduleId > 0 ? $moduleId : $conn->insert_id;
        jsonSuccess(['module_id' => $resultId], '保存成功');
    } else {
        jsonError('保存失败: ' . $stmt->error);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    jsonError('系统错误: ' . $e->getMessage());
}
