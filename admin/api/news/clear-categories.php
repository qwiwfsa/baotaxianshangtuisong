<?php
/**
 * 清空文章分类表
 * 警告：此操作会删除所有分类数据
 */

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $conn = getDbConnection();

    // 删除所有分类
    $result = $conn->query("DELETE FROM cms_categories");

    if ($result) {
        // 重置自增ID
        $conn->query("ALTER TABLE cms_categories AUTO_INCREMENT = 1");

        echo json_encode([
            'success' => true,
            'message' => '所有分类已清空，可以重新添加'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => '清空失败: ' . $conn->error
        ]);
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => '操作失败: ' . $e->getMessage()
    ]);
}
