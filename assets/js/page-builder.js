// 页面构建器前端交互脚本

document.addEventListener('DOMContentLoaded', function() {
    // 初始化Banner轮播
    initBannerSliders();
});

/**
 * 初始化Banner轮播
 */
function initBannerSliders() {
    const sliders = document.querySelectorAll('.banner-slider');

    sliders.forEach(slider => {
        const slides = slider.querySelectorAll('.banner-slide');
        const autoplay = slider.dataset.autoplay === 'true';

        if (slides.length <= 1) return;

        let currentSlide = 0;

        // 创建导航点
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'banner-dots';

        slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.className = 'banner-dot';
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        slider.appendChild(dotsContainer);

        // 创建左右箭头
        const prevBtn = document.createElement('button');
        prevBtn.className = 'banner-nav banner-prev';
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.addEventListener('click', prevSlide);

        const nextBtn = document.createElement('button');
        nextBtn.className = 'banner-nav banner-next';
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.addEventListener('click', nextSlide);

        slider.appendChild(prevBtn);
        slider.appendChild(nextBtn);

        // 隐藏除第一张外的所有幻灯片
        slides.forEach((slide, index) => {
            if (index !== 0) {
                slide.style.display = 'none';
            }
        });

        function goToSlide(index) {
            slides[currentSlide].style.display = 'none';
            dotsContainer.children[currentSlide].classList.remove('active');

            currentSlide = index;

            slides[currentSlide].style.display = 'block';
            dotsContainer.children[currentSlide].classList.add('active');
        }

        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }

        function prevSlide() {
            goToSlide((currentSlide - 1 + slides.length) % slides.length);
        }

        // 自动播放
        if (autoplay) {
            setInterval(nextSlide, 5000);
        }
    });
}

/**
 * 平滑滚动到锚点
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

/**
 * 图片懒加载
 */
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}
