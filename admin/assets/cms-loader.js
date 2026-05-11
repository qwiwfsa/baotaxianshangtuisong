// CMS内容动态加载脚本
(function() {
    // 获取当前页面名称
    const pageName = window.location.pathname.split('/').pop().replace('.html', '') || 'index';

    // 从数据库API加载页面内容
    fetch('../admin/api/load.php?page=' + pageName + '&t=' + Date.now())
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                const data = result.data;

                // 更新页面标题
                if (data.title) {
                    const titleElement = document.querySelector('.page-header-title, .hero-title, h1');
                    if (titleElement) {
                        titleElement.textContent = data.title;
                    }
                }

                // 更新副标题
                if (data.subtitle) {
                    const subtitleElement = document.querySelector('.page-header-subtitle, .hero-subtitle, .page-subtitle');
                    if (subtitleElement) {
                        subtitleElement.textContent = data.subtitle;
                    }
                }

                // 更新各个section的内容
                if (data.sections && Array.isArray(data.sections)) {
                    data.sections.forEach(section => {
                        if (section.id && section.content) {
                            const element = document.querySelector('[data-section="' + section.id + '"]');
                            if (element) {
                                element.innerHTML = section.content;
                            }
                        }
                    });
                }
            }
        })
        .catch(error => {
            console.log('CMS内容加载失败:', error);
            // 失败时使用HTML中的默认内容
        });
})();
