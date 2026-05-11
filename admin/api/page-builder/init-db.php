<?php
/**
 * 页面构建器数据库初始化
 */

require_once __DIR__ . '/../config.php';

try {
    $conn = getDbConnection();

    // 创建页面构建器模块表
    $sql = "CREATE TABLE IF NOT EXISTS page_builder_modules (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_id VARCHAR(50) NOT NULL,
        module_type VARCHAR(50) NOT NULL COMMENT '模块类型：banner, card, text, image, video, custom',
        module_data JSON NOT NULL COMMENT '模块配置数据',
        sort_order INT DEFAULT 0,
        is_active TINYINT DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_page_id (page_id),
        INDEX idx_sort_order (sort_order)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='页面构建器模块表';";

    if ($conn->query($sql)) {
        echo "✓ 页面构建器模块表创建成功\n";
    } else {
        echo "✗ 创建失败: " . $conn->error . "\n";
    }

    // 创建页面模板表
    $sql = "CREATE TABLE IF NOT EXISTS page_builder_templates (
        id INT AUTO_INCREMENT PRIMARY KEY,
        template_name VARCHAR(100) NOT NULL,
        template_description TEXT,
        template_data JSON NOT NULL,
        thumbnail VARCHAR(500),
        category VARCHAR(50) DEFAULT 'general',
        is_system TINYINT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='页面模板表';";

    if ($conn->query($sql)) {
        echo "✓ 页面模板表创建成功\n";
    } else {
        echo "✗ 创建失败: " . $conn->error . "\n";
    }

    // 插入默认模板数据
    $defaultTemplates = [
        [
            'name' => '企业首页模板',
            'description' => '适合企业官网首页，包含Banner、服务介绍、案例展示',
            'category' => 'homepage',
            'data' => json_encode([
                ['type' => 'banner', 'config' => ['height' => 600, 'autoplay' => true]],
                ['type' => 'text', 'config' => ['title' => '我们的服务', 'align' => 'center']],
                ['type' => 'card', 'config' => ['columns' => 3, 'style' => 'modern']],
            ])
        ],
        [
            'name' => '关于我们模板',
            'description' => '公司介绍页面模板',
            'category' => 'about',
            'data' => json_encode([
                ['type' => 'text', 'config' => ['title' => '关于我们']],
                ['type' => 'image', 'config' => ['layout' => 'full']],
                ['type' => 'text', 'config' => ['content' => '公司简介内容']],
            ])
        ]
    ];

    $stmt = $conn->prepare("INSERT INTO page_builder_templates (template_name, template_description, category, template_data, is_system) VALUES (?, ?, ?, ?, 1)");

    foreach ($defaultTemplates as $tpl) {
        $stmt->bind_param("ssss", $tpl['name'], $tpl['description'], $tpl['category'], $tpl['data']);
        $stmt->execute();
    }
    $stmt->close();

    echo "✓ 默认模板数据插入成功\n";
    echo "\n数据库初始化完成！\n";

    $conn->close();

} catch (Exception $e) {
    echo "✗ 错误: " . $e->getMessage() . "\n";
    exit(1);
}
