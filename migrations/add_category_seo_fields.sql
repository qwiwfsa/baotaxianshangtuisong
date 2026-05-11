-- 为 cms_categories 表添加SEO字段
-- 如果字段已存在（通过新的CREATE TABLE），此语句不会重复添加
ALTER TABLE cms_categories
    ADD COLUMN IF NOT EXISTS seo_title VARCHAR(200) DEFAULT '' AFTER description,
    ADD COLUMN IF NOT EXISTS seo_keywords VARCHAR(255) DEFAULT '' AFTER seo_title,
    ADD COLUMN IF NOT EXISTS seo_description TEXT AFTER seo_keywords;
