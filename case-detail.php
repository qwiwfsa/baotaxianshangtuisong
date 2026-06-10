<?php

require_once __DIR__ . '/device-detect.php';

DeviceDetector::redirect();

require_once __DIR__ . '/includes/page-seo.php';

$case_id_seo = intval($_GET['id'] ?? 0);

$case_seo_title = '';

$case_seo_desc = '';

$case_seo_keywords = '';

$case_data = null;

$case_content = [];

$case_tags = [];

if ($case_id_seo > 0) {

    try {

        require_once __DIR__ . '/config/db.php';

        $db_case = getDB();

        

        $stmt = $db_case->prepare("SELECT title, seo_title, seo_keywords, seo_description, description, content FROM cases WHERE id = ? AND status = 1 LIMIT 1");

        $stmt->bind_param('i', $case_id_seo);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {

            $case_seo_title = !empty($row['seo_title']) ? $row['seo_title'] : ($row['title'] . ' - Yao资金网');

            $case_seo_desc = !empty($row['seo_description']) ? $row['seo_description'] : (!empty($row['description']) ? mb_substr($row['description'], 0, 200) : '');

            $case_seo_keywords = !empty($row['seo_keywords']) ? $row['seo_keywords'] : '';

        }

        $stmt->close();

        

        $stmt2 = $db_case->prepare("SELECT id, title, company, amount, period, category, description, image, content FROM cases WHERE id = ? AND status = 1 LIMIT 1");

        $stmt2->bind_param('i', $case_id_seo);

        $stmt2->execute();

        $res2 = $stmt2->get_result();

        if ($row2 = $res2->fetch_assoc()) {

            $case_data = $row2;

            $case_content = json_decode($row2['content'], true) ?: [];

            // 获取标签

            $tagStmt = $db_case->prepare("SELECT t.id, t.name FROM tags t JOIN case_tags ct ON t.id = ct.tag_id WHERE ct.case_id = ?");

            $tagStmt->bind_param('i', $case_id_seo);

            $tagStmt->execute();

            $tagResult = $tagStmt->get_result();

            while ($tagRow = $tagResult->fetch_assoc()) {

                $case_tags[] = $tagRow;

            }

            $tagStmt->close();

        }

        $stmt2->close();

        $db_case->close();

    } catch (Exception $e) {}

}

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");

?>

<?php
// Override with case-specific SEO when available
if (!empty($case_seo_title)) { $page_title = $case_seo_title; }
if (!empty($case_seo_desc)) { $page_description = $case_seo_desc; }
if (!empty($case_seo_keywords)) { $page_keywords = $case_seo_keywords; }
?>
<!DOCTYPE html>

<html lang="zh-CN">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">

    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">

    <title><?php echo htmlspecialchars(!empty($page_title) ? $page_title : "案例详情 - Yao资金网"); ?></title>

    <link rel="canonical" href="https://www.yaozijin.com/case-detail.html?id=<?php echo $case_id_seo; ?>">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">

    <meta http-equiv="Pragma" content="no-cache">

    <meta http-equiv="Expires" content="0">

        <script>

    // 全局错误防御：抑制外部图片404和document异常

    (function() {

        window.addEventListener('error', function(e) {

            if (e.target && e.target.tagName === 'IMG') {

                e.stopPropagation();

                e.preventDefault();

                return true;

            }

        }, true);

        window.onerror = function(msg) {

            if (msg && (msg.toString().indexOf('document.addEventListener') >= 0 ||

                msg.toString().indexOf('GetPic') >= 0 ||

                msg.toString().indexOf('eastmoney') >= 0)) {

                return true;

            }

            return false;

        };

    })();

    </script>

<link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="/css/style.min.css?v=20260519">

    <link rel="stylesheet" href="/css/case-detail.css">
    <link rel="stylesheet" href="/css/page-custom.css?v=20260519">

    <script>

        // 全局函数：检测相关案例图片比例

        window.detectRelatedImageRatio = function(imgElement, container) {

            if (!imgElement || !container) return;

            

            const checkRatio = () => {

                const width = imgElement.naturalWidth || imgElement.width;

                const height = imgElement.naturalHeight || imgElement.height;

                

                if (width && height) {

                    const ratio = width / height;

                    if (ratio >= 1.2) {

                        container.classList.remove('ratio-portrait');

                        container.classList.add('ratio-landscape');

                    } else {

                        container.classList.remove('ratio-landscape');

                        container.classList.add('ratio-portrait');

                    }

                }

            };

            

            if (imgElement.complete) {

                checkRatio();

            } else {

                imgElement.onload = checkRatio;

                imgElement.onerror = () => {};

            }

        };

    </script>

    

    <!-- Logo动态加载 -->

    <script>

    (function(){

        var xhr=new XMLHttpRequest();

        xhr.open('GET','/admin/api/fetch-logo.php?t='+Date.now(),true);

        xhr.onload=function(){

            if(xhr.status>=200&&xhr.status<400){

                try{

                    var resp=JSON.parse(xhr.responseText);

                    if(resp.code===0&&resp.data){

                        function fixSubDir(p){return p&&p.indexOf('http')!==0?'../'+(p.charAt(0)==='/'?p.substring(1):p):p;}

                        if(resp.data.header_logo){

                            var hl=document.querySelector('.logo img');

                            if(hl)hl.src=fixSubDir(resp.data.header_logo);

                        }

                        if(resp.data.footer_logo){

                            var fl=document.querySelector('.footer-logo img');

                            if(fl)fl.src=fixSubDir(resp.data.footer_logo);

                        }

                        if(resp.data.favicon){

                            var lk=document.querySelector('link[rel="icon"]')||document.querySelector('link[rel="shortcut icon"]');

                            if(!lk){lk=document.createElement('link');lk.rel='icon';document.head.appendChild(lk);}

                            lk.href=fixSubDir(resp.data.favicon);

                        }

                    }

                }catch(e){}

            }

        };

        xhr.send();

    })();

    </script>

<script>

(function() {

    var pageName = window.location.pathname.split('/').pop() || 'index.html';

    var xhr = new XMLHttpRequest();

    xhr.open('GET', '/admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);

    xhr.onload = function() {

        if (xhr.status === 200) {

            try {

                var data = JSON.parse(xhr.responseText);

                if (data && data.code === 0 && data.data) {

                    var seo = data.data;

                    // PHP handles title - title set server-side

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

    xhr.open('GET', '/admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);

    xhr.onload = function() {

        if (xhr.status === 200) {

            try {

                var data = JSON.parse(xhr.responseText);

                if (data && data.code === 0 && data.data) {

                    var seo = data.data;

                    // PHP handles title - title set server-side

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

<style>.case-related-thumb img{width:100%;height:100%;object-fit:cover!important}
        .case-media-thumb { cursor: pointer; border: 2px solid transparent; border-radius: 6px; overflow: hidden; width: 120px; height: 80px; flex-shrink: 0; }
        .case-media-thumb.active { border-color: #3b82f6; }
        .case-media-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .case-media-thumbs { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px; }
</style><style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>

<style>.case-related-thumb img{width:100%;height:100%;object-fit:cover!important}</style><style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style>

<script>

var currentCaseImages = <?php

$imgs = $case_content['images'] ?? [];
// Filter out video files from image viewer
$video_exts = ['mp4', 'webm', 'ogg', 'mov', 'avi'];
$imgs = array_values(array_filter($imgs, function($i) use ($video_exts) {
    $ext = strtolower(pathinfo(parse_url($i, PHP_URL_PATH) ?: $i, PATHINFO_EXTENSION));
    return !in_array($ext, $video_exts);
}));

if (!empty($imgs)):

    echo json_encode(array_map(function($i) { return (strpos($i, '/') === 0 || strpos($i, 'http') === 0) ? $i : '../' . $i; }, $imgs));

elseif (!empty($case_data['image'])):

    echo '["' . ((strpos($case_data['image'], '/') === 0 || strpos($case_data['image'], 'http') === 0) ? $case_data['image'] : '../' . $case_data['image']) . '"]';

else:

    echo '[]';

endif;

?>;
var allViewerMedia = [];


var currentImageIndex = 0;


window.switchMedia = function(el) {
    var type = el.getAttribute('data-type');
    var url = el.getAttribute('data-url');
    var idx = parseInt(el.getAttribute('data-idx')) || 0;
    if (!url) return;
    var main = document.getElementById('mainMedia');
    if (!main) return;
    if (url.indexOf('http') !== 0 && url.indexOf('/') !== 0) url = '/' + url;
    window.currentImageIndex = idx;
    if (type === 'video') {
        main.innerHTML = '<video src="' + url + '" controls autoplay style="width:100%;height:400px;object-fit:contain;background:#000;border-radius:8px;" id="mainVideo" onclick="openImageViewer(' + idx + ')"></video>';
    } else {
        main.innerHTML = '<img src="' + url + '" alt="" style="width:100%;height:400px;object-fit:contain;border-radius:8px;background:#f3f4f6;" id="mainImage" onclick="openImageViewer(' + idx + ')">';
    }
    document.querySelectorAll('.case-media-thumb').forEach(function(t) { t.classList.remove('active'); });
    el.classList.add('active');
};

window.changeImage = window.changeImage || function(e, t, n) {

    var i = document.getElementById('mainImage');

    if (i) i.src = e;

    document.querySelectorAll('.case-media-thumb').forEach(function(el) { el.classList.remove('active'); });

    if (t) t.classList.add('active');

    if (typeof n !== 'undefined') {
        window.currentImageIndex = n;
    } else {
        // Find index from DOM thumbnails
        var thumbs = document.querySelectorAll('.case-media-thumb');
        for (var idx = 0; idx < thumbs.length; idx++) {
            if (thumbs[idx] === t) { window.currentImageIndex = idx; break; }
        }
    }

};

window.openImageViewer = window.openImageViewer || function(e) {

    // Use allViewerMedia if available, fallback to currentCaseImages
    var mediaList = window.allViewerMedia && window.allViewerMedia.length ? window.allViewerMedia :
        (window.currentCaseImages || []).map(function(url, idx) { return {type: 'image', url: url, idx: idx}; });

    if (!mediaList.length) return;

    window.currentImageIndex = e || 0;
    if (window.currentImageIndex >= mediaList.length) window.currentImageIndex = 0;

    var currentItem = mediaList[window.currentImageIndex];
    var viewer = document.getElementById('imageViewer');
    var viewerContent = document.getElementById('viewerContent');
    if (!viewer) return;

    // Update viewer content based on media type
    if (!viewerContent) {
        viewerContent = document.createElement('div');
        viewerContent.id = 'viewerContent';
        viewer.querySelector('.viewer-image') && viewer.querySelector('.viewer-image').replaceWith(viewerContent);
    }

    if (currentItem.type === 'video') {
        viewerContent.innerHTML = '<video src="' + currentItem.url + '" controls style="max-width:90vw;max-height:80vh;border-radius:8px;"></video>';
    } else {
        viewerContent.innerHTML = '<img src="' + currentItem.url + '" alt="" class="viewer-image" id="viewerImage" style="max-width:90vw;max-height:80vh;object-fit:contain;border-radius:8px;">';
    }

    viewer.classList.add('active');
    document.body.style.overflow = 'hidden';

    var counter = document.getElementById('viewerCounter');
    if (counter) counter.textContent = (window.currentImageIndex + 1) + ' / ' + mediaList.length;

    // Update nav button states
    var prevBtn = document.getElementById('viewerPrev');
    var nextBtn = document.getElementById('viewerNext');
    if (prevBtn) prevBtn.style.visibility = window.currentImageIndex > 0 ? 'visible' : 'hidden';
    if (nextBtn) nextBtn.style.visibility = window.currentImageIndex < mediaList.length - 1 ? 'visible' : 'hidden';

};

window.closeImageViewer = window.closeImageViewer || function() {

    var viewer = document.getElementById('imageViewer');

    if (viewer) viewer.classList.remove('active');

    document.body.style.overflow = '';

};

window.prevImage = window.prevImage || function() {

    var mediaList = window.allViewerMedia && window.allViewerMedia.length ? window.allViewerMedia :
        (window.currentCaseImages || []).map(function(url, idx) { return {type: 'image', url: url, idx: idx}; });

    if (window.currentImageIndex > 0) {
        window.currentImageIndex--;
        var item = mediaList[window.currentImageIndex];
        var vc = document.getElementById('viewerContent');
        if (!vc) { var vi = document.getElementById('viewerImage'); if (vi) vi.src = item.url; }
        else if (item.type === 'video') {
            vc.innerHTML = '<video src="' + item.url + '" controls style="max-width:90vw;max-height:80vh;border-radius:8px;"></video>';
        } else {
            vc.innerHTML = '<img src="' + item.url + '" alt="" class="viewer-image" id="viewerImage" style="max-width:90vw;max-height:80vh;object-fit:contain;border-radius:8px;">';
        }
        var counter = document.getElementById('viewerCounter');
        if (counter) counter.textContent = (window.currentImageIndex + 1) + ' / ' + mediaList.length;
    }

};

window.nextImage = window.nextImage || function() {

    var mediaList = window.allViewerMedia && window.allViewerMedia.length ? window.allViewerMedia :
        (window.currentCaseImages || []).map(function(url, idx) { return {type: 'image', url: url, idx: idx}; });

    if (window.currentImageIndex < mediaList.length - 1) {
        window.currentImageIndex++;
        var item = mediaList[window.currentImageIndex];
        var vc = document.getElementById('viewerContent');
        if (!vc) { var vi = document.getElementById('viewerImage'); if (vi) vi.src = item.url; }
        else if (item.type === 'video') {
            vc.innerHTML = '<video src="' + item.url + '" controls style="max-width:90vw;max-height:80vh;border-radius:8px;"></video>';
        } else {
            vc.innerHTML = '<img src="' + item.url + '" alt="" class="viewer-image" id="viewerImage" style="max-width:90vw;max-height:80vh;object-fit:contain;border-radius:8px;">';
        }
        var counter = document.getElementById('viewerCounter');
        if (counter) counter.textContent = (window.currentImageIndex + 1) + ' / ' + mediaList.length;
    }

};

</script>

    <meta name="baidu-site-verification" content="codeva-XY6IaVM2X4" />
    <meta name="360-site-verification" content="f310464a017d0090a59ed60edaa367e6" />
    <meta name="sogou_site_verification" content="hZk3RVI5el" />
    <meta name="shenma-site-verification" content="2c7c0059f1eb0bc344ff6f62104c6ee9_1779306988"/>
    <meta name="bytedance-verification-code" content="ax5xO1GtSFCBiE8fTWSz" />
    <meta name="msvalidate.01" content="A2A0A42C6A6A5562D58FA90EF4B0CCE6" />
<script>(function(){var el = document.createElement("script");el.src = "https://lf1-cdn-tos.bytegoofy.com/goofy/ttzz/push.js?3b035154874e19e664d8240b09e14e83e00fbc766c8f9a62fe69bf1753ce8548bc434964556b7d7129e9b750ed197d397efd7b0c6c715c1701396e1af40cec962b8d7c8c6655c9b00211740aa8a98e2e";el.id = "ttzz";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(el, s);})(window)</script>
<script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?93b7f42bd69c99e574dac7e18f9ab573";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script>

</head>

<body style="display:flex;flex-direction:column;min-height:100vh">

    <a href="#main-content" class="skip-link">跳转到主要内容</a>

    <?php require_once __DIR__ . '/includes/logo.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>


    <main id="main-content" style="min-height:60vh" class="main-content">

        <!-- 返回按钮区域 -->

        <div class="case-back-section">

            <button class="case-back-btn" onclick="window.location.href='cases.html'">

                <i class="fas fa-arrow-left"></i>

                返回案例列表

            </button>

        </div>

        <!-- 详情页内容 -->

        <section class="case-detail-content">

            <div class="case-detail-container" style="min-height:400px">

                <div class="case-detail-grid">

                    <!-- 主内容区 -->

                    <div class="case-detail-main">

                        <!-- 图片/视频展示 -->

                        <div class="case-media-gallery" id="caseMedia">

                            <?php if ($case_data): ?>

                            <?php
                            $images = $case_content['images'] ?? [];
                            $cover = $case_content['coverImage'] ?? $case_data['image'] ?? '';
                            $video_url2 = $case_content['video'] ?? '';

                            // Build unified media list
                            $allMedia = [];
                            foreach ($images as $idx => $img) {
                                $allMedia[] = ['type' => 'image', 'url' => $img, 'idx' => $idx];
                            }
                            if ($video_url2) {
                                $allMedia[] = ['type' => 'video', 'url' => $video_url2, 'idx' => count($images)];
                            }

                            $hasMedia = !empty($allMedia);
                            $first = $hasMedia ? $allMedia[0] : null;
                            $showThumbs = count($allMedia) > 1;
                            ?>

                            <?php if ($hasMedia): ?>
                            <!-- Main display -->
                            <div id="mainMedia" style="position:relative;min-height:400px;background:#f3f4f6;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                <?php if ($first['type'] === 'video'): ?>
                                <video src="<?php echo htmlspecialchars($first['url']); ?>" controls style="width:100%;height:400px;object-fit:contain;background:#000;border-radius:8px;" id="mainVideo"></video>
                                <?php else: ?>
                                <img src="<?php echo htmlspecialchars($first['url']); ?>" alt="<?php echo htmlspecialchars($case_data['title']); ?>" style="width:100%;height:400px;object-fit:contain;border-radius:8px;background:#f3f4f6;" id="mainImage" onclick="openImageViewer(0)">
                                <?php endif; ?>
                            </div>

                            <!-- Thumbnail strip -->
                            <?php if ($showThumbs): ?>
                            <div class="case-media-thumbs" style="margin-top:12px;">
                                <?php foreach ($allMedia as $mi => $m): ?>
                                <div class="case-media-thumb <?php echo $mi === 0 ? 'active' : ''; ?>"
                                     onclick="switchMedia(this)"
                                     data-type="<?php echo $m['type']; ?>"
                                     data-url="<?php echo htmlspecialchars($m['url']); ?>"
                                     data-idx="<?php echo $m['idx']; ?>"
                                     style="position:relative;">
                                    <?php if ($m['type'] === 'video'): ?>
                                    <video src="<?php echo htmlspecialchars($m['url']); ?>" muted preload="metadata" style="width:100%;height:100%;object-fit:cover;"></video>
                                    <i class="fas fa-play-circle" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#fff;font-size:24px;text-shadow:0 2px 4px rgba(0,0,0,0.6);"></i>
                                    <?php else: ?>
                                    <img src="<?php echo htmlspecialchars($m['url']); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                            <?php endif; ?>
                            <?php if ($hasMedia): ?>
                            <script>allViewerMedia = <?php echo json_encode(array_values($allMedia)); ?>;</script>
                            <?php endif; ?>

                            
                            <?php endif; ?>

                        </div>

                        <!-- 案例标题和描述 -->

                        <div class="case-description-section">

                            <h1 class="case-detail-title-content" id="caseTitleContent"><?php echo htmlspecialchars($case_data["title"] ?? ""); ?></h1>

                            

                            <h2 class="case-section-title">

                                <i class="fas fa-file-alt"></i>

                                案例详情

                            </h2>

                            <div class="case-description-text" id="caseDescription"><?php echo ($case_content["detail"] ?? $case_data["description"] ?? ""); ?></div>

                        </div>

                        <!-- 资方能配合哪些 -->

                        <div class="case-highlights">

                            <h3 class="case-highlights-title">

                                <i class="fas fa-handshake"></i>

                                资方能配合哪些

                            </h3>

                            <div class="case-highlights-list" id="caseHighlights">

                                <?php $hl = $case_content['highlights'] ?? []; if(!empty($hl)): foreach($hl as $h): ?>

                                <div class="case-highlight-item"><i class="fas fa-check-circle"></i><span><?php echo htmlspecialchars($h); ?></span></div>

                                <?php endforeach; else: ?>

                                <p style="color:#9ca3af;">暂无资方配合信息</p>

                                <?php endif; ?>

                            </div>

                        </div>

                        <!-- 操作流程 -->

                        <div class="case-highlights">

                            <h3 class="case-highlights-title">

                                <i class="fas fa-tasks"></i>

                                操作流程

                            </h3>

                            <div class="case-highlights-list" id="caseProcess">

                                <?php $ps = $case_content['process'] ?? ['初步沟通需求','提供相关资料','资方审核评估','签订合作协议','资金到位操作','业务完成结算']; $i=1; foreach($ps as $s): ?>

                                <div class="case-highlight-item"><i class="fas fa-check-circle"></i><span><?php echo $i; ?>. <?php echo htmlspecialchars($s); ?></span></div>

                                <?php $i++; endforeach; ?>

                            </div>

                        </div>

                    

</div>

                    <!-- 侧边栏 -->

                    <aside class="case-detail-sidebar">

                        <!-- 联系卡片 -->

                        <div class="case-contact-card">

                            <div class="case-contact-avatar">

                                <i class="fas fa-user-tie"></i>

                            </div>

                            <h3 class="case-contact-name">王总</h3>

                            <p class="case-contact-title">资金业务总经理</p>

                            <div class="case-contact-phone">

                                <i class="fas fa-phone"></i>

                                135-5288-3008

                            </div>

    

                        </div>

                        <!-- 相关案例 -->

                        <div class="case-related-card">

                            <h3 class="case-related-title">相关案例</h3>

                            <div class="case-related-list" id="relatedCases">

                                <?php

                                require_once __DIR__ . '/config/db.php';

                                $db_rel = getDB();

                                $rel = [];

                                $case_type = $case_data['category'] ?? '';

                                $cid = intval($case_id_seo);

                                if ($case_type):

                                    $esc = $db_rel->real_escape_string($case_type);

                                    $r1 = $db_rel->query("SELECT id, title, category, amount, image FROM cases WHERE category='$esc' AND id != $cid AND status=1 ORDER BY id DESC LIMIT 5");

                                    while($rw = $r1->fetch_assoc()): $rel[] = $rw; endwhile;

                                    if (count($rel) < 5):

                                        $r2 = $db_rel->query("SELECT id, title, category, amount, image FROM cases WHERE category!='$esc' AND id != $cid AND status=1 ORDER BY id DESC LIMIT " . (5 - count($rel)));

                                        while($rw2 = $r2->fetch_assoc()): $rel[] = $rw2; endwhile;

                                    endif;

                                endif;

                                $db_rel->close();

                                if (!empty($rel)):

                                    foreach ($rel as $rc):

                                        $rc_img = !empty($rc['image']) ? '../' . $rc['image'] : '../images/cases/default.jpg';

                                ?>

                                <a href="case-detail.html?id=<?php echo $rc['id']; ?>" class="case-related-item">

                                    <div class="case-related-thumb ratio-portrait">

                                        <img src="<?php echo htmlspecialchars($rc_img); ?>" alt="<?php echo htmlspecialchars($rc['title']); ?>">

                                    </div>

                                    <div class="case-related-info">

                                        <h4 class="case-related-item-title"><?php echo htmlspecialchars($rc['title']); ?></h4>

                                        <span class="case-related-item-type"><?php echo htmlspecialchars($rc['category'] ?? ''); ?><?php echo !empty($rc['amount']) ? ' · ' . htmlspecialchars($rc['amount']) : ''; ?></span>

                                    </div>

                                </a>

                                <?php endforeach; else: ?>

                                <p style="color:#9ca3af;text-align:center;padding:20px;">暂无相关案例</p>

                                <?php endif; ?>

                            </div>

                        </div>

                        <!-- 服务保障 -->

                        <div class="case-service-guarantee">

                            <h3 class="case-service-guarantee-title">

                                <i class="fas fa-shield-alt"></i>

                                服务保障

                            </h3>

                            <div class="case-guarantee-list">

                                <div class="case-guarantee-item">

                                    <i class="fas fa-check-circle"></i>

                                    <span>资金实力雄厚，百亿级管理规模</span>

                                </div>

                                <div class="case-guarantee-item">

                                    <i class="fas fa-check-circle"></i>

                                    <span>快速响应，3个工作日内放款</span>

                                </div>

                                <div class="case-guarantee-item">

                                    <i class="fas fa-check-circle"></i>

                                    <span>专业团队，20年行业经验</span>

                                </div>

                                <div class="case-guarantee-item">

                                    <i class="fas fa-check-circle"></i>

                                    <span>严格保密，保护客户隐私</span>

                                </div>

                                <div class="case-guarantee-item">

                                    <i class="fas fa-check-circle"></i>

                                    <span>合规操作，风险可控</span>

                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            </div>

        </section>

        <!-- 更多案例板块已移除 -->

    </main>

        <!-- 用户评论 -->

        

    <!-- 页脚 -->

    

    <!-- 图片查看器 -->

    <div class="image-viewer" id="imageViewer">

        <div class="viewer-overlay" onclick="closeImageViewer()"></div>

        <button class="viewer-close" onclick="closeImageViewer()" aria-label="关闭">

            <i class="fas fa-times"></i>

        </button>

        <button class="viewer-nav prev" id="viewerPrev" onclick="prevImage()" aria-label="上一张">

            <i class="fas fa-chevron-left"></i>

        </button>

        <div class="viewer-container">

            <div id="viewerContent"><img src="" alt="" class="viewer-image" id="viewerImage"></div>

        </div>

        <button class="viewer-nav next" id="viewerNext" onclick="nextImage()" aria-label="下一张">

            <i class="fas fa-chevron-right"></i>

        </button>

        <div class="viewer-counter" id="viewerCounter">1 / 1</div>

    </div>

    <script src="/js/main.js?v=20260610"></script>

    <script>

        // 案例数据 - 将从CMS数据源动态加载

        let casesData = [];

        // 全局基础路径

        const basePath = '../';

        // 获取类型样式类名

        function getTypeClass(type) {

            const typeMap = {

                '过桥': 'bridge',

                '摆账': 'display',

                '亮资': 'proof',

                '冲量': 'deposit',

                '定增': 'placement',

                '应收账款': 'receivable'

            };

            return typeMap[type] || 'bridge';

        }

        // 渲染案例详情

        

        function loadAllCasesFromLocal() {

            try { var c = JSON.parse(localStorage.getItem("cms_cases") || "[]"); return c.filter(function(x) { return x.status === "published"; }); }

            catch(e) { return []; }

        }

        async function loadAllCasesFromServer() {

            try {

                var r = await fetch(basePath + "api/cases.php");

                var d = await r.json();

                if (d.success && d.cases) return d.cases.filter(function(x) { return x.status === "published"; });

            } catch(e) {}

            return [];

        }

        async function loadAllCases() {

            var c = await loadAllCasesFromServer();

            if (c.length === 0) c = loadAllCasesFromLocal();

            casesData = c;

        }

        function loadCaseFromLocal(caseId) {

            try {

                var c = JSON.parse(localStorage.getItem("cms_cases") || "[]");

                return c.find(function(x) { return String(x.id) === String(caseId); }) || null;

            } catch(e) { return null; }

        }

        async function loadCaseDetail(caseId, isPreview) {

            try {

                var r = await fetch(basePath + "api/case-detail.php?id=" + caseId + "&_t=" + Date.now() + "&v=2", { cache: "no-store" });

                var d = await r.json();

                if (d.success && d.exists) { renderCaseFromCMS(d.case); return; }

            } catch(e) { console.log("API error:", e); renderCaseDetail(caseId); }

            var lc = loadCaseFromLocal(caseId);

            if (lc) { renderCaseFromCMS(lc); return; }

            if (isPreview) { window.location.href = "cases.html"; }

            else { renderCaseDetail(caseId); }

        }

        function renderCaseFromCMS(caseData) {

            document.title = caseData.title + " - 案例详情 - Yao资金网";

            var imgs = [];

            if (caseData.images && caseData.images.length > 0) imgs = caseData.images.map(function(i) { return getImageUrl(i); }).filter(function(u) { return u; });

            else if (caseData.image) imgs = [getImageUrl(caseData.image)];

            currentCaseImages = imgs;

            var vurl = caseData.video ? getVideoUrl(caseData.video) : "";

            var m = "<div class="case-media-main" id="mainMedia" onclick="openImageViewer(currentImageIndex)">" + (vurl ? "<div class="case-video-play" onclick="event.stopPropagation(); playVideo('" + vurl + "')"><i class="fas fa-play"></i></div>" : "") + "<img src="" + (imgs.length > 0 ? imgs[0] : basePath + "images/cases/default.jpg") + "" alt="" + caseData.title + "" id="mainImage" style="width:100%;height:400px;object-fit:contain;background:#f3f4f6;"></div>";

            if (imgs.length > 1 || vurl) { m += '<div class="case-media-thumbs">'; imgs.forEach(function(i, idx) { m += '<div class="case-media-thumb ' + (idx === 0 && !vurl ? 'active' : '') + '" onclick="switchMedia(this)" data-type="image" data-url="' + i + '" data-idx="' + idx + '" style="position:relative;"><img src="' + i + '" alt=""></div>'; }); if (vurl) { var vIdx = imgs.length; m += '<div class="case-media-thumb ' + (imgs.length === 0 ? 'active' : '') + '" onclick="switchMedia(this)" data-type="video" data-url="' + vurl + '" data-idx="' + vIdx + '" style="position:relative;"><video src="' + vurl + '" muted preload="metadata" style="width:100%;height:100%;object-fit:cover;"></video><i class="fas fa-play-circle" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:#fff;font-size:24px;text-shadow:0 2px 4px rgba(0,0,0,0.6);"></i></div>'; } m += '</div>'; }

            document.getElementById("caseMedia").innerHTML = m;
            // Populate allViewerMedia for viewer navigation
            allViewerMedia = imgs.map(function(url, idx) { return {type: 'image', url: url, idx: idx}; });
            if (vurl) { allViewerMedia.push({type: 'video', url: vurl, idx: imgs.length}); }

            document.getElementById("caseTitleContent").innerHTML = caseData.title;

            document.getElementById("caseDescription").innerHTML = caseData.detail;

            var hl = caseData.highlights || [];

            document.getElementById("caseHighlights").innerHTML = hl.map(function(h) { return "<div class="case-highlight-item"><i class="fas fa-check-circle"></i><span>" + h + "</span></div>"; }).join("") || "<p style="color:#9ca3af;">暂无资方配合信息</p>";

            var ps = caseData.process || ["初步沟通需求", "提供相关资料", "资方审核评估", "签订合作协议", "资金到位操作", "业务完成结算"];

            document.getElementById("caseProcess").innerHTML = ps.map(function(s, i) { return "<div class="case-highlight-item"><i class="fas fa-check-circle"></i><span>" + (i + 1) + ". " + s + "</span></div>"; }).join("") || "<p style="color:#9ca3af;">暂无操作流程</p>";

            var rel = casesData.filter(function(c) { return c.type === caseData.type && c.id !== caseData.id; });

            if (rel.length < 5) { var o = casesData.filter(function(c) { return c.type !== caseData.type && c.id !== caseData.id; }).slice(0, 5 - rel.length); rel = rel.concat(o); }

            rel = rel.slice(0, 5);

            document.getElementById("relatedCases").innerHTML = rel.map(function(c) {

                var img = c.coverImage || (c.images && c.images.length > 0 ? getImageUrl(c.images[0]) : c.image);

                if (img && img.indexOf("http") !== 0 && img.indexOf("/") !== 0 && img.indexOf("data:") !== 0) img = basePath + img;

                if (!img) img = basePath + "images/cases/default.jpg";

                return '<a href="case-detail.html?id=' + c.id + '" class="case-related-item"><div class="case-related-thumb ratio-portrait"><img src="' + img + '" alt="' + c.title + '" onload="detectRelatedImageRatio(this, this.parentElement)" onerror="this.parentElement.classList.add('ratio-portrait')"></div><div class="case-related-info"><h4 class="case-related-item-title">' + c.title + '</h4><span class="case-related-item-type">' + (c.type || '') + (c.amount ? ' · ' + c.amount : '') + '</span></div></a>';

            }).join("") || "<p style="color:#9ca3af;text-align:center;padding:20px;">暂无相关案例</p>";

        }

        document.addEventListener("DOMContentLoaded", async function() {

            var p = new URLSearchParams(window.location.search);

            var id = p.get("id");

            var preview = p.get("preview") === "true";

            if (id) { currentCaseId = id; await loadAllCases(); loadCaseDetail(id, preview); }

            else { window.location.href = "cases.html"; }

        });

        function renderCaseDetail(caseId) {

            const caseItem = casesData.find(c => c.id === parseInt(caseId));

            

            if (!caseItem) {

                window.location.href = 'cases.html';

                return;

            }

            // 更新页面标题

            document.title = `${caseItem.title} - 案例详情 - Yao资金网`;

            const typeClass = getTypeClass(caseItem.type);

            // 头部区域已移除

            // 保存当前案例图片列表

            currentCaseImages = caseItem.images || [caseItem.image];

            // 渲染媒体区域

            let mediaHtml = `

                <div class="case-media-main" id="mainMedia" onclick="openImageViewer(currentImageIndex)">

                    ${caseItem.hasVideo ? `

                        <div class="case-video-play" onclick="event.stopPropagation(); playVideo('${caseItem.video}')">

                            <i class="fas fa-play"></i>

                        </div>

                    ` : ''}

                    <img src="${caseItem.images[0]}" alt="${caseItem.title}" id="mainImage" style="width:100%;height:400px;object-fit:contain;background:#f3f4f6;">

                </div>

            `;

            if (caseItem.images.length > 1) {

                mediaHtml += `

                    <div class="case-media-thumbs">

                        ${caseItem.images.map((img, idx) => `

                            <div class="case-media-thumb ${idx === 0 ? 'active' : ''}" onclick="changeImage('${img}', this, ${idx})">

                                <img src="${img}" alt="${caseItem.title} - ${idx + 1}">

                            </div>

                        `).join('')}

                    </div>

                `;

            }

            document.getElementById('caseMedia').innerHTML = mediaHtml;

            // 渲染标题到内容区域

            document.getElementById('caseTitleContent').innerHTML = caseItem.title;

            // 渲染描述

            document.getElementById('caseTitleContent').innerHTML = caseData.title;

            

            // 渲染描述

            document.getElementById('caseDescription').innerHTML = caseData.detail;

            

            // 渲染亮点（资方能配合哪些）

            const highlights = caseData.highlights || [];

            document.getElementById('caseHighlights').innerHTML = highlights.map(h => `

                <div class="case-highlight-item">

                    <i class="fas fa-check-circle"></i>

                    <span>${h}</span>

                </div>

            `).join('') || '<p style="color: #9ca3af;">暂无资方配合信息</p>';

            // 渲染操作流程

            const processSteps = caseData.process || ['初步沟通需求', '提供相关资料', '资方审核评估', '签订合作协议', '资金到位操作', '业务完成结算'];

            document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `

                <div class="case-highlight-item">

                    <i class="fas fa-check-circle"></i>

                    <span>${index + 1}. ${step}</span>

                </div>

            `).join('') || '<p style="color: #9ca3af;">暂无操作流程</p>';

            }

            

            // 判断图片比例并设置容器类名（用于相关案例缩略图）

        function detectRelatedImageRatio(imgElement, container) {

            if (!imgElement || !container) return;

            

            const checkRatio = () => {

                const width = imgElement.naturalWidth || imgElement.width;

                const height = imgElement.naturalHeight || imgElement.height;

                

                if (width && height) {

                    const ratio = width / height;

                    // 横图：宽高比 >= 1.2，使用 4:3

                    // 竖图：宽高比 < 1.2，使用 3:4

                    if (ratio >= 1.2) {

                        container.classList.remove('ratio-portrait');

                        container.classList.add('ratio-landscape');

                    } else {

                        container.classList.remove('ratio-landscape');

                        container.classList.add('ratio-portrait');

                    }

                }

            };

            

            if (imgElement.complete) {

                checkRatio();

            } else {

                imgElement.onload = checkRatio;

                imgElement.onerror = () => {

                    container.classList.remove('ratio-landscape');

                    container.classList.add('ratio-portrait');

                };

            }

        }

        // 渲染相关案例（同类型优先，不足5个时补充其他类型）

            let relatedCases = casesData

                .filter(c => c.type === caseData.type && c.id !== caseData.id);

            

            // 如果同类型不足5个，补充其他类型

            if (relatedCases.length < 5) {

                const otherCases = casesData

                    .filter(c => c.type !== caseData.type && c.id !== caseData.id)

                    .slice(0, 5 - relatedCases.length);

                relatedCases = relatedCases.concat(otherCases);

            }

            

            relatedCases = relatedCases.slice(0, 5);

            

            document.getElementById('relatedCases').innerHTML = relatedCases.map(c => {

                // 优先使用 coverImage 字段，其次使用 images 数组的第一张（处理新旧格式），最后使用 image 字段

                let relatedImage = c.coverImage;

                if (relatedImage && !relatedImage.startsWith('http') && !relatedImage.startsWith('/') && !relatedImage.startsWith('data:')) {

                    relatedImage = basePath + relatedImage;

                }

                if (!relatedImage && c.images && c.images.length > 0) {

                    relatedImage = getImageUrl(c.images[0]);

                }

                if (!relatedImage) {

                    relatedImage = c.image;

                    if (relatedImage && !relatedImage.startsWith('http') && !relatedImage.startsWith('/') && !relatedImage.startsWith('data:')) {

                        relatedImage = basePath + relatedImage;

                    }

                }

                if (!relatedImage) {

                    relatedImage = basePath + 'images/cases/default.jpg';

                }

                return `

                <a href="case-detail.html?id=${c.id}" class="case-related-item">

                    <div class="case-related-thumb ratio-portrait">

                        <img src="${relatedImage}" alt="${c.title}" onload="detectRelatedImageRatio(this, this.parentElement)" onerror="this.parentElement.classList.add('ratio-portrait')">

                    </div>

                    <div class="case-related-info">

                        <h4 class="case-related-item-title">${c.title}</h4>

                        <span class="case-related-item-type">${c.type || ""}${c.amount ? " · " + c.amount : ""}</span>

                    </div>

                </a>

            `}).join('') || '<p style="color: #9ca3af; text-align: center; padding: 20px;">暂无相关案例</p>';

            

            // 更多案例板块已移除

    </script>

    

        <!-- CMS Editor -->

    <script>

        // 检查是否需要加载编辑器

        (function() {

            console.log('[CMS] 初始化检查...');

            

            const urlParams = new URLSearchParams(window.location.search);

            const isEditMode = urlParams.get('edit') === 'true';

            const isLoggedIn = localStorage.getItem('cms_logged_in') === 'true';

            

            console.log('[CMS] 编辑模式:', isEditMode);

            console.log('[CMS] 登录状态:', isLoggedIn);

            

            if (isEditMode && isLoggedIn) {

                console.log('[CMS] 开始加载编辑器...');

                

                // 加载编辑器样式

                const editorCss = document.createElement('link');

                editorCss.rel = 'stylesheet';

                editorCss.href = 'admin/editor.css';

                editorCss.onerror = function() {

                    console.error('[CMS] 编辑器样式加载失败');

                };

                document.head.appendChild(editorCss);

                

                // 加载编辑器脚本

                const editorScript = document.createElement('script');

                editorScript.src = 'admin/editor.js';

                editorScript.onload = function() {

                    console.log('[CMS] 编辑器脚本加载成功');

                };

                editorScript.onerror = function() {

                    console.error('[CMS] 编辑器脚本加载失败');

                };

                document.body.appendChild(editorScript);

            } else if (isEditMode && !isLoggedIn) {

                console.log('[CMS] 未登录，重定向到登录页');

                window.location.href = 'admin/login.html?redirect=' + encodeURIComponent(window.location.href);

            }

})();

    </script>

    

        <!-- 案例评论功能 -->

        <script>

        

        </script>

    <script src="/admin/assets/cms.js"></script>

    

    <!-- 移动端链接拦截器：确保点击标签/链接时保持在手机端 -->

    <script>

    (function() {

        var isMobile = window.location.pathname.indexOf('/mobile/') === 0;

        if (!isMobile) return;

        // 方案A：页面加载后重写所有现有链接

        function rewriteExistingLinks() {

            document.querySelectorAll('a[href^="/"]').forEach(function(a) {

                var href = a.getAttribute('href');

                // 只重写根相对路径，排除外部链接、锚点、已移动端路径

                if (href && href.startsWith('/') &&

                    !href.startsWith('/mobile/') &&

                    !href.startsWith('//') &&

                    !href.startsWith('http') &&

                    !href.startsWith('mailto:') &&

                    !href.startsWith('tel:') &&

                    !href.startsWith('#')) {

                    a.href = '/mobile' + href;

                }

            });

        }

        // 方案B：拦截点击事件（安全网，捕获动态添加的链接）

        document.addEventListener('click', function(e) {

            var a = e.target.closest('a');

            if (!a) return;

            var href = a.getAttribute('href');

            if (!href) return;

            // 只拦截会导航到桌面端的根相对路径

            if (href.startsWith('/') &&

                !href.startsWith('/mobile/') &&

                !href.startsWith('//') &&

                !href.startsWith('http') &&

                !href.startsWith('mailto:') &&

                !href.startsWith('tel:') &&

                !href.startsWith('#')) {

                e.preventDefault();

                window.location.href = '/mobile' + href;

            }

        });

        // 方案C：监听DOM变化，重写动态添加的链接

        var observer = new MutationObserver(function(mutations) {

            mutations.forEach(function(mutation) {

                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {

                    mutation.addedNodes.forEach(function(node) {

                        if (node.nodeType === 1) { // Element node

                            if (node.tagName === 'A') {

                                var h = node.getAttribute('href');

                                if (h && h.startsWith('/') && !h.startsWith('/mobile/') && !h.startsWith('//') && !h.startsWith('http') && !h.startsWith('mailto:') && !h.startsWith('tel:') && !h.startsWith('#')) {

                                    node.href = '/mobile' + h;

                                }

                            }

                            if (node.querySelectorAll) {

                                node.querySelectorAll('a[href^="/"]').forEach(function(link) {

                                    var h2 = link.getAttribute('href');

                                    if (h2 && !h2.startsWith('/mobile/') && !h2.startsWith('//') && !h2.startsWith('http') && !h2.startsWith('mailto:') && !h2.startsWith('tel:') && !h2.startsWith('#')) {

                                        link.href = '/mobile' + h2;

                                    }

                                });

                            }

                        }

                    });

                }

            });

        });

        observer.observe(document.body, { childList: true, subtree: true });

        // 初始执行

        if (document.readyState === 'loading') {

            document.addEventListener('DOMContentLoaded', rewriteExistingLinks);

        } else {

            rewriteExistingLinks();

        }

})();

    </script>



<?php include __DIR__ . "/includes/footer.php"; ?>
</body>

</html>
