/**
 * 导航栏动态加载 - 同步渲染无闪烁
 * 先读localStorage立即渲染，再后台更新
 */
(function() {
    'use strict';
    if (window.__navLoaded) return;
    window.__navLoaded = true;

    var NAV_API = '/admin/api/nav-save.php?type=nav&t=' + Date.now();

    var DEFAULT_NAV = [
        {name:'首页',url:'/'},
        {name:'业务范围',url:'/services.html'},
        {name:'成功案例',url:'/cases.html'},
        {name:'服务优势',url:'/advantages.html'},
        {name:'行业资讯',url:'/news.php'},
        {name:'常见问题',url:'/faq.html'},
        {name:'联系我们',url:'/contact.html'}
    ];

    function getActiveClass(url) {
        var path = window.location.pathname;
        var cp = path.replace(/^\/pages\//, '/');
        if (url === '/') return cp === '/' || cp === '/index.php' || cp === '/index.html';
        return cp === url || cp === url.replace('.html', '.php');
    }

    function renderNav(items) {
        var navMenu = document.getElementById('dynamicNavMenu');
        if (!navMenu) return;
        var html = '';
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var isActive = getActiveClass(item.url);
            html += '<li role=\"none\"><a href=\"' + item.url + '\" class=\"nav-link' + (isActive ? ' active' : '') + '\" role=\"menuitem\">' + item.name + '</a></li>';
        }
        navMenu.innerHTML = html;
    }

    // 1. 同步从localStorage渲染（无闪烁）
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

    // 2. 后台从API更新
    var xhr = new XMLHttpRequest();
    xhr.open('GET', NAV_API, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            try {
                var resp = JSON.parse(xhr.responseText);
                if (resp.code === 0 && resp.data && resp.data.length > 0) {
                    try { localStorage.setItem('cms_nav_items_v2', JSON.stringify(resp.data)); } catch(e) {}
                    // 如果数据变了，更新DOM
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
