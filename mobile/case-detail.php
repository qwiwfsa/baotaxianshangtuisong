<?php
require_once __DIR__ . '/../device-detect.php';
$case_id_seo = intval($_GET['id'] ?? 0);
$case_seo_title = '';
$case_seo_desc = '';
$case_seo_keywords = '';
$case_data = null;
$case_content = [];

if ($case_id_seo > 0) {
    try {
        require_once __DIR__ . '/../config/db.php';
        $db_case = getDB();
        
        $stmt = $db_case->prepare("SELECT title, seo_title, seo_keywords, seo_description, description FROM cases WHERE id = ? AND status = 1 LIMIT 1");
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
        }
        $stmt2->close();
        
        $db_case->close();
    } catch (Exception $e) {}
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>

<html lang="zh-CN">

<head>



    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, shrink-to-fit=no">

    <meta name="description" content="Yao资金网成功案例详情 - 查看详细的资金服务案例，了解我们如何帮助企业解决资金需求。">

    <meta name="keywords" content="案例详情,资金服务,过桥资金,摆账,亮资,融资案例">

    <title><?php echo htmlspecialchars($case_seo_title ?: '案例详情 - Yao资金网', ENT_QUOTES, 'UTF-8'); ?></title>
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

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/case-detail.css">

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

    <style>



        /* 页面布局 - 页脚固定到底部 */

        html, body {

            height: 100%;

            margin: 0;

        }

        body {

            display: flex;

            flex-direction: column;

            min-height: 100vh;

        }

        .main-content {

            flex: 1 0 auto;

        }

        .footer {

            flex-shrink: 0;

        }



        /* 编辑按钮样式 */

        .case-edit-btn {

            position: absolute;

            top: 20px;

            right: 20px;

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 10px 20px;

            background: linear-gradient(135deg, #1e3a8a, #3b82f6);

            color: white;

            border: none;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 500;

            cursor: pointer;

            transition: all 0.3s;

            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);

        }

        

        .case-edit-btn:hover {

            transform: translateY(-2px);

            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);

        }

        

        .case-detail-header-container {

            position: relative;

        }

        

        @media (max-width: 768px) {

            .case-edit-btn {

                position: static;

                margin-top: 16px;

                width: 100%;

                justify-content: center;

            }

        }


        /* 评论区样式 */
        

    </style>

    <!-- Logo动态加载 -->

    <script>

    (function(){

        var xhr=new XMLHttpRequest();

        xhr.open('GET','../admin/api/fetch-logo.php?t='+Date.now(),true);

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

    xhr.open('GET', '../admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);

    xhr.onload = function() {

        if (xhr.status === 200) {

            try {

                var data = JSON.parse(xhr.responseText);

                if (data && data.code === 0 && data.data) {

                    var seo = data.data;

                    // PHP handles title

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

    xhr.open('GET', '../admin/api/fetch-seo.php?page=' + pageName + '&t=' + Date.now(), true);

    xhr.onload = function() {

        if (xhr.status === 200) {

            try {

                var data = JSON.parse(xhr.responseText);

                if (data && data.code === 0 && data.data) {

                    var seo = data.data;

                    // PHP handles title

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

<style>.navbar,.nav-menu,.nav-menu a{transition:none!important}</style><style>

        /* 移动端响应式修正 */
        html {
            overflow-x: hidden;
            width: 100%;
        }
        body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
            position: relative;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content,
        .case-detail-content,
        .case-detail-container,
        .case-back-section,
        .case-detail-grid,
        .case-detail-main,
        .case-description-section,
        .case-detail-sidebar {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
        .case-detail-container {
            padding: 0 12px;
        }
        .case-detail-main {
            padding: 16px;
            overflow: visible !important;
        }
        .case-description-section {
            overflow: visible !important;
            overflow-x: visible !important;
        }
        .case-description-text {
            width: 100% !important;
            max-width: 100% !important;
            word-break: break-word;
            overflow-wrap: break-word;
        }
        img, video, iframe, table, pre, code, blockquote, object, embed, svg {
            max-width: 100% !important;
            height: auto !important;
        }
        .logo img,
        .footer-logo img {
            height: 48px !important;
            width: auto !important;
            max-width: none !important;
        }
        .case-description-text * {
            max-width: 100% !important;
        }
        .case-description-text table {
            display: block;
            width: 100% !important;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .case-description-text img,
        .case-description-text video,
        .case-description-text iframe,
        .case-description-text table {
            display: block;
            max-width: 100% !important;
            height: auto !important;
        }
        .case-description-text table {
            display: block;
            overflow-x: auto;
        }
        .case-contact-card,
        .case-related-card,
        .case-service-guarantee {
            min-width: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        @media (max-width: 1024px) {
            .case-detail-grid {
                grid-template-columns: 1fr !important;
                overflow: visible;
            }
            .case-detail-sidebar {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            .case-contact-card,
            .case-related-card,
            .case-service-guarantee {
                flex: none;
                width: 100%;
                min-width: 0;
            }
        }

        @media (max-width: 768px) {
            .case-back-section {
                padding: 60px 12px 12px;
            }
            .case-detail-content {
                padding: 16px 0 32px;
            }
            .case-detail-main {
                padding: 12px;
                border-radius: 12px;
                overflow: visible;
            }
            .case-media-main {
                aspect-ratio: 16/10;
            }
            .case-media-thumbs {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 6px;
            }
            .case-media-thumb {
                height: 60px;
                overflow: hidden;
                border-radius: 6px;
            }
            .case-media-thumb img {
                width: 100%;
                height: 60px;
                object-fit: cover;
            }
            .case-detail-title-content {
                font-size: 20px;
                word-break: break-word;
            }
            .case-section-title {
                font-size: 17px;
            }
            .case-highlights-title {
                font-size: 16px;
            }
            .footer-bottom {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .case-back-section {
                padding: 60px 8px 8px;
            }
            .case-detail-container {
                padding: 0 8px;
            }
            .case-detail-main {
                padding: 10px;
                overflow: visible;
            }
            .case-detail-title-content {
                font-size: 18px !important;
            }
            .case-description-text {
                font-size: 14px;
                max-width: 100% !important;
                overflow-wrap: break-word !important;
                word-break: break-word !important;
                overflow-x: hidden !important;
            }
            .case-detail-main,
            .case-media-gallery,
            .case-description-section,
            .case-highlights,
            .case-detail-grid,
            .case-detail-content {
                overflow-x: hidden !important;
            }
            .case-section-title {
                font-size: 16px !important;
            }
            .case-highlights-title {
                font-size: 15px !important;
            }
            .case-highlight-item {
                font-size: 14px;
            }
            .case-media-thumbs {
                grid-template-columns: repeat(3, 1fr);
                gap: 4px;
            }
            .case-media-thumb {
                height: 50px;
                overflow: hidden;
                border-radius: 4px;
            }
            .case-media-thumb img {
                width: 100% !important;
                height: 50px !important;
                object-fit: cover;
            }
            .case-highlights {
                padding: 12px;
            }
            .case-contact-card,
            .case-related-card {
                padding: 12px;
            }
            .case-media-thumb img {
                width: 100% !important;
                height: 60px !important;
                object-fit: cover;
            }
            #mainImage,
            .case-media-main img {
                max-height: 220px !important;
            }
        }

        /* 防止内容溢出 */
        body {
            max-width: 100vw;
            overflow-x: hidden;
        }
        .case-detail-main,
        .case-description-section,
        .case-description-text,
        .case-media-gallery,
        .case-highlights,
        .case-highlights-list,
        .case-detail-grid,
        .case-detail-content,
        .case-detail-container {
            overflow-x: hidden;
        }
        .case-description-text,
        .case-description-text p,
        .case-description-text div,
        .case-description-text span,
        .case-detail-title-content,
        .case-highlight-item,
        .case-highlight-item span {
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }
        .case-detail-grid > *,
        .case-detail-main > *,
        .case-detail-sidebar > * {
            min-width: 0;
        }
    </style></head>

<body style="display:flex;flex-direction:column;min-height:100vh">

    <a href="#main-content" class="skip-link">跳转到主要内容</a>



    <!-- 导航栏 -->

    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">

        <div class="navbar-container">

<a href="index.html" class="logo" aria-label="Yao资金网首页"><img src="..//uploads/logo/logo_20260505_122045_69f9c47d515d1.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>

            <ul class="nav-menu" role="menubar" id="dynamicNavMenu"></ul>






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



    <main id="main-content" class="main-content" style="min-height:60vh">

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

<div class="case-detail-main" style="max-width:100%;width:100%">

                        <!-- 图片/视频展示 -->

                        <div class="case-media-gallery" id="caseMedia">
                            <?php if ($case_data): ?>
                            <?php $images = $case_content['images'] ?? []; ?>
                            <?php $cover = $case_content['coverImage'] ?? $case_data['image'] ?? ''; ?>
                            <?php $first_img = !empty($images) ? $images[0] : $cover; ?>
                            <?php if ($first_img): ?>
<script>
// Pre-populate image data from PHP for immediate zoom
var currentCaseImages = [];
var currentImageIndex = 0;
<?php
$images = $case_content['images'] ?? [];
if (!empty($images)) {
    echo 'currentCaseImages = ' . json_encode(array_map(function($img) {
        return (strpos($img, 'http') === 0 || $img[0] === '/' || strpos($img, 'data:') === 0) ? $img : '../' . $img;
    }, $images)) . ';';
} elseif (!empty($case_data['image'])) {
    $img = $case_data['image'];
    $url = (strpos($img, 'http') === 0 || $img[0] === '/' || strpos($img, 'data:') === 0) ? $img : '../' . $img;
    echo 'currentCaseImages = ["' . addslashes($url) . '"];';
}
?>
</script>
                            <img src="../<?php echo htmlspecialchars($first_img); ?>" alt="<?php echo htmlspecialchars($case_data['title']); ?>" style="width:100%;max-width:100%;max-height:400px;object-fit:cover;border-radius:8px;" id="mainImage" onclick="openImageViewer(0)">
<?php if (count($images) > 1): ?>
                        <div class="case-media-thumbs">
                            <?php foreach ($images as $idx => $img): ?>
                                <div class="case-media-thumb <?php echo $idx === 0 ? 'active' : ''; ?>" onclick="changeImage('../<?php echo htmlspecialchars($img); ?>', this)">
                                    <img src="../<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($case_data['title']); ?> - <?php echo $idx + 1; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <script>
(function(){
if(typeof currentCaseImages==="undefined"||!currentCaseImages.length){window.currentCaseImages=[];var t=document.querySelectorAll(".case-media-thumb img");t.forEach(function(e){window.currentCaseImages.push(e.src)});if(!window.currentCaseImages.length){var m=document.getElementById("mainImage");if(m)window.currentCaseImages=[m.src]}}
window.currentImageIndex=0;
window.changeImage=window.changeImage||function(e,t,n){var i=document.getElementById("mainImage");if(i)i.src=e;document.querySelectorAll(".case-media-thumb").forEach(function(e){e.classList.remove("active")});if(t)t.classList.add("active");if(typeof n!=="undefined")window.currentImageIndex=n};
window.openImageViewer=window.openImageViewer||function(e){if(!window.currentCaseImages||!window.currentCaseImages.length)return;window.currentImageIndex=e||0;var t=document.getElementById("imageViewer"),n=document.getElementById("viewerImage");if(!t||!n)return;n.src=window.currentCaseImages[window.currentImageIndex];t.classList.add("active");document.body.style.overflow="hidden";var i=document.getElementById("viewerCounter");if(i)i.textContent=(window.currentImageIndex+1)+" / "+window.currentCaseImages.length};
window.closeImageViewer=window.closeImageViewer||function(){var e=document.getElementById("imageViewer");if(e)e.classList.remove("active");document.body.style.overflow=""};
window.prevImage=window.prevImage||function(){if(window.currentImageIndex>0){window.currentImageIndex--;document.getElementById("viewerImage").src=window.currentCaseImages[window.currentImageIndex];var e=document.getElementById("viewerCounter");if(e)e.textContent=(window.currentImageIndex+1)+" / "+window.currentCaseImages.length}};
window.nextImage=window.nextImage||function(){if(window.currentImageIndex<window.currentCaseImages.length-1){window.currentImageIndex++;document.getElementById("viewerImage").src=window.currentCaseImages[window.currentImageIndex];var e=document.getElementById("viewerCounter");if(e)e.textContent=(window.currentImageIndex+1)+" / "+window.currentCaseImages.length}};
})();
</script>



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

                                <?php
                            $highlights = $case_content['highlights'] ?? [];
                            foreach ($highlights as $h): ?>
                            <div class="case-highlight-item">
                                <i class="fas fa-check-circle"></i>
                                <span><?php echo htmlspecialchars($h); ?></span>
                            </div>
                            <?php endforeach; ?>

                            </div>

                        </div>



                        <!-- 操作流程 -->

                        <div class="case-highlights">

                            <h3 class="case-highlights-title">

                                <i class="fas fa-tasks"></i>

                                操作流程

                            </h3>

                            <div class="case-highlights-list" id="caseProcess">

                                <?php
                            $process_steps = $case_content['process'] ?? [];
                            foreach ($process_steps as $idx => $step): ?>
                            <div class="case-highlight-item">
                                <i class="fas fa-check-circle"></i>
                                <span><?php echo ($idx + 1) . ". " . htmlspecialchars($step); ?></span>
                            </div>
                            <?php endforeach; ?>

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

                            <?php include __DIR__ . "/related-cases.php"; ?>

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

            <img src="" alt="" class="viewer-image" id="viewerImage">

        </div>

        <button class="viewer-nav next" id="viewerNext" onclick="nextImage()" aria-label="下一张">

            <i class="fas fa-chevron-right"></i>

        </button>

        <div class="viewer-counter" id="viewerCounter">1 / 1</div>

    </div>



    <script src="../js/main.js"></script>

    <script>

        // 案例数据

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

            // mediaHtml removed - using PHP-rendered image



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



            // Keep PHP-rendered main image, add thumbs if multiple images
            if (typeof caseItem !== 'undefined' && caseItem.images && caseItem.images.length > 1) {
                if (!document.querySelector('#caseMedia .case-media-thumbs')) {
                    var thumbsHtml = '<div class="case-media-thumbs">' +
                        caseItem.images.map(function(img, idx) {
                            return '<div class="case-media-thumb ' + (idx === 0 ? 'active' : '') + '" onclick="changeImage(\'' + img + '\', this)"><img src="' + img + '" alt="' + caseItem.title + ' - ' + (idx + 1) + '"></div>';
                        }).join('') + '</div>';
                    document.getElementById('caseMedia').insertAdjacentHTML('beforeend', thumbsHtml);
                }
            }



            // 渲染标题到内容区域

            // document.getElementById('caseTitleContent').innerHTML = caseItem.title;  // PHP already rendered



            // 渲染描述

            // document.getElementById('caseDescription').innerHTML = (caseItem.detail || '').replace(/\n/g, '<br>');  // PHP already rendered
            



            // 渲染亮点（资方能配合哪些）

            // Only fill if empty
            if (!document.getElementById('caseHighlights').children.length) {
                document.getElementById('caseHighlights').innerHTML = caseItem.highlights.map(h => `

                <div class="case-highlight-item">

                    <i class="fas fa-check-circle"></i>

                    <span>${h}</span>

                </div>

            `).join('');



            // 渲染操作流程

            const processSteps = caseItem.process || ['初步沟通需求', '提供相关资料', '资方审核评估', '签订合作协议', '资金到位操作', '业务完成结算'];

            // Only fill if empty
            if (!document.getElementById('caseProcess').children.length) {
                document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `

                <div class="case-highlight-item">

                    <i class="fas fa-check-circle"></i>

                    <span>${index + 1}. ${step}</span>

                </div>

            `).join('');



            // 渲染相关案例（同类型优先，不足5个时补充其他类型）

            let relatedCases = casesData

                .filter(c => c.type === caseItem.type && c.id !== caseItem.id);

            

            // 如果同类型不足5个，补充其他类型

            if (relatedCases.length < 5) {

                const otherCases = casesData

                    .filter(c => c.type !== caseItem.type && c.id !== caseItem.id)

                    .slice(0, 5 - relatedCases.length);

                relatedCases = relatedCases.concat(otherCases);

            }

            

            relatedCases = relatedCases.slice(0, 5);

            

            document.getElementById('relatedCases').innerHTML = relatedCases.map(c => {

                // 优先使用 coverImage 字段，其次使用 images 数组的第一张，最后使用 image 字段

                const relatedImage = c.coverImage || (c.images && c.images.length > 0 ? c.images[0] : c.image) || basePath + 'images/cases/default.jpg';

                return `

                <a href="case-detail.html?id=${c.id}" class="case-related-item">

                    <div class="case-related-thumb">

                        <img src="${relatedImage}" alt="${c.title}">

                    </div>

                    <div class="case-related-info">

                        <h4 class="case-related-item-title">${c.title}</h4>

                        <span class="case-related-item-type">${c.type || ""}${c.amount ? " · " + c.amount : ""}</span>

                    </div>

                </a>

            `}).join('') || '<p style="color: #9ca3af; text-align: center; padding: 20px;">暂无相关案例</p>';



            // 更多案例板块已移除

        }



        // 切换图片

        function changeImage(src, thumb, index) {

            document.getElementById('mainImage').src = src;

            document.querySelectorAll('.case-media-thumb').forEach(t => t.classList.remove('active'));

            thumb.classList.add('active');

            // 更新当前图片索引

            const thumbs = document.querySelectorAll('.case-media-thumb');

            currentImageIndex = index;

        }



        // 播放视频

        function playVideo(videoSrc) {

            const mainMedia = document.getElementById('mainMedia');

            mainMedia.innerHTML = `

                <video controls autoplay style="width: 100%; height: 100%; object-fit: contain; background: #000;">

                    <source src="${videoSrc}" type="video/mp4">

                    您的浏览器不支持视频播放。

                </video>

            `;

        }



        // 图片查看器相关变量

        // currentCaseImages set from PHP or API

        // currentImageIndex default



        // 打开图片查看器

        function openImageViewer(index) {

            if (currentCaseImages.length === 0) return;

            

            currentImageIndex = index;

            const viewer = document.getElementById('imageViewer');

            const viewerImage = document.getElementById('viewerImage');

            

            viewerImage.src = currentCaseImages[currentImageIndex];

            viewer.classList.add('active');

            document.body.style.overflow = 'hidden';

            

            updateViewerNav();

            updateViewerCounter();

        }



        // 关闭图片查看器

        function closeImageViewer() {

            const viewer = document.getElementById('imageViewer');

            viewer.classList.remove('active');

            document.body.style.overflow = '';

        }



        // 上一张图片

        function prevImage() {

            if (currentImageIndex > 0) {

                currentImageIndex--;

                document.getElementById('viewerImage').src = currentCaseImages[currentImageIndex];

                updateViewerNav();

                updateViewerCounter();

            }

        }



        // 下一张图片

        function nextImage() {

            if (currentImageIndex < currentCaseImages.length - 1) {

                currentImageIndex++;

                document.getElementById('viewerImage').src = currentCaseImages[currentImageIndex];

                updateViewerNav();

                updateViewerCounter();

            }

        }



        // 更新导航按钮状态

        function updateViewerNav() {

            const prevBtn = document.getElementById('viewerPrev');

            const nextBtn = document.getElementById('viewerNext');

            

            prevBtn.disabled = currentImageIndex === 0;

            prevBtn.classList.toggle('disabled', currentImageIndex === 0);

            

            nextBtn.disabled = currentImageIndex === currentCaseImages.length - 1;

            nextBtn.classList.toggle('disabled', currentImageIndex === currentCaseImages.length - 1);

        }



        // 更新计数器

        function updateViewerCounter() {

            document.getElementById('viewerCounter').textContent = 

                `${currentImageIndex + 1} / ${currentCaseImages.length}`;

        }



        // 键盘导航

        document.addEventListener('keydown', function(e) {

            const viewer = document.getElementById('imageViewer');

            if (!viewer.classList.contains('active')) return;

            

            if (e.key === 'Escape') {

                closeImageViewer();

            } else if (e.key === 'ArrowLeft') {

                prevImage();

            } else if (e.key === 'ArrowRight') {

                nextImage();

            }

        });



        // 当前案例ID

        let currentCaseId = null;

        

        // 辅助函数：获取图片URL（兼容新旧格式）

        function getImageUrl(img) {

            if (typeof img === 'string') {

                // 相对路径（如 uploads/xxx.jpg），用 basePath 拼接

                if (img && !img.startsWith('http') && !img.startsWith('/') && !img.startsWith('data:')) {

                    return basePath + img;

                }

                return img;

            }

            if (typeof img === 'object' && img !== null) {

                const url = img.thumbnail || img.url || '';

                if (url && !url.startsWith('http') && !url.startsWith('/') && !url.startsWith('data:')) {

                    return basePath + url;

                }

                return url;

            }

            return '';

        }

        

        // 辅助函数：获取视频URL（兼容新旧格式）

        function getVideoUrl(video) {

            if (typeof video === 'string') {

                return video; // 旧格式

            }

            if (typeof video === 'object' && video !== null) {

                return video.url || '';

            }

            return '';

        }

        

        // 从localStorage加载所有案例（用于相关案例显示）

        function loadAllCasesFromLocal() {

            try {

                const cases = JSON.parse(localStorage.getItem('cms_cases') || '[]');

                return cases.filter(c => c.status === 'published');

            } catch (e) {

                console.error('从localStorage加载失败:', e);

                return [];

            }

        }

        

        // 从服务器加载所有案例

        async function loadAllCasesFromServer() {

            try {

                const response = await fetch(basePath + 'api/cases.php');

                const result = await response.json();

                if (result.success && result.cases) {

                    return result.cases.filter(c => c.status === 'published');

                }

            } catch (error) {

                console.log('服务器加载失败:', error);

            }

            return [];

        }

        

        // 加载所有案例数据

        async function loadAllCases() {

            let cases = await loadAllCasesFromServer();

            if (cases.length === 0) {

                cases = loadAllCasesFromLocal();

            }

            casesData = cases;

        }

        

        // 从localStorage加载单个案例

        function loadCaseFromLocal(caseId) {

            try {

                const cases = JSON.parse(localStorage.getItem('cms_cases') || '[]');

                const foundCase = cases.find(c => String(c.id) === String(caseId));

                return foundCase || null;

            } catch (e) {

                console.error('从localStorage加载失败:', e);

                return null;

            }

        }

        

        // 初始化

        document.addEventListener('DOMContentLoaded', async function() {

            const urlParams = new URLSearchParams(window.location.search);

            const caseId = urlParams.get('id');

            const isPreview = urlParams.get('preview') === 'true';

            

            if (caseId) {

                currentCaseId = caseId;

                // 先加载所有案例数据（用于相关案例）

                await loadAllCases();

                // 再加载具体案例详情

                loadCaseDetail(caseId, isPreview);

            } else {

                window.location.href = 'cases.html';

            }

        });



        // 加载案例详情（优先从CMS加载，失败则使用本地数据）

        async function loadCaseDetail(caseId, isPreview) {

            let serverData = null;

            let serverError = null;



            try {

                // 尝试从CMS API加载（添加时间戳防止缓存）

                const timestamp = new Date().getTime();

                const response = await fetch(basePath + `api/case-detail.php?id=${caseId}&_t=${timestamp}`, {

                    cache: 'no-store'

                });

                const result = await response.json();

                

                if (result.success && result.exists) {

                    // 使用CMS数据渲染

                    serverData = result.case;

                    renderCaseFromCMS(serverData);

                    

                    // 更新localStorage中的数据为最新服务器数据

                    updateLocalCase(serverData);

                    return;

                } else {

                    serverError = result.message || '案例不存在或已下架';

                }

            } catch (error) {

                console.log('CMS API加载失败:', error);

                serverError = error.message || '网络请求失败';

            }

            

            // 服务器加载失败，尝试从localStorage加载（仅作为后备）

            const localCase = loadCaseFromLocal(caseId);

            if (localCase) {

                console.log('服务器加载失败，使用本地缓存数据:', serverError);

                renderCaseFromCMS(localCase);

                return;

            }

            

            if (isPreview) {

                // 预览模式但数据不存在

                alert('案例数据不存在，请先保存');

                window.location.href = 'cases.html';

            } else {

                // 使用硬编码的本地数据

                renderCaseDetail(caseId);

            }

        }

        

        // 更新localStorage中的案例数据

        function updateLocalCase(caseData) {

            try {

                const cases = JSON.parse(localStorage.getItem('cms_cases') || '[]');

                const index = cases.findIndex(c => String(c.id) === String(caseData.id));

                if (index >= 0) {

                    cases[index] = caseData;

                } else {

                    cases.push(caseData);

                }

                localStorage.setItem('cms_cases', JSON.stringify(cases));

            } catch (e) {

                console.error('更新本地缓存失败:', e);

            }

        }

        

        // 从CMS数据渲染案例

        function renderCaseFromCMS(caseData) {

            // 更新页面标题

            document.title = `${caseData.title} - 案例详情 - Yao资金网`;

            

            const typeClass = getTypeClass(caseData.type);

            

            // 头部区域已移除



            // 保存当前案例图片列表（处理新旧格式）

            let images = [];

            if (caseData.images && caseData.images.length > 0) {

                images = caseData.images.map(img => getImageUrl(img)).filter(url => url);

            } else if (caseData.image) {

                images = [caseData.image];

            }

            currentCaseImages = images;

            

            // 处理视频（兼容新旧格式）

            const videoUrl = caseData.video ? getVideoUrl(caseData.video) : '';

            const hasVideo = !!videoUrl;

            

            // 渲染媒体区域

            // mediaHtml removed - using PHP-rendered image

            

            // Thumbs handled below

            

            // Keep PHP-rendered main image, add thumbs if multiple images
            if (typeof caseData !== 'undefined' && caseData.images && caseData.images.length > 1) {
                if (!document.querySelector('#caseMedia .case-media-thumbs')) {
                    var thumbsHtml2 = '<div class="case-media-thumbs">' +
                        caseData.images.map(function(img, idx) {
                            return '<div class="case-media-thumb ' + (idx === 0 ? 'active' : '') + '" onclick="changeImage(\'' + img + '\', this)"><img src="' + img + '" alt="' + caseData.title + ' - ' + (idx + 1) + '"></div>';
                        }).join('') + '</div>';
                    document.getElementById('caseMedia').insertAdjacentHTML('beforeend', thumbsHtml2);
                }
            }

            

            // 渲染标题到内容区域

            // document.getElementById('caseTitleContent').innerHTML = caseData.title;  // PHP already rendered

            

            // 渲染描述

            // document.getElementById('caseDescription').innerHTML = (caseData.detail || '').replace(/\n/g, '<br>');  // PHP already rendered
            

            

            // 渲染亮点（资方能配合哪些）

            const highlights = caseData.highlights || [];

            // Only fill if empty
            if (!document.getElementById('caseHighlights').children.length) {
                document.getElementById('caseHighlights').innerHTML = highlights.map(h => `

                <div class="case-highlight-item">

                    <i class="fas fa-check-circle"></i>

                    <span>${h}</span>

                </div>

            `).join('') || '<p style="color: #9ca3af;">暂无资方配合信息</p>';



            // 渲染操作流程

            const processSteps = caseData.process || ['初步沟通需求', '提供相关资料', '资方审核评估', '签订合作协议', '资金到位操作', '业务完成结算'];

            // Only fill if empty
            if (!document.getElementById('caseProcess').children.length) {
                document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `

                <div class="case-highlight-item">

                    <i class="fas fa-check-circle"></i>

                    <span>${index + 1}. ${step}</span>

                </div>

            `).join('') || '<p style="color: #9ca3af;">暂无操作流程</p>';

            

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




            // 渲染相关案例（renderCaseFromCMS内）
            if (casesData.length > 0) {
                let related = casesData.filter(c => c.type === caseData.type && String(c.id) !== String(caseData.id));
                if (related.length < 5) {
                    const others = casesData.filter(c => c.type !== caseData.type && String(c.id) !== String(caseData.id)).slice(0, 5 - related.length);
                    related = related.concat(others);
                }
                related = related.slice(0, 5);
                var el = document.getElementById('relatedCases');
                if (el) el.innerHTML = related.map(function(c) {
                    var img = c.coverImage || c.image;
                    if (img && img.indexOf('http') !== 0 && img.indexOf('/') !== 0 && img.indexOf('data:') !== 0) img = basePath + img;
                    if (!img) img = basePath + 'images/cases/default.jpg';
                    return '<a href="case-detail.html?id=' + c.id + '" class="case-related-item"><div class="case-related-thumb"><img src="' + img + '" alt="' + c.title + '"></div><div class="case-related-info"><h4>' + c.title + '</h4><span>' + (c.type||'') + (c.amount ? ' · ' + c.amount : '') + '</span></div></a>';
                }).join('') || '<p style="color:#9ca3af;text-align:center;padding:20px;">暂无相关案例</p>';
            }
        // 渲染相关案例（同类型优先，不足5个时补充其他类型）

            let relatedCases = casesData

                .filter(c => c.type === caseData.type && String(c.id) !== String(caseData.id));

            

            // 如果同类型不足5个，补充其他类型

            if (relatedCases.length < 5) {

                const otherCases = casesData

                    .filter(c => c.type !== caseData.type && String(c.id) !== String(caseData.id))

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

        }

        }        }        }        }
    </script>

    

        <!-- CMS Editor -->

    

    
        <!-- 案例评论功能 -->
        <script>
        
        </script>

    <script src="../admin/assets/cms.js"></script>

    


    <!-- 移动端链接拦截器：确保点击标签/链接时保持在手机端 -->
    

<script src="../js/nav-loader.js?v=5"></script>

<footer class="footer"><div class="footer-container"><div class="footer-bottom"><p class="footer-copyright">&copy; 2026 Yao资金网 宏都资本版权所有</p><p class="footer-disclaimer">粤ICP备2026052915号</p></div></div></footer>

</body>

</html>



