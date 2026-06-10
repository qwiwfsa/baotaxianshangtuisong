<?php
/**
 * 共享头部组件 - 导航栏 + 搜索放大镜
 *
 * 使用方式：在 <body> 标签之后添加：
 *   <?php include __DIR__ . '/includes/header.php'; ?>
 *
 * 前置依赖（需在 include 之前）：
 *   require_once __DIR__ . '/includes/logo.php';   // 提供 $header_logo
 *
 * 此文件替代每个页面中内联的 navbar HTML，实现统一维护。
 *
 * 搜索功能依赖：
 *   - CSS: /css/style.min.css (search-toggle, search-overlay 等样式)
 *   - JS:  /js/main.js (initSearch 函数)
 *   请确保页面 <head> 中已引入这两个文件。
 */
?>
<!-- 导航栏 -->
<nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
    <div class="navbar-container">
        <a href="/" class="logo" aria-label="Yao资金网首页"><img loading="lazy" src="<?php echo htmlspecialchars($header_logo ?? '/uploads/logo/logo_20260505_122045_69f9c47d515d1.png'); ?>" alt="Yao资金网" style="height:48px;width:auto;"></a>
        <ul class="nav-menu" role="menubar"><?php include __DIR__ . '/nav.php'; ?></ul>
        <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false" aria-controls="navMenu">
            <span></span><span></span><span></span>
        </button>
    </div>

    <!-- 搜索覆层 -->
    <div class="search-overlay" id="searchOverlay" role="search" aria-hidden="true">
        <div class="search-container">
            <form class="search-form" id="searchForm" action="#" method="get">
                <input type="text" class="search-input" id="searchInput" placeholder="搜索业务、案例、资讯..." aria-label="搜索内容">
                <button type="submit" class="search-submit" aria-label="搜索">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </button>
            </form>
            <div class="search-suggestions" id="searchSuggestions" aria-live="polite"></div>
            <button class="search-close" id="searchClose" aria-label="关闭搜索">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</nav>
