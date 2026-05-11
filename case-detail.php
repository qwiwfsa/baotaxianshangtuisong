<?php
require_once __DIR__ . '/device-detect.php';
DeviceDetector::redirect();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="Yao璧勯噾缃戞垚鍔熸渚嬭鎯?- 鏌ョ湅璇︾粏鐨勮祫閲戞湇鍔℃渚嬶紝浜嗚В鎴戜滑濡備綍甯姪浼佷笟瑙ｅ喅璧勯噾闇€姹傘€?>
    <meta name="keywords" content="妗堜緥璇︽儏,璧勯噾鏈嶅姟,杩囨ˉ璧勯噾,鎽嗚处,浜祫,铻嶈祫妗堜緥">
    <title>妗堜緥璇︽儏 - Yao璧勯噾缃?/title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/case-detail.css">
    <style>
        /* 缂栬緫鎸夐挳鏍峰紡 */
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
    </style>
    <!-- Logo鍔ㄦ€佸姞杞?-->
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

<script>
(function(){var ua=navigator.userAgent;if(/Mobile|Android|iPhone|iPod|BlackBerry|Windows Phone|webOS|Opera Mini|IEMobile/i.test(ua)&&window.location.pathname.indexOf("/mobile/")===-1){var p=window.location.pathname.split("/").pop();if(p){window.location.href="mobile/"+p;}}})();
</script>
</head>
<body>
    <a href="#main-content" class="skip-link">璺宠浆鍒颁富瑕佸唴瀹?/a>

    <!-- 瀵艰埅鏍?-->
    <nav class="navbar" id="navbar" role="navigation" aria-label="涓诲鑸?>
        <div class="navbar-container">
<a href="index.html" class="logo" aria-label="Yao璧勯噾缃戦椤?><img src="uploads/logo.png?v=20260502040820" alt="Yao璧勯噾缃? style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar">
                <li role="none"><a href="index.html" class="nav-link" role="menuitem">棣栭〉</a></li>
                <li role="none"><a href="services.html" class="nav-link" role="menuitem">涓氬姟鑼冨洿</a></li>
                <li role="none"><a href="cases.html" class="nav-link active" role="menuitem">鎴愬姛妗堜緥</a></li>
                <li role="none"><a href="advantages.html" class="nav-link" role="menuitem">鏈嶅姟浼樺娍</a></li>
                <li role="none"><a href="news.php" class="nav-link" role="menuitem">琛屼笟璧勮</a></li>
                <li role="none"><a href="faq.html" class="nav-link" role="menuitem">甯歌闂</a></li>
                <li role="none"><a href="contact.html" class="nav-link" role="menuitem">鑱旂郴鎴戜滑</a></li>
            </ul>

            <button class="search-toggle" id="searchToggle" aria-label="鎵撳紑鎼滅储" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="鎵撳紑鑿滃崟" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <main id="main-content">
        <!-- 杩斿洖鎸夐挳鍖哄煙 -->
        <div class="case-back-section">
            <button class="case-back-btn" onclick="window.location.href='cases.html'">
                <i class="fas fa-arrow-left"></i>
                杩斿洖妗堜緥鍒楄〃
            </button>
        </div>

        <!-- 璇︽儏椤靛唴瀹?-->
        <section class="case-detail-content">
            <div class="case-detail-container">
                <div class="case-detail-grid">
                    <!-- 涓诲唴瀹瑰尯 -->
                    <div class="case-detail-main">
                        <!-- 鍥剧墖/瑙嗛灞曠ず -->
                        <div class="case-media-gallery" id="caseMedia">
                            <!-- 鍔ㄦ€佸～鍏?-->
                        </div>

                        <!-- 妗堜緥鏍囬鍜屾弿杩?-->
                        <div class="case-description-section">
                            <h1 class="case-detail-title-content" id="caseTitleContent"></h1>
                            <h2 class="case-section-title">
                                <i class="fas fa-file-alt"></i>
                                妗堜緥璇︽儏
                            </h2>
                            <div class="case-description-text" id="caseDescription">
                                <!-- 鍔ㄦ€佸～鍏?-->
                            </div>
                        </div>

                        <!-- 璧勬柟鑳介厤鍚堝摢浜?-->
                        <div class="case-highlights">
                            <h3 class="case-highlights-title">
                                <i class="fas fa-handshake"></i>
                                璧勬柟鑳介厤鍚堝摢浜?
                            </h3>
                            <div class="case-highlights-list" id="caseHighlights">
                                <!-- 鍔ㄦ€佸～鍏?-->
                            </div>
                        </div>

                        <!-- 鎿嶄綔娴佺▼ -->
                        <div class="case-highlights">
                            <h3 class="case-highlights-title">
                                <i class="fas fa-tasks"></i>
                                鎿嶄綔娴佺▼
                            </h3>
                            <div class="case-highlights-list" id="caseProcess">
                                <!-- 鍔ㄦ€佸～鍏?-->
                            </div>
                        </div>
                    </div>

                    <!-- 渚ц竟鏍?-->
                    <aside class="case-detail-sidebar">
                        <!-- 鑱旂郴鍗＄墖 -->
                        <div class="case-contact-card">
                            <div class="case-contact-avatar">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h3 class="case-contact-name">鐜嬫€?/h3>
                            <p class="case-contact-title">璧勯噾涓氬姟鎬荤粡鐞?/p>
                            <div class="case-contact-phone">
                                <i class="fas fa-phone"></i>
                                135-5288-3008
                            </div>
    
                        </div>

                        <!-- 鐩稿叧妗堜緥 -->
                        <div class="case-related-card">
                            <h3 class="case-related-title">鐩稿叧妗堜緥</h3>
                            <div class="case-related-list" id="relatedCases">
                                <!-- 鍔ㄦ€佸～鍏?-->
                            </div>
                        </div>

                        <!-- 鏈嶅姟淇濋殰 -->
                        <div class="case-service-guarantee">
                            <h3 class="case-service-guarantee-title">
                                <i class="fas fa-shield-alt"></i>
                                鏈嶅姟淇濋殰
                            </h3>
                            <div class="case-guarantee-list">
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>璧勯噾瀹炲姏闆勫帤锛岀櫨浜跨骇绠＄悊瑙勬ā</span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>蹇€熷搷搴旓紝3涓伐浣滄棩鍐呮斁娆?/span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>涓撲笟鍥㈤槦锛?0骞磋涓氱粡楠?/span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>涓ユ牸淇濆瘑锛屼繚鎶ゅ鎴烽殣绉?/span>
                                </div>
                                <div class="case-guarantee-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>鍚堣鎿嶄綔锛岄闄╁彲鎺?/span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- 鏇村妗堜緥鏉垮潡宸茬Щ闄?-->
    </main>

    <!-- 鍙充晶杈规诞鍔ㄧ數璇濇寜閽?-->
    <div class="chat-widget" id="chatWidget" aria-label="鑱旂郴鐢佃瘽">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="鎷ㄦ墦鐢佃瘽" aria-expanded="false">
            <i class="fas fa-phone-alt" aria-hidden="true"></i>
        </button>
    </div>

    <!-- 椤佃剼 -->
<?php include 'includes/footer.php'; ?>


    <!-- 鍥剧墖鏌ョ湅鍣?-->
    <div class="image-viewer" id="imageViewer">
        <div class="viewer-overlay" onclick="closeImageViewer()"></div>
        <button class="viewer-close" onclick="closeImageViewer()" aria-label="鍏抽棴">
            <i class="fas fa-times"></i>
        </button>
        <button class="viewer-nav prev" id="viewerPrev" onclick="prevImage()" aria-label="涓婁竴寮?>
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="viewer-container">
            <img src="" alt="" class="viewer-image" id="viewerImage">
        </div>
        <button class="viewer-nav next" id="viewerNext" onclick="nextImage()" aria-label="涓嬩竴寮?>
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="viewer-counter" id="viewerCounter">1 / 1</div>
    </div>

    <script src="js/main.js"></script>
    <script>
        // 妗堜緥鏁版嵁 - 灏嗕粠CMS鏁版嵁婧愬姩鎬佸姞杞?
        let casesData = [];
        // 鍏ㄥ眬鍩虹璺緞锛堝 /锛?
        const basePath = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/') + 1);

        // 鑾峰彇绫诲瀷鏍峰紡绫诲悕
        function getTypeClass(type) {
            const typeMap = {
                '杩囨ˉ': 'bridge',
                '鎽嗚处': 'display',
                '浜祫': 'proof',
                '鍐查噺': 'deposit',
                '瀹氬': 'placement',
                '搴旀敹璐︽': 'receivable'
            };
            return typeMap[type] || 'bridge';
        }

        // 娓叉煋妗堜緥璇︽儏
        function renderCaseDetail(caseId) {
            const caseItem = casesData.find(c => c.id === parseInt(caseId));
            
            if (!caseItem) {
                window.location.href = 'cases.html';
                return;
            }

            // 鏇存柊椤甸潰鏍囬
            document.title = `${caseItem.title} - 妗堜緥璇︽儏 - Yao璧勯噾缃慲;

            const typeClass = getTypeClass(caseItem.type);

            // 澶撮儴鍖哄煙宸茬Щ闄?

            // 淇濆瓨褰撳墠妗堜緥鍥剧墖鍒楄〃
            currentCaseImages = caseItem.images || [caseItem.image];

            // 娓叉煋濯掍綋鍖哄煙
            let mediaHtml = `
                <div class="case-media-main" id="mainMedia" onclick="openImageViewer(currentImageIndex)">
                    ${caseItem.hasVideo ? `
                        <div class="case-video-play" onclick="event.stopPropagation(); playVideo('${caseItem.video}')">
                            <i class="fas fa-play"></i>
                        </div>
                    ` : ''}
                    <img src="${caseItem.images[0]}" alt="${caseItem.title}" id="mainImage">
                </div>
            `;

            if (caseItem.images.length > 1) {
                mediaHtml += `
                    <div class="case-media-thumbs">
                        ${caseItem.images.map((img, idx) => `
                            <div class="case-media-thumb ${idx === 0 ? 'active' : ''}" onclick="changeImage('${img}', this)">
                                <img src="${img}" alt="${caseItem.title} - ${idx + 1}">
                            </div>
                        `).join('')}
                    </div>
                `;
            }

            document.getElementById('caseMedia').innerHTML = mediaHtml;

            // 娓叉煋鏍囬鍒板唴瀹瑰尯鍩?
            document.getElementById('caseTitleContent').innerHTML = caseItem.title;

            // 娓叉煋鎻忚堪
            document.getElementById('caseDescription').innerHTML = caseItem.detail;

            // 娓叉煋浜偣锛堣祫鏂硅兘閰嶅悎鍝簺锛?
            document.getElementById('caseHighlights').innerHTML = caseItem.highlights.map(h => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${h}</span>
                </div>
            `).join('');

            // 娓叉煋鎿嶄綔娴佺▼
            const processSteps = caseItem.process || ['鍒濇娌熼€氶渶姹?, '鎻愪緵鐩稿叧璧勬枡', '璧勬柟瀹℃牳璇勪及', '绛捐鍚堜綔鍗忚', '璧勯噾鍒颁綅鎿嶄綔', '涓氬姟瀹屾垚缁撶畻'];
            document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${index + 1}. ${step}</span>
                </div>
            `).join('');

            // 娓叉煋鐩稿叧妗堜緥锛堝悓绫诲瀷浼樺厛锛屼笉瓒?涓椂琛ュ厖鍏朵粬绫诲瀷锛?
            let relatedCases = casesData
                .filter(c => c.type === caseItem.type && c.id !== caseItem.id);
            
            // 濡傛灉鍚岀被鍨嬩笉瓒?涓紝琛ュ厖鍏朵粬绫诲瀷
            if (relatedCases.length < 5) {
                const otherCases = casesData
                    .filter(c => c.type !== caseItem.type && c.id !== caseItem.id)
                    .slice(0, 5 - relatedCases.length);
                relatedCases = relatedCases.concat(otherCases);
            }
            
            relatedCases = relatedCases.slice(0, 5);
            
            document.getElementById('relatedCases').innerHTML = relatedCases.map(c => {
                // 浼樺厛浣跨敤 coverImage 瀛楁锛屽叾娆′娇鐢?images 鏁扮粍鐨勭涓€寮狅紝鏈€鍚庝娇鐢?image 瀛楁
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
            `}).join('') || '<p style="color: #9ca3af; text-align: center; padding: 20px;">鏆傛棤鐩稿叧妗堜緥</p>';

            // 鏇村妗堜緥鏉垮潡宸茬Щ闄?
        }

        // 鍒囨崲鍥剧墖
        function changeImage(src, thumb) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.case-media-thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
            // 鏇存柊褰撳墠鍥剧墖绱㈠紩
            const thumbs = document.querySelectorAll('.case-media-thumb');
            currentImageIndex = Array.from(thumbs).indexOf(thumb);
        }

        // 鎾斁瑙嗛
        function playVideo(videoSrc) {
            const mainMedia = document.getElementById('mainMedia');
            mainMedia.innerHTML = `
                <video controls autoplay style="width: 100%; height: 100%; object-fit: contain; background: #000;">
                    <source src="${videoSrc}" type="video/mp4">
                    鎮ㄧ殑娴忚鍣ㄤ笉鏀寔瑙嗛鎾斁銆?
                </video>
            `;
        }

        // 鍥剧墖鏌ョ湅鍣ㄧ浉鍏冲彉閲?
        let currentCaseImages = [];
        let currentImageIndex = 0;

        // 鎵撳紑鍥剧墖鏌ョ湅鍣?
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

        // 鍏抽棴鍥剧墖鏌ョ湅鍣?
        function closeImageViewer() {
            const viewer = document.getElementById('imageViewer');
            viewer.classList.remove('active');
            document.body.style.overflow = '';
        }

        // 涓婁竴寮犲浘鐗?
        function prevImage() {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                document.getElementById('viewerImage').src = currentCaseImages[currentImageIndex];
                updateViewerNav();
                updateViewerCounter();
            }
        }

        // 涓嬩竴寮犲浘鐗?
        function nextImage() {
            if (currentImageIndex < currentCaseImages.length - 1) {
                currentImageIndex++;
                document.getElementById('viewerImage').src = currentCaseImages[currentImageIndex];
                updateViewerNav();
                updateViewerCounter();
            }
        }

        // 鏇存柊瀵艰埅鎸夐挳鐘舵€?
        function updateViewerNav() {
            const prevBtn = document.getElementById('viewerPrev');
            const nextBtn = document.getElementById('viewerNext');
            
            prevBtn.disabled = currentImageIndex === 0;
            prevBtn.classList.toggle('disabled', currentImageIndex === 0);
            
            nextBtn.disabled = currentImageIndex === currentCaseImages.length - 1;
            nextBtn.classList.toggle('disabled', currentImageIndex === currentCaseImages.length - 1);
        }

        // 鏇存柊璁℃暟鍣?
        function updateViewerCounter() {
            document.getElementById('viewerCounter').textContent = 
                `${currentImageIndex + 1} / ${currentCaseImages.length}`;
        }

        // 閿洏瀵艰埅
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

        // 褰撳墠妗堜緥ID
        let currentCaseId = null;
        
        // 杈呭姪鍑芥暟锛氳幏鍙栧浘鐗嘦RL锛堝吋瀹规柊鏃ф牸寮忥級
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
        
        // 杈呭姪鍑芥暟锛氳幏鍙栬棰慤RL锛堝吋瀹规柊鏃ф牸寮忥級
        function getVideoUrl(video) {
            if (typeof video === 'string') {
                return video; // 鏃ф牸寮?
            }
            if (typeof video === 'object' && video !== null) {
                return video.url || '';
            }
            return '';
        }
        
        // 浠巐ocalStorage鍔犺浇鎵€鏈夋渚嬶紙鐢ㄤ簬鐩稿叧妗堜緥鏄剧ず锛?
        function loadAllCasesFromLocal() {
            try {
                const cases = [];
                return cases.filter(c => c.status === 'published');
            } catch (e) {
                console.error('浠巐ocalStorage鍔犺浇澶辫触:', e);
                return [];
            }
        }
        
        // 浠庢湇鍔″櫒鍔犺浇鎵€鏈夋渚?
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
        
        // 鍔犺浇鎵€鏈夋渚嬫暟鎹?
        async function loadAllCases() {
            let cases = await loadAllCasesFromServer();
            if (cases.length === 0) {
                cases = loadAllCasesFromLocal();
            }
            casesData = cases;
        }
        
        // 浠巐ocalStorage鍔犺浇鍗曚釜妗堜緥
        function loadCaseFromLocal(caseId) { return null; } catch (e) {
                console.error('浠巐ocalStorage鍔犺浇澶辫触:', e);
                return null;
            }
        }
        
        // 鍒濆鍖?
        document.addEventListener('DOMContentLoaded', async function() {
            const urlParams = new URLSearchParams(window.location.search);
            const caseId = urlParams.get('id');
            const isPreview = urlParams.get('preview') === 'true';
            
            if (caseId) {
                currentCaseId = caseId;
                // 鍏堝姞杞芥墍鏈夋渚嬫暟鎹紙鐢ㄤ簬鐩稿叧妗堜緥锛?
                await loadAllCases();
                // 鍐嶅姞杞藉叿浣撴渚嬭鎯?
                loadCaseDetail(caseId, isPreview);
            } else {
                window.location.href = 'cases.html';
            }
        });

        // 鍔犺浇妗堜緥璇︽儏锛堜紭鍏堜粠CMS鍔犺浇锛屽け璐ュ垯浣跨敤鏈湴鏁版嵁锛?
        async function loadCaseDetail(caseId, isPreview) {
            let serverData = null;
            let serverError = null;
            
            try {
                // 灏濊瘯浠嶤MS API鍔犺浇锛堟坊鍔犳椂闂存埑闃叉缂撳瓨锛?
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
                    serverError = result.message || '妗堜緥涓嶅瓨鍦ㄦ垨宸蹭笅鏋?;
                }
            } catch (error) {
                console.log('CMS API鍔犺浇澶辫触:', error);
                serverError = error.message || '缃戠粶璇锋眰澶辫触';
            }
            
            // 鏈嶅姟鍣ㄥ姞杞藉け璐ワ紝灏濊瘯浠巐ocalStorage鍔犺浇锛堜粎浣滀负鍚庡锛?
            const localCase = loadCaseFromLocal(caseId);
            if (localCase) {
                console.log('鏈嶅姟鍣ㄥ姞杞藉け璐ワ紝浣跨敤鏈湴缂撳瓨鏁版嵁:', serverError);
                renderCaseFromCMS(localCase);
                return;
            }
            
            if (isPreview) {
                // 棰勮妯″紡浣嗘暟鎹笉瀛樺湪
                alert('妗堜緥鏁版嵁涓嶅瓨鍦紝璇峰厛淇濆瓨');
                window.location.href = 'cases.html';
            } else {
                // 浣跨敤纭紪鐮佺殑鏈湴鏁版嵁
                renderCaseDetail(caseId);
            }
        }
        
        // 鏇存柊localStorage涓殑妗堜緥鏁版嵁
        
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
                console.error('鏇存柊鏈湴缂撳瓨澶辫触:', e);
            }
        }
        
        // 浠嶤MS鏁版嵁娓叉煋妗堜緥
        function renderCaseFromCMS(caseData) {
            // 鏇存柊椤甸潰鏍囬
                        // 更新页面标题
            document.title = `${caseData.title} - 案例详情 - Yao资金网`;
            // 更新SEO meta标签
            updateMetaTags(caseData);
            
            
            const typeClass = getTypeClass(caseData.type);
            
            // 澶撮儴鍖哄煙宸茬Щ闄?

            // 淇濆瓨褰撳墠妗堜緥鍥剧墖鍒楄〃锛堝鐞嗘柊鏃ф牸寮忥級
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
            
            // 娓叉煋濯掍綋鍖哄煙
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
            
            // 娓叉煋鏍囬鍒板唴瀹瑰尯鍩?
            document.getElementById('caseTitleContent').innerHTML = caseData.title;
            
            // 娓叉煋鎻忚堪
            document.getElementById('caseDescription').innerHTML = caseData.detail;
            
            // 娓叉煋浜偣锛堣祫鏂硅兘閰嶅悎鍝簺锛?
            const highlights = caseData.highlights || [];
            document.getElementById('caseHighlights').innerHTML = highlights.map(h => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${h}</span>
                </div>
            `).join('') || '<p style="color: #9ca3af;">鏆傛棤璧勬柟閰嶅悎淇℃伅</p>';

            // 娓叉煋鎿嶄綔娴佺▼
            const processSteps = caseData.process || ['鍒濇娌熼€氶渶姹?, '鎻愪緵鐩稿叧璧勬枡', '璧勬柟瀹℃牳璇勪及', '绛捐鍚堜綔鍗忚', '璧勯噾鍒颁綅鎿嶄綔', '涓氬姟瀹屾垚缁撶畻'];
            document.getElementById('caseProcess').innerHTML = processSteps.map((step, index) => `
                <div class="case-highlight-item">
                    <i class="fas fa-check-circle"></i>
                    <span>${index + 1}. ${step}</span>
                </div>
            `).join('') || '<p style="color: #9ca3af;">鏆傛棤鎿嶄綔娴佺▼</p>';
            
            // 鍒ゆ柇鍥剧墖姣斾緥骞惰缃鍣ㄧ被鍚嶏紙鐢ㄤ簬鐩稿叧妗堜緥缂╃暐鍥撅級
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

        // 娓叉煋鐩稿叧妗堜緥锛堝悓绫诲瀷浼樺厛锛屼笉瓒?涓椂琛ュ厖鍏朵粬绫诲瀷锛?
            let relatedCases = casesData
                .filter(c => c.type === caseData.type && c.id !== caseData.id);
            
            // 濡傛灉鍚岀被鍨嬩笉瓒?涓紝琛ュ厖鍏朵粬绫诲瀷
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
            `}).join('') || '<p style="color: #9ca3af; text-align: center; padding: 20px;">鏆傛棤鐩稿叧妗堜緥</p>';
            
            // 鏇村妗堜緥鏉垮潡宸茬Щ闄?
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
                    console.log('[CMS] 缂栬緫鍣ㄨ剼鏈姞杞芥垚鍔?);
                };
                editorScript.onerror = function() {
                    console.error('[CMS] 缂栬緫鍣ㄨ剼鏈姞杞藉け璐?);
                };
                document.body.appendChild(editorScript);
            } else if (isEditMode && !isLoggedIn) {
                console.log('[CMS] 鏈櫥褰曪紝閲嶅畾鍚戝埌鐧诲綍椤?);
                window.location.href = 'admin/login.html?redirect=' + encodeURIComponent(window.location.href);
            }
        })();
    </script>
</body>
</html>

