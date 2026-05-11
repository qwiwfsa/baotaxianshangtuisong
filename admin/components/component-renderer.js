/**
 * CMS组件渲染器
 * 负责将组件数据渲染为HTML
 */

const ComponentRenderer = {
    /**
     * 渲染单个组件
     */
    render(component) {
        const { type, category, data } = component;
        
        if (!category || !type) {
            console.warn('Component missing category or type:', component);
            return `<div class="component-error">组件配置错误</div>`;
        }
        
        const categoryConfig = ComponentConfig[category];
        if (!categoryConfig) {
            console.warn(`Unknown component category: ${category}`);
            return `<div class="component-error">未知组件分类: ${category}</div>`;
        }
        
        const config = categoryConfig.components[type];
        if (!config) {
            console.warn(`Unknown component type: ${category}.${type}`);
            return `<div class="component-error">未知组件: ${category}.${type}</div>`;
        }
        
        // 确保数据存在
        const safeData = data || {};
        
        // 填充默认值
        config.fields.forEach(field => {
            if (safeData[field.name] === undefined) {
                safeData[field.name] = Array.isArray(field.default) 
                    ? JSON.parse(JSON.stringify(field.default)) 
                    : field.default;
            }
        });
        
        const renderMethod = this[`render${this.capitalize(category)}${this.capitalize(type)}`];
        
        if (typeof renderMethod === 'function') {
            try {
                return renderMethod.call(this, safeData, component.id);
            } catch (error) {
                console.error(`Error rendering component ${category}.${type}:`, error);
                return `<div class="component-error">渲染错误: ${category}.${type}</div>`;
            }
        }
        
        // 使用通用渲染方法
        return this.renderGeneric(component);
    },
    
    /**
     * 渲染组件列表
     */
    renderList(components) {
        if (!Array.isArray(components)) {
            console.warn('renderList expects an array, got:', typeof components);
            return '';
        }
        
        return components.map(comp => this.render(comp)).join('\n');
    },
    
    /**
     * 通用渲染方法
     */
    renderGeneric(component) {
        const { type, category, data, id } = component;
        return `<div class="component-${category}-${type}" data-component-id="${id}">
            ${JSON.stringify(data)}
        </div>`;
    },
    
    /**
     * ========== 基础组件渲染 ==========
     */
    
    // 文本组件
    renderBasicText(data, id) {
        const style = `text-align: ${data.align || 'left'}; color: ${data.color || '#333333'}; font-size: ${data.fontSize || '16px'};`;
        const content = data.content || '请输入文本内容';
        return `<div class="component-text" data-component-id="${id}" style="${style}">
            ${content}
        </div>`;
    },
    
    // 图片组件
    renderBasicImage(data, id) {
        const alignStyle = `text-align: ${data.align || 'center'};`;
        const imgStyle = `width: ${data.width || '100%'}; height: ${data.height || 'auto'};`;
        
        if (!data.src) {
            return `<div class="component-image" data-component-id="${id}" style="${alignStyle}; padding: 20px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px;">
                <p style="color: #6b7280; text-align: center;"><i class="fas fa-image" style="font-size: 24px; display: block; margin-bottom: 8px;"></i>请设置图片</p>
            </div>`;
        }
        
        const img = `<img src="${data.src}" alt="${data.alt || ''}" style="${imgStyle}" class="component-image-img">`;
        
        return `<div class="component-image" data-component-id="${id}" style="${alignStyle}">
            ${data.link ? `<a href="${data.link}">${img}</a>` : img}
        </div>`;
    },
    
    // 按钮组件
    renderBasicButton(data, id) {
        const typeClass = `btn-${data.type || 'primary'}`;
        const sizeClass = `btn-${data.size || 'medium'}`;
        const target = data.newWindow ? 'target="_blank"' : '';
        const text = data.text || '点击按钮';
        const link = data.link || '#';
        
        return `<div class="component-button" data-component-id="${id}" style="text-align: ${data.align || 'center'};">
            <a href="${link}" class="btn ${typeClass} ${sizeClass}" ${target}>${text}</a>
        </div>`;
    },
    
    // 图文展示组件
    renderBasicImageText(data, id) {
        const layoutClass = `layout-${data.layout || 'image-left'}`;
        const imageWidth = data.imageWidth || '40%';
        const title = data.title || '标题';
        const content = data.content || '请输入内容';
        
        return `<div class="component-image-text ${layoutClass}" data-component-id="${id}">
            <div class="image-text-image" style="width: ${imageWidth};">
                ${data.image ? `<img src="${data.image}" alt="${title}">` : '<div style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center; color: #6b7280;"><i class="fas fa-image" style="font-size: 32px;"></i></div>'}
            </div>
            <div class="image-text-content">
                <h3 class="image-text-title">${title}</h3>
                <div class="image-text-body">${content}</div>
            </div>
        </div>`;
    },
    
    // 列表多图组件
    renderBasicImageList(data, id) {
        const columns = data.columns || '3';
        const gap = data.gap || '16px';
        const gridStyle = `grid-template-columns: repeat(${columns}, 1fr); gap: ${gap};`;
        const images = data.images || [];
        
        if (images.length === 0) {
            return `<div class="component-image-list" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-images" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加图片</p>
            </div>`;
        }
        
        return `<div class="component-image-list" data-component-id="${id}">
            <div class="image-grid" style="${gridStyle}">
                ${images.map(img => `
                    <div class="image-item">
                        ${img.src ? `<img src="${img.src}" alt="${img.title || ''}">` : '<div style="padding: 20px; background: #e5e7eb; text-align: center;"><i class="fas fa-image"></i></div>'}
                        ${data.showCaption && img.title ? `<span class="image-caption">${img.title}</span>` : ''}
                    </div>
                `).join('')}
            </div>
        </div>`;
    },
    
    // 文章列表组件
    renderBasicArticleList(data, id) {
        // 这里需要从API获取文章数据
        return `<div class="component-article-list" data-component-id="${id}" 
            data-category="${data.category}" data-limit="${data.limit}" data-layout="${data.layout}"
            data-show-image="${data.showImage}" data-show-date="${data.showDate}" data-show-summary="${data.showSummary}">
            <div class="article-list-placeholder">文章列表加载中...</div>
        </div>`;
    },
    
    // 轮播多图组件
    renderBasicCarousel(data, id) {
        const images = data.images || [];
        const height = data.height || '400px';
        const autoplayAttr = data.autoplay ? `data-autoplay="true" data-interval="${data.interval || '5'}"` : '';
        
        if (images.length === 0) {
            return `<div class="component-carousel" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-sliders-h" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加轮播图片</p>
            </div>`;
        }
        
        return `<div class="component-carousel" data-component-id="${id}" ${autoplayAttr}>
            <div class="carousel-container" style="height: ${height};">
                ${images.map((img, index) => `
                    <div class="carousel-slide ${index === 0 ? 'active' : ''}">
                        ${img.src ? `<img src="${img.src}" alt="${img.title || ''}">` : '<div style="width: 100%; height: 100%; background: #e5e7eb; display: flex; align-items: center; justify-content: center;"><i class="fas fa-image" style="font-size: 48px; color: #9ca3af;"></i></div>'}
                        ${img.title ? `<div class="carousel-caption">${img.title}</div>` : ''}
                    </div>
                `).join('')}
            </div>
            ${data.showDots && images.length > 1 ? `
                <div class="carousel-dots">
                    ${images.map((_, i) => `<span class="dot ${i === 0 ? 'active' : ''}" data-index="${i}"></span>`).join('')}
                </div>
            ` : ''}
            ${data.showArrows && images.length > 1 ? `
                <button class="carousel-arrow carousel-prev"><i class="fas fa-chevron-left"></i></button>
                <button class="carousel-arrow carousel-next"><i class="fas fa-chevron-right"></i></button>
            ` : ''}
        </div>`;
    },
    
    // 在线视频组件
    renderBasicVideo(data, id) {
        let videoHtml = '';
        const width = data.width || '100%';
        const height = data.height || '400px';
        
        if (data.type === 'embed' && data.embed) {
            videoHtml = data.embed;
        } else if (data.url) {
            const controls = data.controls !== false ? 'controls' : '';
            const autoplay = data.autoplay ? 'autoplay muted' : '';
            videoHtml = `<video ${controls} ${autoplay} style="width: ${width}; height: ${height};">
                <source src="${data.url}" type="video/mp4">
                您的浏览器不支持视频播放。
            </video>`;
        } else {
            return `<div class="component-video" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-video" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请设置视频地址</p>
            </div>`;
        }
        
        return `<div class="component-video" data-component-id="${id}">
            ${videoHtml}
        </div>`;
    },
    
    /**
     * ========== 排版组件渲染 ==========
     */
    
    // 自由容器
    renderLayoutContainer(data, id) {
        const bgColor = data.bgColor || '#ffffff';
        const bgStyle = data.bgImage ? `background-image: url('${data.bgImage}'); background-size: cover;` : `background-color: ${bgColor};`;
        const width = data.width || '100%';
        const padding = data.padding || '24px';
        const borderRadius = data.borderRadius || '0';
        const style = `width: ${width}; padding: ${padding}; border-radius: ${borderRadius}; ${bgStyle}`;
        
        return `<div class="component-container" data-component-id="${id}" style="${style}">
            <div class="container-children" data-children="true">${data.childrenContent || ''}</div>
        </div>`;
    },
    
    // 悬浮容器
    renderLayoutFloating(data, id) {
        const offsetX = data.offsetX || '20px';
        const offsetY = data.offsetY || '20px';
        const positions = {
            'top-left': { top: offsetY, left: offsetX },
            'top-right': { top: offsetY, right: offsetX },
            'bottom-left': { bottom: offsetY, left: offsetX },
            'bottom-right': { bottom: offsetY, right: offsetX }
        };
        
        const pos = positions[data.position || 'bottom-right'];
        const posStyle = Object.entries(pos).map(([k, v]) => `${k}: ${v};`).join(' ');
        const shadowStyle = data.shadow !== false ? 'box-shadow: 0 4px 20px rgba(0,0,0,0.15);' : '';
        const width = data.width || '300px';
        const bgColor = data.bgColor || '#ffffff';
        const style = `position: fixed; ${posStyle} width: ${width}; background: ${bgColor}; ${shadowStyle} z-index: 999; border-radius: 8px; padding: 16px;`;
        
        return `<div class="component-floating" data-component-id="${id}" style="${style}">
            <div class="floating-children" data-children="true">${data.childrenContent || ''}</div>
        </div>`;
    },
    
    // 横向标签
    renderLayoutTabs(data, id) {
        const tabs = data.tabs || [];
        const activeColor = data.activeColor || '#3b82f6';
        
        if (tabs.length === 0) {
            return `<div class="component-tabs" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-folder" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加标签页</p>
            </div>`;
        }
        
        return `<div class="component-tabs" data-component-id="${id}">
            <div class="tabs-header" style="border-bottom-color: ${activeColor};">
                ${tabs.map((tab, i) => `
                    <button class="tab-btn ${i === 0 ? 'active' : ''}" data-index="${i}" style="--active-color: ${activeColor}">
                        ${tab.title || '标签'}
                    </button>
                `).join('')}
            </div>
            <div class="tabs-content">
                ${tabs.map((tab, i) => `
                    <div class="tab-pane ${i === 0 ? 'active' : ''}" data-index="${i}">
                        ${tab.content || ''}
                    </div>
                `).join('')}
            </div>
        </div>`;
    },
    
    // 纵向标签
    renderLayoutTabsVertical(data, id) {
        const tabs = data.tabs || [];
        const activeColor = data.activeColor || '#3b82f6';
        const tabWidth = data.tabWidth || '150px';
        
        if (tabs.length === 0) {
            return `<div class="component-tabs-vertical" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-columns" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加标签页</p>
            </div>`;
        }
        
        return `<div class="component-tabs-vertical" data-component-id="${id}">
            <div class="tabs-vertical-header" style="width: ${tabWidth};">
                ${tabs.map((tab, i) => `
                    <button class="tab-vertical-btn ${i === 0 ? 'active' : ''}" data-index="${i}" style="--active-color: ${activeColor}">
                        ${tab.title || '标签'}
                    </button>
                `).join('')}
            </div>
            <div class="tabs-vertical-content">
                ${tabs.map((tab, i) => `
                    <div class="tab-vertical-pane ${i === 0 ? 'active' : ''}" data-index="${i}">
                        ${tab.content || ''}
                    </div>
                `).join('')}
            </div>
        </div>`;
    },
    
    // 多列排版
    renderLayoutColumns(data, id) {
        const columns = data.columns || '2';
        const gap = data.gap || '24px';
        const gridStyle = `grid-template-columns: repeat(${columns}, 1fr); gap: ${gap};`;
        const equalHeight = data.equalHeight ? 'align-items: stretch;' : '';
        
        return `<div class="component-columns" data-component-id="${id}" style="${gridStyle} ${equalHeight}">
            ${Array(parseInt(columns)).fill(0).map((_, i) => `
                <div class="column-item" data-column="${i}">
                    <div class="column-children" data-children="true">${data[`column${i}Content`] || ''}</div>
                </div>
            `).join('')}
        </div>`;
    },
    
    // 图片标签
    renderLayoutImageTabs(data, id) {
        const tabs = data.tabs || [];
        const layoutClass = data.imagePosition === 'left' ? 'layout-left' : 'layout-top';
        
        if (tabs.length === 0) {
            return `<div class="component-image-tabs" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-images" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加图片标签</p>
            </div>`;
        }
        
        return `<div class="component-image-tabs ${layoutClass}" data-component-id="${id}">
            <div class="image-tabs-nav">
                ${tabs.map((tab, i) => `
                    <div class="image-tab-item ${i === 0 ? 'active' : ''}" data-index="${i}">
                        ${tab.image ? `<img src="${tab.image}" alt="${tab.title || ''}">` : '<div style="width: 60px; height: 60px; background: #e5e7eb; display: flex; align-items: center; justify-content: center;"><i class="fas fa-image"></i></div>'}
                        <span>${tab.title || '标签'}</span>
                    </div>
                `).join('')}
            </div>
            <div class="image-tabs-content">
                ${tabs.map((tab, i) => `
                    <div class="image-tab-pane ${i === 0 ? 'active' : ''}" data-index="${i}">
                        ${tab.content || ''}
                    </div>
                `).join('')}
            </div>
        </div>`;
    },
    
    // 折叠标签
    renderLayoutCollapse(data, id) {
        const items = data.items || [];
        const borderClass = data.bordered ? 'bordered' : '';
        const accordion = data.accordion || false;
        
        if (items.length === 0) {
            return `<div class="component-collapse" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-compress" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加折叠项</p>
            </div>`;
        }
        
        return `<div class="component-collapse ${borderClass}" data-component-id="${id}" data-accordion="${accordion}">
            ${items.map((item, i) => `
                <div class="collapse-item ${i === 0 && !accordion ? 'expanded' : ''}">
                    <div class="collapse-header" data-index="${i}">
                        <span>${item.title || '标题'}</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="collapse-content" style="${i === 0 && !accordion ? '' : 'display: none;'}">
                        ${item.content || ''}
                    </div>
                </div>
            `).join('')}
        </div>`;
    },
    
    // 手风琴
    renderLayoutAccordion(data, id) {
        const items = data.items || [];
        const expandFirst = data.expandFirst !== false;
        const iconPosition = data.iconPosition || 'right';
        
        if (items.length === 0) {
            return `<div class="component-accordion" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-bars" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加面板项</p>
            </div>`;
        }
        
        return `<div class="component-accordion" data-component-id="${id}">
            ${items.map((item, i) => `
                <div class="accordion-item ${i === 0 && expandFirst ? 'expanded' : ''}">
                    <div class="accordion-header" data-index="${i}">
                        <span>${item.title || '标题'}</span>
                        <i class="fas fa-chevron-${iconPosition === 'left' ? 'right' : 'down'}"></i>
                    </div>
                    <div class="accordion-content" style="${i === 0 && expandFirst ? '' : 'display: none;'}">
                        ${item.content || ''}
                    </div>
                </div>
            `).join('')}
        </div>`;
    },
    
    // 通栏排版
    renderLayoutFullWidth(data, id) {
        const bgColor = data.bgColor || '#f5f7fa';
        const bgStyle = data.bgImage ? `background-image: url('${data.bgImage}'); background-size: cover; background-position: center;` : `background-color: ${bgColor};`;
        const padding = data.padding || '64px';
        const contentWidth = data.contentWidth || '1200px';
        
        return `<div class="component-fullwidth" data-component-id="${id}" style="${bgStyle} padding: ${padding} 0;">
            <div class="fullwidth-inner" style="max-width: ${contentWidth}; margin: 0 auto; padding: 0 24px;">
                <div class="fullwidth-children" data-children="true">${data.childrenContent || ''}</div>
            </div>
        </div>`;
    },
    
    /**
     * ========== 互动组件渲染 ==========
     */
    
    // 在线客服
    renderInteractiveChat(data, id) {
        const position = data.position === 'left' ? 'left: 20px;' : 'right: 20px;';
        const type = data.type || 'phone';
        const text = data.text || '在线咨询';
        
        let contactHtml = '';
        if (type === 'phone' && data.phone) {
            contactHtml = `<a href="tel:${data.phone}" class="chat-btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #3b82f6; color: white; border-radius: 24px; text-decoration: none; box-shadow: 0 4px 12px rgba(59,130,246,0.3);"><i class="fas fa-phone"></i> ${text}</a>`;
        } else if (type === 'wechat') {
            contactHtml = `<div class="chat-wechat" style="background: white; padding: 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                ${data.qrCode ? `<img src="${data.qrCode}" alt="微信二维码" style="width: 120px; height: 120px; display: block; margin: 0 auto 8px;">` : '<div style="width: 120px; height: 120px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px;"><i class="fas fa-qrcode"></i></div>'}
                ${data.wechat ? `<p style="text-align: center; margin: 0; font-size: 12px;">微信号: ${data.wechat}</p>` : ''}
            </div>`;
        } else if (type === 'qq' && data.qq) {
            contactHtml = `<a href="http://wpa.qq.com/msgrd?v=3&uin=${data.qq}&site=qq&menu=yes" class="chat-btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #12b7f5; color: white; border-radius: 24px; text-decoration: none; box-shadow: 0 4px 12px rgba(18,183,245,0.3);"><i class="fab fa-qq"></i> ${text}</a>`;
        } else {
            contactHtml = `<div style="padding: 12px 20px; background: #f3f4f6; border-radius: 24px; color: #6b7280;"><i class="fas fa-comments"></i> ${text}</div>`;
        }
        
        return `<div class="component-chat" data-component-id="${id}" style="position: fixed; bottom: 20px; ${position}; z-index: 999;">
            ${contactHtml}
        </div>`;
    },
    
    // 在线表单
    renderInteractiveForm(data, id) {
        const fields = data.fields || [];
        
        return `<div class="component-form" data-component-id="${id}">
            <h3 class="form-title">${data.title || '在线留言'}</h3>
            <form class="custom-form" onsubmit="return ComponentEvents.handleFormSubmit(event, '${id}')">
                ${fields.map(field => this.renderFormField(field)).join('')}
                <button type="submit" class="btn btn-primary">${data.submitText || '提交'}</button>
            </form>
        </div>`;
    },
    
    // 留言提交
    renderInteractiveMessage(data, id) {
        const fields = data.fields || ['name', 'phone', 'content'];
        
        return `<div class="component-message" data-component-id="${id}">
            <h3 class="message-title">${data.title || '留言咨询'}</h3>
            <p class="message-subtitle">${data.subtitle || '请填写以下信息，我们会尽快回复您'}</p>
            <form class="message-form" onsubmit="return ComponentEvents.handleMessageSubmit(event, '${id}')">
                ${fields.includes('name') ? '<div class="form-group"><label>姓名</label><input type="text" name="name" required></div>' : ''}
                ${fields.includes('phone') ? '<div class="form-group"><label>电话</label><input type="tel" name="phone" required></div>' : ''}
                ${fields.includes('email') ? '<div class="form-group"><label>邮箱</label><input type="email" name="email"></div>' : ''}
                ${fields.includes('company') ? '<div class="form-group"><label>公司</label><input type="text" name="company"></div>' : ''}
                ${fields.includes('content') ? '<div class="form-group"><label>留言内容</label><textarea name="content" rows="4"></textarea></div>' : ''}
                <button type="submit" class="btn btn-primary">${data.submitText || '提交留言'}</button>
            </form>
        </div>`;
    },
    
    // 二维码
    renderInteractiveQrcode(data, id) {
        const align = data.align || 'center';
        const title = data.title || '扫码关注';
        const size = data.size || '150px';
        
        return `<div class="component-qrcode" data-component-id="${id}" style="text-align: ${align};">
            <h4 class="qrcode-title">${title}</h4>
            ${data.image ? `<img src="${data.image}" alt="二维码" style="width: ${size}; height: ${size};">` : '<div style="width: ' + size + '; height: ' + size + '; background: #f3f4f6; display: inline-flex; align-items: center; justify-content: center; border: 2px dashed #d1d5db; border-radius: 8px;"><i class="fas fa-qrcode" style="font-size: 48px; color: #9ca3af;"></i></div>'}
            ${data.description ? `<p class="qrcode-desc">${data.description}</p>` : ''}
        </div>`;
    },
    
    // 全站搜索
    renderInteractiveSearch(data, id) {
        const styleClass = `search-${data.style || 'default'}`;
        const width = data.width || '100%';
        const placeholder = data.placeholder || '请输入搜索关键词';
        const buttonText = data.buttonText || '搜索';
        
        return `<div class="component-search ${styleClass}" data-component-id="${id}" style="width: ${width};">
            <form class="search-form" onsubmit="return ComponentEvents.handleSearch(event, '${id}')" style="display: flex;">
                <input type="text" class="search-input" placeholder="${placeholder}" style="flex: 1; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 6px 0 0 6px; border-right: none;">
                <button type="submit" class="search-btn" style="padding: 12px 24px; background: #3b82f6; color: white; border: none; border-radius: 0 6px 6px 0; cursor: pointer;">${buttonText}</button>
            </form>
        </div>`;
    },
    
    // 分享网站
    renderInteractiveShare(data, id) {
        const platforms = data.platforms || [];
        const align = data.align || 'center';
        const showText = data.showText !== false;
        
        return `<div class="component-share" data-component-id="${id}" style="text-align: ${align};">
            ${showText ? '<span class="share-text" style="margin-right: 12px;">分享到：</span>' : ''}
            <div class="share-buttons" style="display: inline-flex; gap: 8px;">
                ${platforms.includes('wechat') ? `<button class="share-btn wechat" onclick="ComponentEvents.shareTo('wechat')" title="微信" style="width: 40px; height: 40px; border-radius: 50%; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; color: white; background: #07c160;"><i class="fab fa-weixin"></i></button>` : ''}
                ${platforms.includes('weibo') ? `<button class="share-btn weibo" onclick="ComponentEvents.shareTo('weibo')" title="微博" style="width: 40px; height: 40px; border-radius: 50%; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; color: white; background: #e6162d;"><i class="fab fa-weibo"></i></button>` : ''}
                ${platforms.includes('qq') ? `<button class="share-btn qq" onclick="ComponentEvents.shareTo('qq')" title="QQ" style="width: 40px; height: 40px; border-radius: 50%; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; color: white; background: #12b7f5;"><i class="fab fa-qq"></i></button>` : ''}
                ${platforms.includes('qzone') ? `<button class="share-btn qzone" onclick="ComponentEvents.shareTo('qzone')" title="QQ空间" style="width: 40px; height: 40px; border-radius: 50%; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; color: white; background: #ffc028;"><i class="fas fa-star"></i></button>` : ''}
                ${platforms.includes('link') ? `<button class="share-btn link" onclick="ComponentEvents.copyLink()" title="复制链接" style="width: 40px; height: 40px; border-radius: 50%; border: none; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; color: white; background: #6b7280;"><i class="fas fa-link"></i></button>` : ''}
            </div>
        </div>`;
    },
    
    // 会员登录
    renderInteractiveLogin(data, id) {
        const title = data.title || '会员登录';
        
        return `<div class="component-login" data-component-id="${id}" style="max-width: 400px; margin: 0 auto; padding: 24px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 class="login-title" style="text-align: center; margin-bottom: 20px;">${title}</h3>
            <form class="login-form" onsubmit="return ComponentEvents.handleLogin(event, '${id}')">
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 500;">用户名/邮箱</label>
                    <input type="text" name="username" required style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 6px; font-weight: 500;">密码</label>
                    <input type="password" name="password" required style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="width: 100%; padding: 12px; background: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer;">登录</button>
                <div class="login-links" style="display: flex; justify-content: space-between; margin-top: 16px; font-size: 14px;">
                    ${data.showRegister ? '<a href="/register.html" style="color: #3b82f6; text-decoration: none;">注册账号</a>' : '<span></span>'}
                    ${data.showForgot ? '<a href="/forgot.html" style="color: #3b82f6; text-decoration: none;">忘记密码</a>' : '<span></span>'}
                </div>
            </form>
        </div>`;
    },
    
    // 在线投票
    renderInteractiveVote(data, id) {
        const options = data.options || [];
        const inputType = data.multiple ? 'checkbox' : 'radio';
        const title = data.title || '您对我们的服务满意吗？';
        const showResult = data.showResult !== false;
        
        if (options.length === 0) {
            return `<div class="component-vote" data-component-id="${id}" style="padding: 40px; background: #f3f4f6; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center;">
                <p style="color: #6b7280;"><i class="fas fa-poll" style="font-size: 32px; display: block; margin-bottom: 12px;"></i>请添加投票选项</p>
            </div>`;
        }
        
        return `<div class="component-vote" data-component-id="${id}" data-multiple="${data.multiple}" style="max-width: 500px; margin: 0 auto; padding: 24px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h3 class="vote-title" style="margin-bottom: 20px;">${title}</h3>
            <form class="vote-form" onsubmit="return ComponentEvents.handleVote(event, '${id}')">
                ${options.map((opt, i) => `
                    <label class="vote-option" style="display: flex; align-items: center; gap: 12px; padding: 12px; margin-bottom: 8px; background: #f9fafb; border-radius: 6px; cursor: pointer;">
                        <input type="${inputType}" name="vote" value="${i}" style="width: 18px; height: 18px;">
                        <span class="vote-text" style="flex: 1;">${opt.text || '选项'}</span>
                        <span class="vote-bar" style="display: none; flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden;"><span class="vote-fill" style="display: block; height: 100%; background: #3b82f6; width: 0%;"></span></span>
                        <span class="vote-percent" style="display: none; font-size: 14px; color: #6b7280;">0%</span>
                    </label>
                `).join('')}
                <div style="display: flex; gap: 12px; margin-top: 20px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1; padding: 12px; background: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer;">投票</button>
                    ${showResult ? '<button type="button" class="btn btn-secondary" onclick="ComponentEvents.showVoteResult(\'' + id + '\')" style="padding: 12px 20px; background: #f3f4f6; color: #374151; border: none; border-radius: 6px; cursor: pointer;">查看结果</button>' : ''}
                </div>
            </form>
        </div>`;
    },
    
    /**
     * 辅助方法
     */
    renderFormField(field) {
        if (!field) return '';
        
        const required = field.required ? 'required' : '';
        const name = field.name || '';
        const label = field.label || '';
        
        switch(field.type) {
            case 'textarea':
                return `<div class="form-group" style="margin-bottom: 16px;"><label style="display: block; margin-bottom: 6px; font-weight: 500;">${label}</label><textarea name="${name}" ${required} rows="4" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px; resize: vertical;"></textarea></div>`;
            case 'select':
                const options = field.options || [];
                return `<div class="form-group" style="margin-bottom: 16px;"><label style="display: block; margin-bottom: 6px; font-weight: 500;">${label}</label><select name="${name}" ${required} style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px; background: white;">${options.map(o => `<option value="${o.value || o}">${o.label || o}</option>`).join('')}</select></div>`;
            default:
                return `<div class="form-group" style="margin-bottom: 16px;"><label style="display: block; margin-bottom: 6px; font-weight: 500;">${label}</label><input type="${field.type || 'text'}" name="${name}" ${required} style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px;"></div>`;
        }
    },
    
    capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
};

// 组件事件处理
const ComponentEvents = {
    handleFormSubmit(event, componentId) {
        event.preventDefault();
        // 提交表单逻辑
        alert('表单提交成功！');
        return false;
    },
    
    handleMessageSubmit(event, componentId) {
        event.preventDefault();
        alert('留言提交成功！');
        return false;
    },
    
    handleSearch(event, componentId) {
        event.preventDefault();
        const keyword = event.target.querySelector('.search-input').value;
        window.location.href = `/search.html?q=${encodeURIComponent(keyword)}`;
        return false;
    },
    
    handleLogin(event, componentId) {
        event.preventDefault();
        alert('登录功能需要后端支持');
        return false;
    },
    
    handleVote(event, componentId) {
        event.preventDefault();
        alert('投票成功！');
        return false;
    },
    
    showVoteResult(componentId) {
        alert('投票结果功能需要后端支持');
    },
    
    shareTo(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        
        const shareUrls = {
            wechat: () => alert('请使用微信扫一扫分享'),
            weibo: `https://service.weibo.com/share/share.php?url=${url}&title=${title}`,
            qq: `https://connect.qq.com/widget/shareqq/index.html?url=${url}&title=${title}`,
            qzone: `https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=${url}&title=${title}`
        };
        
        if (typeof shareUrls[platform] === 'function') {
            shareUrls[platform]();
        } else {
            window.open(shareUrls[platform], '_blank', 'width=600,height=400');
        }
    },
    
    copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('链接已复制到剪贴板');
        });
    }
};

// 导出
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ComponentRenderer, ComponentEvents };
}
