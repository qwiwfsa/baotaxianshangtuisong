<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
// ===== 动态 SEO =====
$seo_title = '';
$seo_desc = '';
$seo_keywords = '';
$seo_url = 'https://www.yaozijin.com/news-detail.php?id=' . intval($_GET['id'] ?? 0);
$article_id_seo = intval($_GET['id'] ?? 0);
if ($article_id_seo > 0) {
    try {
        require_once __DIR__ . '/config/db.php';
        $db_seo = getDB();
        $stmt_seo = $db_seo->prepare("SELECT title, seo_title, seo_keywords, seo_description, summary FROM cms_articles WHERE id = ? AND status = 'published' LIMIT 1");
        $stmt_seo->bind_param('i', $article_id_seo);
        $stmt_seo->execute();
        $result_seo = $stmt_seo->get_result();
        if ($row_seo = $result_seo->fetch_assoc()) {
            $seo_title = !empty($row_seo['seo_title']) ? $row_seo['seo_title'] : ($row_seo['title'] . ' - Yao资金网');
            $seo_desc = !empty($row_seo['seo_description']) ? $row_seo['seo_description'] : (!empty($row_seo['summary']) ? mb_substr($row_seo['summary'], 0, 200) : '');
            $seo_keywords = !empty($row_seo['seo_keywords']) ? $row_seo['seo_keywords'] : '';
        }
        $stmt_seo->close();
        $db_seo->close();
    } catch (Exception $e) {}
}

// ===== 相关推荐 =====
$related_articles = [];
if ($article_id_seo > 0) {
    try {
        require_once __DIR__ . '/config/db.php';
        $db_rel = getDB();
        // Get current article's category
        $cat_stmt = $db_rel->prepare("SELECT category_id FROM cms_articles WHERE id = ?");
        $cat_stmt->bind_param('i', $article_id_seo);
        $cat_stmt->execute();
        $cat_result = $cat_stmt->get_result();
        $cat_row = $cat_result->fetch_assoc();
        $category_id = $cat_row ? (int)$cat_row['category_id'] : 0;
        $cat_stmt->close();

        if ($category_id > 0) {
            $rel_stmt = $db_rel->prepare("SELECT id, title, cover_image, created_at FROM cms_articles WHERE category_id = ? AND id != ? AND status = 'published' ORDER BY id DESC LIMIT 4");
            $rel_stmt->bind_param('ii', $category_id, $article_id_seo);
            $rel_stmt->execute();
            $rel_result = $rel_stmt->get_result();
            while ($row = $rel_result->fetch_assoc()) {
                if (!empty($row['cover_image']) && strpos($row['cover_image'], 'http') !== 0 && strpos($row['cover_image'], '/') !== 0) {
                    $row['cover_image'] = '/' . $row['cover_image'];
                }
                $related_articles[] = $row;
            }
            $rel_stmt->close();
        }

        if (empty($related_articles)) {
            $rel_stmt2 = $db_rel->prepare("SELECT id, title, cover_image, created_at FROM cms_articles WHERE id != ? AND status = 'published' ORDER BY id DESC LIMIT 4");
            $rel_stmt2->bind_param('i', $article_id_seo);
            $rel_stmt2->execute();
            $rel_result2 = $rel_stmt2->get_result();
            while ($row = $rel_result2->fetch_assoc()) {
                if (!empty($row['cover_image']) && strpos($row['cover_image'], 'http') !== 0 && strpos($row['cover_image'], '/') !== 0) {
                    $row['cover_image'] = '/' . $row['cover_image'];
                }
                $related_articles[] = $row;
            }
            $rel_stmt2->close();
        }
        $db_rel->close();
    } catch (Exception $e) {}
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($seo_desc ?: 'Yao资金网行业资讯详情', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($seo_keywords ?: '行业资讯,亮资知识,摆账流程', ENT_QUOTES, 'UTF-8'); ?>">
    <title><?php echo htmlspecialchars($seo_title ?: '文章详情 - Yao资金网', ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
    <style>
        /* 文章详情页样式 */
        .article-detail-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 80px 0 60px;
            color: white;
        }
        
        .article-detail-header-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .article-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 24px;
            transition: color 0.3s;
        }
        
        .article-back-btn:hover {
            color: white;
        }
        
        .article-back-btn-top {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            transition: color 0.3s;
        }
        
        .article-back-btn-top:hover {
            color: white;
        }
        
        .article-detail-category {
            display: none;
        }
        
        .article-detail-title {
            font-size: 40px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .article-detail-meta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        
        .article-detail-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        /* 文章内容区 */
        .article-detail-content {
            padding: 60px 0;
            background: #f8fafc;
        }
        
        .article-detail-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .article-detail-main {
            background: white;
            border-radius: 16px;
            padding: 48px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        
        .article-cover-image {
            width: 100%;
            height: 400px;
            object-fit: contain;
            background-color: #f3f4f6;
            border-radius: 12px;
            margin-bottom: 32px;
        }
        
        .article-body {
            font-size: 16px;
            line-height: 1.8;
            color: #374151;
            overflow-wrap: break-word;
        }
        
        .article-body img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 24px auto;
            border-radius: 8px;
        }
        
        .article-body video {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 24px auto;
            border-radius: 8px;
        }
        
        .article-body table {
            display: block;
            max-width: 100%;
            overflow-x: auto;
        }
        
        .article-body p {
            margin-bottom: 20px;
        }
        
        .article-body h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin: 40px 0 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .article-body h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin: 32px 0 16px;
        }
        
        .article-body ul, .article-body ol {
            margin-bottom: 20px;
            padding-left: 24px;
        }
        
        .article-body li {
            margin-bottom: 8px;
        }
        
        .article-body strong {
            color: #1f2937;
        }
        
        /* 文章标签 */
        .article-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 40px;
            padding-top: 32px;
            border-top: 1px solid #e5e7eb;
        }
        
        .article-tag {
            padding: 6px 14px;
            background: #f3f4f6;
            border-radius: 20px;
            font-size: 13px;
            color: #6b7280;
        }
        
        /* 文章导航 */
        .article-navigation {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 40px;
        }
        
        .article-nav-item {
            background: white;
            border-radius: 12px;
            padding: 24px;
            text-decoration: none;
            transition: all 0.3s;
            border: 1px solid #e5e7eb;
        }
        
        .article-nav-item:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-color: #3b82f6;
        }
        
        .article-nav-item.prev {
            text-align: left;
        }
        
        .article-nav-item.next {
            text-align: right;
        }
        
        .article-nav-label {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .article-nav-item.next .article-nav-label {
            justify-content: flex-end;
        }
        
        .article-nav-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.5;
        }
        
        /* 相关文章 */
        .related-articles {
            padding: 60px 0;
            background: white;
        }
        
        .related-articles-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .related-articles-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        
        .related-articles-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }
        
        .related-articles-more {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .related-articles-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        .related-article-card {
            background: #f8fafc;
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        
        .related-article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        
        .related-article-thumb {
            width: 80px;
            height: 80px;
            min-width: 80px;
            overflow: hidden;
            border-radius: 8px;
            margin: 12px;
        }
        
        .related-article-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        
        .related-article-card:hover .related-article-thumb img {
            transform: scale(1.05);
        }
        
        .related-article-content {
            padding: 12px 12px 12px 0;
            flex: 1;
            min-width: 0;
        }
        
        .related-article-title {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .related-article-date {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 8px;
        }
        
        /* 未找到文章 */
        .article-not-found {
            text-align: center;
            padding: 80px 20px;
        }
        
        .article-not-found i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 24px;
        }
        
        .article-not-found h2 {
            font-size: 24px;
            color: #374151;
            margin-bottom: 12px;
        }
        
        .article-not-found p {
            color: #9ca3af;
            margin-bottom: 24px;
        }
        
        .article-not-found .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #3b82f6;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .article-not-found .btn:hover {
            background: #2563eb;
        }
        
        /* 响应式 */
        @media (max-width: 768px) {
            .article-detail-header {
                padding: 60px 0 40px;
            }
            
            .article-detail-title {
                font-size: 28px;
                text-align: center;
            }
            
            .article-detail-main {
                padding: 24px;
            }
            
            .article-cover-image {
                height: 200px;
            }
            
            .related-articles-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .article-navigation {
                grid-template-columns: 1fr;
            }
            
            .article-nav-item.next {
                text-align: left;
            }
            
            .article-nav-item.next .article-nav-label {
                justify-content: flex-start;
            }
            
            .related-articles-grid {
                grid-template-columns: 1fr;
            }
            
            .related-article-card {
                flex-direction: row;
            }
        }
    </style>
    <!-- Logo动态加载 -->
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open('GET','admin/api/fetch-logo.php?t='+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p&&p.charAt(0)==='/'?p.substring(1):p;}
                        if(resp.data.header_logo){
                            var hl=document.querySelector('.logo img');
                            if(hl)hl.src=fixPath(resp.data.header_logo);
                        }
                        if(resp.data.footer_logo){
                            var fl=document.querySelector('.footer-logo img');
                            if(fl)fl.src=fixPath(resp.data.footer_logo);
                        }
                        if(resp.data.favicon){
                            var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');
                            if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}
                            lk.href=fixPath(resp.data.favicon);
                        }
                    }
                }catch(e){}
            }
        };
        // 全局logo加载失败处理
        document.addEventListener('error', function(e){
            var t = e.target;
            if(t.tagName==='IMG' && /logo/i.test(t.src)){
                t.src='images/logo.png';
            }
        }, true);
        xhr.send();
    })();
    </script>
<script>
(function() {
    var pageName = window.location.pathname.split('/').pop() || 'index.html';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data && data.code === 0 && data.data) {
                    var seo = data.data;
                    if (seo.page_title) document.title = seo.page_title;
                    if (seo.meta_keywords) {
                        var kw = document.querySelector('meta[name="keywords"]');
                        if (kw) kw.content = seo.meta_keywords;
                    }
                    if (seo.meta_description) {
                        var desc = document.querySelector('meta[name="description"]');
                        if (desc) desc.content = seo.meta_description;
                    }
                }
            } catch(e) {}
        }
    };
    xhr.send();
})();
</script>
<script>
(function() {
    var pageName = window.location.pathname.split('/').pop() || 'index.html';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var data = JSON.parse(xhr.responseText);
                if (data && data.code === 0 && data.data) {
                    var seo = data.data;
                    if (seo.page_title) document.title = seo.page_title;
                    if (seo.meta_keywords) {
                        var kw = document.querySelector('meta[name="keywords"]');
                        if (kw) kw.content = seo.meta_keywords;
                    }
                    if (seo.meta_description) {
                        var desc = document.querySelector('meta[name="description"]');
                        if (desc) desc.content = seo.meta_description;
                    }
                }
            } catch(e) {}
        }
    };
    xhr.send();
})();
</script>

<style>
/* 文章详情页 - 使用flexbox让页脚固定在底部 */
html, body {
    height: 100%;
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
main#main-content {
    flex: 1 0 auto;
}
.footer {
    flex-shrink: 0;
}

.footer-icp {
    margin-top: 6px;
    font-size: 13px;
    color: #9ca3af;
}

.footer-icp a {
    color: #9ca3af;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-icp a:hover {
    color: #6b7280;
}


/* 表情选择器 */
.emoji-picker-wrapper {
    position: relative;
    margin-bottom: 8px;
}
.emoji-toggle-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #fff;
    cursor: pointer;
    font-size: 18px;
    color: #6b7280;
    transition: all 0.2s;
}
.emoji-toggle-btn:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    background: #eff6ff;
}
.emoji-picker {
    position: absolute;
    bottom: 44px;
    left: 0;
    z-index: 100;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    padding: 10px;
}
.emoji-picker-inner {
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    gap: 4px;
    max-width: 360px;
}
.emoji-item {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    border-radius: 6px;
    cursor: pointer;
    font-size: 20px;
    transition: background 0.15s;
    padding: 0;
    line-height: 1;
}
.emoji-item:hover {
    background: #f3f4f6;
    transform: scale(1.15);
}

/* 回复按钮 */
.comment-reply-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 8px;
    padding: 4px 12px;
    font-size: 13px;
    color: #6b7280;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}
.comment-reply-btn:hover {
    color: #3b82f6;
    background: #eff6ff;
    border-color: #bfdbfe;
}

/* 回复表单 - 内联 */

.nickname-emoji-row {
    display: flex;
    align-items: center;
    gap: 8px;
}
.nickname-emoji-row input {
    flex: 1;
}
.nickname-emoji-row .emoji-picker-wrapper {
    margin-bottom: 0;
}
.nickname-emoji-row .emoji-picker {
    bottom: 44px;
    left: auto;
    right: 0;
}
.reply-form {
    margin: 12px 0 12px 48px;
    padding: 16px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    display: none;
}
.reply-form.show { display: block; }
.reply-form .form-group { margin-bottom: 10px; }
.reply-form label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}
.reply-form input[type="text"] {
    width: 100%;
    max-width: 250px;
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 13px;
    outline: none;
}
.reply-form input[type="text"]:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.1);
}
.reply-form textarea {
    width: 100%;
    min-height: 60px;
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 13px;
    font-family: inherit;
    outline: none;
    resize: vertical;
}
.reply-form textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,0.1);
}
.reply-form .form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-top: 8px;
}
.reply-form .form-tip { font-size: 12px; color: #9ca3af; }
.reply-submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 18px;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.reply-submit-btn:hover {
    background: linear-gradient(135deg, #1e40af, #2563eb);
}
.reply-submit-btn:disabled { opacity: 0.6; cursor: not-allowed; }
.reply-cancel-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    background: transparent;
    color: #6b7280;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
}
.reply-cancel-btn:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
}

/* 回复列表 */
.comment-replies {
    margin-left: 48px;
    border-left: 2px solid #e5e7eb;
    padding-left: 16px;
}
.comment-reply-item {
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
}
.comment-reply-item:last-child { border-bottom: none; }
.comment-reply-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}
.comment-reply-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: linear-gradient(135deg, #8b5cf6, #a78bfa);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 600;
    flex-shrink: 0;
}
.comment-reply-author {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}
.comment-reply-time {
    font-size: 11px;
    color: #9ca3af;
}
.comment-reply-text {
    font-size: 14px;
    color: #4b5563;
    line-height: 1.6;
}

/* 回复表单内的表情选择器 */
.reply-form .emoji-picker-wrapper {
    margin-bottom: 0;
}
.reply-form .emoji-picker {
    bottom: 40px;
}

/* 评论区域样式 */
.comments-section {
    max-width: 900px;
    margin: 40px auto 20px;
    padding: 0 20px;
}
.comments-title {
    font-size: 22px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.comments-title i { color: #3b82f6; }
.comments-title span {
    font-size: 14px;
    font-weight: 400;
    color: #9ca3af;
}
.comment-form {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 32px;
}
.comment-form .form-group { margin-bottom: 16px; }
.comment-form label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}
.comment-form input[type="text"] {
    width: 100%;
    max-width: 300px;
    padding: 10px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
}
.comment-form input[type="text"]:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}
.comment-form textarea {
    width: 100%;
    min-height: 100px;
    padding: 10px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    resize: vertical;
    transition: border-color 0.2s;
}
.comment-form textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}
.comment-form .form-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}
.comment-form .form-tip { font-size: 13px; color: #9ca3af; }
.comment-submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 28px;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.comment-submit-btn:hover {
    background: linear-gradient(135deg, #1e40af, #2563eb);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}
.comment-submit-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
.comment-list { list-style: none; padding: 0; }
.comment-item {
    padding: 20px 0;
    border-bottom: 1px solid #f3f4f6;
}
.comment-item:last-child { border-bottom: none; }
.comment-item-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}
.comment-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6, #1e40af);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    flex-shrink: 0;
}
.comment-author {
    font-size: 14px;
    font-weight: 600;
    color: #1f2937;
}
.comment-time {
    font-size: 13px;
    color: #9ca3af;
    margin-left: auto;
}
.comment-text {
    font-size: 15px;
    line-height: 1.7;
    color: #374151;
    padding-left: 46px;
}
.comment-empty {
    text-align: center;
    padding: 40px 20px;
    color: #9ca3af;
}
.comment-empty i {
    font-size: 40px;
    color: #d1d5db;
    margin-bottom: 12px;
}
.comment-empty p { font-size: 15px; }
.comment-success {
    text-align: center;
    padding: 20px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 12px;
    color: #065f46;
    font-size: 15px;
    margin-bottom: 24px;
    display: none;
}
.comment-success.show { display: block; }
.comment-error {
    color: #ef4444;
    font-size: 13px;
    margin-top: 4px;
    display: none;
}
.comment-error.show { display: block; }
@media (max-width: 640px) {
    .comments-section { margin: 24px auto 16px; padding: 0 16px; }
    .comment-form { padding: 16px; }
    .comment-form input[type="text"] { max-width: 100%; }
}

</style>

<script>
(function(){var ua=navigator.userAgent;if(/Mobile|Android|iPhone|iPod|BlackBerry|Windows Phone|webOS|Opera Mini|IEMobile/i.test(ua)&&window.location.pathname.indexOf("/mobile/")===-1){var p=window.location.pathname.split("/").pop();if(p){window.location.href="mobile/"+p;}}})();
</script>
    <!-- 社交分享样式 -->
    <link rel="stylesheet" href="/css/social-share.css">
    <link rel="canonical" href="<?php echo htmlspecialchars($seo_url, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="robots" content="index, follow">
    <!-- Article Structured Data -->
    <script type="application/ld+json">
<?php if ($article_id_seo > 0 && $seo_title): ?>{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo htmlspecialchars($seo_title, ENT_QUOTES, 'UTF-8'); ?>",
    "description": "<?php echo htmlspecialchars($seo_desc, ENT_QUOTES, 'UTF-8'); ?>",
    "url": "<?php echo htmlspecialchars($seo_url, ENT_QUOTES, 'UTF-8'); ?>",
    "mainEntityOfPage": { "@type": "WebPage", "@id": "<?php echo htmlspecialchars($seo_url, ENT_QUOTES, 'UTF-8'); ?>" },
    "publisher": { "@type": "Organization", "name": "Yao资金网" }
}<?php endif; ?>
    </script>
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($seo_title ?: 'Yao资金网', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo_desc ?: '了解最新行业动态与业务资讯', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($seo_url, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="zh_CN">
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网首页"><img src="/uploads/logo/biaoqianlogo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar">
                <li role="none"><a href="/" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="/services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="/cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                <li role="none"><a href="/advantages.html" class="nav-link" role="menuitem">服务优势</a></li>
                <li role="none"><a href="/news.php" class="nav-link active" role="menuitem">行业资讯</a></li>
                <li role="none"><a href="/faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                <li role="none"><a href="/contact.html" class="nav-link" role="menuitem">联系我们</a></li>
            </ul>

            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <main id="main-content">
        <!-- 文章头部 -->
        <section class="article-detail-header">
            <div class="article-detail-header-container">
                <div id="articleHeader">
                    <!-- 动态填充 -->
                </div>
            </div>
        </section>

        <!-- 文章内容 -->
        <section class="article-detail-content">
            <div class="article-detail-container">
                <div id="articleContent">
                    <!-- 动态填充 -->
                </div>
        <div class="article-tags" id="articleTags"></div>
            </div>
        </section>

        <!-- 相关文章 -->
        
        <!-- 用户评论 -->
        <section class="comments-section">
            <h2 class="comments-title">
                <i class="far fa-comment-dots"></i>
                用户评论
                <span id="commentCount">(0)</span>
            </h2>

            <div class="comment-form">                    <div class="form-group">
                    <label for="commentNickname">昵称</label>
                    <div class="nickname-emoji-row">
                        <input type="text" id="commentNickname" placeholder="请输入您的昵称" maxlength="20">
                        <div class="emoji-picker-wrapper">
                            <button type="button" class="emoji-toggle-btn" id="emojiToggleBtn" onclick="toggleEmojiPicker()" title="插入表情">
                                <i class="far fa-smile-wink"></i>
                            </button>
                            <div class="emoji-picker" id="emojiPicker" style="display:none;">
                                <div class="emoji-picker-inner">
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😊')">😊</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😂')">😂</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('❤️')">❤️</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('👍')">👍</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😍')">😍</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('🎉')">🎉</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('💪')">💪</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('🔥')">🔥</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('🙌')">🙌</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😎')">😎</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('✨')">✨</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('💯')">💯</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('🤝')">🤝</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('👏')">👏</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😄')">😄</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😅')">😅</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('🤗')">🤗</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😁')">😁</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('🥰')">🥰</button>
                                    <button type="button" class="emoji-item" onclick="insertEmoji('😘')">😘</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="commentContent">评论内容</label>
                    <textarea id="commentContent" placeholder="来说点什么吧..." maxlength="2000"></textarea>
<div class="comment-error" id="commentError"></div>
                </div>
                <div class="form-footer">
                    <span class="form-tip">评论审核通过后显示</span>
                    <button class="comment-submit-btn" id="commentSubmitBtn" onclick="submitComment()">
                        <i class="fas fa-paper-plane"></i>
                        提交评论
                    </button>
                </div>
            </div>

            <div class="comment-success" id="commentSuccess"></div>

            <ul class="comment-list" id="commentList"></ul>
            <div class="comment-empty" id="commentEmpty">
                <i class="far fa-comment-dots"></i>
                <p>暂无评论，快来抢沙发吧~</p>
            </div>
        </section>

<section class="related-articles">
            <div class="related-articles-container">
                <div class="related-articles-header">
                    <h2 class="related-articles-title">相关资讯</h2>
                    <a href="/news.php" class="related-articles-more">
                        查看全部 <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="related-articles-grid" id="relatedArticles">
                    <?php if (!empty($related_articles)): ?>
                        <?php foreach ($related_articles as $ra): ?>
                            <?php
                            $ra_title = htmlspecialchars($ra['title'] ?: '无标题', ENT_QUOTES, 'UTF-8');
                            $ra_img = !empty($ra['cover_image']) ? htmlspecialchars($ra['cover_image'], ENT_QUOTES, 'UTF-8') : '';
                            $ra_date = date('Y-m-d', strtotime($ra['created_at']));
                            ?>
                            <a href="news-detail.php?id=<?= $ra['id'] ?>" class="related-article-card">
                                <?php if ($ra_img): ?>
                                <div class="related-article-thumb"><img src="<?= $ra_img ?>" alt="<?= $ra_title ?>" loading="lazy"></div>
                                <?php else: ?>
                                <div class="related-article-thumb placeholder"><div class="placeholder-bg"></div></div>
                                <?php endif; ?>
                                <div class="related-article-content">
                                    <h3 class="related-article-title"><?= $ra_title ?></h3>
                                    <span class="related-article-date"><?= $ra_date ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- 右侧边浮动电话按钮 -->
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
    </div>

    <!-- 页脚（动态引用，与后台同步） -->
    <?php include 'includes/footer.php'; ?>


    <script src="js/main.js"></script>
    <script>
        // 验证图片数据是否有效
        function isValidImage(imageData) {
            if (!imageData) return false;
            if (typeof imageData !== 'string') return false;
            if (imageData.startsWith('data:image')) {
                return imageData.length > 100;
            }
            if (imageData.startsWith('http://') || imageData.startsWith('https://') || imageData.startsWith('/')) {
                return imageData.length > 10;
            }
            if (imageData.startsWith('uploads/') || imageData.startsWith('images/')) {
                return true;
            }
            return false;
        }

        // 从后端API加载文章
        async function loadArticleFromAPI(articleId) {
            try {
                const response = await fetch('api/news-detail.php?id=' + articleId + '&t=' + Date.now(), {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return null;
                const result = await response.json();
                // admin的detail.php返回 {success, data}，api/news-detail.php直接返回文章对象
                return result.data || result;
            } catch (e) {
                console.error('[News Detail] API请求失败:', e);
                return null;
            }
        }

        // 从后端加载相关文章
        async function loadRelatedArticles(currentId) {
            try {
                const response = await fetch('api/news.php?limit=10&t=' + Date.now(), {
                    method: 'GET',
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) return [];
                const result = await response.json();
                const articles = result.data ? result.data.news : result.news;
                if (!articles) return [];
                return articles.filter(a => String(a.id) !== String(currentId)).slice(0, 4);
            } catch (e) {
                console.error('[News Detail] Error:', e);
                return [];
            }
        }

        // 渲染文章
        function renderArticle(article) {
            // 更新标题 - 优先使用文章的SEO字段
            var seoTitle = article.seo_title || article.title || '文章详情';
            var seoKeywords = article.seo_keywords || '';
            var seoDesc = article.seo_description || article.summary || '';
            document.title = seoTitle + ' - Yao资金网';
            // 更新meta keywords
            if (seoKeywords) {
                var kw = document.querySelector('meta[name="keywords"]');
                if (kw) kw.content = seoKeywords;
            }
            // 更新meta description
            if (seoDesc) {
                var desc = document.querySelector('meta[name="description"]');
                if (desc) desc.content = seoDesc;
            }

            // 头部
            const date = article.created_at || article.date || new Date().toISOString();
            const formattedDate = new Date(date).toLocaleDateString('zh-CN');
            document.getElementById('articleHeader').innerHTML = `
                <a href="/news.php" class="article-back-btn-top">
                    <i class="fas fa-arrow-left"></i>
                    返回资讯列表
                </a>
                <h1 class="article-detail-title">${article.title || '无标题'}</h1>
                <div class="article-detail-meta">
                    <span><i class="far fa-calendar"></i> ${formattedDate}</span>
                    <span><i class="far fa-user"></i> ${article.author || 'Yao资金网'}</span>
                    <span><i class="far fa-eye"></i> ${article.view_count || article.views || 0} 阅读</span>
                </div>
            `;

            // 内容 - 修复图片URL（兼容各种存储格式）
            let content = article.content || '<p>暂无内容</p>';
            var basePath = '/';
            var pathname = window.location.pathname;
            var secondSlash = pathname.indexOf('/', 1);
            if (secondSlash > 0) {
                basePath = pathname.substring(0, secondSlash + 1);
            }
            // 1) 替换 http://localhost/uploads/ -> /uploads/
            content = content.replace(/https?:\/\/[^\/]+\/uploads\//g, '/uploads/');
            // 2) 替换 ../../../uploads/ -> /uploads/
            content = content.replace(/src="(?:\.\.\/)+(uploads\/)/g, 'src="/$1');
            // 3) 确保 /uploads/ 路径正确
            content = content.replace(/src="\/uploads\//g, 'src="/uploads/');
            // 4) 替换 /admin/uploads/ -> /uploads/（管理员上传的图片前台可访问）
            content = content.replace(/src="\/admin\/uploads\//g, 'src="\/uploads\/')
            const tags = article.tags || [];
            let tagsHtml = '';
            if (tags.length > 0) {
                tagsHtml = `
                    <div class="article-tags">
                        ${tags.map(function(tag){
                            var tagName = (typeof tag === 'object') ? tag.name : tag;
                            var tagSlug = (typeof tag === 'object' && tag.slug) ? tag.slug : '';
                            if (tagSlug) {
                                return '<a href="/tag/' + tagSlug + '" class="article-tag" style="text-decoration:none;">' + tagName + '</a>';
                            }
                            return '<span class="article-tag">' + tagName + '</span>';
                        }).join('')}
                    </div>
                `;
            }
            
            document.getElementById('articleContent').innerHTML = `
                <div class="article-detail-main">
                    <div class="article-body">${content}</div>
                    ${tagsHtml}
                    <div class="article-share-full">
                        <div class="share-left">
                            <span class="share-title">分享到：</span>
                            <div class="share-buttons">
                                <button class="share-btn wechat" id="shareBtnWechat" title="微信"><i class="fab fa-weixin"></i></button>
                                <button class="share-btn wechat-moments" id="shareBtnMoments" title="朋友圈"><i class="fas fa-users"></i></button>
                                <button class="share-btn qq" id="shareBtnQQ" title="QQ"><i class="fab fa-qq"></i></button>
                                <button class="share-btn weibo" id="shareBtnWeibo" title="微博"><i class="fab fa-weibo"></i></button>
                                <button class="share-btn copy" id="shareBtnCopy" title="复制链接"><i class="fas fa-link"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // 绑定分享按钮事件
            setTimeout(function() {
                var url = window.location.href.split('#')[0];
                var titleEl = document.querySelector('h1.article-detail-title');
                var title = titleEl ? titleEl.textContent.trim() : document.title;
                var u = encodeURIComponent(url);
                var t = encodeURIComponent(title);
                var wechatBtn = document.getElementById('shareBtnWechat');
                var momentsBtn = document.getElementById('shareBtnMoments');
                var qqBtn = document.getElementById('shareBtnQQ');
                var weiboBtn = document.getElementById('shareBtnWeibo');
                var copyBtn = document.getElementById('shareBtnCopy');
                if (wechatBtn) wechatBtn.onclick = function(){ shareToWechat(url, title); };
                if (momentsBtn) momentsBtn.onclick = function(){ shareToMoments(url, title); };
                if (qqBtn) qqBtn.onclick = function(){ shareToQQ(url, title); };
                if (weiboBtn) weiboBtn.onclick = function(){ shareToWeibo(url, title); };
                if (copyBtn) copyBtn.onclick = function(){ copyLink(url, this); };
            }, 100);
        
                        // Tags are now rendered inline above share section

        // 渲染相关文章
        }
        function renderRelated(articles) {
            if (articles.length === 0) {
                document.getElementById('relatedArticles').innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; color: #9ca3af; padding: 40px;">
                        暂无相关资讯
                    </div>
                `;
                return;
            }

            const fixCoverPath = (path) => {
                // API已返回完整路径（如 /uploads/xxx.jpg），直接使用
                return path || '';
            };
            document.getElementById('relatedArticles').innerHTML = articles.map(a => {
                const title = a.title || '无标题';
                const d = new Date(a.created_at || a.date || Date.now()).toLocaleDateString('zh-CN');
                const img = a.cover_image && isValidImage(a.cover_image)
                    ? `<div class="related-article-thumb"><img src="${fixCoverPath(a.cover_image)}" alt="${title}" loading="lazy"></div>`
                    : `<div class="related-article-thumb placeholder"><div class="placeholder-bg"></div></div>`;
                return `
                    <a href="news-detail.php?id=${a.id}" class="related-article-card">
                        ${img}
                        <div class="related-article-content">
                            <h3 class="related-article-title">${title}</h3>
                            <span class="related-article-date">${d}</span>
                        </div>
                    </a>
                `;
            }).join('');
        }

        // 渲染未找到
        function renderNotFound() {
            document.getElementById('articleHeader').innerHTML = '';
            document.getElementById('articleContent').innerHTML = `
                <div class="article-not-found">
                    <i class="far fa-file-alt"></i>
                    <h2>文章未找到</h2>
                    <p>抱歉，您访问的文章不存在或已被删除</p>
                    <a href="/news.php" class="btn">
                        <i class="fas fa-arrow-left"></i>
                        返回资讯列表
                    </a>
                </div>
            `;
        }

        // 初始化
        document.addEventListener('DOMContentLoaded', async function() {
            const urlParams = new URLSearchParams(window.location.search);
            const articleId = urlParams.get('id');

            if (!articleId) {
                renderNotFound();
                return;
            }

            // 从API加载文章
            const article = await loadArticleFromAPI(articleId);
            if (!article || article.code === 1) {
                renderNotFound();
                return;
            }

            renderArticle(article);

            // 加载相关文章
            const related = await loadRelatedArticles(articleId);
            renderRelated(related);
        });
    </script>
    <!-- 社交分享功能 -->
    <script src="/js/social-share.js"></script>

    <!-- 评论功能 -->
    <script>
    (function() {
        var articleId = null;
        var params = new URLSearchParams(window.location.search);
        articleId = params.get('id');
        if (!articleId) return;

        function loadComments() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'api/comment-list.php?article_id=' + articleId + '&t=' + Date.now(), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.success && resp.data) renderComments(resp.data);
                    } catch(e) {}
                }
            };
            xhr.send();
        }

        
                function renderComments(comments) {
            var list = document.getElementById('commentList');
            var empty = document.getElementById('commentEmpty');
            var count = document.getElementById('commentCount');
            if (!list) return;
            list.innerHTML = '';
            if (!comments || comments.length === 0) {
                if (empty) empty.style.display = 'block';
                if (count) count.textContent = '(0)';
                return;
            }
            if (empty) empty.style.display = 'none';
            if (count) count.textContent = '(' + comments.length + ')';

            comments.forEach(function(c) {
                var nickname = c.nickname || '匿名';
                var li = document.createElement('li');
                li.className = 'comment-item';

                var html =
                    '<div class="comment-item-header">' +
                        '<div class="comment-avatar">' + esc(nickname.charAt(0)) + '</div>' +
                        '<span class="comment-author">' + esc(nickname) + '</span>' +
                        '<span class="comment-time">' + esc(c.created_at || '') + '</span>' +
                    '</div>' +
                    '<div class="comment-text">' + esc(c.content || '') + '</div>' +
                    '<button class="comment-reply-btn" data-cid="' + c.id + '" data-nickname="' + esc(nickname) + '" onclick="toggleReply(this)">' +
                        '<i class="fas fa-reply"></i> 回复' +
                    '</button>';

                // Inline reply form
                html += '<div class="reply-form" id="replyForm_' + c.id + '">' +
                    '<div class="form-group">' +
                        '<label>昵称</label>' +
                        '<input type="text" name="replyNickname" placeholder="您的昵称" maxlength="20">' +
                    '</div>' +
                    '<div class="form-group">' +
                        '<label id="replyLabel_' + c.id + '">回复</label>' +
                        '<textarea name="replyContent" placeholder="写下你的回复..." maxlength="2000"></textarea>' +
                    '</div>' +
                    '<div class="reply-error" style="color:#ef4444;font-size:13px;display:none;margin-bottom:6px;"></div>' +
                    '<div class="form-footer">' +
                        '<span class="form-tip">评论审核通过后显示</span>' +
                        '<div>' +
                            '<button type="button" class="reply-cancel-btn" onclick="cancelReply(' + c.id + ')">取消</button>' +
                            '<button type="button" class="reply-submit-btn" onclick="submitReply(' + c.id + ')"><i class="fas fa-reply"></i> 回复</button>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                // Replies
                if (c.replies && c.replies.length > 0) {
                    html += '<div class="comment-replies">';
                    for (var ri = 0; ri < c.replies.length; ri++) {
                        var r = c.replies[ri];
                        var rNick = r.nickname || '匿名';
                        html += '<div class="comment-reply-item">' +
                            '<div class="comment-reply-header">' +
                                '<div class="comment-reply-avatar">' + esc(rNick.charAt(0)) + '</div>' +
                                '<span class="comment-reply-author">' + esc(rNick) + '</span>' +
                                '<span class="comment-reply-time">' + esc(r.created_at || '') + '</span>' +
                            '</div>' +
                            '<div class="comment-reply-text">' + esc(r.content || '') + '</div>' +
                        '</div>';
                    }
                    html += '</div>';
                }

                li.innerHTML = html;
                list.appendChild(li);
            });
        }function esc(t) { if (!t) return ''; var d = document.createElement('div'); d.textContent = t; return d.innerHTML; }

        window.submitComment = function() {
            var nickname = document.getElementById('commentNickname');
            var content = document.getElementById('commentContent');
            var error = document.getElementById('commentError');
            var btn = document.getElementById('commentSubmitBtn');
            var success = document.getElementById('commentSuccess');
            if (!nickname || !content) return;
            var nameVal = nickname.value.trim();
            var contentVal = content.value.trim();
            if (error) error.classList.remove('show');
            
            if (nameVal.length > 20) { if (error) { error.textContent = '昵称不能超过20个字符'; error.classList.add('show'); } return; }
            if (!contentVal) { content.focus(); if (error) { error.textContent = '请输入评论内容'; error.classList.add('show'); } return; }
            if (contentVal.length < 2) { content.focus(); if (error) { error.textContent = '评论内容至少2个字符'; error.classList.add('show'); } return; }
            if (contentVal.length > 2000) { if (error) { error.textContent = '评论内容不能超过2000字'; error.classList.add('show'); } return; }
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> 提交中...';
            var formData = new FormData();
            formData.append('article_id', articleId);
            formData.append('nickname', nameVal);
            formData.append('content', contentVal);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/comment-submit.php', true);
            xhr.onload = function() {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> 提交评论';
                if (xhr.status === 200) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.success) {
                            nickname.value = ''; content.value = '';
                            if (success) { success.textContent = '\u8bc4\u8bba\u63d0\u4ea4\u6210\u529f\uff0c\u7b49\u5f85\u5ba1\u6838\u540e\u663e\u793a'; success.classList.add('show'); setTimeout(function() { success.classList.remove('show'); }, 4000); }
                        } else { if (error) { error.textContent = resp.message || '\u63d0\u4ea4\u5931\u8d25'; error.classList.add('show'); } }
                    } catch(e) { if (error) { error.textContent = '\u63d0\u4ea4\u5931\u8d25\uff0c\u8bf7\u7a0d\u540e\u518d\u8bd5'; error.classList.add('show'); } }
                } else { if (error) { error.textContent = '\u7f51\u7edc\u9519\u8bef (' + xhr.status + ')'; error.classList.add('show'); } }
            };
            xhr.onerror = function() { btn.disabled = false; btn.innerHTML = '<i class="fas fa-paper-plane"></i> \u63d0\u4ea4\u8bc4\u8bba'; if (error) { error.textContent = '\u7f51\u7edc\u8bf7\u6c42\u5931\u8d25'; error.classList.add('show'); } };
            xhr.send(formData);
        };


        // ===== 回复功能 =====
        
        // ===== Reply functionality =====
        var replyingTo = null;

        window.toggleReply = function(btn) {
            var cid = parseInt(btn.getAttribute('data-cid'));
            var nickname = btn.getAttribute('data-nickname');
            var form = document.getElementById('replyForm_' + cid);
            if (!form) return;
            if (form.classList.contains('show')) {
                form.classList.remove('show');
                replyingTo = null;
                return;
            }
            document.querySelectorAll('.reply-form').forEach(function(f) {
                f.classList.remove('show');
            });
            form.classList.add('show');
            replyingTo = { commentId: cid, nickname: nickname };
            var label = document.getElementById('replyLabel_' + cid);
            if (label) label.textContent = '回复 ' + nickname;
            var ta = form.querySelector('textarea');
            if (ta) setTimeout(function() { ta.focus(); }, 100);
        };

        window.cancelReply = function(commentId) {
            var form = document.getElementById('replyForm_' + commentId);
            if (form) form.classList.remove('show');
            replyingTo = null;
        };

        window.submitReply = function(commentId) {
            if (!replyingTo || replyingTo.commentId !== commentId) return;
            var form = document.getElementById('replyForm_' + commentId);
            if (!form) return;
            var nicknameInput = form.querySelector('input[name="replyNickname"]');
            var contentInput = form.querySelector('textarea');
            var errorDiv = form.querySelector('.reply-error');
            var btn = form.querySelector('.reply-submit-btn');
            if (!contentInput) return;

            var nameVal = nicknameInput ? nicknameInput.value.trim() : '';
            var contentVal = contentInput.value.trim();
            if (errorDiv) errorDiv.style.display = 'none';

            if (!contentVal) { contentInput.focus(); if (errorDiv) { errorDiv.textContent = '请输入回复内容'; errorDiv.style.display = 'block'; } return; }
            if (contentVal.length < 2) { contentInput.focus(); if (errorDiv) { errorDiv.textContent = '回复内容至少2个字符'; errorDiv.style.display = 'block'; } return; }

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> 提交...';

            var fd = new FormData();
            fd.append('article_id', articleId);
            fd.append('parent_id', commentId);
            fd.append('nickname', nameVal || '匿名');
            fd.append('content', contentVal);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api/comment-submit.php', true);
            xhr.onload = function() {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-reply"></i> 回复';
                if (xhr.status === 200) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.success) {
                            if (nicknameInput) nicknameInput.value = '';
                            contentInput.value = '';
                            cancelReply(commentId);
                            loadComments();
                            var success = document.getElementById('commentSuccess');
                            if (success) {
                                success.textContent = '回复提交成功' + (resp.message && resp.message.indexOf('审核') >= 0 ? '，等待审核后显示' : '');
                                success.classList.add('show');
                                setTimeout(function() { success.classList.remove('show'); }, 3000);
                            }
                        } else {
                            if (errorDiv) { errorDiv.textContent = resp.message || '提交失败'; errorDiv.style.display = 'block'; }
                        }
                    } catch(e) {
                        if (errorDiv) { errorDiv.textContent = '提交失败，请稍后再试'; errorDiv.style.display = 'block'; }
                    }
                } else {
                    if (errorDiv) { errorDiv.textContent = '网络错误 (' + xhr.status + ')'; errorDiv.style.display = 'block'; }
                }
            };
            xhr.onerror = function() {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-reply"></i> 回复';
                if (errorDiv) { errorDiv.textContent = '网络请求失败'; errorDiv.style.display = 'block'; }
            };
            xhr.send(fd);
        };

        // ===== Emoji picker =====
        window.toggleEmojiPicker = function() {
            var picker = document.getElementById('emojiPicker');
            if (picker) picker.style.display = (picker.style.display !== 'block') ? 'block' : 'none';
        };

        window.insertEmoji = function(emoji) {
            var textarea = document.getElementById('commentContent');
            if (!textarea) return;
            var start = textarea.selectionStart;
            var end = textarea.selectionEnd;
            textarea.value = textarea.value.substring(0, start) + emoji + textarea.value.substring(end);
            textarea.selectionStart = textarea.selectionEnd = start + emoji.length;
            textarea.focus();
            document.getElementById('emojiPicker').style.display = 'none';
        };

        document.addEventListener('click', function(e) {
            var picker = document.getElementById('emojiPicker');
            var btn = document.getElementById('emojiToggleBtn');
            if (picker && picker.style.display === 'block' && !picker.contains(e.target) && !(btn && btn.contains(e.target))) {
                picker.style.display = 'none';
            }
        });
        loadComments();
    })();
    </script>

<script>
    // 从URL读取page参数，用于返回列表时保持页码
    (function() {
        var params = new URLSearchParams(window.location.search);
        var page = params.get('page');
        if (page) {
            // 更新导航中"行业资讯"链接，保留页码
            var newsLinks = document.querySelectorAll('a[href="/news.php"]');
            for (var i = 0; i < newsLinks.length; i++) {
                newsLinks[i].href = '/news.php?page=' + page;
            }
        }
    })();
</script>
</body>
</html>

