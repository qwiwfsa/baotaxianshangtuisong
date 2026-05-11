/**
 * CMS数据集成脚本
 * 从JSON数据文件加载内容并应用到页面
 */

(function() {
    'use strict';

    // 获取当前页面ID
    function getPageId() {
        const path = window.location.pathname;
        const filename = path.split('/').pop() || 'index.html';
        return filename.replace('.html', '');
    }

    // 加载CMS数据
    async function loadCMSData() {
        const pageId = getPageId();

        try {
            // 从数据库API加载最新数据
            const CMS_BASE = '/admin/';
            const response = await fetch(CMS_BASE + `api/load.php?page=${pageId}&t=${Date.now()}`);
            if (response.ok) {
                const result = await response.json();
                if (result.success && result.data) {
                    applyData(result.data);
                    console.log('[CMS] 已从数据库加载数据');
                    return;
                }
            }

            // 如果API加载失败，尝试从JSON文件加载
            const jsonResponse = await fetch(CMS_BASE + `data/${pageId}.json`);
            if (jsonResponse.ok) {
                const data = await jsonResponse.json();
                applyData(data);
                console.log('[CMS] 已从JSON文件加载数据');
            }
        } catch (error) {
            console.log('[CMS] 加载数据失败:', error);
        }
    }

    // 应用数据到页面
    function applyData(data) {
        const pageId = getPageId();

        // 根据页面ID应用不同的数据映射
        const mappings = getPageMappings(pageId);
        
        mappings.forEach(mapping => {
            const element = document.querySelector(mapping.selector);
            if (element && data[mapping.field]) {
                if (mapping.type === 'html') {
                    element.innerHTML = data[mapping.field];
                } else if (mapping.type === 'attr') {
                    element.setAttribute(mapping.attr, data[mapping.field]);
                } else {
                    element.textContent = data[mapping.field];
                }
            }
        });
    }

    // 获取页面数据映射
    function getPageMappings(pageId) {
        const mappings = {
            index: [
                // Hero区域
                { selector: '.hero-title', field: 'heroTitle', type: 'text' },
                { selector: '.hero-subtitle', field: 'heroSubtitle', type: 'text' },
                { selector: '.btn-primary', field: 'heroButtonText', type: 'text' },
                { selector: '.btn-primary', field: 'heroButtonLink', type: 'attr', attr: 'href' },
                
                // 统计数据
                { selector: '.stat-card:nth-child(1) .stat-number', field: 'stat1Number', type: 'text' },
                { selector: '.stat-card:nth-child(1) .stat-label', field: 'stat1Label', type: 'text' },
                { selector: '.stat-card:nth-child(2) .stat-number', field: 'stat2Number', type: 'text' },
                { selector: '.stat-card:nth-child(2) .stat-label', field: 'stat2Label', type: 'text' },
                { selector: '.stat-card:nth-child(3) .stat-number', field: 'stat3Number', type: 'text' },
                { selector: '.stat-card:nth-child(3) .stat-label', field: 'stat3Label', type: 'text' },
                { selector: '.stat-card:nth-child(4) .stat-number', field: 'stat4Number', type: 'text' },
                { selector: '.stat-card:nth-child(4) .stat-label', field: 'stat4Label', type: 'text' },
                
                // 服务区域
                { selector: '#services .section-title', field: 'servicesTitle', type: 'text' },
                { selector: '#services .section-subtitle', field: 'servicesSubtitle', type: 'text' },
                
                // 服务卡片
                { selector: '.service-card:nth-child(1) .service-title', field: 'service1Title', type: 'text' },
                { selector: '.service-card:nth-child(1) .service-list', field: 'service1Content', type: 'html' },
                { selector: '.service-card:nth-child(2) .service-title', field: 'service2Title', type: 'text' },
                { selector: '.service-card:nth-child(2) .service-list', field: 'service2Content', type: 'html' },
                { selector: '.service-card:nth-child(3) .service-title', field: 'service3Title', type: 'text' },
                { selector: '.service-card:nth-child(3) .service-list', field: 'service3Content', type: 'html' },
                { selector: '.service-card:nth-child(4) .service-title', field: 'service4Title', type: 'text' },
                { selector: '.service-card:nth-child(4) .service-list', field: 'service4Content', type: 'html' },
                
                // 案例区域
                { selector: '#cases .section-title', field: 'casesTitle', type: 'text' },
                { selector: '#cases .section-subtitle', field: 'casesSubtitle', type: 'text' },
                
                // 优势区域
                { selector: '#advantages .advantages-title', field: 'advantagesTitle', type: 'text' },
                { selector: '#advantages .advantages-subtitle', field: 'advantagesSubtitle', type: 'text' },
                
                // FAQ区域
                { selector: '#faq .section-title', field: 'faqTitle', type: 'text' },
                { selector: '#faq .section-subtitle', field: 'faqSubtitle', type: 'text' }
            ],
            services: [
                { selector: '.page-title', field: 'pageTitle', type: 'text' },
                { selector: '.page-subtitle', field: 'pageSubtitle', type: 'text' }
            ],
            cases: [
                { selector: '.page-title', field: 'pageTitle', type: 'text' },
                { selector: '.page-subtitle', field: 'pageSubtitle', type: 'text' }
            ],
            contact: [
                { selector: '.page-title', field: 'pageTitle', type: 'text' },
                { selector: '.page-subtitle', field: 'pageSubtitle', type: 'text' }
            ]
        };

        return mappings[pageId] || [];
    }

    // 加载页脚数据
    async function loadFooter() {
        try {
            const resp = await fetch('/admin/api/footer-data.php');
            const result = await resp.json();
            if (result.code !== 0 || !result.grouped) return;
            const g = result.grouped;

            // 品牌描述
            const descEl = document.querySelector('.footer-desc');
            if (descEl && g.brand) {
                const descItem = g.brand.find(i => i.item_key === 'company_desc');
                if (descItem && descItem.item_value) descEl.textContent = descItem.item_value;
            }

            // 快速链接
            const quickNav = document.querySelector('.footer-nav[data-footer-group="quick_links"] .footer-nav-list');
            if (quickNav && g.quick_links) {
                quickNav.innerHTML = g.quick_links.map(link =>
                    `<li><a href="${link.item_url || '#'}">${link.item_value || link.item_label}</a></li>`
                ).join('');
            }

            // 业务链接（更多内容）
            const svcNav = document.querySelector('.footer-nav[data-footer-group="service_links"] .footer-nav-list');
            if (svcNav && g.service_links && g.service_links.length > 0) {
                svcNav.innerHTML = g.service_links.map(link =>
                    `<li><a href="${link.item_url || '#'}">${link.item_value || link.item_label}</a></li>`
                ).join('');
            }

            // 联系方式
            const contactNav = document.querySelector('.footer-nav[data-footer-group="contact"] .footer-nav-list');
            if (contactNav && g.contact) {
                contactNav.innerHTML = g.contact.map(item => {
                    const icon = item.item_key === 'phone' ? 'fa-phone' :
                                item.item_key === 'contact_person' ? 'fa-user' :
                                item.item_key === 'email' ? 'fa-envelope' : 'fa-circle';
                    return `<li><i class="fas ${icon}"></i> ${item.item_value || ''}</li>`;
                }).join('');
            }

            // 底部信息
            const copyrightEl = document.querySelector('.footer-copyright');
            if (copyrightEl && g.bottom) {
                const cr = g.bottom.find(i => i.item_key === 'copyright_text');
                if (cr && cr.item_value) copyrightEl.innerHTML = cr.item_value;
            }
            const disclaimerEl = document.querySelector('.footer-disclaimer');
            if (disclaimerEl && g.bottom) {
                const ds = g.bottom.find(i => i.item_key === 'disclaimer_text');
                if (ds && ds.item_value) disclaimerEl.textContent = ds.item_value;
            }

            console.log('[CMS] 页脚数据已同步');
        } catch (e) {
            console.log('[CMS] 加载页脚失败:', e);
        }
    }

    // 页面加载完成后执行
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => { loadCMSData(); loadFooter(); });
    } else {
        loadCMSData();
        loadFooter();
    }
})();

