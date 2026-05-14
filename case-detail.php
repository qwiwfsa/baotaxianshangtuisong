<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
// ===== 动态 SEO - 案例详情 =====
$case_seo_title = '';
$case_seo_desc = '';
$case_seo_keywords = '';
$case_seo_url = 'https://www.yaozijin.com/case-detail.html?id=' . intval($_GET['id'] ?? 0);
$case_id_seo = intval($_GET['id'] ?? 0);
if ($case_id_seo > 0) {
    try {
        require_once __DIR__ . '/config/db.php';
        $db_case = getDB();
        $stmt_case = $db_case->prepare("SELECT title, seo_title, seo_keywords, seo_description, description FROM cases WHERE id = ? AND status = 1 LIMIT 1");
        $stmt_case->bind_param('i', $case_id_seo);
        $stmt_case->execute();
        $result_case = $stmt_case->get_result();
        if ($row_case = $result_case->fetch_assoc()) {
            $case_seo_title = !empty($row_case['seo_title']) ? $row_case['seo_title'] : ($row_case['title'] . ' - Yao资金网');
            $case_seo_desc = !empty($row_case['seo_description']) ? $row_case['seo_description'] : (!empty($row_case['description']) ? mb_substr($row_case['description'], 0, 200) : '');
            $case_seo_keywords = !empty($row_case['seo_keywords']) ? $row_case['seo_keywords'] : '';
        }
        $stmt_case->close();
        $db_case->close();
    } catch (Exception $e) {}
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($case_seo_url, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($case_seo_desc ?: 'Yao资金网成功案例详情', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($case_seo_keywords ?: '案例详情,资金服务,过桥资金,摆账,亮资', ENT_QUOTES, 'UTF-8'); ?>">
    <title><?php echo htmlspecialchars($case_seo_title ?: '案例详情 - Yao资金网', ENT_QUOTES, 'UTF-8'); ?></title>
    <base href="/">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.min.css?v=20250514">
    <link rel="stylesheet" href="css/case-detail.css">
    <!-- Case Structured Data -->
    <script type="application/ld+json">
<?php if ($case_id_seo > 0 && $case_seo_title): ?>{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?php echo htmlspecialchars($case_seo_title, ENT_QUOTES, 'UTF-8'); ?>",
    "description": "<?php echo htmlspecialchars($case_seo_desc, ENT_QUOTES, 'UTF-8'); ?>",
    "url": "<?php echo htmlspecialchars($case_seo_url, ENT_QUOTES, 'UTF-8'); ?>",
    "publisher": { "@type": "Organization", "name": "Yao资金网" }
}<?php endif; ?>
    </script>
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($case_seo_title ?: 'Yao资金网 - 案例详情', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($case_seo_desc ?: '查看Yao资金网成功案例', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($case_seo_url, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="zh_CN">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($case_seo_title ?: 'Yao资金网', ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($case_seo_desc ?: '查看Yao资金网成功案例', ENT_QUOTES, 'UTF-8'); ?>">
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容/a>

    <!-- 导航栏-->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航>
        <div class="navbar-container">
<a href="/" class="logo" aria-label="Yao资金网站首页"><img src="uploads/logo.png?v=20260502040820" alt="Yao资金网" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar">
                <li role="none"><a href="/" class="nav-link" role="menuitem">首页</a></li>
                <li role="none"><a href="/services.html" class="nav-link" role="menuitem">业务范围</a></li>
                <li role="none"><a href="/cases.html" class="nav-link active" role="menuitem">成功案例</a></li>
                <li role="none"><a href="/advantages.html" class="nav-link" role="menuitem">服务优势</a></li>
                <li role="none"><a href="/news.php" class="nav-link" role="menuitem">行业资讯</a></li>
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
        <!-- 返回按钮区域 -->
        <div class="case-back-section">
            <button class="case-back-btn" onclick="window.location.href='cases.html'">
                <i class="fas fa-arrow-left"></i>
                返回案例列表
            </button>
        </div>

        <!-- 详情页内容-->
        <section class="case-detail-content">
            <div class="case-detail-container">
                <div class="case-detail-grid">
                    <!-- 主内容区 -->
                    <div class="case-detail-main">
                        <!-- 图片/视频展示 -->
                        <div class="case-media-gallery" id="caseMedia">
                            <!-- 动态填充-->
                        </div>

                        <!-- 案例标题和描述-->
                        <div class="case-description-section">
                            <h1 class="case-detail-title-content" id="caseTitleContent"></h1>
                            <h2 class="case-section-title">
                                <i class="fas fa-file-alt"></i>
                                案例详情
                            </h2>
                            <div class="case-description-text" id="caseDescription">
                                <!-- 动态填充-->
                            </div>
                        </div>

                        <!-- 资方能配合哪些-->
                        <div class="case-highlights">
                            <h3 class="case-highlights-title">
                                <i class="fas fa-handshake"></i>
                                资方能配合哪些
                            </h3>
                            <div class="case-highlights-list" id="caseHighlights">
                                <!-- 动态填充-->
                            </div>
                        </div>

                        <!-- 操作流程 -->
                        <div class="case-highlights">
                            <h3 class="case-highlights-title">
                                <i class="fas fa-tasks"></i>
                                操作流程
                            </h3>
                            <div class="case-highlights-list" id="caseProcess">
                                <!-- 动态填充-->
                            </div>
                        </div>
                    </div>

                    <!-- 侧边栏-->
                    <aside class="case-detail-sidebar">
                        <!-- 联系卡片 -->
                        <div class="case-contact-card">
                            <div class="case-contact-avatar">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3 class="case-contact-name">王总/h3>
                            <p class="case-contact-title">资金业务总经理/p>
                            <div class="case-contact-phone">
                                <i class="fas fa-phone"></i>
                                135-5288-3008
                            </div>
    
                        </div>

                        <!-- 相关案例 -->
                        <div class="case-related-card">
                            <h3 class="case-related-title">相关案例</h3>
                            <div class="case-related-list" id="relatedCases">
                                <!-- 动态填充-->
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
                                    <span>快速响应，3个工作日内放款/span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>专业团队，10年行业经验/span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>严格保密，保护客户隐私/span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>合规操作，风险可控/span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- 更多案例区块已移除-->
    </main>

    <!-- 右侧边浮动电话按钮-->
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="拨打电话" aria-expanded="false">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
    </div>

    <!-- 页脚 -->
<?php include 'includes/footer.php'; ?>


    <!-- 图片查看器-->
    <div class="image-viewer" id="imageViewer">
        <div class="viewer-overlay" onclick="closeImageViewer()"></div>
        <button class="viewer-close" onclick="closeImageViewer()" aria-label="关闭">
            <i class="fas fa-times"></i>
        </button>
        <button class="viewer-nav prev" id="viewerPrev" onclick="prevImage()" aria-label="上一张>
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="viewer-container">
            <img src="" alt="" class="viewer-image" id="viewerImage">
        </div>
        <button class="viewer-nav next" id="viewerNext" onclick="nextImage()" aria-label="下一张>
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="viewer-counter" id="viewerCounter">1 / 1</div>
    </div>

    <script src="js/main.js"></script>
    <script>
        // 案例数据 - 将从CMS数据源动态加载
        let casesData = [];
        // 全局基础路径（如 /）
        const basePath = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/') + 1);

        // 鑾峰彇绫诲瀷鏍峰紡绫诲悕
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

        // 娓叉煋案例详情
        function renderCaseDetail(caseId) {
            const caseItem = casesData.find(c => String(c.id) === String(caseId));
            
            if (!caseItem) {
                window.location.href = 'cases.html';
                return;
            }

            // 更新页面标题
            document.title = `${caseItem.title} - 案例详情 - Yao璧勯噾缃慲;

            const typeClass = getTypeClass(caseItem.type);

            // 头部区域已移除

            // 保存当前案例图片列表
            currentCaseImages = (caseItem.images && caseItem.images.length > 0) ? caseItem.images.map(function(img) { return getImageUrl(img); }).filter(function(url) { return url; }) : (caseItem.image ? [getImageUrl(caseItem.image)].filter(function(url) { return url; }) : []);

            // 渲染媒体区域
            let mediaHtml = `
                <div class="case-media-main" id="mainMedia" onclick="openImageViewer(currentImageIndex)">
                    ${caseItem.hasVideo ? `
                        <div class="case-video-play" onclick="event.stopPropagation(); playVideo('${caseItem.video}')">
                            <i class="fas fa-play"></i>
                        </div>
                    ` : ''}
                    <img src="${currentCaseImages.length > 0 ? currentCaseImages[0] : basePath + 'images/cases/default.jpg'}" alt="${caseItem.title}" id="mainImage">
                </div>
            `;

            if (caseItem.images.length > 1) {
                mediaHtml += `
                    <div class="case-media-thumbs">
                        ${currentCaseImages.map((img, idx) => `
                            <div class="case-media-thumb ${idx === 0 ? 'active' : ''}" onclick="changeImage('${img}', this)">
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
            document.getElementById('caseDescription').innerHTML = caseItem.detail;

            // 渲染亮点（资方能配合哪些）
            document.getElementById('caseHighlights').innerHTML = caseItem.highlights.map(h => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${h}</span>
                </div>
            `).join('');

            // 娓叉煋操作流程
            const processSteps = caseItem.process || ['初步沟通需求, '提供相关资料', '资方审核评估', '签署合作协议', '资金到位操作', '业务完成结算'];
            document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${index + 1}. ${step}</span>
                </div>
            `).join('');

            // 娓叉煋相关案例锛堝悓绫诲瀷浼樺厛锛屼笉瓒?涓椂琛ュ厖鍏朵粬绫诲瀷锛?
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
                const relatedImage = c.coverImage || (c.images && c.images.length > 0 ? c.images[0] : c.image) || 'images/cases/default.jpg';
                return `
                <a href="case-detail.html?id=${c.id}" class="case-related-item">
                    <div class="case-related-thumb">
                        <img src="${relatedImage}" alt="${c.title}">
                    </div>
                    <div class="case-related-info">
                        <h4 class="case-related-item-title">${c.title}</h4>
                        <span class="case-related-item-type">${c.type} ? ${c.amount}</span>
                    </div>
                </a>
            `}).join('') || '<p style="color: #9ca3af; text-align: center; padding: 20px;">鏆傛棤相关案例</p>';

            // 更多案例区块已移除
        }

        // 切换图片
        function changeImage(src, thumb) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.case-media-thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
            // 更新当前图片索引
            const thumbs = document.querySelectorAll('.case-media-thumb');
            currentImageIndex = Array.from(thumbs).indexOf(thumb);
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
        let currentCaseImages = [];
        let currentImageIndex = 0;

        // 鎵撳紑图片查看器
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
                // 鐩稿璺緞锛堝 uploads/xxx.jpg锛夛紝鐢?basePath 鎷兼帴
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
                return video; // 鏃ф牸寮?
            }
            if (typeof video === 'object' && video !== null) {
                return video.url || '';
            }
            return '';
        }
        
        // 浠巐ocalStorage鍔犺浇鎵€鏈夋渚嬶紙鐢ㄤ簬相关案例鏄剧ず锛?
        function loadAllCasesFromLocal() {
            try {
                const cases = [];
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
                console.log('鏈嶅姟鍣ㄥ姞杞藉け璐?', error);
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
            return null;
        }
        
        // 初始化
        document.addEventListener('DOMContentLoaded', async function() {
            const urlParams = new URLSearchParams(window.location.search);
            const caseId = urlParams.get('id');
            const isPreview = urlParams.get('preview') === 'true';
            
            if (caseId) {
                currentCaseId = caseId;
                // 鍏堝姞杞芥墍鏈夋渚嬫暟鎹紙鐢ㄤ簬相关案例锛?
                await loadAllCases();
                // 鍐嶅姞杞藉叿浣撴渚嬭鎯?
                loadCaseDetail(caseId, isPreview);
            } else {
                window.location.href = 'cases.html';
            }
        });

        // 鍔犺浇案例详情锛堜紭鍏堜粠CMS鍔犺浇锛屽け璐ュ垯浣跨敤鏈湴鏁版嵁锛?
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
                    // 浣跨敤CMS鏁版嵁娓叉煋
                    serverData = result.case;
                    renderCaseFromCMS(serverData);
                    
                    // 鏇存柊localStorage涓殑鏁版嵁涓烘渶鏂版湇鍔″櫒鏁版嵁
                    updateLocalCase(serverData);
                    return;
                } else {
                    serverError = result.message || '案例不存在或已下架;
                }
            } catch (error) {
                console.log('CMS API加载失败:', error);
                serverError = error.message || '网络请求失败';
            }
            
            // 鏈嶅姟鍣ㄥ姞杞藉け璐ワ紝灏濊瘯浠巐ocalStorage鍔犺浇锛堜粎浣滀负鍚庡锛?
            const localCase = loadCaseFromLocal(caseId);
            if (localCase) {
                console.log('服务器加载失败，使用本地缓存数据:', serverError);
                renderCaseFromCMS(localCase);
                return;
            }
            
            if (isPreview) {
                // 棰勮妯″紡浣嗘暟鎹笉瀛樺湪
                alert('案例数据不存在，请先保存');
                window.location.href = 'cases.html';
            } else {
                // 浣跨敤纭紪鐮佺殑鏈湴鏁版嵁
                renderCaseDetail(caseId);
            }
        }
        
        // 更新localStorage中的案例数据
        
        // 动态更新SEO meta标签
        function updateMetaTags(caseData) {
            // 更新description
            let descMeta = document.querySelector('meta[name="description"]');
            if (!descMeta) {
                descMeta = document.createElement('meta');
                descMeta.name = 'description';
                document.head.appendChild(descMeta);
            }
            descMeta.content = caseData.seo_description || caseData.summary || caseData.title || '案例详情';
            
            // 更新keywords
            let kwMeta = document.querySelector('meta[name="keywords"]');
            if (!kwMeta) {
                kwMeta = document.createElement('meta');
                kwMeta.name = 'keywords';
                document.head.appendChild(kwMeta);
            }
            kwMeta.content = caseData.seo_keywords || caseData.type || '案例';
        }
        
        function updateLocalCase(caseData) {
            try {
                const cases = [];
                const index = cases.findIndex(c => String(c.id) === String(caseData.id));
                if (index >= 0) {
                    cases[index] = caseData;
                } else {
                    cases.push(caseData);
                }
                // localStorage disabled
            } catch (e) {
                console.error('更新本地缓存失败:', e);
            }
        }
        
        // 从CMS数据渲染案例
        function renderCaseFromCMS(caseData) {
            // 更新页面标题
                        // 更新页面标题
            document.title = `${caseData.title} - 案例详情 - Yao资金网`;
            // 更新SEO meta标签
            updateMetaTags(caseData);
            
            
            const typeClass = getTypeClass(caseData.type);
            
            // 头部区域已移除

            // 保存当前案例图片列表锛堝鐞嗘柊鏃ф牸寮忥級
            let images = [];
            if (caseData.images && caseData.images.length > 0) {
                images = caseData.images.map(img => getImageUrl(img)).filter(url => url);
            } else if (caseData.image) {
                images = [caseData.image];
            }
            currentCaseImages = images;
            
            // 澶勭悊瑙嗛锛堝吋瀹规柊鏃ф牸寮忥級
            const videoUrl = caseData.video ? getVideoUrl(caseData.video) : '';
            const hasVideo = !!videoUrl;
            
            // 渲染媒体区域
            let mediaHtml = `
                <div class="case-media-main" id="mainMedia" onclick="openImageViewer(currentImageIndex)">
                    ${hasVideo ? `
                        <div class="case-video-play" onclick="event.stopPropagation(); playVideo('${videoUrl}')">
                            <i class="fas fa-play"></i>
                        </div>
                    ` : ''}
                    <img src="${images.length > 0 ? images[0] : basePath + 'images/cases/default.jpg'}" alt="${caseData.title}" id="mainImage">
                </div>
            `;
            
            if (images.length > 1) {
                mediaHtml += `
                    <div class="case-media-thumbs">
                        ${images.map((img, idx) => `
                            <div class="case-media-thumb ${idx === 0 ? 'active' : ''}" onclick="changeImage('${img}', this)">
                                <img src="${img}" alt="${caseData.title} - ${idx + 1}">
                            </div>
                        `).join('')}
                    </div>
                `;
            }
            
            document.getElementById('caseMedia').innerHTML = mediaHtml;
            
            // 渲染标题到内容区域
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
            `).join('') || '<p style="color: #9ca3af;">鏆傛棤璧勬柟閰嶅悎淇℃伅</p>';

            // 娓叉煋操作流程
            const processSteps = caseData.process || ['初步沟通需求, '提供相关资料', '资方审核评估', '签署合作协议', '资金到位操作', '业务完成结算'];
            document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${index + 1}. ${step}</span>
                </div>
            `).join('') || '<p style="color: #9ca3af;">鏆傛棤操作流程</p>';
            
            // 鍒ゆ柇鍥剧墖姣斾緥骞惰缃鍣ㄧ被鍚嶏紙鐢ㄤ簬相关案例缂╃暐鍥撅級
        function detectRelatedImageRatio(imgElement, container) {
            if (!imgElement || !container) return;
            
            const checkRatio = () => {
                const width = imgElement.naturalWidth || imgElement.width;
                const height = imgElement.naturalHeight || imgElement.height;
                
                if (width && height) {
                    const ratio = width / height;
                    // 妯浘锛氬楂樻瘮 >= 1.2锛屼娇鐢?4:3
                    // 绔栧浘锛氬楂樻瘮 < 1.2锛屼娇鐢?3:4
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

        // 娓叉煋相关案例锛堝悓绫诲瀷浼樺厛锛屼笉瓒?涓椂琛ュ厖鍏朵粬绫诲瀷锛?
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
                // 浼樺厛浣跨敤 coverImage 瀛楁锛屽叾娆′娇鐢?images 鏁扮粍鐨勭涓€寮狅紙澶勭悊鏂版棫鏍煎紡锛夛紝鏈€鍚庝娇鐢?image 瀛楁
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
                        <span class="case-related-item-type">${c.type} ? ${c.amount}</span>
                    </div>
                </a>
            `}).join('') || '<p style="color: #9ca3af; text-align: center; padding: 20px;">鏆傛棤相关案例</p>';
            
            // 更多案例区块已移除
        }
    </script>
    
        <!-- CMS Editor -->
    <script>
        // 妫€鏌ユ槸鍚﹂渶瑕佸姞杞界紪杈戝櫒
        (function() {
            console.log('[CMS] 鍒濆鍖栨鏌?..');
            
            const urlParams = new URLSearchParams(window.location.search);
            const isEditMode = urlParams.get('edit') === 'true';
            const isLoggedIn = localStorage.getItem('cms_logged_in') === 'true';
            
            console.log('[CMS] 缂栬緫妯″紡:', isEditMode);
            console.log('[CMS] 鐧诲綍鐘舵€?', isLoggedIn);
            
            if (isEditMode && isLoggedIn) {
                console.log('[CMS] 寮€濮嬪姞杞界紪杈戝櫒...');
                
                // 鍔犺浇缂栬緫鍣ㄦ牱寮?
                const editorCss = document.createElement('link');
                editorCss.rel = 'stylesheet';
                editorCss.href = 'admin/editor.css';
                editorCss.onerror = function() {
                    console.error('[CMS] 缂栬緫鍣ㄦ牱寮忓姞杞藉け璐?);
                };
                document.head.appendChild(editorCss);
                
                // 鍔犺浇缂栬緫鍣ㄨ剼鏈?
                const editorScript = document.createElement('script');
                editorScript.src = 'admin/editor.js';
                editorScript.onload = function() {
                    console.log('[CMS] 编辑器脚本加载成功);
                };
                editorScript.onerror = function() {
                    console.error('[CMS] 编辑器脚本加载失败);
                };
                document.body.appendChild(editorScript);
            } else if (isEditMode && !isLoggedIn) {
                console.log('[CMS] 未登录，重定向到登录页);
                window.location.href = 'admin/login.html?redirect=' + encodeURIComponent(window.location.href);
            }
        })();
    </script>
</body>
</html>

