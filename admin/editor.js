/**
 * CMS可视化编辑器核心
 * Yao资金网网站内容管理系统
 */

class CMSEditor {
    constructor() {
        this.isEditing = false;
        this.currentElement = null;
        this.editToolbar = null;
        this.propertyPanel = null;
        this.changes = [];
        this.savedContent = {};
        this.currentPage = window.location.pathname.split('/').pop() || 'index.html';
        
        this.init();
    }

    init() {
        console.log('[CMS Editor] 初始化开始...');
        
        // 检查登录状态
        if (!this.checkAuth()) {
            console.log('[CMS Editor] 未登录，停止初始化');
            return;
        }

        // 登录成功，添加登录状态类到body
        document.body.classList.add('cms-logged-in');
        console.log('[CMS Editor] 已添加 cms-logged-in 类');

        // 加载保存的内容
        this.loadSavedContent();
        
        // 创建编辑器UI
        this.createEditorUI();
        console.log('[CMS Editor] UI已创建');
        
        // 绑定事件
        this.bindEvents();
        console.log('[CMS Editor] 事件已绑定');
        
        // 应用保存的内容
        this.applySavedContent();
        
        // 显示初始化成功提示
        this.showNotification('CMS编辑器已激活', 'success');
        console.log('[CMS Editor] 初始化完成');
    }

    checkAuth() {
        const isLoggedIn = localStorage.getItem('cms_logged_in') === 'true';
        if (!isLoggedIn) {
            // 未登录，显示登录提示
            this.showLoginPrompt();
            return false;
        }
        return true;
    }

    showLoginPrompt() {
        const prompt = document.createElement('div');
        prompt.className = 'cms-login-prompt';
        prompt.innerHTML = `
            <div class="cms-prompt-content">
                <i class="fas fa-lock"></i>
                <p>请先登录CMS管理后台</p>
                <a href="admin/login.html" class="cms-prompt-btn">去登录</a>
            </div>
        `;
        document.body.appendChild(prompt);
    }

    createEditorUI() {
        // 创建编辑器工具栏
        this.createToolbar();
        
        // 创建属性面板
        this.createPropertyPanel();
        
        // 创建模块添加面板
        this.createModulePanel();
        
        // 创建浮动编辑按钮
        this.createFloatingTools();
    }

    createToolbar() {
        const toolbar = document.createElement('div');
        toolbar.className = 'cms-toolbar';
        toolbar.id = 'cmsToolbar';
        toolbar.innerHTML = `
            <div class="cms-toolbar-left">
                <div class="cms-logo">
                    <i class="fas fa-edit"></i>
                    <span>CMS编辑器</span>
                </div>
                <div class="cms-divider"></div>
                <div class="cms-page-info">
                    <i class="fas fa-file"></i>
                    <span id="currentPageName">${this.currentPage}</span>
                </div>
            </div>
            <div class="cms-toolbar-center">
                <button class="cms-btn cms-btn-secondary" id="cmsPreviewBtn">
                    <i class="fas fa-eye"></i>
                    <span>预览</span>
                </button>
                <button class="cms-btn cms-btn-primary" id="cmsSaveBtn">
                    <i class="fas fa-save"></i>
                    <span>保存</span>
                </button>
                <button class="cms-btn cms-btn-secondary" id="cmsExportBtn">
                    <i class="fas fa-download"></i>
                    <span>导出</span>
                </button>
            </div>
            <div class="cms-toolbar-right">
                <button class="cms-btn cms-btn-text" id="cmsModuleBtn">
                    <i class="fas fa-plus-circle"></i>
                    <span>添加模块</span>
                </button>
                <div class="cms-divider"></div>
                <div class="cms-user">
                    <i class="fas fa-user-circle"></i>
                    <span>${localStorage.getItem('cms_username') || 'Admin'}</span>
                </div>
                <button class="cms-btn cms-btn-text cms-btn-danger" id="cmsLogoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        `;
        document.body.appendChild(toolbar);
        this.toolbar = toolbar;
    }

    createPropertyPanel() {
        const panel = document.createElement('div');
        panel.className = 'cms-property-panel';
        panel.id = 'cmsPropertyPanel';
        panel.innerHTML = `
            <div class="cms-panel-header">
                <h3><i class="fas fa-sliders-h"></i> 属性设置</h3>
                <button class="cms-panel-close" id="closePropertyPanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="cms-panel-content" id="propertyPanelContent">
                <div class="cms-empty-state">
                    <i class="fas fa-mouse-pointer"></i>
                    <p>点击页面元素进行编辑</p>
                </div>
            </div>
        `;
        document.body.appendChild(panel);
        this.propertyPanel = panel;
    }

    createModulePanel() {
        const panel = document.createElement('div');
        panel.className = 'cms-module-panel';
        panel.id = 'cmsModulePanel';
        panel.innerHTML = `
            <div class="cms-panel-header">
                <h3><i class="fas fa-cubes"></i> 添加模块</h3>
                <button class="cms-panel-close" id="closeModulePanel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="cms-panel-content">
                <div class="cms-module-grid">
                    <div class="cms-module-item" data-module="text">
                        <div class="cms-module-icon">
                            <i class="fas fa-paragraph"></i>
                        </div>
                        <span class="cms-module-name">文本模块</span>
                    </div>
                    <div class="cms-module-item" data-module="heading">
                        <div class="cms-module-icon">
                            <i class="fas fa-heading"></i>
                        </div>
                        <span class="cms-module-name">标题模块</span>
                    </div>
                    <div class="cms-module-item" data-module="image">
                        <div class="cms-module-icon">
                            <i class="fas fa-image"></i>
                        </div>
                        <span class="cms-module-name">图片模块</span>
                    </div>
                    <div class="cms-module-item" data-module="video">
                        <div class="cms-module-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <span class="cms-module-name">视频模块</span>
                    </div>
                    <div class="cms-module-item" data-module="card">
                        <div class="cms-module-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <span class="cms-module-name">卡片模块</span>
                    </div>
                    <div class="cms-module-item" data-module="button">
                        <div class="cms-module-icon">
                            <i class="fas fa-square"></i>
                        </div>
                        <span class="cms-module-name">按钮模块</span>
                    </div>
                    <div class="cms-module-item" data-module="divider">
                        <div class="cms-module-icon">
                            <i class="fas fa-minus"></i>
                        </div>
                        <span class="cms-module-name">分隔线</span>
                    </div>
                    <div class="cms-module-item" data-module="stats">
                        <div class="cms-module-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <span class="cms-module-name">数据统计</span>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(panel);
        this.modulePanel = panel;
    }

    createFloatingTools() {
        // 创建浮动编辑指示器
        const indicator = document.createElement('div');
        indicator.className = 'cms-edit-indicator';
        indicator.id = 'cmsEditIndicator';
        indicator.innerHTML = `
            <div class="cms-indicator-content">
                <i class="fas fa-pen"></i>
                <span>点击编辑</span>
            </div>
        `;
        document.body.appendChild(indicator);
        this.editIndicator = indicator;

        // 创建元素操作工具栏
        const elementToolbar = document.createElement('div');
        elementToolbar.className = 'cms-element-toolbar';
        elementToolbar.id = 'cmsElementToolbar';
        elementToolbar.innerHTML = `
            <button class="cms-tool-btn" data-action="edit" title="编辑内容">
                <i class="fas fa-edit"></i>
            </button>
            <button class="cms-tool-btn" data-action="style" title="样式设置">
                <i class="fas fa-paint-brush"></i>
            </button>
            <button class="cms-tool-btn" data-action="duplicate" title="复制">
                <i class="fas fa-copy"></i>
            </button>
            <button class="cms-tool-btn cms-tool-btn-danger" data-action="delete" title="删除">
                <i class="fas fa-trash"></i>
            </button>
        `;
        document.body.appendChild(elementToolbar);
        this.elementToolbar = elementToolbar;
    }

    bindEvents() {
        console.log('[CMS Editor] 绑定事件中...');
        
        // 工具栏按钮事件
        const saveBtn = document.getElementById('cmsSaveBtn');
        const previewBtn = document.getElementById('cmsPreviewBtn');
        const exportBtn = document.getElementById('cmsExportBtn');
        const moduleBtn = document.getElementById('cmsModuleBtn');
        const logoutBtn = document.getElementById('cmsLogoutBtn');
        
        console.log('[CMS Editor] 工具栏按钮:', { saveBtn, previewBtn, exportBtn, moduleBtn, logoutBtn });
        
        saveBtn?.addEventListener('click', () => this.saveContent());
        previewBtn?.addEventListener('click', () => this.togglePreview());
        exportBtn?.addEventListener('click', () => this.exportContent());
        moduleBtn?.addEventListener('click', () => this.toggleModulePanel());
        logoutBtn?.addEventListener('click', () => this.logout());

        // 面板关闭按钮
        document.getElementById('closePropertyPanel')?.addEventListener('click', () => {
            this.propertyPanel.classList.remove('show');
        });
        document.getElementById('closeModulePanel')?.addEventListener('click', () => {
            this.modulePanel.classList.remove('show');
        });

        // 模块添加事件
        if (this.modulePanel) {
            this.modulePanel.querySelectorAll('.cms-module-item').forEach(item => {
                item.addEventListener('click', (e) => {
                    const moduleType = item.dataset.module;
                    this.addModule(moduleType);
                });
            });
        }

        // 元素操作工具栏事件
        if (this.elementToolbar) {
            this.elementToolbar.querySelectorAll('.cms-tool-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const action = btn.dataset.action;
                    this.handleElementAction(action);
                });
            });
        }

        // 页面点击事件 - 选择元素
        document.addEventListener('click', (e) => {
            // 忽略编辑器UI的点击
            if (e.target.closest('.cms-toolbar') || 
                e.target.closest('.cms-property-panel') ||
                e.target.closest('.cms-module-panel') ||
                e.target.closest('.cms-element-toolbar') ||
                e.target.closest('.cms-edit-indicator')) {
                return;
            }

            // 选择可编辑元素
            const editableElement = e.target.closest('[data-editable]') || 
                                   e.target.closest('h1, h2, h3, h4, h5, h6, p, span, a, button, img, article, section');
            
            if (editableElement && !editableElement.closest('nav') && !editableElement.closest('footer')) {
                console.log('[CMS Editor] 选中元素:', editableElement.tagName, editableElement.className);
                this.selectElement(editableElement, e);
            }
        });

        // 键盘快捷键
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 's':
                        e.preventDefault();
                        this.saveContent();
                        break;
                    case 'z':
                        e.preventDefault();
                        this.undo();
                        break;
                }
            }
            if (e.key === 'Escape') {
                this.deselectElement();
            }
        });
        
        console.log('[CMS Editor] 事件绑定完成');
    }

    selectElement(element, event) {
        console.log('[CMS Editor] selectElement 被调用', element?.tagName);
        
        // 取消之前的选择
        this.deselectElement();

        this.currentElement = element;
        element.classList.add('cms-selected');
        console.log('[CMS Editor] 已添加 cms-selected 类');

        // 显示元素工具栏
        this.showElementToolbar(element);

        // 更新属性面板
        this.updatePropertyPanel(element);

        // 显示编辑指示器
        if (event) {
            this.showEditIndicator(event.clientX, event.clientY);
        }
        
        console.log('[CMS Editor] 元素选择完成');
    }

    deselectElement() {
        if (this.currentElement) {
            this.currentElement.classList.remove('cms-selected');
            this.currentElement = null;
        }
        this.elementToolbar.classList.remove('show');
        this.editIndicator.classList.remove('show');
    }

    showElementToolbar(element) {
        if (!this.elementToolbar) {
            console.error('[CMS Editor] elementToolbar 不存在');
            return;
        }
        
        const rect = element.getBoundingClientRect();
        const toolbarWidth = 50; // 工具栏宽度估算
        
        // 计算位置，确保不超出视口
        let left = rect.right + 10;
        let top = rect.top;
        
        // 如果超出右侧视口，显示在元素左侧
        if (left + toolbarWidth > window.innerWidth) {
            left = rect.left - toolbarWidth - 10;
        }
        
        // 确保不超出顶部
        if (top < 60) {
            top = 60;
        }
        
        this.elementToolbar.style.left = `${left}px`;
        this.elementToolbar.style.top = `${top}px`;
        this.elementToolbar.classList.add('show');
        
        console.log('[CMS Editor] 工具栏显示在:', left, top);
    }

    showEditIndicator(x, y) {
        this.editIndicator.style.left = `${x + 15}px`;
        this.editIndicator.style.top = `${y - 40}px`;
        this.editIndicator.classList.add('show');
        
        setTimeout(() => {
            this.editIndicator.classList.remove('show');
        }, 2000);
    }

    handleElementAction(action) {
        if (!this.currentElement) return;

        switch(action) {
            case 'edit':
                this.editElementContent(this.currentElement);
                break;
            case 'style':
                this.openStyleEditor(this.currentElement);
                break;
            case 'duplicate':
                this.duplicateElement(this.currentElement);
                break;
            case 'delete':
                this.deleteElement(this.currentElement);
                break;
        }
    }

    editElementContent(element) {
        const tagName = element.tagName.toLowerCase();
        
        if (tagName === 'img') {
            this.editImage(element);
        } else if (['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'a', 'button'].includes(tagName)) {
            this.editText(element);
        } else {
            // 对于容器元素，编辑HTML
            this.editHTML(element);
        }
    }

    editText(element) {
        const originalText = element.textContent;
        const input = document.createElement('textarea');
        input.className = 'cms-inline-editor';
        input.value = originalText;
        
        // 保存原始元素
        const originalElement = element.cloneNode(true);
        
        // 替换为输入框
        element.innerHTML = '';
        element.appendChild(input);
        input.focus();
        input.select();

        const saveEdit = () => {
            const newText = input.value;
            element.textContent = newText;
            this.recordChange({
                type: 'text',
                element: element,
                oldValue: originalText,
                newValue: newText
            });
            this.deselectElement();
        };

        input.addEventListener('blur', saveEdit);
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                saveEdit();
            }
            if (e.key === 'Escape') {
                element.innerHTML = originalElement.innerHTML;
                this.deselectElement();
            }
        });
    }

    editImage(element) {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        
        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const oldSrc = element.src;
                    element.src = event.target.result;
                    this.recordChange({
                        type: 'image',
                        element: element,
                        oldValue: oldSrc,
                        newValue: element.src
                    });
                };
                reader.readAsDataURL(file);
            }
        });
        
        input.click();
    }

    editHTML(element) {
        // 打开属性面板进行HTML编辑
        this.propertyPanel.classList.add('show');
        this.updatePropertyPanel(element, true);
    }

    openStyleEditor(element) {
        this.propertyPanel.classList.add('show');
        this.updatePropertyPanel(element);
    }

    duplicateElement(element) {
        const clone = element.cloneNode(true);
        clone.classList.remove('cms-selected');
        element.parentNode.insertBefore(clone, element.nextSibling);
        
        this.recordChange({
            type: 'duplicate',
            element: clone,
            original: element
        });
    }

    deleteElement(element) {
        if (confirm('确定要删除这个元素吗？')) {
            const parent = element.parentNode;
            const nextSibling = element.nextSibling;
            
            element.remove();
            
            this.recordChange({
                type: 'delete',
                element: element,
                parent: parent,
                nextSibling: nextSibling
            });
            
            this.deselectElement();
        }
    }

    updatePropertyPanel(element, showHTML = false) {
        const content = document.getElementById('propertyPanelContent');
        const computedStyle = window.getComputedStyle(element);
        
        let html = `
            <div class="cms-property-group">
                <h4>元素信息</h4>
                <div class="cms-property-item">
                    <label>标签</label>
                    <span class="cms-tag">${element.tagName.toLowerCase()}</span>
                </div>
                <div class="cms-property-item">
                    <label>类名</label>
                    <input type="text" class="cms-input" value="${element.className.replace('cms-selected', '').trim()}" id="propClassName">
                </div>
            </div>
        `;

        // 文本内容编辑
        if (!showHTML && ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'a', 'button', 'li'].includes(element.tagName.toLowerCase())) {
            html += `
                <div class="cms-property-group">
                    <h4>文本内容</h4>
                    <textarea class="cms-textarea" id="propTextContent" rows="4">${element.textContent}</textarea>
                </div>
            `;
        }

        // 图片属性
        if (element.tagName.toLowerCase() === 'img') {
            html += `
                <div class="cms-property-group">
                    <h4>图片属性</h4>
                    <div class="cms-property-item">
                        <label>图片地址</label>
                        <input type="text" class="cms-input" value="${element.src}" id="propSrc">
                    </div>
                    <div class="cms-property-item">
                        <label>替代文本</label>
                        <input type="text" class="cms-input" value="${element.alt || ''}" id="propAlt">
                    </div>
                </div>
            `;
        }

        // 链接属性
        if (element.tagName.toLowerCase() === 'a') {
            html += `
                <div class="cms-property-group">
                    <h4>链接属性</h4>
                    <div class="cms-property-item">
                        <label>链接地址</label>
                        <input type="text" class="cms-input" value="${element.href}" id="propHref">
                    </div>
                </div>
            `;
        }

        // 样式编辑
        html += `
            <div class="cms-property-group">
                <h4>样式设置</h4>
                <div class="cms-property-row">
                    <div class="cms-property-item">
                        <label>文字颜色</label>
                        <input type="color" class="cms-color-picker" value="${this.rgbToHex(computedStyle.color)}" id="propColor">
                    </div>
                    <div class="cms-property-item">
                        <label>背景颜色</label>
                        <input type="color" class="cms-color-picker" value="${this.rgbToHex(computedStyle.backgroundColor)}" id="propBgColor">
                    </div>
                </div>
                <div class="cms-property-row">
                    <div class="cms-property-item">
                        <label>字体大小</label>
                        <input type="text" class="cms-input cms-input-small" value="${computedStyle.fontSize}" id="propFontSize">
                    </div>
                    <div class="cms-property-item">
                        <label>对齐方式</label>
                        <select class="cms-select" id="propTextAlign">
                            <option value="left" ${computedStyle.textAlign === 'left' ? 'selected' : ''}>左对齐</option>
                            <option value="center" ${computedStyle.textAlign === 'center' ? 'selected' : ''}>居中</option>
                            <option value="right" ${computedStyle.textAlign === 'right' ? 'selected' : ''}>右对齐</option>
                        </select>
                    </div>
                </div>
            </div>
        `;

        // 间距设置
        html += `
            <div class="cms-property-group">
                <h4>间距设置</h4>
                <div class="cms-property-row">
                    <div class="cms-property-item">
                        <label>内边距</label>
                        <input type="text" class="cms-input cms-input-small" value="${computedStyle.padding}" id="propPadding">
                    </div>
                    <div class="cms-property-item">
                        <label>外边距</label>
                        <input type="text" class="cms-input cms-input-small" value="${computedStyle.margin}" id="propMargin">
                    </div>
                </div>
            </div>
        `;

        // HTML编辑（高级）
        if (showHTML) {
            html += `
                <div class="cms-property-group">
                    <h4>HTML代码</h4>
                    <textarea class="cms-textarea cms-code" id="propHTML" rows="10">${this.escapeHtml(element.innerHTML)}</textarea>
                </div>
            `;
        }

        // 操作按钮
        html += `
            <div class="cms-property-actions">
                <button class="cms-btn cms-btn-primary" id="applyChanges">
                    <i class="fas fa-check"></i> 应用更改
                </button>
                <button class="cms-btn cms-btn-secondary" id="resetChanges">
                    <i class="fas fa-undo"></i> 重置
                </button>
            </div>
        `;

        content.innerHTML = html;

        // 绑定属性更改事件
        this.bindPropertyChanges(element);
    }

    bindPropertyChanges(element) {
        // 应用更改按钮
        document.getElementById('applyChanges')?.addEventListener('click', () => {
            this.applyPropertyChanges(element);
        });

        // 重置按钮
        document.getElementById('resetChanges')?.addEventListener('click', () => {
            this.updatePropertyPanel(element);
        });

        // 实时预览样式更改
        const styleInputs = ['propColor', 'propBgColor', 'propFontSize', 'propTextAlign', 'propPadding', 'propMargin'];
        styleInputs.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', () => {
                    this.previewStyleChange(element, id, input.value);
                });
            }
        });
    }

    previewStyleChange(element, propId, value) {
        switch(propId) {
            case 'propColor':
                element.style.color = value;
                break;
            case 'propBgColor':
                element.style.backgroundColor = value;
                break;
            case 'propFontSize':
                element.style.fontSize = value;
                break;
            case 'propTextAlign':
                element.style.textAlign = value;
                break;
            case 'propPadding':
                element.style.padding = value;
                break;
            case 'propMargin':
                element.style.margin = value;
                break;
        }
    }

    applyPropertyChanges(element) {
        const oldState = {
            className: element.className,
            style: element.style.cssText,
            textContent: element.textContent,
            innerHTML: element.innerHTML
        };

        // 应用类名
        const className = document.getElementById('propClassName')?.value;
        if (className !== undefined) {
            element.className = className + ' cms-selected';
        }

        // 应用文本内容
        const textContent = document.getElementById('propTextContent')?.value;
        if (textContent !== undefined) {
            element.textContent = textContent;
        }

        // 应用图片属性
        const src = document.getElementById('propSrc')?.value;
        if (src !== undefined && element.tagName.toLowerCase() === 'img') {
            element.src = src;
        }
        const alt = document.getElementById('propAlt')?.value;
        if (alt !== undefined && element.tagName.toLowerCase() === 'img') {
            element.alt = alt;
        }

        // 应用链接属性
        const href = document.getElementById('propHref')?.value;
        if (href !== undefined && element.tagName.toLowerCase() === 'a') {
            element.href = href;
        }

        // 应用HTML
        const html = document.getElementById('propHTML')?.value;
        if (html !== undefined) {
            element.innerHTML = html;
        }

        this.recordChange({
            type: 'property',
            element: element,
            oldState: oldState,
            newState: {
                className: element.className,
                style: element.style.cssText,
                textContent: element.textContent,
                innerHTML: element.innerHTML
            }
        });

        this.showNotification('更改已应用', 'success');
    }

    addModule(moduleType) {
        // 创建新模块
        let newElement;
        
        switch(moduleType) {
            case 'text':
                newElement = document.createElement('div');
                newElement.className = 'cms-module-text';
                newElement.innerHTML = '<p>在此输入文本内容...</p>';
                break;
            case 'heading':
                newElement = document.createElement('h2');
                newElement.className = 'cms-module-heading';
                newElement.textContent = '标题文本';
                break;
            case 'image':
                newElement = document.createElement('div');
                newElement.className = 'cms-module-image';
                newElement.innerHTML = '<img src="uploads/placeholder.jpg" alt="图片">';
                break;
            case 'video':
                newElement = document.createElement('div');
                newElement.className = 'cms-module-video';
                newElement.innerHTML = '<div class="video-placeholder"><i class="fas fa-play-circle"></i><p>视频模块</p></div>';
                break;
            case 'card':
                newElement = document.createElement('article');
                newElement.className = 'cms-module-card';
                newElement.innerHTML = `
                    <div class="card-icon"><i class="fas fa-star"></i></div>
                    <h3>卡片标题</h3>
                    <p>卡片描述内容...</p>
                `;
                break;
            case 'button':
                newElement = document.createElement('a');
                newElement.className = 'cms-module-button btn btn-primary';
                newElement.href = '#';
                newElement.textContent = '点击按钮';
                break;
            case 'divider':
                newElement = document.createElement('hr');
                newElement.className = 'cms-module-divider';
                break;
            case 'stats':
                newElement = document.createElement('div');
                newElement.className = 'cms-module-stats stat-card';
                newElement.innerHTML = `
                    <div class="stat-number">0</div>
                    <div class="stat-label">统计项</div>
                `;
                break;
        }

        if (newElement) {
            // 添加到页面主要内容区域
            const mainContent = document.querySelector('main') || document.querySelector('.section-container') || document.body;
            mainContent.appendChild(newElement);
            
            // 滚动到新元素
            newElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // 自动选中新元素
            this.selectElement(newElement);
            
            this.recordChange({
                type: 'add',
                element: newElement
            });

            this.showNotification('模块已添加', 'success');
        }

        // 关闭模块面板
        this.modulePanel.classList.remove('show');
    }

    toggleModulePanel() {
        this.modulePanel.classList.toggle('show');
        this.propertyPanel.classList.remove('show');
    }

    recordChange(change) {
        this.changes.push(change);
        console.log('Change recorded:', change);
    }

    undo() {
        if (this.changes.length === 0) {
            this.showNotification('没有可撤销的操作', 'info');
            return;
        }

        const lastChange = this.changes.pop();
        
        switch(lastChange.type) {
            case 'text':
                lastChange.element.textContent = lastChange.oldValue;
                break;
            case 'image':
                lastChange.element.src = lastChange.oldValue;
                break;
            case 'delete':
                if (lastChange.nextSibling) {
                    lastChange.parent.insertBefore(lastChange.element, lastChange.nextSibling);
                } else {
                    lastChange.parent.appendChild(lastChange.element);
                }
                break;
            case 'duplicate':
            case 'add':
                lastChange.element.remove();
                break;
            case 'property':
                lastChange.element.className = lastChange.oldState.className;
                lastChange.element.style.cssText = lastChange.oldState.style;
                lastChange.element.innerHTML = lastChange.oldState.innerHTML;
                break;
        }

        this.showNotification('已撤销', 'success');
    }

    saveContent() {
        // 收集页面所有可编辑内容
        const content = {
            page: this.currentPage,
            timestamp: new Date().toISOString(),
            elements: []
        };

        // 保存主要区域的内容
        const editableSelectors = 'h1, h2, h3, h4, h5, h6, p, span:not(.cms-toolbar *):not(.cms-property-panel *), a:not(.cms-toolbar *):not(.cms-property-panel *), button:not(.cms-toolbar *):not(.cms-property-panel *), img, .service-card, .case-card, .advantage-card';
        
        document.querySelectorAll(editableSelectors).forEach((el, index) => {
            // 跳过编辑器UI元素
            if (el.closest('.cms-toolbar') || el.closest('.cms-property-panel') || el.closest('.cms-module-panel')) {
                return;
            }

            const elData = {
                index: index,
                tagName: el.tagName.toLowerCase(),
                className: el.className.replace('cms-selected', '').trim(),
                id: el.id,
                textContent: el.textContent,
                innerHTML: el.innerHTML
            };

            if (el.tagName.toLowerCase() === 'img') {
                elData.src = el.src;
                elData.alt = el.alt;
            }

            if (el.tagName.toLowerCase() === 'a') {
                elData.href = el.href;
            }

            content.elements.push(elData);
        });

        // 保存到localStorage
        const storageKey = `cms_content_${this.currentPage.replace('.html', '')}`;
        localStorage.setItem(storageKey, JSON.stringify(content));
        
        // 保存所有页面的索引
        const pagesIndex = JSON.parse(localStorage.getItem('cms_pages_index') || '[]');
        if (!pagesIndex.includes(this.currentPage)) {
            pagesIndex.push(this.currentPage);
            localStorage.setItem('cms_pages_index', JSON.stringify(pagesIndex));
        }

        this.showNotification('内容已保存', 'success');
        console.log('Content saved:', content);
    }

    loadSavedContent() {
        const storageKey = `cms_content_${this.currentPage.replace('.html', '')}`;
        const saved = localStorage.getItem(storageKey);
        if (saved) {
            this.savedContent = JSON.parse(saved);
        }
    }

    applySavedContent() {
        if (!this.savedContent.elements) return;

        // 这里可以实现内容恢复逻辑
        // 由于直接替换内容可能导致事件监听器丢失，
        // 建议在实际项目中使用更精细的内容更新策略
        console.log('Saved content available:', this.savedContent);
    }

    exportContent() {
        const storageKey = `cms_content_${this.currentPage.replace('.html', '')}`;
        const content = localStorage.getItem(storageKey);
        
        if (!content) {
            this.showNotification('没有可导出的内容', 'error');
            return;
        }

        // 创建下载
        const blob = new Blob([content], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `cms-content-${this.currentPage.replace('.html', '')}-${new Date().toISOString().split('T')[0]}.json`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);

        this.showNotification('内容已导出', 'success');
    }

    togglePreview() {
        document.body.classList.toggle('cms-preview-mode');
        const isPreview = document.body.classList.contains('cms-preview-mode');
        
        if (isPreview) {
            this.deselectElement();
            this.toolbar.style.display = 'none';
            this.propertyPanel.classList.remove('show');
            this.modulePanel.classList.remove('show');
        } else {
            this.toolbar.style.display = 'flex';
        }

        this.showNotification(isPreview ? '预览模式' : '编辑模式', 'info');
    }

    logout() {
        if (confirm('确定要退出登录吗？')) {
            localStorage.removeItem('cms_logged_in');
            localStorage.removeItem('cms_username');
            localStorage.removeItem('cms_login_time');
            window.location.href = 'login.html';
        }
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `cms-notification cms-notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // 工具方法
    rgbToHex(rgb) {
        if (!rgb || rgb === 'rgba(0, 0, 0, 0)') return '#000000';
        if (rgb.startsWith('#')) return rgb;
        
        const rgbValues = rgb.match(/\d+/g);
        if (!rgbValues) return '#000000';
        
        return '#' + rgbValues.slice(0, 3).map(x => {
            const hex = parseInt(x).toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('');
    }

    escapeHtml(html) {
        const div = document.createElement('div');
        div.textContent = html;
        return div.innerHTML;
    }
}

// 初始化编辑器
document.addEventListener('DOMContentLoaded', () => {
    window.cmsEditor = new CMSEditor();
});
