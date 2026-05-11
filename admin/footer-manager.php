<?php
/**
 * 页脚管理 - 后台管理页面
 * 
 * === 部署步骤 ===
 * 1. 确保 database 表已建：访问 admin/api/footer-data.php 自动建表
 * 2. 左侧导航栏添加入口：<a href="footer-manager.php" class="cms-nav-item" data-section="footer"><i class="fas fa-list-alt"></i><span>页脚管理</span></a>
 * 3. 所有前台页面 footer 替换为：<?php include 'includes/footer.php'; ?>
 * 4. 编码：UTF-8 (无BOM)
 * 
 * === 功能 ===
 * - 按分组展示可编辑项
 * - 品牌简介/联系方式/底部版权：直接编辑保存
 * - 快速链接/业务链接：支持添加/删除行
 * - 保存到MySQL footer_settings 表
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>页脚管理 - CMS管理后台</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #3b82f6;
            --sidebar-text: #cbd5e1;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border: #e5e7eb;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: var(--body-bg);
            min-height: 100vh;
            display: flex;
        }

        .cms-layout { display: flex; width: 100%; min-height: 100vh; }

        .cms-sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            flex-shrink: 0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            overflow-y: auto;
        }

        .cms-sidebar-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .cms-sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 18px;
            font-weight: 700;
        }

        .cms-sidebar-brand i { color: var(--sidebar-active); }

        .cms-sidebar-nav { padding: 16px 0; }

        .cms-nav-section { margin-bottom: 8px; }

        .cms-nav-title {
            padding: 12px 24px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
        }

        .cms-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .cms-nav-item:hover { background: var(--sidebar-hover); color: white; }
        .cms-nav-item.active { background: var(--sidebar-active); color: white; }
        .cms-nav-item i { width: 20px; text-align: center; }

        .cms-main {
            flex: 1;
            margin-left: 260px;
            min-height: 100vh;
        }

        .cms-header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .cms-header-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cms-header-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        .cms-header-btn:hover { background: linear-gradient(135deg, #1e40af, #2563eb); }
        .cms-header-btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .cms-content { padding: 24px; max-width: 1100px; }

        /* 卡片样式 */
        .footer-card {
            background: var(--card-bg);
            border-radius: 8px;
            border: 1px solid var(--border);
            padding: 24px;
            margin-bottom: 20px;
        }

        .footer-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .footer-card-header i {
            font-size: 22px;
            color: var(--primary);
        }

        .footer-card-header h3 { font-size: 16px; color: var(--text-primary); }

        /* 表单 */
        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }
        .form-input, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: inherit;
        }
        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .form-textarea { resize: vertical; min-height: 80px; }

        /* 链接列表 */
        .link-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }
        .link-row:last-child { border-bottom: none; }
        .link-row .link-text-input { flex: 1; min-width: 120px; }
        .link-row .link-url-input { flex: 1.5; min-width: 150px; }
        .link-row .link-drag { color: #9ca3af; cursor: move; }
        .link-row .link-delete-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            background: #fef2f2;
            color: var(--danger);
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }
        .link-row .link-delete-btn:hover { background: #fee2e2; }

        .add-link-btn {
            margin-top: 12px;
            padding: 8px 16px;
            border: 1px dashed var(--primary);
            border-radius: 6px;
            background: transparent;
            color: var(--primary);
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }
        .add-link-btn:hover { background: #eff6ff; }

        /* 按钮 */
        .action-bar {
            margin-top: 24px;
            padding: 20px 0;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
        }
        .btn-primary:hover { background: linear-gradient(135deg, #1e40af, #2563eb); }

        .btn-outline {
            background: white;
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { background: #f9fafb; }

        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* Toast 提示 */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 14px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            z-index: 9999;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .toast.show { opacity: 1; transform: translateY(0); }
        .toast-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .toast-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* 联系方式项 */
        .contact-field {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
        }
        .contact-field .contact-icon {
            width: 32px;
            color: var(--primary);
            text-align: center;
        }
        .contact-field .form-input { flex: 1; }

        /* 标签 */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
        }
        .badge-info { background: #eff6ff; color: #3b82f6; }
    </style>
</head>
<body>
    <div class="cms-layout">
        <!-- 侧边栏 -->
        <aside class="cms-sidebar">
            <div class="cms-sidebar-header">
                <div class="cms-sidebar-brand">
                    <i class="fas fa-cog"></i>
                    <span>CMS管理后台</span>
                </div>
            </div>
            <nav class="cms-sidebar-nav">
                <div class="cms-nav-section">
                    <div class="cms-nav-title">主要</div>
                    <a href="dashboard.html" class="cms-nav-item"><i class="fas fa-home"></i><span>仪表板</span></a>
                    <a href="logo-settings.html" class="cms-nav-item"><i class="fas fa-image"></i><span>Logo设置</span></a>
                    <a href="case-management.html" class="cms-nav-item"><i class="fas fa-trophy"></i><span>案例管理</span></a>
                    <a href="index.html" class="cms-nav-item"><i class="fas fa-file-alt"></i><span>页面管理</span></a>
                    <a href="nav-management.html" class="cms-nav-item"><i class="fas fa-bars"></i><span>导航菜单</span></a>
                    <a href="components/news/article-list.html" class="cms-nav-item"><i class="fas fa-newspaper"></i><span>文章管理</span></a>
                    <a href="faq-management.html" class="cms-nav-item"><i class="fas fa-question-circle"></i><span>FAQ管理</span></a>
                    <a href="seo-settings.html" class="cms-nav-item"><i class="fas fa-search"></i><span>SEO设置</span></a>
                    <a href="footer-manager.php" class="cms-nav-item active" data-section="footer"><i class="fas fa-list-alt"></i><span>页脚管理</span></a>
                </div>
            </nav>
        </aside>

        <!-- 主内容区 -->
        <main class="cms-main">
            <header class="cms-header">
                <div class="cms-header-left">
                    <h1 class="cms-header-title">
                        <i class="fas fa-list-alt" style="color:#3b82f6;"></i> 页脚管理
                    </h1>
                </div>
                <button class="cms-header-btn" onclick="saveAllFooter()" id="btn-save-all">
                    <i class="fas fa-save"></i> 保存所有设置
                </button>
            </header>

            <div class="cms-content" id="appContent">
                <!-- Brand -->
                <div class="footer-card" data-group="brand">
                    <div class="footer-card-header">
                        <i class="fas fa-building"></i>
                        <div>
                            <h3>品牌简介</h3>
                            <span class="badge badge-info">brand</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">企业简介文案</label>
                        <textarea class="form-textarea footer-field" data-group="brand" data-key="company_desc" placeholder="请输入企业简介文案">加载中...</textarea>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-card" data-group="quick_links">
                    <div class="footer-card-header">
                        <i class="fas fa-link"></i>
                        <div>
                            <h3>快速链接</h3>
                            <span class="badge badge-info">quick_links</span>
                        </div>
                    </div>
                    <div id="quickLinksContainer">
                        <!-- 由JS动态渲染 -->
                    </div>
                    <button class="add-link-btn" onclick="addLinkRow('quick_links')"><i class="fas fa-plus"></i> 添加链接</button>
                </div>

                <!-- Service Links -->
                <div class="footer-card" data-group="service_links">
                    <div class="footer-card-header">
                        <i class="fas fa-briefcase"></i>
                        <div>
                            <h3>业务链接</h3>
                            <span class="badge badge-info">service_links</span>
                        </div>
                    </div>
                    <div id="serviceLinksContainer">
                        <!-- 由JS动态渲染 -->
                    </div>
                    <button class="add-link-btn" onclick="addLinkRow('service_links')"><i class="fas fa-plus"></i> 添加链接</button>
                </div>

                <!-- Contact -->
                <div class="footer-card" data-group="contact">
                    <div class="footer-card-header">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h3>联系方式</h3>
                            <span class="badge badge-info">contact</span>
                        </div>
                    </div>
                    <div id="contactContainer">
                        <!-- 由JS动态渲染 -->
                    </div>
                </div>

                <!-- Bottom -->
                <div class="footer-card" data-group="bottom">
                    <div class="footer-card-header">
                        <i class="fas fa-copyright"></i>
                        <div>
                            <h3>底部版权 &amp; 免责</h3>
                            <span class="badge badge-info">bottom</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">版权声明文字</label>
                        <input type="text" class="form-input footer-field" data-group="bottom" data-key="copyright_text" placeholder="请输入版权声明">
                    </div>
                    <div class="form-group">
                        <label class="form-label">风险提示免责文案</label>
                        <textarea class="form-textarea footer-field" data-group="bottom" data-key="disclaimer_text" placeholder="请输入免责文案"></textarea>
                    </div>
                </div>

                <div class="action-bar">
                    <button class="btn btn-outline" onclick="loadFooterData()"><i class="fas fa-undo"></i> 重置</button>
                    <button class="btn btn-primary" onclick="saveAllFooter()"><i class="fas fa-save"></i> 保存所有设置</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast"></div>

<script>
const API_BASE = 'api';
let footerData = {}; // grouped data

document.addEventListener('DOMContentLoaded', function() {
    loadFooterData();
});

function loadFooterData() {
    const btn = document.getElementById('btn-save-all');
    btn.innerHTML = '<span class="loading-spinner"></span> 加载中...';
    btn.disabled = true;

    fetch(API_BASE + '/footer-data.php?t=' + Date.now())
        .then(r => r.json())
        .then(res => {
            btn.innerHTML = '<i class="fas fa-save"></i> 保存所有设置';
            btn.disabled = false;

            if (res.code === 0) {
                footerData = res.grouped || {};
                renderAll();
            } else {
                showToast('加载失败: ' + (res.msg || '未知错误'), 'error');
            }
        })
        .catch(err => {
            btn.innerHTML = '<i class="fas fa-save"></i> 保存所有设置';
            btn.disabled = false;
            showToast('加载失败: ' + err.message, 'error');
        });
}

function renderAll() {
    // Brand
    renderTextField('brand', 'company_desc');

    // Quick Links
    renderLinkGroup('quick_links', 'quickLinksContainer');

    // Service Links
    renderLinkGroup('service_links', 'serviceLinksContainer');

    // Contact
    renderContact();

    // Bottom
    renderTextField('bottom', 'copyright_text', 'input');
    renderTextField('bottom', 'disclaimer_text', 'textarea');
}

function renderTextField(group, key, type) {
    const el = document.querySelector(`.footer-field[data-group="${group}"][data-key="${key}"]`);
    if (!el) return;
    const items = footerData[group] || [];
    const item = items.find(i => i.item_key === key);
    el.value = item ? (item.item_value || '') : '';
}

function renderLinkGroup(group, containerId) {
    const container = document.getElementById(containerId);
    const items = footerData[group] || [];
    if (items.length === 0) {
        container.innerHTML = '<div style="text-align:center;padding:24px;color:#9ca3af;">暂无数据</div>';
        return;
    }
    container.innerHTML = items.map(item => {
        const label = item.item_value || item.item_label || '';
        const url = item.item_url || '';
        const id = item.id || 0;
        const itemKey = item.item_key || '';
        return `
            <div class="link-row" data-id="${id}" data-group="${group}" data-key="${itemKey}">
                <span class="link-drag"><i class="fas fa-grip-vertical"></i></span>
                <input type="text" class="form-input link-text-input" value="${escapeHtml(label)}" placeholder="导航文字" data-field="label">
                <input type="text" class="form-input link-url-input" value="${escapeHtml(url)}" placeholder="链接URL" data-field="url">
                <button class="link-delete-btn" onclick="deleteLinkRow(this)"><i class="fas fa-trash"></i> 删除</button>
            </div>
        `;
    }).join('');
}

function renderContact() {
    const container = document.getElementById('contactContainer');
    const items = footerData['contact'] || [];
    if (items.length === 0) {
        container.innerHTML = '<div style="text-align:center;padding:24px;color:#9ca3af;">暂无数据</div>';
        return;
    }

    const iconMap = {
        'phone': 'fa-phone',
        'contact_person': 'fa-user',
        'email': 'fa-envelope'
    };

    container.innerHTML = items.map(item => {
        const icon = iconMap[item.item_key] || 'fa-info-circle';
        const label = item.item_label || item.item_key;
        const value = item.item_value || '';
        return `
            <div class="contact-field">
                <span class="contact-icon"><i class="fas ${icon}"></i></span>
                <span style="min-width:60px;font-size:14px;color:#374151;">${label}</span>
                <input type="text" class="form-input footer-field" data-group="contact" data-key="${item.item_key}" value="${escapeHtml(value)}" placeholder="请输入${label}">
            </div>
        `;
    }).join('');
}

function addLinkRow(group) {
    // 生成临时 item_key
    const ts = Date.now();
    const itemKey = 'link_' + ts;
    const containerId = group === 'quick_links' ? 'quickLinksContainer' : 'serviceLinksContainer';
    const container = document.getElementById(containerId);

    const div = document.createElement('div');
    div.className = 'link-row';
    div.dataset.id = '0';
    div.dataset.group = group;
    div.dataset.key = itemKey;
    div.innerHTML = `
        <span class="link-drag"><i class="fas fa-grip-vertical"></i></span>
        <input type="text" class="form-input link-text-input" value="" placeholder="导航文字" data-field="label">
        <input type="text" class="form-input link-url-input" value="" placeholder="链接URL" data-field="url">
        <button class="link-delete-btn" onclick="deleteLinkRow(this)"><i class="fas fa-trash"></i> 删除</button>
    `;

    // 如果是空状态，替换内容
    const emptyMsg = container.querySelector('div[style*="text-align:center"]');
    if (emptyMsg) {
        container.innerHTML = '';
    }
    container.appendChild(div);
}

function deleteLinkRow(btn) {
    const row = btn.closest('.link-row');
    if (row) {
        row.remove();
    }
}

function saveAllFooter() {
    const btn = document.getElementById('btn-save-all');
    btn.innerHTML = '<span class="loading-spinner"></span> 保存中...';
    btn.disabled = true;

    const settings = [];

    // 收集各分组数据
    const groups = ['brand', 'quick_links', 'service_links', 'contact', 'bottom'];

    groups.forEach(group => {
        const items = footerData[group] || [];

        if (group === 'brand' || group === 'bottom') {
            // 普通字段
            const fields = document.querySelectorAll(`.footer-field[data-group="${group}"]`);
            fields.forEach(el => {
                const key = el.dataset.key;
                const value = el.value;
                const existing = items.find(i => i.item_key === key);
                settings.push({
                    group_key: group,
                    item_key: key,
                    item_label: existing ? (existing.item_label || key) : key,
                    item_value: value,
                    item_url: '',
                    sort_order: existing ? (existing.sort_order || 0) : 0
                });
            });
        } else if (group === 'contact') {
            // 联系方式
            const fields = document.querySelectorAll(`.footer-field[data-group="${group}"]`);
            fields.forEach(el => {
                const key = el.dataset.key;
                const value = el.value;
                const existing = items.find(i => i.item_key === key);
                settings.push({
                    group_key: group,
                    item_key: key,
                    item_label: existing ? (existing.item_label || key) : key,
                    item_value: value,
                    item_url: '',
                    sort_order: existing ? (existing.sort_order || 0) : 0
                });
            });
        } else if (group === 'quick_links' || group === 'service_links') {
            // 链接列表
            const rows = document.querySelectorAll(`#${group === 'quick_links' ? 'quickLinksContainer' : 'serviceLinksContainer'} .link-row`);
            let idx = 1;
            rows.forEach(row => {
                const itemKey = row.dataset.key || ('link_' + Date.now() + '_' + idx);
                const labelInput = row.querySelector('.link-text-input');
                const urlInput = row.querySelector('.link-url-input');
                const label = labelInput ? labelInput.value.trim() : '';
                const url = urlInput ? urlInput.value.trim() : '';

                if (label || url) {
                    settings.push({
                        group_key: group,
                        item_key: itemKey,
                        item_label: label || '未命名链接',
                        item_value: label || '未命名链接',
                        item_url: url,
                        sort_order: idx
                    });
                    idx++;
                }
            });
        }
    });

    fetch(API_BASE + '/footer-save.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'save_all', settings: settings })
    })
    .then(r => r.json())
    .then(res => {
        btn.innerHTML = '<i class="fas fa-save"></i> 保存所有设置';
        btn.disabled = false;

        if (res.code === 0) {
            showToast('页脚设置保存成功', 'success');
            loadFooterData();
        } else {
            showToast('保存失败: ' + (res.msg || '未知错误'), 'error');
        }
    })
    .catch(err => {
        btn.innerHTML = '<i class="fas fa-save"></i> 保存所有设置';
        btn.disabled = false;
        showToast('保存失败: ' + err.message, 'error');
    });
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function showToast(msg, type) {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.className = 'toast toast-' + type + ' show';
    setTimeout(() => toast.classList.remove('show'), 3000);
}
</script>
</body>
</html>
