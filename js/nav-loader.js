/**
 * 导航动态加载 - 同步渲染无闪烁
 * 先读localStorage缓存渲染，再后台更新
 * v2: 修复移动端URL，支持分站
 */
(function() {
    'use strict';
    if (window.__navLoaded) return;
    window.__navLoaded = true;

    var pathname = window.location.pathname;
    var isMobile = pathname.indexOf('/mobile/') === 0;
    var isFenzhan = pathname.indexOf('/fenzhan/') === 0;

    var NAV_API = '/admin/api/nav-save.php?type=nav&t=' + Date.now();

    var DEFAULT_NAV = [
        {name:'首页',url:'/'},
        {name:'业务范围',url:'/services.html'},
        {name:'成功案例',url:'/cases.html'},
        {name:'核心优势',url:'/advantages.html'},
        {name:'行业资讯',url:'/news.php'},
        {name:'常见问题',url:'/faq.html'},
        {name:'联系我们',url:'/contact.html'}
    ];

    function fixUrl(url) {
        if (!url || url === '#') return url;
        // Calculate depth within /mobile/ for correct relative paths
        var depth = 0;
        if (isMobile) {
            var mobilePath = pathname.replace('/mobile/', '');
            depth = mobilePath.split('/').length - 1;
        }
        var prefix = '';
        for (var i = 0; i < depth; i++) { prefix += '../'; }
        
        if (url === '/') {
            if (isMobile) return prefix + 'index.html';
            return url;
        }
        if (isMobile && url.indexOf('/mobile/') !== 0) {
            return prefix + url.replace(/^\//, '');
        }
        return url;
    }
    function getActiveClass(url) {
        var p = pathname;
        if (isMobile) p = p.replace(/^\/mobile/, '');
        p = p.replace(/^\/pages\//, '/');
        if (url === '/') return p === '/' || p === '/index.php' || p === '/index.html';
        var p2 = p.replace('.php', '.html');
        var u2 = url.replace('.php', '.html');
        return p === url || p === u2 || p2 === url || p2 === u2;
    }

    function renderNav(items) {
        var navMenu = document.getElementById('dynamicNavMenu');
        if (!navMenu) return;
        var html = '';
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var url = fixUrl(item.url || item.value || '');
            var name = item.name || '';
            var isActive = getActiveClass(url);
            html += '<li role="none"><a href="' + url + '" class="nav-link' + (isActive ? ' active' : '') + '" role="menuitem">' + name + '</a></li>';
        }
        navMenu.innerHTML = html;
    }

    // 1. Render from localStorage immediately
    var stored = null;
    try { stored = localStorage.getItem('cms_nav_items_v2'); } catch(e) {}
    if (stored) {
        try {
            var parsed = JSON.parse(stored);
            if (Array.isArray(parsed) && parsed.length > 0) {
                renderNav(parsed);
            } else {
                renderNav(DEFAULT_NAV);
            }
        } catch(e) {
            renderNav(DEFAULT_NAV);
        }
    } else {
        renderNav(DEFAULT_NAV);
    }

    // 2. Background API update
    var xhr = new XMLHttpRequest();
    xhr.open('GET', NAV_API, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            try {
                var resp = JSON.parse(xhr.responseText);
                if (resp.code === 0 && resp.data && resp.data.length > 0) {
                    try { localStorage.setItem('cms_nav_items_v2', JSON.stringify(resp.data)); } catch(e) {}
                    var current = document.getElementById('dynamicNavMenu');
                    if (current) {
                        renderNav(resp.data);
                    }
                }
            } catch(e) {}
        }
    };
    xhr.send();
})();
