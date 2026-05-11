-- ========================================
-- 页脚配置表 - 建表SQL
-- Yao资金网 CMS
-- ========================================

-- 删除旧表（如有）
DROP TABLE IF EXISTS `footer_settings`;

-- 创建页脚配置表
CREATE TABLE `footer_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_key` varchar(50) NOT NULL COMMENT '分组：brand/quick_links/service_links/contact/bottom',
  `item_key` varchar(50) NOT NULL COMMENT '配置键名',
  `item_label` varchar(100) NOT NULL COMMENT '配置中文标签',
  `item_value` text COMMENT '配置文本值',
  `item_url` varchar(500) DEFAULT NULL COMMENT '链接URL',
  `sort_order` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_group` (`group_key`),
  KEY `idx_key` (`item_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='页脚配置表';

-- ========================================
-- 默认数据
-- ========================================

-- 品牌信息
INSERT INTO `footer_settings` (`group_key`, `item_key`, `item_label`, `item_value`, `item_url`, `sort_order`) VALUES
('brand', 'company_desc', '企业简介文案', '专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务', NULL, 1);

-- 快速链接
INSERT INTO `footer_settings` (`group_key`, `item_key`, `item_label`, `item_value`, `item_url`, `sort_order`) VALUES
('quick_links', 'link_1', '首页', '首页', '/', 1),
('quick_links', 'link_2', '服务项目', '服务项目', 'services.html', 2),
('quick_links', 'link_3', '成功案例', '成功案例', 'cases.html', 3),
('quick_links', 'link_4', '公司优势', '公司优势', 'advantages.html', 4),
('quick_links', 'link_5', '行业资讯', '行业资讯', 'news.html', 5);

-- 业务链接
INSERT INTO `footer_settings` (`group_key`, `item_key`, `item_label`, `item_value`, `item_url`, `sort_order`) VALUES
('service_links', 'svc_1', '上市公司融资', '上市公司融资', 'services.html', 1),
('service_links', 'svc_2', '企业/个人摆账', '企业/个人摆账', 'services.html', 2),
('service_links', 'svc_3', '银行存款', '银行存款', 'services.html', 3),
('service_links', 'svc_4', '应收账款融资', '应收账款融资', 'services.html', 4);

-- 联系方式
INSERT INTO `footer_settings` (`group_key`, `item_key`, `item_label`, `item_value`, `item_url`, `sort_order`) VALUES
('contact', 'phone', '手机号', '13552883008', NULL, 1),
('contact', 'contact_person', '联系人', '王先生', NULL, 2),
('contact', 'email', '邮箱', 'wanglizhongguo@126.com', NULL, 3);

-- 底部信息
INSERT INTO `footer_settings` (`group_key`, `item_key`, `item_label`, `item_value`, `item_url`, `sort_order`) VALUES
('bottom', 'copyright_text', '版权声明文字', '&copy; 2024 Yao资金网 版权所有', NULL, 1),
('bottom', 'disclaimer_text', '风险提示免责文案', '投资有风险，理财需谨慎。本网站内容仅供参考，不构成投资建议。', NULL, 2);
