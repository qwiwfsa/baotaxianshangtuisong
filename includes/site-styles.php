<?php
/**
 * 站点样式读取函数
 * 可供前端 PHP 页面直接调用
 * 
 * 用法：
 *   require_once 'includes/site-styles.php';
 *   $styles = getSiteStyles('news');
 *   $coverWidth = $styles['news_cover_width'] ?? 180;
 */

/**
 * 获取站点样式配置
 * @param string $group 分组名称（可选）
 * @return array 样式配置
 */
function getSiteStyles($group = '') {
    require_once dirname(__DIR__) . '/config/db.php';
    
    $conn = getDB();
    
    if ($group) {
        $stmt = $conn->prepare("SELECT style_key, style_value FROM site_styles WHERE group_name = ?");
        $stmt->bind_param('s', $group);
    } else {
        $stmt = $conn->prepare("SELECT style_key, style_value FROM site_styles");
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $styles = [];
    while ($row = $result->fetch_assoc()) {
        $key = $row['style_key'];
        $value = $row['style_value'];
        
        // 尝试解析JSON
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $styles[$key] = $decoded;
        } else {
            $styles[$key] = $value;
        }
    }
    
    $stmt->close();
    return $styles;
}

/**
 * 获取一个样式值
 * @param string $key 样式键名
 * @param string $default 默认值
 * @return mixed 样式值
 */
function getSiteStyle($key, $default = '') {
    $styles = getSiteStyles();
    return isset($styles[$key]) ? $styles[$key] : $default;
}
