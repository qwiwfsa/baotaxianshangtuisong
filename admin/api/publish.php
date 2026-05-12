<?php
/**
 * CMS页面发布API
 * 将数据保存到数据库，并同步更新前端HTML文件
 */

// 引入数据库配置
require_once __DIR__ . '/config.php';

// 设置响应头
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// 只允许POST请求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => '方法不允许']);
    exit;
}

// 获取POST数据
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '无效的JSON数据']);
    exit;
}

// 验证必需字段
if (empty($data['page'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '缺少页面ID']);
    exit;
}

$pageId = preg_replace('/[^a-zA-Z0-9_-]/', '', $data['page']);

// 页面映射配置
$pageMap = [
    'index' => 'index.html',
    'services' => 'services.html',
    'cases' => 'cases.html',
    'case-detail' => 'case-detail.html',
    'advantages' => 'advantages.html',
    'news' => 'news.html',
    'faq' => 'faq.html',
    'contact' => 'contact.html',
    'privacy' => 'privacy.html',
    'compliance' => 'compliance.html',
    'sitemap' => 'sitemap.html'
];

if (!isset($pageMap[$pageId])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => '未知的页面ID']);
    exit;
}

// 获取数据库连接
$conn = getDbConnection();

// 初始化数据库（确保表存在）
initDatabase($conn);

// 添加发布标记到数据中
$data['published'] = true;
$data['publishedAt'] = date('Y-m-d H:i:s');
$data['lastModified'] = date('Y-m-d H:i:s');

$pageName = isset($data['pageName']) ? $data['pageName'] : $pageId;
$title = isset($data['title']) ? $data['title'] : '';
$subtitle = isset($data['subtitle']) ? $data['subtitle'] : '';

// 准备内容JSON
$contentJson = json_encode($data, JSON_UNESCAPED_UNICODE);

// 检查页面是否已存在
$checkStmt = $conn->prepare("SELECT id FROM cms_pages WHERE page_id = ?");
$checkStmt->bind_param("s", $pageId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    // 更新现有页面
    $updateStmt = $conn->prepare("UPDATE cms_pages SET page_name = ?, title = ?, subtitle = ?, content = ? WHERE page_id = ?");
    $updateStmt->bind_param("sssss", $pageName, $title, $subtitle, $contentJson, $pageId);
    $result = $updateStmt->execute();
    $updateStmt->close();
} else {
    // 插入新页面
    $insertStmt = $conn->prepare("INSERT INTO cms_pages (page_id, page_name, title, subtitle, content) VALUES (?, ?, ?, ?, ?)");
    $insertStmt->bind_param("sssss", $pageId, $pageName, $title, $subtitle, $contentJson);
    $result = $insertStmt->execute();
    $insertStmt->close();
}

$checkStmt->close();
$conn->close();

if (!$result) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '保存到数据库失败']);
    exit;
}

// ====== 同步更新前端HTML文件 ======
$htmlFile = __DIR__ . '/../../' . $pageMap[$pageId];
$syncResult = syncHtmlFile($pageId, $data, $htmlFile);

if (!$syncResult['success']) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => '数据库保存成功，但同步HTML文件失败: ' . $syncResult['message'],
        'page' => $pageId,
        'file' => $pageMap[$pageId]
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => '发布成功',
    'page' => $pageId,
    'file' => $pageMap[$pageId],
    'publishedAt' => $data['publishedAt'],
    'syncDetails' => $syncResult
]);

/**
 * 同步更新HTML文件
 * @param string $pageId 页面ID
 * @param array $data 页面数据
 * @param string $htmlFile HTML文件路径
 * @return array 同步结果
 */
function syncHtmlFile($pageId, $data, $htmlFile) {
    if (!file_exists($htmlFile)) {
        return ['success' => false, 'message' => 'HTML文件不存在: ' . $htmlFile];
    }
    
    $htmlContent = file_get_contents($htmlFile);
    if ($htmlContent === false) {
        return ['success' => false, 'message' => '无法读取HTML文件'];
    }
    
    $originalContent = $htmlContent;
    $replacements = [];
    
    // 根据页面ID执行不同的替换逻辑
    
    // Flatten nested data from editor (fields under 'data' key)
    if (isset($data['data']) && is_array($data['data'])) {
        foreach ($data['data'] as $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }
    }

    // 根据页面ID执行不同的替换逻辑
switch ($pageId) {
        case 'contact':
            $replacements = syncContactPage($data, $htmlContent);
            break;
        case 'index':
            $replacements = syncIndexPage($data, $htmlContent);
            break;
        case 'services':
            $replacements = syncServicesPage($data, $htmlContent);
            break;
        case 'cases':
            $replacements = syncCasesPage($data, $htmlContent);
            break;
        case 'faq':
            $replacements = syncFaqPage($data, $htmlContent);
            break;
        case 'news':
            $replacements = syncNewsPage($data, $htmlContent);
            break;
        default:
            return ['success' => false, 'message' => '不支持的页面类型: ' . $pageId];
    }
    
    // 如果没有替换发生
    if (empty($replacements)) {
        return ['success' => true, 'message' => '没有需要更新的内容', 'replacements' => []];
    }
    
    // 如果内容没有变化
    if ($htmlContent === $originalContent) {
        return ['success' => true, 'message' => '内容已是最新', 'replacements' => $replacements];
    }
    
    // 写入文件
    $result = file_put_contents($htmlFile, $htmlContent, LOCK_EX);
    if ($result === false) {
        return ['success' => false, 'message' => '无法写入HTML文件'];
    }
    
    return [
        'success' => true,
        'message' => 'HTML文件已更新',
        'replacements' => $replacements,
        'bytesWritten' => $result
    ];
}

/**
 * 同步联系我们页面
 */
function syncContactPage($data, &$htmlContent) {
    $replacements = [];
    
    // 替换联系电话 - 使用ID选择器
    if (!empty($data['contactPhone'])) {
        // 替换 cms-contact-phone
        $htmlContent = preg_replace(
            '/(<span id="cms-contact-phone">)([^<]*)(<\/span>)/i',
            '${1}' . escapeRegexReplacement($data['contactPhone']) . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '联系电话(cms-contact-phone): ' . $data['contactPhone'];
        }
        
        // 替换 cms-float-phone
        $htmlContent = preg_replace(
            '/(<span id="cms-float-phone"[^>]*>)([^<]*)(<\/span>)/i',
            '${1}' . escapeRegexReplacement($data['contactPhone']) . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '浮动电话(cms-float-phone): ' . $data['contactPhone'];
        }
        
        // 替换 cms-footer-phone
        $htmlContent = preg_replace(
            '/(<span id="cms-footer-phone">)([^<]*)(<\/span>)/i',
            '${1}' . escapeRegexReplacement($data['contactPhone']) . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '页脚电话(cms-footer-phone): ' . $data['contactPhone'];
        }
        
        // 替换其他位置的13552883008
        $htmlContent = preg_replace(
            '/(>\s*)13552883008(\s*<)/i',
            '${1}' . escapeRegexReplacement($data['contactPhone']) . '${2}',
            $htmlContent,
            -1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '其他位置电话: ' . $data['contactPhone'] . ' (共' . $count . '处)';
        }
        
        // 替换meta中的电话
        $htmlContent = preg_replace(
            '/(<meta name="description" content="[^"]*电话：)[0-9\-]+(")/i',
            '${1}' . escapeRegexReplacement($data['contactPhone']) . '${2}',
            $htmlContent,
            1,
            $count
        );
    }
    
    // 替换联系人
    if (!empty($data['contactName'])) {
        // 替换 cms-footer-name
        $htmlContent = preg_replace(
            '/(<span id="cms-footer-name">)([^<]*)(<\/span>)/i',
            '${1}' . escapeRegexReplacement($data['contactName']) . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '联系人(cms-footer-name): ' . $data['contactName'];
        }
        
        // 替换其他位置的王总
        $htmlContent = preg_replace(
            '/(<i class="fas fa-user"><\/i>\s*<span[^>]*>)王总(<\/span>)/i',
            '${1}' . escapeRegexReplacement($data['contactName']) . '${2}',
            $htmlContent,
            1,
            $count
        );
    }
    
    // 替换邮箱
    if (!empty($data['contactEmail'])) {
        // 替换 cms-footer-email
        $htmlContent = preg_replace(
            '/(<span id="cms-footer-email">)([^<]*)(<\/span>)/i',
            '${1}' . escapeRegexReplacement($data['contactEmail']) . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '邮箱(cms-footer-email): ' . $data['contactEmail'];
        }
        
        // 替换mailto链接
        $htmlContent = preg_replace(
            '/(href="mailto:)[^"]*(")/i',
            '${1}' . escapeRegexReplacement($data['contactEmail']) . '${2}',
            $htmlContent,
            1,
            $count
        );
        // 替换mailto文本
        $htmlContent = preg_replace(
            '/(mailto:)[^<\s]+/i',
            '${1}' . escapeRegexReplacement($data['contactEmail']),
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '邮箱链接: ' . $data['contactEmail'];
        }
    }
    
    // 替换地址
    if (!empty($data['contactAddress'])) {
        $htmlContent = preg_replace(
            '/(<strong>财富金融中心<\/strong><br>\s*)([^<]+)/i',
            '${1}' . escapeRegexReplacement($data['contactAddress']),
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '地址: ' . $data['contactAddress'];
        }
    }
    
    return $replacements;
}

/**
 * 同步首页
 */
function syncIndexPage($data, &$htmlContent) {
    $replacements = [];
    
    // 替换主标题
    if (!empty($data['heroTitle'])) {
        $heroTitle = nl2br(htmlspecialchars($data['heroTitle']));
        $htmlContent = preg_replace(
            '/(<h1 class="hero-title">)(.*?)(<\/h1>)/is',
            '${1}' . $heroTitle . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '主标题已更新';
        }
    }
    
    // 替换副标题
    if (!empty($data['heroSubtitle'])) {
        $heroSubtitle = htmlspecialchars($data['heroSubtitle']);
        $htmlContent = preg_replace(
            '/(<p class="hero-subtitle">)(.*?)(<\/p>)/is',
            '${1}' . $heroSubtitle . '${3}',
            $htmlContent,
            1,
            $count
        );
        if ($count > 0) {
            $replacements[] = '副标题已更新';
        }
    }
    
            // 替换核心优势标题
        if (!empty($data['advantagesTitle'])) {
            $advTitle = htmlspecialchars($data['advantagesTitle']);
            $htmlContent = preg_replace(
                '/(<h2 class="advantages-title"[^>]*>)(.*?)(<\/h2>)/is',
                '${1}' . $advTitle . '${3}',
                $htmlContent, 1, $count
            );
            if ($count > 0) { $replacements[] = '优势标题已更新'; }
        }
        // 替换核心优势副标题
        if (!empty($data['advantagesSubtitle'])) {
            $advSub = htmlspecialchars($data['advantagesSubtitle']);
            $htmlContent = preg_replace(
                '/(<p class="advantages-subtitle">)(.*?)(<\/p>)/is',
                '${1}' . $advSub . '${3}',
                $htmlContent, 1, $count
            );
            if ($count > 0) { $replacements[] = '优势副标题已更新'; }
        }

return $replacements;
}

/**
 * 同步业务范围页面
 */
function syncServicesPage($data, &$htmlContent) {
    $replacements = [];
    
    // 替换各服务内容
    $services = ['listed', 'baizhang', 'deposit', 'receivable'];
    foreach ($services as $service) {
        $titleKey = $service . 'Title';
        $contentKey = $service . 'Content';
        
        if (!empty($data[$titleKey])) {
            $replacements[] = $service . '标题已更新';
        }
        if (!empty($data[$contentKey])) {
            $replacements[] = $service . '内容已更新';
        }
    }
    
    return $replacements;
}

/**
 * 同步成功案例页面
 */
function syncCasesPage($data, &$htmlContent) {
    $replacements = [];
    
    $stats = [
        'statClients' => '服务企业数',
        'statAmount' => '管理资金规模',
        'statSuccess' => '成功率',
        'statSatisfaction' => '客户满意度'
    ];
    
    foreach ($stats as $key => $label) {
        if (!empty($data[$key])) {
            $replacements[] = $label . ': ' . $data[$key];
        }
    }
    
    return $replacements;
}

/**
 * 同步FAQ页面
 */
function syncFaqPage($data, &$htmlContent) {
    $replacements = [];
    
    if (!empty($data['pageTitle'])) {
        $replacements[] = '页面标题已更新';
    }
    if (!empty($data['pageSubtitle'])) {
        $replacements[] = '页面副标题已更新';
    }
    
    return $replacements;
}

/**
 * 同步资讯页面
 */
function syncNewsPage($data, &$htmlContent) {
    $replacements = [];
    
    if (!empty($data['pageTitle'])) {
        $replacements[] = '页面标题已更新';
    }
    if (!empty($data['pageSubtitle'])) {
        $replacements[] = '页面副标题已更新';
    }
    
    return $replacements;
}

/**
 * 转义正则替换字符串中的特殊字符
 */
function escapeRegexReplacement($str) {
    return str_replace(['\\', '$'], ['\\\\', '\\$'], $str);
}
