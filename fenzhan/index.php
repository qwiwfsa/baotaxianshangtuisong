<?php
/**
 * 城市分站前端渲染模板
 */
require_once __DIR__ . '/../config/db.php';

if (!function_exists('getDbConnection')) {
    function getDbConnection() { return getDB(); }
}

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if ($slug === '') {
    http_response_code(404);
    exit('Page not found');
}

try {
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT * FROM fenzhan_cities WHERE slug = ? AND is_active = 1");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt->close(); $conn->close();
        http_response_code(404);
        exit('Page not found');
    }
    $city = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    http_response_code(500);
    exit('Internal error');
}

$page_title = !empty($city['title']) ? $city['title'] : $city['city_name'] . ' - Yao资金网';
$page_keywords = !empty($city['keywords']) ? $city['keywords'] : $city['city_name'] . '资金服务,企业贷款,短期拆借';
$page_description = !empty($city['description']) ? $city['description'] : $city['city_name'] . '专业资金业务服务，提供企业及个人短期资金需求解决方案';
$page_content = $city['content'];
$city_name = $city['city_name'];
$phone = $city['phone'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="author" content="Yao资金网">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="all" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <link rel="stylesheet" href="../css/style.css?v=20260513c">
    <link rel="stylesheet" href="../css/page-custom.css?v=20260513c">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <base href="/">
</head>
<body>
    <!-- 导航栏 -->
    <header>
        <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
            <div class="navbar-container">
                <a href="index.html" class="logo" aria-label="Yao资金网首页">
                    <img src="./uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金网" style="height:48px;width:auto;" class="">
                </a>
                <ul class="nav-menu" role="menubar" id="dynamicNavMenu">
                    <li role="none"><a href="index.html" class="nav-link active" role="menuitem">首页</a></li>
                    <li role="none"><a href="services.html" class="nav-link" role="menuitem">业务范围</a></li>
                    <li role="none"><a href="cases.html" class="nav-link" role="menuitem">成功案例</a></li>
                    <li role="none"><a href="advantages.html" class="nav-link" role="menuitem">核心优势</a></li>
                    <li role="none"><a href="news.php" class="nav-link" role="menuitem">行业资讯</a></li>
                    <li role="none"><a href="faq.html" class="nav-link" role="menuitem">常见问题</a></li>
                    <li role="none"><a href="contact.html" class="nav-link" role="menuitem">联系我们</a></li>
                </ul>
                <button class="nav-toggle" id="navToggle" aria-label="切换菜单">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </nav>
    </header>

    <!-- 主内容 -->
    <main>
        <!-- 页面横幅 -->
        <section class="page-banner">
            <div class="banner-bg" style="background: linear-gradient(135deg, #1a365d 0%, #2d4a7a 50%, #1a365d 100%);">
                <div class="banner-overlay" style="position:absolute;top:0;left:0;right:0;bottom:0;background:url('images/banner-pattern.png') repeat;opacity:0.1;"></div>
            </div>
            <div class="banner-content" style="position:relative;z-index:2;">
                <h1><?php echo htmlspecialchars($city_name, ENT_QUOTES, 'UTF-8'); ?> - 专业资金服务</h1>
                <p>为您提供全方位的资金解决方案</p>
            </div>
        </section>

        <!-- 城市分站内容 -->
        <section class="section">
            <div class="container">
                <div class="city-content" style="padding: 40px 0;">
                    <?php if ($phone): ?>
                    <div class="city-phone" style="text-align:center;margin-bottom:30px;padding:20px;background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:8px;">
                        <i class="fas fa-phone-alt" style="color:#d4a843;font-size:24px;"></i>
                        <span style="font-size:24px;font-weight:bold;color:#1a365d;margin-left:10px;">咨询热线：<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="city-body">
                        <?php echo $page_content; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- 底部 -->
    <footer class="footer">
        <div id="footerDynamicContainer"></div>
    </footer>

    <script src="js/footer-loader.js?v=20260513d"></script>
    <script src="js/main.js?v=20260513d"></script>
    <script src="js/cms.js?v=20260513d"></script>
    <script>
    // Override nav active state for city pages
    document.addEventListener('DOMContentLoaded', function() {
        var links = document.querySelectorAll('.nav-menu a');
        links.forEach(function(link) {
            link.classList.remove('active');
        });
    });
    </script>
</body>
</html>