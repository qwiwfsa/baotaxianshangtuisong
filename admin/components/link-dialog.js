/**
 * 富文本编辑器超链接功能增强
 * 支持内部链接和外部链接
 */

class LinkDialog {
    constructor(editor) {
        this.editor = editor;
        this.dialog = null;
        this.init();
    }
    
    init() {
        // 创建对话框HTML
        this.createDialog();
        this.bindEvents();
    }
    
    createDialog() {
        const dialogHtml = `
            <div class="link-dialog-overlay" id="linkDialogOverlay">
                <div class="link-dialog">
                    <div class="link-dialog-header">
                        <h3 class="link-dialog-title">
                            <i class="fas fa-link"></i>
                            插入链接
                        </h3>
                        <button class="link-dialog-close" id="linkDialogClose">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="link-dialog-body">
                        <div class="link-tabs">
                            <button class="link-tab active" data-tab="external">外部链接</button>
                            <button class="link-tab" data-tab="internal">内部页面</button>
                        </div>
                        
                        <!-- 外部链接 -->
                        <div class="link-tab-content active" id="tab-external">
                            <div class="form-group">
                                <label class="form-label">链接地址 <span class="required">*</span></label>
                                <input type="text" class="form-input" id="externalUrl" placeholder="https://example.com">
                                <span class="form-hint">请输入完整的URL地址，包含 http:// 或 https://</span>
                            </div>
                        </div>
                        
                        <!-- 内部页面 -->
                        <div class="link-tab-content" id="tab-internal">
                            <div class="form-group">
                                <label class="form-label">选择页面 <span class="required">*</span></label>
                                <select class="form-select" id="internalPage">
                                    <option value="">请选择页面</option>
                                    <option value="index.html">首页</option>
                                    <option value="services.html">业务范围</option>
                                    <option value="cases.html">成功案例</option>
                                    <option value="contact.html">联系我们</option>
                                    <option value="news.html">行业资讯</option>
                                    <option value="advantages.html">服务优势</option>
                                    <option value="compliance.html">合规保障</option>
                                    <option value="faq.html">常见问题</option>
                                    <option value="privacy.html">隐私政策</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">锚点（可选）</label>
                                <input type="text" class="form-input" id="internalAnchor" placeholder="例如: #section1">
                            </div>
                        </div>
                        
                        <!-- 通用设置 -->
                        <div class="link-common-settings">
                            <div class="form-group">
                                <label class="form-label">链接文字</label>
                                <input type="text" class="form-input" id="linkText" placeholder="显示的文字">
                            </div>
                            <div class="form-group">
                                <label class="form-checkbox">
                                    <input type="checkbox" id="linkNewWindow" checked>
                                    <span>在新窗口打开</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="form-checkbox">
                                    <input type="checkbox" id="linkNoFollow">
                                    <span>添加 nofollow 属性</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="link-dialog-footer">
                        <button class="btn btn-secondary" id="linkDialogCancel">取消</button>
                        <button class="btn btn-primary" id="linkDialogConfirm">插入链接</button>
                    </div>
                </div>
            </div>
        `;
        
        // 添加样式
        const styleHtml = `
            <style>
                .link-dialog-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0,0,0,0.5);
                    display: none;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                }
                .link-dialog-overlay.show { display: flex; }
                
                .link-dialog {
                    background: white;
                    border-radius: 12px;
                    width: 90%;
                    max-width: 500px;
                    max-height: 90vh;
                    overflow: hidden;
                    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
                }
                
                .link-dialog-header {
                    padding: 16px 20px;
                    border-bottom: 1px solid #e5e7eb;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }
                
                .link-dialog-title {
                    font-size: 18px;
                    font-weight: 600;
                    color: #1f2937;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                }
                
                .link-dialog-title i { color: #3b82f6; }
                
                .link-dialog-close {
                    background: none;
                    border: none;
                    font-size: 20px;
                    color: #6b7280;
                    cursor: pointer;
                    padding: 4px;
                    border-radius: 4px;
                    transition: all 0.2s;
                }
                
                .link-dialog-close:hover {
                    background: #f3f4f6;
                    color: #374151;
                }
                
                .link-dialog-body {
                    padding: 20px;
                    overflow-y: auto;
                    max-height: calc(90vh - 140px);
                }
                
                .link-tabs {
                    display: flex;
                    gap: 8px;
                    margin-bottom: 20px;
                    border-bottom: 1px solid #e5e7eb;
                }
                
                .link-tab {
                    padding: 10px 16px;
                    border: none;
                    background: none;
                    font-size: 14px;
                    color: #6b7280;
                    cursor: pointer;
                    border-bottom: 2px solid transparent;
                    margin-bottom: -1px;
                    transition: all 0.2s;
                }
                
                .link-tab:hover { color: #374151; }
                .link-tab.active { color: #3b82f6; border-bottom-color: #3b82f6; }
                
                .link-tab-content { display: none; }
                .link-tab-content.active { display: block; }
                
                .link-common-settings {
                    margin-top: 20px;
                    padding-top: 20px;
                    border-top: 1px solid #e5e7eb;
                }
                
                .form-group { margin-bottom: 16px; }
                .form-label { display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 6px; }
                .form-label .required { color: #ef4444; }
                .form-input, .form-select {
                    width: 100%;
                    padding: 10px 14px;
                    border: 1px solid #d1d5db;
                    border-radius: 8px;
                    font-size: 14px;
                    transition: all 0.2s;
                }
                .form-input:focus, .form-select:focus {
                    outline: none;
                    border-color: #3b82f6;
                    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                }
                .form-hint { font-size: 12px; color: #6b7280; margin-top: 4px; }
                
                .form-checkbox {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    cursor: pointer;
                    font-size: 14px;
                    color: #374151;
                }
                .form-checkbox input { width: 16px; height: 16px; cursor: pointer; }
                
                .link-dialog-footer {
                    padding: 16px 20px;
                    border-top: 1px solid #e5e7eb;
                    display: flex;
                    justify-content: flex-end;
                    gap: 12px;
                }
                
                .btn {
                    padding: 10px 20px;
                    border-radius: 6px;
                    font-size: 14px;
                    font-weight: 500;
                    cursor: pointer;
                    transition: all 0.2s;
                    border: none;
                }
                .btn-secondary { background: #f3f4f6; color: #374151; }
                .btn-secondary:hover { background: #e5e7eb; }
                .btn-primary { background: #3b82f6; color: white; }
                .btn-primary:hover { background: #2563eb; }
                
                /* TinyMCE 自定义链接按钮 */
                .tox .tox-toolbar__group .tox-tbtn[title="插入/编辑链接"] {
                    position: relative;
                }
            </style>
        `;
        
        // 添加到页面
        document.head.insertAdjacentHTML('beforeend', styleHtml);
        document.body.insertAdjacentHTML('beforeend', dialogHtml);
        
        this.dialog = document.getElementById('linkDialogOverlay');
    }
    
    bindEvents() {
        // 关闭按钮
        document.getElementById('linkDialogClose').addEventListener('click', () => this.close());
        document.getElementById('linkDialogCancel').addEventListener('click', () => this.close());
        
        // 点击遮罩关闭
        this.dialog.addEventListener('click', (e) => {
            if (e.target === this.dialog) this.close();
        });
        
        // 标签切换
        document.querySelectorAll('.link-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.link-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.link-tab-content').forEach(c => c.classList.remove('active'));
                
                tab.classList.add('active');
                document.getElementById(`tab-${tab.dataset.tab}`).classList.add('active');
            });
        });
        
        // 确认按钮
        document.getElementById('linkDialogConfirm').addEventListener('click', () => this.insertLink());
        
        // 回车确认
        this.dialog.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.insertLink();
            }
        });
    }
    
    open(selectedText = '') {
        // 重置表单
        document.getElementById('externalUrl').value = '';
        document.getElementById('internalPage').value = '';
        document.getElementById('internalAnchor').value = '';
        document.getElementById('linkText').value = selectedText;
        document.getElementById('linkNewWindow').checked = true;
        document.getElementById('linkNoFollow').checked = false;
        
        // 重置标签页
        document.querySelectorAll('.link-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.link-tab-content').forEach(c => c.classList.remove('active'));
        document.querySelector('[data-tab="external"]').classList.add('active');
        document.getElementById('tab-external').classList.add('active');
        
        this.dialog.classList.add('show');
        document.getElementById('externalUrl').focus();
    }
    
    close() {
        this.dialog.classList.remove('show');
    }
    
    insertLink() {
        const activeTab = document.querySelector('.link-tab.active').dataset.tab;
        let href = '';
        
        if (activeTab === 'external') {
            href = document.getElementById('externalUrl').value.trim();
            if (!href) {
                alert('请输入链接地址');
                return;
            }
            // 自动添加协议
            if (!href.match(/^https?:\/\//i)) {
                href = 'https://' + href;
            }
        } else {
            const page = document.getElementById('internalPage').value;
            const anchor = document.getElementById('internalAnchor').value.trim();
            if (!page) {
                alert('请选择页面');
                return;
            }
            href = page + anchor;
        }
        
        const text = document.getElementById('linkText').value.trim();
        const newWindow = document.getElementById('linkNewWindow').checked;
        const noFollow = document.getElementById('linkNoFollow').checked;
        
        // 构建链接属性
        let attrs = `href="${href}"`;
        if (newWindow) attrs += ' target="_blank" rel="noopener noreferrer' + (noFollow ? ' nofollow' : '') + '"';
        else if (noFollow) attrs += ' rel="nofollow"';
        
        // 插入链接
        if (this.editor) {
            const linkText = text || href;
            this.editor.insertContent(`<a ${attrs}>${linkText}</a>`);
        }
        
        this.close();
    }
    
    /**
     * 初始化TinyMCE增强
     */
    static enhanceTinyMCE(editor) {
        // 替换默认的链接按钮行为
        editor.ui.registry.addButton('enhancedLink', {
            icon: 'link',
            tooltip: '插入/编辑链接',
            onAction: () => {
                const selectedText = editor.selection.getContent({ format: 'text' });
                const linkDialog = new LinkDialog(editor);
                linkDialog.open(selectedText);
            }
        });
        
        // 添加快捷键
        editor.shortcuts.add('meta+k', '插入链接', () => {
            const selectedText = editor.selection.getContent({ format: 'text' });
            const linkDialog = new LinkDialog(editor);
            linkDialog.open(selectedText);
        });
    }
}

// 全局初始化函数
function initEnhancedLink(editor) {
    LinkDialog.enhanceTinyMCE(editor);
}

// 导出
if (typeof module !== 'undefined' && module.exports) {
    module.exports = LinkDialog;
}
