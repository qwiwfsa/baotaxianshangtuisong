<?php
/**
 * 页脚配置保存 API
 * 接收POST JSON数据，更新或插入 footer_settings 表
 * 
 * 部署步骤见 footer-data.php
 */

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json; charset=utf-8');
// 城市分站缓存清理
function clearFenzhanCache() {
    $cacheDir = __DIR__ . "/../../fenzhan/cache/";
    if (is_dir($cacheDir)) {
        $files = glob($cacheDir . "*.html");
        foreach ($files as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['code' => 1, 'msg' => '仅支持POST请求']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['code' => 1, 'msg' => '无效的JSON数据']);
    exit;
}

$conn = getDB();

$action = $input['action'] ?? 'save';

if ($action === 'save') {
    // 保存单条记录
    $groupKey  = $input['group_key'] ?? '';
    $itemKey   = $input['item_key'] ?? '';
    $itemValue = $input['item_value'] ?? '';
    $itemUrl   = $input['item_url'] ?? '';

    if (!$groupKey || !$itemKey) {
        echo json_encode(['code' => 1, 'msg' => '缺少必要参数(group_key / item_key)']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO footer_settings (group_key, item_key, item_label, item_value, item_url) 
                            VALUES (?, ?, ?, ?, ?) 
                            ON DUPLICATE KEY UPDATE item_value=VALUES(item_value), item_url=VALUES(item_url), updated_at=NOW()");
    // item_label 从现有数据获取或使用 item_key
    $label = $input['item_label'] ?? $itemKey;
    $stmt->bind_param("sssss", $groupKey, $itemKey, $label, $itemValue, $itemUrl);
    $stmt->execute();
    $stmt->close();

    clearFenzhanCache();
    echo json_encode(['code' => 0, 'msg' => '保存成功']);
    exit;
}

if ($action === 'save_all') {
    // 批量保存整个页脚
    $settings = $input['settings'] ?? [];
    if (empty($settings)) {
        echo json_encode(['code' => 1, 'msg' => '没有要保存的数据']);
        exit;
    }

    foreach ($settings as $item) {
        $groupKey  = $item['group_key'] ?? '';
        $itemKey   = $item['item_key'] ?? '';
        $itemValue = $item['item_value'] ?? '';
        $itemUrl   = $item['item_url'] ?? '';
        $itemLabel = $item['item_label'] ?? $itemKey;
        $sortOrder = $item['sort_order'] ?? 0;

        if (!$groupKey || !$itemKey) continue;

        $stmt = $conn->prepare("INSERT INTO footer_settings (group_key, item_key, item_label, item_value, item_url, sort_order) 
                                VALUES (?, ?, ?, ?, ?, ?) 
                                ON DUPLICATE KEY UPDATE item_label=VALUES(item_label), item_value=VALUES(item_value), item_url=VALUES(item_url), sort_order=VALUES(sort_order), updated_at=NOW()");
        $stmt->bind_param("sssssi", $groupKey, $itemKey, $itemLabel, $itemValue, $itemUrl, $sortOrder);
        $stmt->execute();
        $stmt->close();
    }

    clearFenzhanCache();
    echo json_encode(['code' => 0, 'msg' => '全部保存成功']);
    exit;
}

if ($action === 'add_link') {
    // 添加新链接 (quick_links / service_links)
    $groupKey = $input['group_key'] ?? '';
    $itemKey  = $input['item_key'] ?? '';
    $label    = $input['item_label'] ?? '';
    $url      = $input['item_url'] ?? '';
    $sort     = $input['sort_order'] ?? 0;

    if (!$groupKey || !$itemKey) {
        echo json_encode(['code' => 1, 'msg' => '缺少必要参数']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO footer_settings (group_key, item_key, item_label, item_value, item_url, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $groupKey, $itemKey, $label, $label, $url, $sort);
    $stmt->execute();
    $newId = $stmt->insert_id;
    $stmt->close();

    clearFenzhanCache();
    echo json_encode(['code' => 0, 'msg' => '添加成功', 'id' => $newId]);
    exit;
}

if ($action === 'delete_link') {
    // 删除链接
    $id = $input['id'] ?? 0;
    if (!$id) {
        echo json_encode(['code' => 1, 'msg' => '缺少ID']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM footer_settings WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    clearFenzhanCache();
    echo json_encode(['code' => 0, 'msg' => '删除成功']);
    exit;
}

echo json_encode(['code' => 1, 'msg' => '未知操作']);
