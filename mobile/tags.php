<?php
/**
 * 手机端 - 热门标签页
 */
require_once __DIR__ . '/../config/db.php';
$basePath = '/';
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>热门标签 - Yao资金网</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.min.css?v=20250514">
    <style>
        .mobile-tags { padding: 20px; }
        .mobile-tags h1 { font-size: 22px; color: #1f2937; margin-bottom: 20px; text-align: center; }
        .mobile-tag-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .mobile-tag-item { display: flex; flex-direction: column; align-items: center; padding: 20px 16px; background: white; border-radius: 12px; text-decoration: none; box-shadow: 0 1px 3px rgba(0,0,0,0.06); border: 1px solid #f3f4f6; }
        .mobile-tag-name { font-size: 16px; font-weight: 600; color: #1f2937; margin-bottom: 4px; }
        .mobile-tag-count { font-size: 12px; color: #9ca3af; }
        .loading { text-align: center; padding: 40px; color: #9ca3af; }
    </style>
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>
</head>
<body>
    <?php include '../inc_header.php'; ?>
    <div class="mobile-tags">
        <h1>热门标签</h1>
        <div class="loading" id="loading"><i class="fas fa-spinner"></i> 加载中...</div>
        <div class="mobile-tag-grid" id="tagGrid" style="display:none;"></div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-bottom">
                <p class="footer-copyright">© 2026 Yao资金网 宏都资本版权所有</p>
                <p class="footer-disclaimer">粤ICP备2026052915号</p>
            </div>
        </div>
    </footer>
    <script>
        fetch('../api/tag-frontend-list.php')
            .then(r => r.json())
            .then(res => {
                document.getElementById('loading').style.display = 'none';
                if (res.success && res.data && res.data.length > 0) {
                    const grid = document.getElementById('tagGrid');
                    grid.style.display = 'grid';
                    grid.innerHTML = res.data.map(t => {
                        const total = (parseInt(t.article_count)||0) + (parseInt(t.case_count)||0);
                        return `<a href="tag.php?slug=${t.slug}" class="mobile-tag-item"><span class="mobile-tag-name">${t.name}</span><span class="mobile-tag-count">${total} 篇</span></a>`;
                    }).join('');
                } else {
                    document.getElementById('loading').innerHTML = '暂无标签';
                }
            });
    </script>
</body>
</html>
