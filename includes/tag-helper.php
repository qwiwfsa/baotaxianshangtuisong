<?php
/**
 * 标签辅助函数
 */

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * 将中文转换为拼音slug
 * @param string $name 中文名称
 * @return string 拼音slug
 */
function chineseToSlug($name) {
    // 使用 overtrue/pinyin 库
    $pinyin = new Overtrue\Pinyin\Pinyin();
    $result = $pinyin->permalink($name, '-');
    return strtolower(trim($result, '-'));
}

/**
 * 生成唯一slug
 * @param string $name 标签名称
 * @param mysqli $conn 数据库连接
 * @param int|null $excludeId 排除的ID（更新时使用）
 * @return string 唯一的slug
 */
function generateUniqueSlug($name, $conn, $excludeId = null) {
    $slug = chineseToSlug($name);
    $baseSlug = $slug;
    $counter = 1;
    
    while (true) {
        $sql = "SELECT id FROM tags WHERE slug = ?";
        $params = [$slug];
        $types = "s";
        
        if ($excludeId !== null) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
            $types .= "i";
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            break;
        }
        
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }
    
    return $slug;
}

