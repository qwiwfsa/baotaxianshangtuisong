<?php
/**
 * 网站访问统计API
 * 提供前端网页数据统计功能
 */

// 允许跨域请求
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once 'config.php';

/**
 * 初始化统计表
 */
function initStatsTable($conn) {
    // 创建访问日志表
    $sql = "CREATE TABLE IF NOT EXISTS cms_statistics (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(45) NOT NULL,
        user_agent VARCHAR(500),
        page_url VARCHAR(500) NOT NULL,
        referer VARCHAR(500),
        source_type VARCHAR(50) DEFAULT 'direct',
        visit_date DATE NOT NULL,
        visit_time TIME NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_ip_date (ip_address, visit_date),
        INDEX idx_visit_date (visit_date),
        INDEX idx_page_url (page_url),
        INDEX idx_source_type (source_type)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);
    
    // 创建每日统计汇总表
    $sql = "CREATE TABLE IF NOT EXISTS cms_stats_daily (
        id INT AUTO_INCREMENT PRIMARY KEY,
        stat_date DATE NOT NULL UNIQUE,
        total_visits INT DEFAULT 0,
        unique_visitors INT DEFAULT 0,
        page_views INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $conn->query($sql);
}

/**
 * 获取访客IP地址
 */
function getClientIP() {
    $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 
               'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
    foreach ($ipKeys as $key) {
        if (!empty($_SERVER[$key])) {
            $ips = explode(',', $_SERVER[$key]);
            $ip = trim($ips[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return '0.0.0.0';
}

/**
 * 判断访问来源类型
 */
function getSourceType($referer) {
    if (empty($referer)) {
        return 'direct';
    }
    
    $referer = strtolower($referer);
    
    // 搜索引擎
    $searchEngines = ['google', 'baidu', 'bing', 'yahoo', 'sogou', '360', 'yandex'];
    foreach ($searchEngines as $engine) {
        if (strpos($referer, $engine) !== false) {
            return 'search';
        }
    }
    
    // 社交媒体
    $socialMedia = ['weibo', 'wechat', 'qq', 'facebook', 'twitter', 'linkedin'];
    foreach ($socialMedia as $social) {
        if (strpos($referer, $social) !== false) {
            return 'social';
        }
    }
    
    // 外部链接
    return 'external';
}

/**
 * 记录访问日志
 */
function recordVisit($conn) {
    $ip = getClientIP();
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $pageUrl = $_POST['page_url'] ?? ($_SERVER['HTTP_REFERER'] ?? '');
    $referer = $_POST['referer'] ?? '';
    $sourceType = getSourceType($referer);
    
    $visitDate = date('Y-m-d');
    $visitTime = date('H:i:s');
    
    // 插入访问记录
    $stmt = $conn->prepare("INSERT INTO cms_statistics 
        (ip_address, user_agent, page_url, referer, source_type, visit_date, visit_time) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $ip, $userAgent, $pageUrl, $referer, $sourceType, $visitDate, $visitTime);
    $stmt->execute();
    $stmt->close();
    
    return ['success' => true, 'message' => '访问记录已保存'];
}

/**
 * 获取统计数据
 */
function getStats($conn) {
    $today = date('Y-m-d');
    
    // 总访问量
    $totalVisits = 0;
    $result = $conn->query("SELECT COUNT(*) as total FROM cms_statistics");
    if ($result && $row = $result->fetch_assoc()) {
        $totalVisits = (int)$row['total'];
    }
    
    // 今日访问量
    $todayVisits = 0;
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM cms_statistics WHERE visit_date = ?");
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $todayVisits = (int)$row['total'];
    }
    $stmt->close();
    
    // 独立访客数（今日）
    $uniqueVisitors = 0;
    $stmt = $conn->prepare("SELECT COUNT(DISTINCT ip_address) as total FROM cms_statistics WHERE visit_date = ?");
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $uniqueVisitors = (int)$row['total'];
    }
    $stmt->close();
    
    // 总独立访客数
    $totalUniqueVisitors = 0;
    $result = $conn->query("SELECT COUNT(DISTINCT ip_address) as total FROM cms_statistics");
    if ($result && $row = $result->fetch_assoc()) {
        $totalUniqueVisitors = (int)$row['total'];
    }
    
    // 各页面浏览量
    $pageViews = [];
    $result = $conn->query("SELECT page_url, COUNT(*) as views FROM cms_statistics GROUP BY page_url ORDER BY views DESC LIMIT 10");
    while ($result && $row = $result->fetch_assoc()) {
        $pageViews[] = [
            'page' => basename($row['page_url']),
            'url' => $row['page_url'],
            'views' => (int)$row['views']
        ];
    }
    
    // 访问来源统计
    $sourceStats = [];
    $result = $conn->query("SELECT source_type, COUNT(*) as count FROM cms_statistics GROUP BY source_type");
    while ($result && $row = $result->fetch_assoc()) {
        $sourceStats[$row['source_type']] = (int)$row['count'];
    }
    
    // 最近7天访问趋势
    $visitTrend = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM cms_statistics WHERE visit_date = ?");
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = 0;
        if ($row = $result->fetch_assoc()) {
            $count = (int)$row['total'];
        }
        $stmt->close();
        
        $visitTrend[] = [
            'date' => $date,
            'date_label' => date('m/d', strtotime($date)),
            'visits' => $count
        ];
    }
    
    return [
        'success' => true,
        'data' => [
            'totalVisits' => $totalVisits,
            'todayVisits' => $todayVisits,
            'uniqueVisitors' => $uniqueVisitors,
            'totalUniqueVisitors' => $totalUniqueVisitors,
            'pageViews' => $pageViews,
            'sourceStats' => $sourceStats,
            'visitTrend' => $visitTrend
        ]
    ];
}

/**
 * 获取简化版统计数据（用于前端跟踪）
 */
function getSimpleStats($conn) {
    $today = date('Y-m-d');
    
    // 今日访问量
    $todayVisits = 0;
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM cms_statistics WHERE visit_date = ?");
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $todayVisits = (int)$row['total'];
    }
    $stmt->close();
    
    // 总访问量
    $totalVisits = 0;
    $result = $conn->query("SELECT COUNT(*) as total FROM cms_statistics");
    if ($result && $row = $result->fetch_assoc()) {
        $totalVisits = (int)$row['total'];
    }
    
    return [
        'success' => true,
        'data' => [
            'todayVisits' => $todayVisits,
            'totalVisits' => $totalVisits
        ]
    ];
}

// 主逻辑
try {
    $conn = getDbConnection();
    initStatsTable($conn);
    
    $action = $_GET['action'] ?? $_POST['action'] ?? 'get';
    
    switch ($action) {
        case 'record':
            // 记录访问
            echo json_encode(recordVisit($conn));
            break;
            
        case 'simple':
            // 获取简化统计
            echo json_encode(getSimpleStats($conn));
            break;
            
        case 'get':
        default:
            // 获取完整统计
            echo json_encode(getStats($conn));
            break;
    }
    
    $conn->close();
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
