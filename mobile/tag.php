<?php
/**
 * 手机端 - 标签聚合页
 */
require_once __DIR__ . '/../config.php';
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>标签聚合 - Yao资金网</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .mobile-tag-detail { padding: 20px; }
        .mobile-tag-back { display: inline-flex; align-items: center; gap: 6px; color: #3b82f6; text-decoration: none; font-size: 14px; margin-bottom: 16px; }
        .mobile-tag-title { font-size: 22px; font-weight: 700; color: #1f2937; margin-bottom: 4px; }
        .mobile-tag-count { font-size: 14px; color: #6b7280; margin-bottom: 20px; }
        .mobile-tabs { display: flex; gap: 4px; margin-bottom: 16px; background: #f3f4f6; border-radius: 8px; padding: 3px; }
        .mobile-tab { flex: 1; padding: 8px; text-align: center; border: none; background: transparent; border-radius: 6px; cursor: pointer; font-size: 13px; color: #6b7280; }
        .mobile-tab.active { background: white; color: #1e3a8a; font-weight: 600; box-shadow: 0 1px 2px rgba(0,0,0,0.08); }
        .mobile-item { padding: 16px; background: white; border-radius: 10px; margin-bottom: 12px; box-shadow: 0 1px 2px rgba(0,0,0,0.04); }
        .mobile-item-title { font-size: 16px; font-weight: 600; color: #1f2937; text-decoration: none; display: block; margin-bottom: 4px; }
        .mobile-item-meta { font-size: 12px; color: #9ca3af; display: flex; gap: 12px; }
        .mobile-item-meta .tag { background: #dbeafe; color: #1d4ed8; padding: 1px 8px; border-radius: 10px; }
        .loading { text-align: center; padding: 40px; color: #9ca3af; }
        .empty-state { text-align: center; padding: 40px; color: #9ca3af; }
    </style>
</head>
<body>
    <?php include '../inc_header.php'; ?>
    <div class="mobile-tag-detail">
        <a href="tags.php" class="mobile-tag-back"><i class="fas fa-arrow-left"></i> 返回标签</a>
        <div class="mobile-tag-title" id="tagTitle">...</div>
        <div class="mobile-tag-count" id="tagCount">加载中...</div>
        <div class="mobile-tabs" id="tabs">
            <button class="mobile-tab active" onclick="switchMTab('all')">全部</button>
            <button class="mobile-tab" onclick="switchMTab('article')">文章</button>
            <button class="mobile-tab" onclick="switchMTab('case')">案例</button>
        </div>
        <div class="loading" id="loading"><i class="fas fa-spinner"></i> 加载中...</div>
        <div id="contentList"></div>
    </div>
    <?php include '../inc_footer.php'; ?>
    <script>
        const slug = '<?php echo addslashes($slug); ?>';
        let mType = 'all';

        function loadMData() {
            document.getElementById('loading').style.display = 'block';
            document.getElementById('contentList').innerHTML = '';
            fetch('../api/tag-frontend-detail.php?slug=' + encodeURIComponent(slug) + '&type=' + mType)
                .then(r => r.json())
                .then(res => {
                    document.getElementById('loading').style.display = 'none';
                    if (res.success && res.data) {
                        document.getElementById('tagTitle').textContent = res.data.tag.name || slug;
                        const ac = parseInt(res.data.articles?.total) || 0;
                        const cc = parseInt(res.data.cases?.total) || 0;
                        document.getElementById('tagCount').textContent = '共 ' + (ac + cc) + ' 篇内容';
                        renderMItems(res.data);
                        if (res.data.tag.seo_title) document.title = res.data.tag.seo_title;
                    }
                });
        }

        function renderMItems(data) {
            const c = document.getElementById('contentList');
            c.innerHTML = '';
            let items = [];
            if (mType === 'all' || mType === 'article') (data.articles?.list || []).forEach(a => items.push({...a, _t: 'article'}));
            if (mType === 'all' || mType === 'case') (data.cases?.list || []).forEach(a => items.push({...a, _t: 'case'}));
            if (!items.length) { c.innerHTML = '<div class="empty-state"><i class="fas fa-inbox"></i><p>暂无内容</p></div>'; return; }
            items.forEach(item => {
                const link = item._t === 'article' ? '../news-detail.php?id=' + item.id : '../case-detail.html?id=' + item.id;
                const label = item._t === 'article' ? '文章' : '案例';
                c.innerHTML += '<div class="mobile-item"><a href="' + link + '" class="mobile-item-title">' + item.title + '</a><div class="mobile-item-meta"><span class="tag">' + label + '</span><span>' + (item.created_at || '').substring(0,10) + '</span></div></div>';
            });
        }

        function switchMTab(t) {
            mType = t;
            document.querySelectorAll('.mobile-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.mobile-tab').forEach(b => { if (b.textContent.includes(t === 'all' ? '全部' : t === 'article' ? '文章' : '案例')) b.classList.add('active'); });
            loadMData();
        }
        if (slug) loadMData();
    </script>
</body>
</html>
