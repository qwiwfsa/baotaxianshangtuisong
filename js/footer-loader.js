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
    const FOOTER_API = './admin/api/footer-data.php';

    /**
     * 从分组数据中获取指定键的值
     */
    function getValue(grouped, group, key, defaultValue) {
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

        // 2. 更新快速链接 (data-footer-group="quick_links")
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

        // 3. 更新业务链接 (data-footer-group="service_links")
        var serviceLinksNav = document.querySelector('.footer-nav[data-footer-group="service_links"]');
        if (serviceLinksNav) {
            var sList = serviceLinksNav.querySelector('.footer-nav-list');
            if (sList) {
                var svcLinks = getList(grouped, 'service_links');
                if (svcLinks.length > 0) {
                    sList.innerHTML = '';
                    for (var j = 0; j < svcLinks.length; j++) {
                        var li2 = document.createElement('li');
                        var a2 = document.createElement('a');
                        a2.href = svcLinks[j].item_url || '#';
                        a2.textContent = svcLinks[j].item_value || svcLinks[j].item_label;
                        li2.appendChild(a2);
                        sList.appendChild(li2);
                    }
                }
            }
        }

        // 4. 更新联系方式 (data-footer-group="contact")
        var contactNav = document.querySelector('.footer-nav[data-footer-group="contact"]');
        if (contactNav) {
            var cList = contactNav.querySelector('.footer-nav-list');
            if (cList) {
                var contacts = getList(grouped, 'contact');
                if (contacts.length > 0) {
                    cList.innerHTML = '';
                    for (var k = 0; k < contacts.length; k++) {
                        var cItem = contacts[k];
                        var li3 = document.createElement('li');
                        var icon = '';
                        if (cItem.item_key === 'phone') icon = '<i class="fas fa-phone"></i> ';
                        else if (cItem.item_key === 'contact_person') icon = '<i class="fas fa-user"></i> ';
                        else if (cItem.item_key === 'email') icon = '<i class="fas fa-envelope"></i> ';
                        li3.innerHTML = icon + (cItem.item_value || cItem.item_label);
                        cList.appendChild(li3);
                    }
                }
            }
        }

        // 5. 更新底部版权
        var copyrightEl = document.querySelector('.footer-copyright');
        if (copyrightEl) {
            var copyright = getValue(grouped, 'bottom', 'copyright_text', '');
            if (copyright) copyrightEl.innerHTML = copyright;
        }

        // 6. 更新免责声明
        var disclaimerEl = document.querySelector('.footer-disclaimer');
        if (disclaimerEl) {
            var disclaimer = getValue(grouped, 'bottom', 'disclaimer_text', '');
            if (disclaimer) disclaimerEl.textContent = disclaimer;
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
