<?php
/**
 * Mobile header include - shared navbar
 */
require_once __DIR__ . '/config/db.php';
?>
    <!-- 导航栏 -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="主导航">
        <div class="navbar-container">
            <a href="/" class="logo" aria-label="Yao资金首页"><img src="/uploads/logo/logo_20260505_122045_69f9c47d515d1.png" alt="Yao资金" style="height:48px;width:auto;"></a>
            <ul class="nav-menu" role="menubar"><?php include __DIR__ . "/includes/nav.php"; ?></ul>
            <button class="search-toggle" id="searchToggle" aria-label="打开搜索" aria-expanded="false">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="打开菜单" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>
