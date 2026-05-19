/**
 * 页脚动态加载脚本
 * 从后台数据库动态加载页脚配置（版权、免责声明等）
 * 所有桌面端页面统一使用，后台修改后自动同步
 */
(function() {
    'use strict';

    // 避免重复执行
    if (window.__footerLoaded) return;
    window.__footerLoaded = true;

    // 页脚配置API地址
    const FOOTER_API = '/admin/api/footer-data.php';

    /**
     * 从分组数据中获取指定键的值
     */
    function getValue(grouped, group, key, defaultValue, urlKey) {
            if (grouped && grouped[group]) {
                for (var i = 0; i < grouped[group].length; i++) {
                    if (grouped[group][i].item_key === key) {
                        if (urlKey) return grouped[group][i].item_url || '';
                        return grouped[group][i].item_value || defaultValue;
                    }
                }
            }
            return defaultValue;
        }

        function _getValue_old(grouped, group, key, defaultValue) {
        if (!grouped[group]) return defaultValue;
        for (var i = 0; i < grouped[group].length; i++) {
            if (grouped[group][i].item_key === key) {
                return grouped[group][i].item_value || defaultValue;
            }
        }
        return defaultValue;
    }

    /**
     * 获取分组数据的列表
     */
    function getList(grouped, group) {
        return grouped[group] || [];
    }

    /**
     * 更新页脚内容
     */
            function updateFooter(grouped) {
        // 1. 更新品牌描述
        var descEl = document.querySelector('.footer-desc');
        if (descEl) {
            var desc = getValue(grouped, 'brand', 'company_desc', '');
            if (desc) descEl.textContent = desc;
        }

        // 2. 更新快捷导航 (data-footer-group="quick_links")
        var quickLinksNav = document.querySelector('.footer-nav[data-footer-group="quick_links"]');
        if (quickLinksNav) {
            var list = quickLinksNav.querySelector('.footer-nav-list');
            if (list) {
                var links = getList(grouped, 'quick_links');
                if (links.length > 0) {
                    list.innerHTML = '';
                    for (var i = 0; i < links.length; i++) {
                        var li = document.createElement('li');
                        var a = document.createElement('a');
                        a.href = links[i].item_url || '#';
                        a.textContent = links[i].item_value || links[i].item_label;
                        li.appendChild(a);
                        list.appendChild(li);
                    }
                }
            }
        }

        // 3. 更新底部版权
        var copyrightEl = document.querySelector('.footer-copyright');
        if (copyrightEl) {
            var copyright = getValue(grouped, 'bottom', 'copyright_text', '');
            var copyrightUrl = getValue(grouped, 'bottom', 'copyright_text', '', 'item_url');
            if (copyright) {
                if (copyrightUrl) copyrightEl.innerHTML = '<a href="' + copyrightUrl + '">' + copyright + '</a>';
                else copyrightEl.innerHTML = copyright;
            }
        }

        // 4. 更新免责声明
        var disclaimerEl = document.querySelector('.footer-disclaimer');
        if (disclaimerEl) {
            var disclaimer = getValue(grouped, 'bottom', 'disclaimer_text', '');
            var disclaimerUrl = getValue(grouped, 'bottom', 'disclaimer_text', '', 'item_url');
            if (disclaimer) {
                if (disclaimerUrl) disclaimerEl.innerHTML = '<a href="' + disclaimerUrl + '">' + disclaimer + '</a>';
                else disclaimerEl.innerHTML = disclaimer;
            }
        }
    }

    /**
     * 从API加载页脚数据
     */
    function loadFooterData() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', FOOTER_API + '?t=' + Date.now(), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.code === 0 && resp.grouped) {
                            updateFooter(resp.grouped);
                        }
                    } catch (e) {
                        console.warn('[Footer] 解析页脚数据失败');
                    }
                }
            }
        };
        xhr.send();
    }

    // DOM就绪后加载
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadFooterData);
    } else {
        loadFooterData();
    }
})();
