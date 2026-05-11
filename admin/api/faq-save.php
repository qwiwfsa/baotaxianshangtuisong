<?php
/**
 * FAQ保存 API
 * POST: 保存/更新/删除FAQ
 */

require_once __DIR__ . '/../../config/db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$conn = getDB();

// ========== POST 处理 ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    // --- 删除FAQ ---
    if ($action === 'delete') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if (!$id) {
            echo json_encode(['code' => 1, 'msg' => '缺少ID参数']);
            exit;
        }
        $stmt = $conn->prepare("DELETE FROM faq WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '删除成功']);
        exit;
    }

    // --- 保存FAQ（新增或更新） ---
    if ($action === 'save') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $question = isset($_POST['question']) ? trim($_POST['question']) : '';
        $answer = isset($_POST['answer']) ? trim($_POST['answer']) : '';
        $category = isset($_POST['category']) ? trim($_POST['category']) : 'general';

        if (!$question) {
            echo json_encode(['code' => 1, 'msg' => '问题不能为空']);
            exit;
        }

        if (!$answer) {
            echo json_encode(['code' => 1, 'msg' => '答案不能为空']);
            exit;
        }

        $seo_title = isset($_POST['seo_title']) ? trim($_POST['seo_title']) : '';
        $seo_keywords = isset($_POST['seo_keywords']) ? trim($_POST['seo_keywords']) : '';
        $seo_description = isset($_POST['seo_description']) ? trim($_POST['seo_description']) : '';

        if ($id > 0) {
            // 更新现有FAQ
            $stmt = $conn->prepare("UPDATE faq SET question=?, answer=?, category=?, seo_title=?, seo_keywords=?, seo_description=? WHERE id=?");
            $stmt->bind_param("ssssssi", $question, $answer, $category, $seo_title, $seo_keywords, $seo_description, $id);
            $stmt->execute();
            $stmt->close();
            echo json_encode(['code' => 0, 'msg' => '更新成功', 'id' => $id]);
        } else {
            // 新增FAQ
            $stmt = $conn->prepare("INSERT INTO faq (question, answer, category, seo_title, seo_keywords, seo_description) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $question, $answer, $category, $seo_title, $seo_keywords, $seo_description);
            $stmt->execute();
            $newId = $conn->insert_id;
            $stmt->close();
            echo json_encode(['code' => 0, 'msg' => '添加成功', 'id' => $newId]);
        }
        exit;
    }

    // --- 保存分类 ---
    if ($action === 'save_categories') {
        $categoriesJson = isset($_POST['categories']) ? $_POST['categories'] : '';
        if (!$categoriesJson) {
            echo json_encode(['code' => 1, 'msg' => '缺少分类数据']);
            exit;
        }
        $categoryData = json_decode($categoriesJson, true);
        if (!$categoryData || !is_array($categoryData)) {
            echo json_encode(['code' => 1, 'msg' => '分类数据格式错误']);
            exit;
        }
        
        // 清空旧数据
        $conn->query("DELETE FROM faq_categories");
        
        // 插入新数据
        $stmt = $conn->prepare("INSERT INTO faq_categories (cat_key, cat_label, sort_order, seo_title, seo_keywords, seo_description) VALUES (?, ?, ?, ?, ?, ?)");
        $sortOrder = 0;
        foreach ($categoryData as $item) {
            $key = $item['key'];
            $label = $item['label'];
            $seo_title = isset($item['seo_title']) ? trim($item['seo_title']) : '';
            $seo_keywords = isset($item['seo_keywords']) ? trim($item['seo_keywords']) : '';
            $seo_description = isset($item['seo_description']) ? trim($item['seo_description']) : '';
            $stmt->bind_param("ssisss", $key, $label, $sortOrder, $seo_title, $seo_keywords, $seo_description);
            $stmt->execute();
            $sortOrder++;
        }
        $stmt->close();
        
        echo json_encode(['code' => 0, 'msg' => '分类保存成功']);
        exit;
    }

    // --- 新增分类 ---
    if ($action === 'add_category') {
        $key = isset($_POST['key']) ? trim($_POST['key']) : '';
        $label = isset($_POST['label']) ? trim($_POST['label']) : '';
        
        if (!$key || !$label) {
            echo json_encode(['code' => 1, 'msg' => '分类键名和标签不能为空']);
            exit;
        }
        
        // 检查键名是否已存在
        $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM faq_categories WHERE cat_key=?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        if ($row['cnt'] > 0) {
            echo json_encode(['code' => 1, 'msg' => '分类键名已存在']);
            exit;
        }
        
        // 获取最大排序值
        $result = $conn->query("SELECT MAX(sort_order) as max_order FROM faq_categories");
        $row = $result->fetch_assoc();
        $maxOrder = intval($row['max_order']) + 1;
        
        $stmt = $conn->prepare("INSERT INTO faq_categories (cat_key, cat_label, sort_order) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $key, $label, $maxOrder);
        $stmt->execute();
        $stmt->close();
        
        echo json_encode(['code' => 0, 'msg' => '分类添加成功']);
        exit;
    }

    // --- 删除分类 ---
    if ($action === 'delete_category') {
        $key = isset($_POST['key']) ? trim($_POST['key']) : '';
        if (!$key) {
            echo json_encode(['code' => 1, 'msg' => '缺少分类键名']);
            exit;
        }
        $stmt = $conn->prepare("DELETE FROM faq_categories WHERE cat_key=?");
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $stmt->close();
        echo json_encode(['code' => 0, 'msg' => '分类删除成功']);
        exit;
    }

    echo json_encode(['code' => 1, 'msg' => '未知操作']);
    exit;
}

echo json_encode(['code' => 1, 'msg' => '仅支持POST请求']);
