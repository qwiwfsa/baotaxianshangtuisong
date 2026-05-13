/**
 * Yao资金网官网 - 主JavaScript文件
 * 功能：导航、搜索、滚动动画、表单处理、移动端菜单、客服组件
 * 版本：v2.0 全面优化版
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initNavigation();
        initSearch();
        initMobileMenu();
        initSmoothScroll();
        initScrollAnimations();
        initContactForm();
        initChatWidget();
        initHeaderScroll();
        initStatsAnimation();
        initFaqAccordion();
        initContactTooltip();
    });

    /**
     * 联系按钮Tooltip交互
     * 鼠标经过或点击显示联系方式
     */
    function initContactTooltip() {
        const contactButtons = document.querySelectorAll('.contact-tooltip');
        
        contactButtons.forEach(button => {
            // 点击切换active状态（移动端支持）
            button.addEventListener('click', function(e) {
                // 移除其他按钮的active状态
                contactButtons.forEach(btn => {
                    if (btn !== this) btn.classList.remove('active');
                });
                
                // 切换当前按钮的active状态
                this.classList.toggle('active');
                
                // 如果显示了tooltip，3秒后自动隐藏
                if (this.classList.contains('active')) {
                    setTimeout(() => {
                        this.classList.remove('active');
                    }, 3000);
                }
            });
            
            // 鼠标离开时移除active状态
            button.addEventListener('mouseleave', function() {
                this.classList.remove('active');
            });
        });
        
        // 点击页面其他地方关闭所有tooltip
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.contact-tooltip')) {
                contactButtons.forEach(btn => btn.classList.remove('active'));
            }
        });
    }

    /**
     * 切换Hero区域预约咨询卡片显示/隐藏
     * 点击预约咨询按钮时显示或隐藏联系卡片
     */
    window.toggleBookingCard = function(button) {
        const wrapper = button.closest('.booking-wrapper');
        const card = wrapper.querySelector('.contact-card');
        
        if (card) {
            if (card.style.display === 'none') {
                // 显示卡片
                card.style.display = 'block';
                card.classList.remove('hiding');
                button.classList.add('active');
                
                // 3秒后自动收起
                setTimeout(() => {
                    if (card.style.display !== 'none') {
                        card.classList.add('hiding');
                        setTimeout(() => {
                            card.style.display = 'none';
                            card.classList.remove('hiding');
                            button.classList.remove('active');
                        }, 250);
                    }
                }, 5000);
            } else {
                // 收起卡片
                card.classList.add('hiding');
                setTimeout(() => {
                    card.style.display = 'none';
                    card.classList.remove('hiding');
                    button.classList.remove('active');
                }, 250);
            }
        }
    };

    // 点击页面其他地方关闭所有卡片
    document.addEventListener('click', function(e) {
        const bookingWrappers = document.querySelectorAll('.booking-wrapper');
        bookingWrappers.forEach(function(bookingWrapper) {
            if (!bookingWrapper.contains(e.target)) {
                const card = bookingWrapper.querySelector('.contact-card');
                const button = bookingWrapper.querySelector('button');
                if (card && card.style.display !== 'none') {
                    card.classList.add('hiding');
                    setTimeout(() => {
                        card.style.display = 'none';
                        card.classList.remove('hiding');
                        if (button) button.classList.remove('active');
                    }, 250);
                }
            }
        });
    });

    /**
     * 切换联系方式显示/隐藏
     * 点击按钮时显示或隐藏联系方式
     */
    window.toggleContact = function(button) {
        const wrapper = button.closest('.cta-wrapper');
        const contactInfo = wrapper.querySelector('.cta-phone, .cta-phone-light');
        
        if (contactInfo) {
            if (contactInfo.style.display === 'none') {
                contactInfo.style.display = 'inline-block';
            } else {
                contactInfo.style.display = 'none';
            }
        }
    };

    /**
     * 导航功能
     * 高亮当前页面区域对应的导航项
     */
    function initNavigation() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');
        
        if (!sections.length || !navLinks.length) return;

        const observerOptions = {
            root: null,
            rootMargin: '-50% 0px -50% 0px',
            threshold: 0
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    updateActiveNav(id);
                }
            });
        }, observerOptions);
        
        sections.forEach(section => observer.observe(section));
    }

    /**
     * 更新活动导航项
     */
    function updateActiveNav(activeId) {
        const navLinks = document.querySelectorAll('.nav-menu a');
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href === '#' + activeId) {
                link.classList.add('active');
            }
        });
    }

    /**
     * 搜索功能
     */
    function initSearch() {
        const searchToggle = document.getElementById('searchToggle');
        const searchOverlay = document.getElementById('searchOverlay');
        const searchClose = document.getElementById('searchClose');
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        const searchSuggestions = document.getElementById('searchSuggestions');

        if (!searchToggle || !searchOverlay) return;

        // 搜索关键词数据
        const searchData = [
            { title: '上市公司过桥资金', url: '#services', category: '业务' },
            { title: '股票解质押', url: '#services', category: '业务' },
            { title: '企业摆账服务', url: '#services', category: '业务' },
            { title: '亮资业务', url: '#services', category: '业务' },
            { title: '银行存款冲量', url: '#services', category: '业务' },
            { title: '应收账款融资', url: '#services', category: '业务' },
            { title: '云信票据', url: '#services', category: '业务' },
            { title: '成功案例', url: '#cases', category: '页面' },
            { title: '服务优势', url: '#advantages', category: '页面' },
            { title: '常见问题', url: '#faq', category: '页面' },
            { title: '行业资讯', url: '#news', category: '页面' },
            { title: '联系我们', url: '#contact', category: '页面' }
        ];

        // 打开搜索
        searchToggle.addEventListener('click', () => {
            searchOverlay.classList.add('active');
            searchOverlay.setAttribute('aria-hidden', 'false');
            searchToggle.setAttribute('aria-expanded', 'true');
            setTimeout(() => searchInput.focus(), 100);
            document.body.style.overflow = 'hidden';
        });

        // 关闭搜索
        function closeSearch() {
            searchOverlay.classList.remove('active');
            searchOverlay.setAttribute('aria-hidden', 'true');
            searchToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
            searchInput.value = '';
            searchSuggestions.innerHTML = '';
        }

        searchClose.addEventListener('click', closeSearch);

        // 点击遮罩关闭
        searchOverlay.addEventListener('click', (e) => {
            if (e.target === searchOverlay) {
                closeSearch();
            }
        });

        // ESC键关闭
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                closeSearch();
            }
        });

        // 搜索输入建议
        searchInput.addEventListener('input', debounce(function() {
            const query = this.value.trim().toLowerCase();
            
            if (query.length < 1) {
                searchSuggestions.innerHTML = '';
                return;
            }

            const matches = searchData.filter(item => 
                item.title.toLowerCase().includes(query)
            ).slice(0, 5);

            if (matches.length > 0) {
                searchSuggestions.innerHTML = matches.map(item => `
                    <a href="${item.url}" class="search-suggestion-item" onclick="document.getElementById('searchOverlay').classList.remove('active'); document.body.style.overflow = '';">
                        <span class="suggestion-title">${highlightMatch(item.title, query)}</span>
                        <span class="suggestion-category">${item.category}</span>
                    </a>
                `).join('');
            } else {
                searchSuggestions.innerHTML = '<div class="search-no-results">未找到相关结果</div>';
            }
        }, 200));

        // 搜索表单提交
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query) {
                // 实际项目中这里应该跳转到搜索结果页
                showNotification('搜索功能演示：搜索 "' + query + '"', 'info');
                closeSearch();
            }
        });
    }

    /**
     * 高亮匹配文本
     */
    function highlightMatch(text, query) {
        const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    /**
     * 转义正则特殊字符
     */
    function escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    /**
     * 移动端菜单
     */
    function initMobileMenu() {
        const menuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.querySelector('.nav-menu');
        
        if (!menuBtn || !navMenu) return;

        menuBtn.addEventListener('click', () => {
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', !isExpanded);
            menuBtn.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            // 防止背景滚动
            document.body.style.overflow = isExpanded ? '' : 'hidden';
        });

        // 点击导航链接后关闭菜单
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuBtn.setAttribute('aria-expanded', 'false');
                menuBtn.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }

    /**
     * 平滑滚动
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    const navbar = document.getElementById('navbar');
                    const navbarHeight = navbar ? navbar.offsetHeight : 72;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * 滚动动画
     */
    function initScrollAnimations() {
        const animatedElements = document.querySelectorAll(
            '.service-card, .case-card, .advantage-card, .testimonial-card, .news-card, .faq-category, .detail-card'
        );
        
        if (!animatedElements.length) return;

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 50);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        var windowHeight = window.innerHeight || document.documentElement.clientHeight;

        animatedElements.forEach(function(el) {
            var rect = el.getBoundingClientRect();
            // If element is already in viewport, show immediately without animation
            if (rect.top < windowHeight - 50) {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            } else {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(el);
            }
        });
    }

    /**
     * 联系表单处理
     */
    function initContactForm() {
        const form = document.getElementById('contactForm');
        if (!form) return;

        const inputs = {
            name: document.getElementById('name'),
            phone: document.getElementById('phone'),
            email: document.getElementById('email'),
            privacy: document.getElementById('privacy')
        };

        const errors = {
            name: document.getElementById('nameError'),
            phone: document.getElementById('phoneError'),
            email: document.getElementById('emailError'),
            privacy: document.getElementById('privacyError')
        };

        const submitBtn = document.getElementById('submitBtn');

        // 实时验证
        inputs.name.addEventListener('blur', () => validateName());
        inputs.phone.addEventListener('blur', () => validatePhone());
        inputs.email.addEventListener('blur', () => validateEmail());

        // 手机号格式化
        inputs.phone.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) {
                value = value.slice(0, 11);
            }
            e.target.value = value;
        });

        // 表单提交
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // 验证所有字段
            const isNameValid = validateName();
            const isPhoneValid = validatePhone();
            const isEmailValid = validateEmail();
            const isPrivacyValid = validatePrivacy();

            if (isNameValid && isPhoneValid && isEmailValid && isPrivacyValid) {
                submitForm();
            } else {
                // 滚动到第一个错误字段
                const firstError = form.querySelector('.form-error:not(:empty)');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        function validateName() {
            const value = inputs.name.value.trim();
            if (!value) {
                showError('name', '请输入您的姓名');
                return false;
            }
            if (value.length < 2) {
                showError('name', '姓名至少需要2个字符');
                return false;
            }
            clearError('name');
            return true;
        }

        function validatePhone() {
            const value = inputs.phone.value.trim();
            const phoneRegex = /^1[3-9]\d{9}$/;
            
            if (!value) {
                showError('phone', '请输入联系电话');
                return false;
            }
            if (!phoneRegex.test(value)) {
                showError('phone', '请输入有效的手机号码');
                return false;
            }
            clearError('phone');
            return true;
        }

        function validateEmail() {
            const value = inputs.email.value.trim();
            if (!value) return true; // 邮箱为选填
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                showError('email', '请输入有效的电子邮箱');
                return false;
            }
            clearError('email');
            return true;
        }

        function validatePrivacy() {
            if (!inputs.privacy.checked) {
                showError('privacy', '请阅读并同意隐私政策和合规声明');
                return false;
            }
            clearError('privacy');
            return true;
        }

        function showError(field, message) {
            if (errors[field]) {
                errors[field].textContent = message;
                inputs[field].classList.add('error');
            }
        }

        function clearError(field) {
            if (errors[field]) {
                errors[field].textContent = '';
                inputs[field].classList.remove('error');
            }
        }

        function submitForm() {
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            // 显示加载状态
            submitBtn.disabled = true;
            btnText.hidden = true;
            btnLoading.hidden = false;

            // 收集表单数据
            const formData = {
                name: inputs.name.value.trim(),
                phone: inputs.phone.value.trim(),
                email: inputs.email.value.trim(),
                content: document.getElementById('message') ? document.getElementById('message').value.trim() : '',
                source: 'contact'
            };

            // 提交到API
            fetch('admin/api/message/submit.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('提交成功！我们会尽快与您联系。', 'success');
                    form.reset();
                } else {
                    showNotification(data.message || '提交失败，请稍后重试', 'error');
                }
            })
            .catch(error => {
                console.error('提交失败:', error);
                showNotification('提交失败，请检查网络连接后重试', 'error');
            })
            .finally(() => {
                // 恢复按钮状态
                submitBtn.disabled = false;
                btnText.hidden = false;
                btnLoading.hidden = true;
            });
        }
    }

    /**
     * 客服组件 - 电话按钮交互
     * 点击显示手机号，点击空白区域关闭
     */
    function initChatWidget() {
        const chatWidget = document.getElementById('chatWidget');
        const chatBtn = document.getElementById('chatWidgetBtn');
        
        if (!chatBtn || !chatWidget) return;

        // 创建电话显示元素
        let phoneDisplay = chatWidget.querySelector('.chat-widget-phone-display');
        if (!phoneDisplay) {
            phoneDisplay = document.createElement('div');
            phoneDisplay.className = 'chat-widget-phone-display';
            phoneDisplay.innerHTML = `
                <span class="chat-widget-phone-text">13552883008</span>
            `;
            chatWidget.appendChild(phoneDisplay);
        }

        // 状态标记
        let isPhoneVisible = false;

        // 切换电话显示
        chatBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            
            if (!isPhoneVisible) {
                // 显示电话
                phoneDisplay.classList.add('active');
                chatBtn.setAttribute('aria-expanded', 'true');
                isPhoneVisible = true;
            } else {
                // 隐藏电话
                hidePhoneDisplay();
            }
        });

        // 隐藏电话显示的函数
        function hidePhoneDisplay() {
            phoneDisplay.classList.remove('active');
            chatBtn.setAttribute('aria-expanded', 'false');
            isPhoneVisible = false;
        }

        // 点击页面其他地方关闭
        document.addEventListener('click', (e) => {
            if (isPhoneVisible && !chatWidget.contains(e.target)) {
                hidePhoneDisplay();
            }
        });

        // ESC键关闭
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isPhoneVisible) {
                hidePhoneDisplay();
            }
        });
    }

    /**
     * 头部滚动效果
     */
    function initHeaderScroll() {
        const navbar = document.getElementById('navbar');
        if (!navbar) return;

        let lastScroll = 0;
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const currentScroll = window.pageYOffset;
                    
                    if (currentScroll > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                    
                    lastScroll = currentScroll;
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    /**
     * 统计数据动画
     */
    function initStatsAnimation() {
        const statNumbers = document.querySelectorAll('.stat-number[data-target]');
        if (!statNumbers.length) return;

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.dataset.target);
                    animateNumber(entry.target, target);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        statNumbers.forEach(stat => observer.observe(stat));
    }

    /**
     * 数字动画
     */
    function animateNumber(element, target) {
        const duration = 2000;
        const start = 0;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Ease out quart
            const easeOut = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(start + (target - start) * easeOut);
            
            // 根据目标值决定显示格式
            let suffix = '';
            if (element.parentElement.querySelector('.stat-label').textContent.includes('%')) {
                suffix = '%';
            } else if (element.parentElement.querySelector('.stat-label').textContent.includes('亿')) {
                suffix = '亿+';
            } else {
                suffix = '+';
            }
            
            element.textContent = current + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }

    /**
     * FAQ手风琴效果
     */
    function initFaqAccordion() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const summary = item.querySelector('summary');
            
            summary.addEventListener('click', () => {
                // 关闭其他已打开的项
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.open) {
                        otherItem.open = false;
                    }
                });
            });
        });
    }

    /**
     * 显示通知
     */
    function showNotification(message, type = 'info') {
        // 移除现有通知
        const existing = document.querySelector('.notification');
        if (existing) {
            existing.remove();
        }

        // 创建通知元素
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.setAttribute('role', 'alert');
        
        const iconMap = {
            success: 'check-circle',
            error: 'exclamation-circle',
            info: 'info-circle'
        };
        
        notification.innerHTML = `
            <i class="fas fa-${iconMap[type] || 'info-circle'}" aria-hidden="true"></i>
            <span class="notification-message">${message}</span>
            <button class="notification-close" aria-label="关闭通知">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        `;

        // 添加样式
        const colors = {
            success: '#10b981',
            error: '#ef4444',
            info: '#3b82f6'
        };

        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 24px;
            background: white;
            color: ${colors[type] || colors.info};
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
            max-width: 400px;
            border-left: 4px solid ${colors[type] || colors.info};
        `;

        // 添加动画样式
        if (!document.getElementById('notification-styles')) {
            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                @keyframes slideIn {
                    from { opacity: 0; transform: translateX(100%); }
                    to { opacity: 1; transform: translateX(0); }
                }
                @keyframes slideOut {
                    from { opacity: 1; transform: translateX(0); }
                    to { opacity: 0; transform: translateX(100%); }
                }
                .notification-close {
                    background: none;
                    border: none;
                    color: inherit;
                    opacity: 0.6;
                    cursor: pointer;
                    padding: 4px;
                    margin-left: auto;
                    transition: opacity 0.2s;
                }
                .notification-close:hover { opacity: 1; }
                .notification-message { color: #1f2937; font-size: 14px; }
            `;
            document.head.appendChild(style);
        }

        document.body.appendChild(notification);

        // 关闭按钮
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.style.animation = 'slideOut 0.3s ease-out forwards';
            setTimeout(() => notification.remove(), 300);
        });

        // 自动移除
        setTimeout(() => {
            if (notification.parentNode) {
                notification.style.animation = 'slideOut 0.3s ease-out forwards';
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }

    /**
     * 防抖函数
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * 切换联系方式显示/隐藏
     * 点击CTA按钮时显示联系方式（带淡入动画）
     */
    window.toggleContactInfo = function() {
        const contactInfo = document.getElementById('contact-info-text');
        const contactBtn = document.getElementById('contactBtn');
        
        if (contactInfo) {
            if (contactInfo.style.display === 'none' || contactInfo.style.display === '') {
                contactInfo.style.display = 'inline-block';
                contactInfo.classList.add('fade-in');
                if (contactBtn) {
                    contactBtn.innerHTML = '立即联系我们 <i class="fas fa-arrow-down"></i>';
                }
            } else {
                contactInfo.classList.remove('fade-in');
                contactInfo.classList.add('fade-out');
                setTimeout(() => {
                    contactInfo.style.display = 'none';
                    contactInfo.classList.remove('fade-out');
                }, 300);
                if (contactBtn) {
                    contactBtn.innerHTML = '立即联系我们 <i class="fas fa-arrow-right"></i>';
                }
            }
        }
    };

    /**
     * 显示联系方式（兼容旧版本）
     * 点击CTA按钮时显示联系方式
     */
    window.showContactInfo = function() {
        toggleContactInfo();
    };

    // 暴露全局函数
    window.showNotification = showNotification;

})();
