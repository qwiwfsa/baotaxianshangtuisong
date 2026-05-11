-- 宏都资本CMS数据库结构
-- 数据库名: hongdu_cms

-- 创建数据库
CREATE DATABASE IF NOT EXISTS hongdu_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hongdu_cms;

-- 页面表
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(50) NOT NULL UNIQUE COMMENT '页面标识',
    title VARCHAR(100) NOT NULL COMMENT '页面标题',
    content LONGTEXT COMMENT '页面内容HTML',
    meta_description VARCHAR(255) COMMENT 'SEO描述',
    meta_keywords VARCHAR(255) COMMENT 'SEO关键词',
    status TINYINT DEFAULT 1 COMMENT '状态: 1=发布, 0=草稿',
    sort_order INT DEFAULT 0 COMMENT '排序',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 成功案例表
CREATE TABLE IF NOT EXISTS cases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL COMMENT '案例标题',
    company VARCHAR(100) COMMENT '客户名称',
    amount VARCHAR(50) COMMENT '资金规模',
    period VARCHAR(50) COMMENT '服务周期',
    category VARCHAR(50) COMMENT '案例分类',
    description TEXT COMMENT '案例描述',
    content LONGTEXT COMMENT '详细内容',
    image VARCHAR(255) COMMENT '案例图片',
    status TINYINT DEFAULT 1 COMMENT '状态: 1=发布, 0=草稿',
    sort_order INT DEFAULT 0 COMMENT '排序',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 行业资讯表
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL COMMENT '新闻标题',
    summary TEXT COMMENT '摘要',
    content LONGTEXT COMMENT '详细内容',
    category VARCHAR(50) COMMENT '分类',
    cover_image VARCHAR(255) COMMENT '封面图',
    author VARCHAR(50) COMMENT '作者',
    views INT DEFAULT 0 COMMENT '浏览量',
    status TINYINT DEFAULT 1 COMMENT '状态: 1=发布, 0=草稿',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 媒体文件表
CREATE TABLE IF NOT EXISTS media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL COMMENT '文件名',
    original_name VARCHAR(255) COMMENT '原始文件名',
    file_path VARCHAR(255) NOT NULL COMMENT '文件路径',
    file_type VARCHAR(50) COMMENT '文件类型',
    file_size INT COMMENT '文件大小(字节)',
    used_in VARCHAR(100) COMMENT '使用位置',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 管理员表
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE COMMENT '用户名',
    password VARCHAR(255) NOT NULL COMMENT '密码(加密)',
    email VARCHAR(100) COMMENT '邮箱',
    role VARCHAR(20) DEFAULT 'admin' COMMENT '角色',
    last_login TIMESTAMP NULL COMMENT '最后登录时间',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 插入默认管理员账号 (密码: admin123)
INSERT INTO users (username, password, email, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@hengdziben.com', 'admin');

-- 插入默认页面数据
INSERT INTO pages (slug, title, content, meta_description, status) VALUES
('index', '首页', '<h1>专业资金解决方案</h1><p>提供上市公司短拆、企业摆账、银行存款、应收账款融资等全方位资金服务</p>', '宏都资本-专业资金业务服务商', 1),
('services', '业务范围', '<h1>业务范围</h1><p>涵盖上市公司、企业摆账、银行存款、应收账款融资等全方位资金服务</p>', '宏都资本业务范围', 1),
('cases', '成功案例', '<h1>成功案例</h1><p>多年来，我们已成功服务数百家企业，累计管理资金规模超百亿</p>', '宏都资本成功案例', 1),
('advantages', '服务优势', '<h1>服务优势</h1><p>专业团队、丰富经验、高效服务</p>', '宏都资本服务优势', 1),
('news', '行业资讯', '<h1>行业资讯</h1><p>最新行业动态和政策解读</p>', '宏都资本行业资讯', 1),
('faq', '常见问题', '<h1>常见问题</h1><p>解答您的疑问</p>', '宏都资本常见问题', 1),
('contact', '联系我们', '<h1>联系我们</h1><p>电话：13552883008</p>', '宏都资本联系方式', 1);

-- 插入示例案例
INSERT INTO cases (title, company, amount, period, category, description, status) VALUES
('股票解质押过桥', '某上市制造企业', '5.8亿元', '15天', '上市公司过桥', '为上市公司股东提供股票解质押过桥资金，成功化解质押风险', 1),
('募集账户归还过桥', '某大型集团公司', '8亿元', '7天', '上市公司过桥', '为上市公司提供募集资金账户归还过桥服务', 1),
('企业摆账服务', '某民营企业', '5000万', '30天', '企业摆账', '提供企业资金证明摆账服务', 1);

-- 插入示例新闻
INSERT INTO news (title, summary, content, category, author, status) VALUES
('资金业务市场分析报告', '2024年资金业务市场分析', '<p>详细内容...</p>', '行业动态', 'admin', 1),
('宏都资本服务升级公告', '我们推出了新的服务方案', '<p>详细内容...</p>', '公司新闻', 'admin', 1);
