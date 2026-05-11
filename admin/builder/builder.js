/**
 * CMS拖拽式编辑器核心
 * 支持组件拖拽、属性编辑、实时预览
 */

class CMSBuilder {
    constructor(containerId, options = {}) {
        this.container = document.getElementById(containerId);
        this.options = {
            onChange: () => {},
            onSave: () => {},
            ...options
        };
        
        this.components = [];
        this.selectedComponentId = null;
        this.draggedComponent = null;
        this.draggedItem = null;
        
        this.init();
    }
    
    init() {
        this.renderLayout();
        this.renderComponentLibrary();
        this.bindEvents();
        this.initSortable();
    }
    
    /**
     * 渲染编辑器布局
     */
    renderLayout() {
        this.container.innerHTML = `
            <div class="builder-container">
                <div class="builder-sidebar">
                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            <i class="fas fa-cubes"></i>
                            组件库
                        </div>
                    </div>
                    <div class="component-categories" id="componentCategories"></div>
                </div>
                <div class="builder-canvas">
                    <div class="canvas-area" id="canvasArea">
                        <div class="canvas-empty" id="canvasEmpty">
                            <i class="fas fa-mouse-pointer"></i>
                            <p>从左侧拖拽组件到此处</p>
                        </div>
                        <div class="canvas-components" id="canvasComponents"></div>
                    </div>
                </div>
                <div class="builder-properties">
                    <div class="properties-header">
                        <div class="properties-title">
                            <i class="fas fa-cog"></i>
                            属性设置
                        </div>
                    </div>
                    <div class="properties-body" id="propertiesBody">
                        <div class="properties-empty">
                            <i class="fas fa-hand-pointer"></i>
                            <p>点击组件进行编辑</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        this.canvasComponents = document.getElementById('canvasComponents');
        this.canvasEmpty = document.getElementById('canvasEmpty');
        this.propertiesBody = document.getElementById('propertiesBody');
    }
    
    /**
     * 渲染组件库
     */
    renderComponentLibrary() {
        const container = document.getElementById('componentCategories');
        
        Object.entries(ComponentConfig).forEach(([categoryKey, category]) => {
            const categoryEl = document.createElement('div');
            categoryEl.className = 'category-group';
            categoryEl.innerHTML = `
                <div class="category-header" data-category="${categoryKey}">
                    <i class="fas fa-chevron-down"></i>
                    <i class="fas ${category.icon}"></i>
                    <span>${category.name}</span>
                </div>
                <div class="category-components" id="category-${categoryKey}">
                    ${Object.entries(category.components).map(([compKey, comp]) => `
                        <div class="component-item" draggable="true" data-category="${categoryKey}" data-component="${compKey}">
                            <i class="fas ${comp.icon}"></i>
                            <span>${comp.name}</span>
                        </div>
                    `).join('')}
                </div>
            `;
            container.appendChild(categoryEl);
        });
    }
    
    /**
     * 绑定事件
     */
    bindEvents() {
        // 分类折叠
        document.querySelectorAll('.category-header').forEach(header => {
            header.addEventListener('click', () => {
                const category = header.dataset.category;
                const components = document.getElementById(`category-${category}`);
                header.classList.toggle('collapsed');
                components.classList.toggle('collapsed');
            });
        });
        
        // 组件库拖拽
        document.querySelectorAll('.component-item').forEach(item => {
            item.addEventListener('dragstart', (e) => {
                this.draggedItem = {
                    category: item.dataset.category,
                    component: item.dataset.component,
                    isNew: true
                };
                e.dataTransfer.effectAllowed = 'copy';
            });
        });
        
        // 画布拖放
        this.canvasComponents.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.dataTransfer.dropEffect = this.draggedItem?.isNew ? 'copy' : 'move';
        });
        
        this.canvasComponents.addEventListener('drop', (e) => {
            e.preventDefault();
            this.handleDrop(e);
        });
        
        // 画布点击
        this.canvasComponents.addEventListener('click', (e) => {
            const componentEl = e.target.closest('.builder-component');
            if (componentEl) {
                this.selectComponent(componentEl.dataset.id);
            } else {
                this.deselectComponent();
            }
        });
    }
    
    /**
     * 初始化排序
     */
    initSortable() {
        // 使用HTML5拖放API实现排序
        this.canvasComponents.addEventListener('dragstart', (e) => {
            const componentEl = e.target.closest('.builder-component');
            if (componentEl) {
                this.draggedItem = {
                    id: componentEl.dataset.id,
                    isNew: false
                };
                componentEl.classList.add('dragging');
                e.dataTransfer.effectAllowed = 'move';
            }
        });
        
        this.canvasComponents.addEventListener('dragend', (e) => {
            const componentEl = e.target.closest('.builder-component');
            if (componentEl) {
                componentEl.classList.remove('dragging');
            }
            this.draggedItem = null;
        });
        
        // 添加拖拽经过时的视觉反馈
        this.canvasComponents.addEventListener('dragenter', (e) => {
            e.preventDefault();
        });
        
        this.canvasComponents.addEventListener('dragover', (e) => {
            e.preventDefault();
            const afterElement = this.getDragAfterElement(this.canvasComponents, e.clientY);
            const draggable = document.querySelector('.dragging');
            if (draggable && afterElement) {
                this.canvasComponents.insertBefore(draggable, afterElement);
            } else if (draggable) {
                this.canvasComponents.appendChild(draggable);
            }
        });
    }
    
    /**
     * 获取拖拽后的元素位置
     */
    getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.builder-component:not(.dragging)')];
        
        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }
    
    /**
     * 处理拖放
     */
    handleDrop(e) {
        if (!this.draggedItem) return;
        
        const rect = this.canvasComponents.getBoundingClientRect();
        const y = e.clientY - rect.top;
        
        // 计算插入位置
        const componentEls = Array.from(this.canvasComponents.querySelectorAll('.builder-component'));
        let insertIndex = componentEls.length;
        
        for (let i = 0; i < componentEls.length; i++) {
            const compRect = componentEls[i].getBoundingClientRect();
            const compMiddle = compRect.top + compRect.height / 2 - rect.top;
            if (y < compMiddle) {
                insertIndex = i;
                break;
            }
        }
        
        if (this.draggedItem.isNew) {
            // 添加新组件
            this.addComponent(
                this.draggedItem.category,
                this.draggedItem.component,
                insertIndex
            );
        } else {
            // 移动现有组件 - 从DOM顺序重新计算索引
            const newIndex = this.getComponentIndexFromDOM(this.draggedItem.id);
            if (newIndex !== -1) {
                this.moveComponent(this.draggedItem.id, newIndex);
            }
        }
        
        this.draggedItem = null;
    }
    
    /**
     * 从DOM顺序获取组件索引
     */
    getComponentIndexFromDOM(componentId) {
        const componentEls = Array.from(this.canvasComponents.querySelectorAll('.builder-component'));
        for (let i = 0; i < componentEls.length; i++) {
            if (componentEls[i].dataset.id === componentId) {
                return i;
            }
        }
        return -1;
    }
    
    /**
     * 添加组件
     */
    addComponent(category, type, index = -1) {
        const categoryConfig = ComponentConfig[category];
        if (!categoryConfig) {
            console.error(`Unknown category: ${category}`);
            return;
        }
        
        const config = categoryConfig.components[type];
        if (!config) {
            console.error(`Unknown component type: ${category}.${type}`);
            return;
        }
        
        const id = `comp_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
        
        // 获取默认数据 - 深拷贝以避免引用问题
        const data = {};
        config.fields.forEach(field => {
            if (Array.isArray(field.default)) {
                data[field.name] = JSON.parse(JSON.stringify(field.default));
            } else {
                data[field.name] = field.default;
            }
        });
        
        const component = {
            id,
            category,
            type,
            data,
            children: config.allowChildren ? [] : null
        };
        
        if (index === -1 || index >= this.components.length) {
            this.components.push(component);
        } else {
            this.components.splice(index, 0, component);
        }
        
        this.renderCanvas();
        this.selectComponent(id);
        this.options.onChange(this.components);
    }
    
    /**
     * 移动组件
     */
    moveComponent(id, newIndex) {
        const oldIndex = this.components.findIndex(c => c.id === id);
        if (oldIndex === -1) return;
        
        const component = this.components.splice(oldIndex, 1)[0];
        
        // 调整插入位置
        if (oldIndex < newIndex) {
            newIndex--;
        }
        
        this.components.splice(newIndex, 0, component);
        this.renderCanvas();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除组件
     */
    deleteComponent(id) {
        if (!confirm('确定要删除这个组件吗？')) return;
        
        this.components = this.components.filter(c => c.id !== id);
        
        if (this.selectedComponentId === id) {
            this.deselectComponent();
        }
        
        this.renderCanvas();
        this.options.onChange(this.components);
    }
    
    /**
     * 复制组件
     */
    duplicateComponent(id) {
        const component = this.components.find(c => c.id === id);
        if (!component) return;
        
        const newComponent = {
            id: `comp_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`,
            category: component.category,
            type: component.type,
            data: JSON.parse(JSON.stringify(component.data)),
            children: component.children ? JSON.parse(JSON.stringify(component.children)) : null
        };
        
        const index = this.components.findIndex(c => c.id === id);
        this.components.splice(index + 1, 0, newComponent);
        
        this.renderCanvas();
        this.selectComponent(newComponent.id);
        this.options.onChange(this.components);
    }
    
    /**
     * 渲染画布
     */
    renderCanvas() {
        if (this.components.length === 0) {
            this.canvasEmpty.style.display = 'flex';
            this.canvasComponents.innerHTML = '';
            return;
        }
        
        this.canvasEmpty.style.display = 'none';
        
        this.canvasComponents.innerHTML = this.components.map(comp => {
            const categoryConfig = ComponentConfig[comp.category];
            if (!categoryConfig) {
                console.warn(`Unknown component category: ${comp.category}`);
                return '';
            }
            
            const config = categoryConfig.components[comp.type];
            if (!config) {
                console.warn(`Unknown component type: ${comp.category}.${comp.type}`);
                return '';
            }
            
            const isSelected = comp.id === this.selectedComponentId;
            
            // 确保组件数据存在
            if (!comp.data) {
                comp.data = {};
            }
            
            // 设置默认值
            config.fields.forEach(field => {
                if (comp.data[field.name] === undefined) {
                    comp.data[field.name] = field.default;
                }
            });
            
            return `
                <div class="builder-component ${isSelected ? 'selected' : ''}" 
                     data-id="${comp.id}" 
                     draggable="true">
                    <div class="component-overlay"></div>
                    <div class="component-toolbar">
                        <button class="toolbar-btn component-drag-handle" title="拖拽排序">
                            <i class="fas fa-grip-vertical"></i>
                        </button>
                        <button class="toolbar-btn" onclick="builder.duplicateComponent('${comp.id}')" title="复制">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="toolbar-btn delete" onclick="builder.deleteComponent('${comp.id}')" title="删除">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="component-label">${config.name}</div>
                    <div class="component-content">
                        ${ComponentRenderer.render(comp)}
                    </div>
                </div>
            `;
        }).join('');
    }
    
    /**
     * 选择组件
     */
    selectComponent(id) {
        // 如果切换组件，先销毁富文本编辑器
        if (this.selectedComponentId !== id && typeof tinymce !== 'undefined') {
            tinymce.remove('.prop-richtext-editor');
        }
        
        this.selectedComponentId = id;
        this.renderCanvas();
        this.renderProperties();
    }
    
    /**
     * 取消选择
     */
    deselectComponent() {
        // 销毁富文本编辑器
        if (typeof tinymce !== 'undefined') {
            tinymce.remove('.prop-richtext-editor');
        }
        
        this.selectedComponentId = null;
        this.renderCanvas();
        this.propertiesBody.innerHTML = `
            <div class="properties-empty">
                <i class="fas fa-hand-pointer"></i>
                <p>点击组件进行编辑</p>
            </div>
        `;
    }
    
    /**
     * 渲染属性面板
     */
    renderProperties() {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        const categoryConfig = ComponentConfig[component.category];
        if (!categoryConfig) {
            console.warn(`Unknown category: ${component.category}`);
            return;
        }
        
        const config = categoryConfig.components[component.type];
        if (!config) {
            console.warn(`Unknown component type: ${component.category}.${component.type}`);
            return;
        }
        
        // 确保组件数据存在
        if (!component.data) {
            component.data = {};
        }
        
        this.propertiesBody.innerHTML = `
            <div class="prop-group">
                <label class="prop-label">组件类型</label>
                <input type="text" class="prop-input" value="${config.name}" disabled>
            </div>
            ${config.fields.map(field => {
                // 如果数据中没有该字段，使用默认值
                const value = component.data[field.name] !== undefined ? component.data[field.name] : field.default;
                return this.renderPropertyField(field, value);
            }).join('')}
        `;
        
        // 绑定属性变更事件
        this.bindPropertyEvents(component);
    }
    
    /**
     * 渲染属性字段
     */
    renderPropertyField(field, value) {
        const fieldId = `prop_${field.name}`;
        
        switch (field.type) {
            case 'text':
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <input type="text" class="prop-input" id="${fieldId}" value="${this.escapeHtml(value || '')}">
                    </div>
                `;
                
            case 'textarea':
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <textarea class="prop-textarea" id="${fieldId}" rows="4">${this.escapeHtml(value || '')}</textarea>
                    </div>
                `;
                
            case 'richtext':
                return `
                    <div class="prop-group prop-richtext">
                        <label class="prop-label">${field.label}</label>
                        <textarea class="prop-richtext-editor" id="${fieldId}" rows="6">${value || ''}</textarea>
                    </div>
                `;
                
            case 'select':
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <select class="prop-select" id="${fieldId}">
                            ${field.options.map(opt => `
                                <option value="${opt}" ${value === opt ? 'selected' : ''}>${opt}</option>
                            `).join('')}
                        </select>
                    </div>
                `;
                
            case 'image':
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-image-upload" onclick="document.getElementById('${fieldId}_file').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>点击上传图片</p>
                            ${value ? `<img src="${value}" class="prop-image-preview">` : ''}
                        </div>
                        <input type="file" id="${fieldId}_file" accept="image/*" style="display: none;">
                        <input type="hidden" id="${fieldId}" value="${value || ''}">
                    </div>
                `;
                
            case 'color':
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-color-group">
                            <input type="color" class="prop-color-picker" id="${fieldId}_picker" value="${value || '#000000'}">
                            <input type="text" class="prop-input" id="${fieldId}" value="${value || ''}" placeholder="#000000">
                        </div>
                    </div>
                `;
                
            case 'checkbox':
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <label class="prop-checkbox">
                            <input type="checkbox" id="${fieldId}" ${value ? 'checked' : ''}>
                            <span>启用</span>
                        </label>
                    </div>
                `;
                
            case 'checkboxGroup':
                const selectedValues = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-checkbox-group">
                            ${field.options.map(opt => `
                                <label class="prop-checkbox">
                                    <input type="checkbox" name="${fieldId}" value="${opt}" ${selectedValues.includes(opt) ? 'checked' : ''}>
                                    <span>${opt}</span>
                                </label>
                            `).join('')}
                        </div>
                    </div>
                `;
                
            case 'imageList':
                const images = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-list" id="${fieldId}_list">
                            ${images.map((img, i) => `
                                <div class="prop-list-item">
                                    <input type="text" value="${img.src || ''}" placeholder="图片地址" data-index="${i}" data-field="src">
                                    <input type="text" value="${img.title || ''}" placeholder="标题" data-index="${i}" data-field="title">
                                    <button class="prop-list-btn remove" onclick="builder.removeImageListItem('${field.name}', ${i})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                        <button class="prop-list-add" onclick="builder.addImageListItem('${field.name}')">
                            <i class="fas fa-plus"></i>
                            添加图片
                        </button>
                    </div>
                `;
                
            case 'tabList':
                const tabs = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-tabs-list" id="${fieldId}_list">
                            ${tabs.map((tab, i) => `
                                <div class="prop-tab-item">
                                    <div class="prop-tab-header">
                                        <input type="text" value="${this.escapeHtml(tab.title || '')}" placeholder="标签标题" data-index="${i}" data-field="title">
                                        <button class="prop-list-btn remove" onclick="builder.removeTabItem('${field.name}', ${i})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="prop-tab-content">
                                        <textarea placeholder="标签内容" data-index="${i}" data-field="content">${this.escapeHtml(tab.content || '')}</textarea>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        <button class="prop-list-add" onclick="builder.addTabItem('${field.name}')">
                            <i class="fas fa-plus"></i>
                            添加标签页
                        </button>
                    </div>
                `;
                
            case 'collapseList':
                const collapseItems = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-tabs-list" id="${fieldId}_list">
                            ${collapseItems.map((item, i) => `
                                <div class="prop-tab-item">
                                    <div class="prop-tab-header">
                                        <input type="text" value="${this.escapeHtml(item.title || '')}" placeholder="标题" data-index="${i}" data-field="title">
                                        <button class="prop-list-btn remove" onclick="builder.removeCollapseItem('${field.name}', ${i})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="prop-tab-content">
                                        <textarea placeholder="内容" data-index="${i}" data-field="content">${this.escapeHtml(item.content || '')}</textarea>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        <button class="prop-list-add" onclick="builder.addCollapseItem('${field.name}')">
                            <i class="fas fa-plus"></i>
                            添加折叠项
                        </button>
                    </div>
                `;
                
            case 'formFields':
                const formFields = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-list" id="${fieldId}_list">
                            ${formFields.map((fld, i) => `
                                <div class="prop-list-item" style="flex-wrap: wrap; gap: 8px;">
                                    <input type="text" value="${this.escapeHtml(fld.name || '')}" placeholder="字段名" data-index="${i}" data-field="name" style="flex: 1; min-width: 80px;">
                                    <input type="text" value="${this.escapeHtml(fld.label || '')}" placeholder="标签" data-index="${i}" data-field="label" style="flex: 1; min-width: 80px;">
                                    <select data-index="${i}" data-field="type" style="padding: 6px; border: 1px solid #d1d5db; border-radius: 4px;">
                                        <option value="text" ${fld.type === 'text' ? 'selected' : ''}>文本</option>
                                        <option value="email" ${fld.type === 'email' ? 'selected' : ''}>邮箱</option>
                                        <option value="tel" ${fld.type === 'tel' ? 'selected' : ''}>电话</option>
                                        <option value="textarea" ${fld.type === 'textarea' ? 'selected' : ''}>多行文本</option>
                                    </select>
                                    <label style="display: flex; align-items: center; gap: 4px; font-size: 12px;">
                                        <input type="checkbox" data-index="${i}" data-field="required" ${fld.required ? 'checked' : ''}>
                                        必填
                                    </label>
                                    <button class="prop-list-btn remove" onclick="builder.removeFormField('${field.name}', ${i})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                        <button class="prop-list-add" onclick="builder.addFormField('${field.name}')">
                            <i class="fas fa-plus"></i>
                            添加字段
                        </button>
                    </div>
                `;
                
            case 'voteOptions':
                const voteOptions = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-list" id="${fieldId}_list">
                            ${voteOptions.map((opt, i) => `
                                <div class="prop-list-item">
                                    <input type="text" value="${this.escapeHtml(opt.text || '')}" placeholder="选项文字" data-index="${i}">
                                    <button class="prop-list-btn remove" onclick="builder.removeVoteOption('${field.name}', ${i})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                        <button class="prop-list-add" onclick="builder.addVoteOption('${field.name}')">
                            <i class="fas fa-plus"></i>
                            添加选项
                        </button>
                    </div>
                `;
                
            case 'imageTabList':
                const imageTabs = Array.isArray(value) ? value : [];
                return `
                    <div class="prop-group">
                        <label class="prop-label">${field.label}</label>
                        <div class="prop-list" id="${fieldId}_list">
                            ${imageTabs.map((tab, i) => `
                                <div class="prop-list-item" style="flex-wrap: wrap;">
                                    <input type="text" value="${this.escapeHtml(tab.image || '')}" placeholder="图片地址" data-index="${i}" data-field="image" style="flex: 1; min-width: 100%;">
                                    <input type="text" value="${this.escapeHtml(tab.title || '')}" placeholder="标题" data-index="${i}" data-field="title" style="flex: 1;">
                                    <button class="prop-list-btn remove" onclick="builder.removeImageTabItem('${field.name}', ${i})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                        <button class="prop-list-add" onclick="builder.addImageTabItem('${field.name}')">
                            <i class="fas fa-plus"></i>
                            添加图片标签
                        </button>
                    </div>
                `;
                
            default:
                return '';
        }
    }
    
    /**
     * 绑定属性事件
     */
    bindPropertyEvents(component) {
        const config = ComponentConfig[component.category].components[component.type];
        
        config.fields.forEach(field => {
            const fieldId = `prop_${field.name}`;
            
            switch (field.type) {
                case 'text':
                case 'textarea':
                    document.getElementById(fieldId)?.addEventListener('input', (e) => {
                        component.data[field.name] = e.target.value;
                        this.updateComponent(component);
                    });
                    break;
                    
                case 'select':
                    document.getElementById(fieldId)?.addEventListener('change', (e) => {
                        component.data[field.name] = e.target.value;
                        this.updateComponent(component);
                    });
                    break;
                    
                case 'checkbox':
                    document.getElementById(fieldId)?.addEventListener('change', (e) => {
                        component.data[field.name] = e.target.checked;
                        this.updateComponent(component);
                    });
                    break;
                    
                case 'checkboxGroup':
                    document.querySelectorAll(`[name="${fieldId}"]`).forEach(checkbox => {
                        checkbox.addEventListener('change', () => {
                            const checked = Array.from(document.querySelectorAll(`[name="${fieldId}"]:checked`)).map(cb => cb.value);
                            component.data[field.name] = checked;
                            this.updateComponent(component);
                        });
                    });
                    break;
                    
                case 'color':
                    const colorPicker = document.getElementById(`${fieldId}_picker`);
                    const colorInput = document.getElementById(fieldId);
                    
                    colorPicker?.addEventListener('input', (e) => {
                        colorInput.value = e.target.value;
                        component.data[field.name] = e.target.value;
                        this.updateComponent(component);
                    });
                    
                    colorInput?.addEventListener('input', (e) => {
                        colorPicker.value = e.target.value;
                        component.data[field.name] = e.target.value;
                        this.updateComponent(component);
                    });
                    break;
                    
                case 'image':
                    const fileInput = document.getElementById(`${fieldId}_file`);
                    const hiddenInput = document.getElementById(fieldId);
                    
                    fileInput?.addEventListener('change', (e) => {
                        const file = e.target.files[0];
                        if (!file) return;
                        
                        const reader = new FileReader();
                        reader.onload = (event) => {
                            hiddenInput.value = event.target.result;
                            component.data[field.name] = event.target.result;
                            this.updateComponent(component);
                            this.renderProperties(); // 刷新预览图
                        };
                        reader.readAsDataURL(file);
                    });
                    break;
                    
                case 'imageList':
                    // 图片列表字段 - 绑定输入事件
                    document.querySelectorAll(`#${fieldId}_list input`).forEach(input => {
                        input.addEventListener('input', (e) => {
                            const index = parseInt(e.target.dataset.index);
                            const field = e.target.dataset.field;
                            if (!Array.isArray(component.data[fieldName])) {
                                component.data[fieldName] = [];
                            }
                            if (!component.data[fieldName][index]) {
                                component.data[fieldName][index] = {};
                            }
                            component.data[fieldName][index][field] = e.target.value;
                            this.updateComponent(component);
                        });
                    });
                    break;
                    
                case 'tabList':
                    // 标签页列表字段 - 绑定输入事件
                    document.querySelectorAll(`#${fieldId}_list input, #${fieldId}_list textarea`).forEach(input => {
                        input.addEventListener('input', (e) => {
                            const index = parseInt(e.target.dataset.index);
                            const field = e.target.dataset.field;
                            if (!Array.isArray(component.data[fieldName])) {
                                component.data[fieldName] = [];
                            }
                            if (!component.data[fieldName][index]) {
                                component.data[fieldName][index] = {};
                            }
                            component.data[fieldName][index][field] = e.target.value;
                            this.updateComponent(component);
                        });
                    });
                    break;
                    
                case 'collapseList':
                    // 折叠列表字段 - 绑定输入事件
                    document.querySelectorAll(`#${fieldId}_list input, #${fieldId}_list textarea`).forEach(input => {
                        input.addEventListener('input', (e) => {
                            const index = parseInt(e.target.dataset.index);
                            const field = e.target.dataset.field;
                            if (!Array.isArray(component.data[fieldName])) {
                                component.data[fieldName] = [];
                            }
                            if (!component.data[fieldName][index]) {
                                component.data[fieldName][index] = {};
                            }
                            component.data[fieldName][index][field] = e.target.value;
                            this.updateComponent(component);
                        });
                    });
                    break;
                    
                case 'formFields':
                    // 表单字段列表 - 绑定输入事件
                    document.querySelectorAll(`#${fieldId}_list input, #${fieldId}_list select`).forEach(input => {
                        input.addEventListener('change', (e) => {
                            const index = parseInt(e.target.dataset.index);
                            const field = e.target.dataset.field;
                            if (!Array.isArray(component.data[fieldName])) {
                                component.data[fieldName] = [];
                            }
                            if (!component.data[fieldName][index]) {
                                component.data[fieldName][index] = {};
                            }
                            if (e.target.type === 'checkbox') {
                                component.data[fieldName][index][field] = e.target.checked;
                            } else {
                                component.data[fieldName][index][field] = e.target.value;
                            }
                            this.updateComponent(component);
                        });
                    });
                    break;
                    
                case 'voteOptions':
                    // 投票选项列表 - 绑定输入事件
                    document.querySelectorAll(`#${fieldId}_list input`).forEach(input => {
                        input.addEventListener('input', (e) => {
                            const index = parseInt(e.target.dataset.index);
                            if (!Array.isArray(component.data[fieldName])) {
                                component.data[fieldName] = [];
                            }
                            if (!component.data[fieldName][index]) {
                                component.data[fieldName][index] = {};
                            }
                            component.data[fieldName][index].text = e.target.value;
                            this.updateComponent(component);
                        });
                    });
                    break;
                    
                case 'imageTabList':
                    // 图片标签列表 - 绑定输入事件
                    document.querySelectorAll(`#${fieldId}_list input`).forEach(input => {
                        input.addEventListener('input', (e) => {
                            const index = parseInt(e.target.dataset.index);
                            const field = e.target.dataset.field;
                            if (!Array.isArray(component.data[fieldName])) {
                                component.data[fieldName] = [];
                            }
                            if (!component.data[fieldName][index]) {
                                component.data[fieldName][index] = {};
                            }
                            component.data[fieldName][index][field] = e.target.value;
                            this.updateComponent(component);
                        });
                    });
                    break;
            }
        });
        
        // 初始化富文本编辑器
        this.initRichTextEditors(component);
    }
    
    /**
     * 初始化富文本编辑器
     */
    initRichTextEditors(component) {
        // 先销毁所有现有的编辑器实例
        if (typeof tinymce !== 'undefined') {
            tinymce.remove('.prop-richtext-editor');
        }
        
        // 延迟初始化以确保DOM已更新
        setTimeout(() => {
            document.querySelectorAll('.prop-richtext-editor').forEach(textarea => {
                const fieldName = textarea.id.replace('prop_', '');
                
                tinymce.init({
                    selector: `#${textarea.id}`,
                    plugins: 'lists link code',
                    toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
                    menubar: false,
                    height: 200,
                    branding: false,
                    setup: (editor) => {
                        editor.on('change input blur', () => {
                            component.data[fieldName] = editor.getContent();
                            this.updateComponent(component);
                        });
                    }
                });
            });
        }, 100);
    }
    
    /**
     * 添加图片列表项
     */
    addImageListItem(fieldName) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        if (!Array.isArray(component.data[fieldName])) {
            component.data[fieldName] = [];
        }
        
        component.data[fieldName].push({ src: '', title: '' });
        this.renderProperties();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除图片列表项
     */
    removeImageListItem(fieldName, index) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        component.data[fieldName].splice(index, 1);
        this.renderProperties();
        this.updateComponent(component);
    }
    
    /**
     * 添加标签页
     */
    addTabItem(fieldName) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        if (!Array.isArray(component.data[fieldName])) {
            component.data[fieldName] = [];
        }
        
        component.data[fieldName].push({ title: '新标签', content: '' });
        this.renderProperties();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除标签页
     */
    removeTabItem(fieldName, index) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        component.data[fieldName].splice(index, 1);
        this.renderProperties();
        this.updateComponent(component);
    }
    
    /**
     * 添加折叠项
     */
    addCollapseItem(fieldName) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        if (!Array.isArray(component.data[fieldName])) {
            component.data[fieldName] = [];
        }
        
        component.data[fieldName].push({ title: '新标题', content: '' });
        this.renderProperties();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除折叠项
     */
    removeCollapseItem(fieldName, index) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        component.data[fieldName].splice(index, 1);
        this.renderProperties();
        this.updateComponent(component);
    }
    
    /**
     * 添加表单字段
     */
    addFormField(fieldName) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        if (!Array.isArray(component.data[fieldName])) {
            component.data[fieldName] = [];
        }
        
        component.data[fieldName].push({ name: '', label: '', type: 'text', required: false });
        this.renderProperties();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除表单字段
     */
    removeFormField(fieldName, index) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        component.data[fieldName].splice(index, 1);
        this.renderProperties();
        this.updateComponent(component);
    }
    
    /**
     * 添加投票选项
     */
    addVoteOption(fieldName) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        if (!Array.isArray(component.data[fieldName])) {
            component.data[fieldName] = [];
        }
        
        component.data[fieldName].push({ text: '新选项' });
        this.renderProperties();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除投票选项
     */
    removeVoteOption(fieldName, index) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        component.data[fieldName].splice(index, 1);
        this.renderProperties();
        this.updateComponent(component);
    }
    
    /**
     * 添加图片标签项
     */
    addImageTabItem(fieldName) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        if (!Array.isArray(component.data[fieldName])) {
            component.data[fieldName] = [];
        }
        
        component.data[fieldName].push({ image: '', title: '新标签', content: '' });
        this.renderProperties();
        this.options.onChange(this.components);
    }
    
    /**
     * 删除图片标签项
     */
    removeImageTabItem(fieldName, index) {
        const component = this.components.find(c => c.id === this.selectedComponentId);
        if (!component) return;
        
        component.data[fieldName].splice(index, 1);
        this.renderProperties();
        this.updateComponent(component);
    }
    
    /**
     * 更新组件
     */
    updateComponent(component) {
        const index = this.components.findIndex(c => c.id === component.id);
        if (index !== -1) {
            this.components[index] = component;
            this.renderCanvas();
            this.options.onChange(this.components);
        }
    }
    
    /**
     * 获取组件数据
     */
    getData() {
        return this.components;
    }
    
    /**
     * 设置组件数据
     */
    setData(data) {
        // 深拷贝数据以避免引用问题
        this.components = data ? JSON.parse(JSON.stringify(data)) : [];
        
        // 确保每个组件都有完整的数据结构
        this.components.forEach(comp => {
            if (!comp.data) {
                comp.data = {};
            }
            
            const categoryConfig = ComponentConfig[comp.category];
            if (categoryConfig) {
                const config = categoryConfig.components[comp.type];
                if (config && config.fields) {
                    // 填充默认值
                    config.fields.forEach(field => {
                        if (comp.data[field.name] === undefined) {
                            if (Array.isArray(field.default)) {
                                comp.data[field.name] = JSON.parse(JSON.stringify(field.default));
                            } else {
                                comp.data[field.name] = field.default;
                            }
                        }
                    });
                }
            }
        });
        
        this.renderCanvas();
        this.deselectComponent();
    }
    
    /**
     * 清空画布
     */
    clear() {
        this.components = [];
        this.selectedComponentId = null;
        this.renderCanvas();
        this.deselectComponent();
    }
    
    /**
     * 导出HTML
     */
    exportHTML() {
        return ComponentRenderer.renderList(this.components);
    }
    
    /**
     * HTML转义
     */
    escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// 全局实例
let builder = null;

/**
 * 初始化构建器
 */
function initBuilder(containerId, options = {}) {
    builder = new CMSBuilder(containerId, options);
    return builder;
}
