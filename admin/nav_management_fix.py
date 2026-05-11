# -*- coding: utf-8 -*-
import os, shutil

base = r'D:\yingyong\xampp\htdocs\hongdu\admin'
filepath = os.path.join(base, 'nav-management.html')
bakpath = filepath + '.bak'
shutil.copy2(filepath, bakpath)
print('备份已保存:', bakpath)

with open(filepath, 'r', encoding='utf-8') as f:
    html = f.read()

# ==== 修改 loadNavItems ====
# 原: load from localStorage -> async load from API
old_loadNav = """        // 加载导航菜单项
        function loadNavItems() {
            const stored = localStorage.getItem('cms_nav_items');
            
            if (stored) {
                navItems = JSON.parse(stored);
                renderNavItems();
            } else {
                // 初始化默认导航项
                navItems = [
                    { id: '1', name: '\\u9996\\u9875', url: 'index.html', icon: 'fas fa-home' },
                    { id: '2', name: '\\u4e1a\\u52a1\\u8303\\u56f4', url: 'services.html', icon: 'fas fa-cogs' },
                    { id: '3', name: '\\u6210\\u529f\\u6848\\u4f8b', url: 'cases.html', icon: 'fas fa-trophy' },
                    { id: '4', name: '\\u65b0\\u95fb\\u52a8\\u6001', url: 'news.html', icon: 'fas fa-newspaper' },
                    { id: '5', name: '\\u5173\\u4e8e\\u6211\\u4eec', url: 'about.html', icon: 'fas fa-info-circle' },
                    { id: '6', name: '\\u8054\\u7cfb\\u6211\\u4eec', url: 'contact.html', icon: 'fas fa-envelope' }
                ];
                localStorage.setItem('cms_nav_items', JSON.stringify(navItems));
                renderNavItems();
            }
        }"""

new_loadNav = """        // 加载导航菜单项（从数据库）
        function loadNavItems() {
            fetch('/hongduadmin/api/nav-save.php?type=nav')
                .then(res => res.json())
                .then(result => {
                    if (result.code === 0 && result.data) {
                        navItems = result.data;
                    } else {
                        navItems = [];
                    }
                    renderNavItems();
                })
                .catch(err => {
                    console.error('加载导航失败:', err);
                    navItems = [];
                    renderNavItems();
                });
        }"""

html = html.replace(old_loadNav, new_loadNav)

# ==== 修改 saveNav ====
# 原来先改内存数组再写 localStorage -> 现在调 API 然后刷新
old_saveNav = """        // 保存菜单项
        function saveNav() {
            const id = document.getElementById('navId').value;
            const name = document.getElementById('navName').value.trim();
            const url = document.getElementById('navUrl').value.trim();
            const icon = document.getElementById('navIcon').value.trim() || 'fas fa-home';

            if (!name || !url) {
                showToast('\\u8bf7\\u586b\\u5199\\u83dc\\u5355\\u540d\\u79f0\\u548c\\u94fe\\u63a5\\u5730\\u5740', 'error');
                return;
            }

            if (id) {
                // 编辑现有项
                const index = navItems.findIndex(item => item.id === id);
                if (index !== -1) {
                    navItems[index] = { id, name, url, icon };
                }
            } else {
                // 添加新项
                const newId = Date.now().toString();
                navItems.push({ id: newId, name, url, icon });
            }

            localStorage.setItem('cms_nav_items', JSON.stringify(navItems));
            closeModal();
            renderNavItems();
            showToast('\\u4fdd\\u5b58\\u6210\\u529f');
        }"""

new_saveNav = """        // 保存菜单项（通过API）
        function saveNav() {
            const id = document.getElementById('navId').value;
            const name = document.getElementById('navName').value.trim();
            const url = document.getElementById('navUrl').value.trim();
            const icon = document.getElementById('navIcon').value.trim() || 'fas fa-home';

            if (!name || !url) {
                showToast('\\u8bf7\\u586b\\u5199\\u83dc\\u5355\\u540d\\u79f0\\u548c\\u94fe\\u63a5\\u5730\\u5740', 'error');
                return;
            }

            const payload = {
                action: 'save',
                type: 'nav',
                item_id: id || '',
                name: name,
                url: url,
                icon: icon
            };

            fetch('/hongduadmin/api/nav-save.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(result => {
                if (result.code === 0) {
                    closeModal();
                    loadNavItems();
                    showToast('\\u4fdd\\u5b58\\u6210\\u529f');
                } else {
                    showToast(result.msg || '\\u4fdd\\u5b58\\u5931\\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\\u4fdd\\u5b58\\u5931\\u8d25: ' + err.message, 'error');
            });
        }"""

html = html.replace(old_saveNav, new_saveNav)

# ==== 修改 deleteNav ====
old_deleteNav = """        // 删除菜单项
        function deleteNav(id) {
            if (!confirm('\\u786e\\u5b9a\\u8981\\u5220\\u9664\\u8fd9\\u4e2a\\u83dc\\u5355\\u5417\\uff1f')) return;

            navItems = navItems.filter(item => item.id !== id);
            localStorage.setItem('cms_nav_items', JSON.stringify(navItems));
            renderNavItems();
            showToast('\\u83dc\\u5355\\u5df2\\u5220\\u9664');
        }"""

new_deleteNav = """        // 删除菜单项（通过API）
        function deleteNav(id) {
            if (!confirm('\\u786e\\u5b9a\\u8981\\u5220\\u9664\\u8fd9\\u4e2a\\u83dc\\u5355\\u5417\\uff1f')) return;

            fetch('/hongduadmin/api/nav-save.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'delete',
                    type: 'nav',
                    item_id: id
                })
            })
            .then(res => res.json())
            .then(result => {
                if (result.code === 0) {
                    loadNavItems();
                    showToast('\\u83dc\\u5355\\u5df2\\u5220\\u9664');
                } else {
                    showToast(result.msg || '\\u5220\\u9664\\u5931\\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\\u5220\\u9664\\u5931\\u8d25: ' + err.message, 'error');
            });
        }"""

html = html.replace(old_deleteNav, new_deleteNav)

# ==== 修改 loadComponents ====
old_loadComp = """        // 加载组件列表
        function loadComponents() {
            const stored = localStorage.getItem('cms_components');
            
            if (stored) {
                components = JSON.parse(stored);
                renderComponents();
            } else {
                // 初始化默认组件
                components = [
                    { id: '1', name: '\\u5e95\\u90e8\\u5bfc\\u822a\\u680f', type: 'basic', icon: 'fas fa-bars', html: '<div class=\\"footer-menu\\"><ul><li><a href=\\"index.html\\">\\u9996\\u9875</a></li><li><a href=\\"services.html\\">\\u4e1a\\u52a1\\u8303\\u56f4</a></li></ul></div>' },
                    { id: '2', name: '\\u8054\\u7cfb\\u4fe1\\u606f\\u6a21\\u5757', type: 'basic', icon: 'fas fa-address-card', html: '<div class=\\"contact-info\\"><p>\\u7535\\u8bdd: 13552883008</p><p>\\u90ae\\u7bb1: contact@example.com</p></div>' }
                ];
                localStorage.setItem('cms_components', JSON.stringify(components));
                renderComponents();
            }
        }"""

new_loadComp = """        // 加载组件列表（从数据库）
        function loadComponents() {
            fetch('/hongduadmin/api/nav-save.php?type=component')
                .then(res => res.json())
                .then(result => {
                    if (result.code === 0 && result.data) {
                        components = result.data;
                    } else {
                        components = [];
                    }
                    renderComponents();
                })
                .catch(err => {
                    console.error('\\u52a0\\u8f7d\\u7ec4\\u4ef6\\u5931\\u8d25:', err);
                    components = [];
                    renderComponents();
                });
        }"""

html = html.replace(old_loadComp, new_loadComp)

# ==== 修改 saveComponent ====
old_saveComp = """        // 保存组件
        function saveComponent() {
            const name = document.getElementById('componentName').value.trim();
            const type = document.getElementById('componentType').value;
            const icon = document.getElementById('componentIcon').value.trim() || 'fas fa-cube';
            const html = document.getElementById('componentHtml').value.trim();

            if (!name || !html) {
                showToast('\\u8bf7\\u586b\\u5199\\u7ec4\\u4ef6\\u540d\\u79f0\\u548cHTML\\u4ee3\\u7801', 'error');
                return;
            }

            if (editingComponentId) {
                const index = components.findIndex(c => c.id === editingComponentId);
                if (index !== -1) {
                    components[index] = { id: editingComponentId, name, type, icon, html };
                }
            } else {
                const newId = Date.now().toString();
                components.push({ id: newId, name, type, icon, html });
            }

            localStorage.setItem('cms_components', JSON.stringify(components));
            closeComponentModal();
            renderComponents();
            showToast('\\u7ec4\\u4ef6\\u4fdd\\u5b58\\u6210\\u529f');
        }"""

new_saveComp = """        // 保存组件（通过API）
        function saveComponent() {
            const name = document.getElementById('componentName').value.trim();
            const itemType = document.getElementById('componentType').value;
            const icon = document.getElementById('componentIcon').value.trim() || 'fas fa-cube';
            const html = document.getElementById('componentHtml').value.trim();

            if (!name || !html) {
                showToast('\\u8bf7\\u586b\\u5199\\u7ec4\\u4ef6\\u540d\\u79f0\\u548cHTML\\u4ee3\\u7801', 'error');
                return;
            }

            const payload = {
                action: 'save',
                type: 'component',
                item_id: editingComponentId || '',
                name: name,
                item_type: itemType,
                icon: icon,
                html: html
            };

            fetch('/hongduadmin/api/nav-save.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(result => {
                if (result.code === 0) {
                    closeComponentModal();
                    loadComponents();
                    showToast('\\u7ec4\\u4ef6\\u4fdd\\u5b58\\u6210\\u529f');
                } else {
                    showToast(result.msg || '\\u4fdd\\u5b58\\u5931\\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\\u4fdd\\u5b58\\u5931\\u8d25: ' + err.message, 'error');
            });
        }"""

html = html.replace(old_saveComp, new_saveComp)

# ==== 修改 deleteComponent ====
old_deleteComp = """        // 删除组件
        function deleteComponent(id) {
            if (!confirm('\\u786e\\u5b9a\\u8981\\u5220\\u9664\\u8fd9\\u4e2a\\u7ec4\\u4ef6\\u5417\\uff1f')) return;

            components = components.filter(c => c.id !== id);
            localStorage.setItem('cms_components', JSON.stringify(components));
            renderComponents();
            showToast('\\u7ec4\\u4ef6\\u5220\\u9664\\u6210\\u529f');
        }"""

new_deleteComp = """        // 删除组件（通过API）
        function deleteComponent(id) {
            if (!confirm('\\u786e\\u5b9a\\u8981\\u5220\\u9664\\u8fd9\\u4e2a\\u7ec4\\u4ef6\\u5417\\uff1f')) return;

            fetch('/hongduadmin/api/nav-save.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'delete',
                    type: 'component',
                    item_id: id
                })
            })
            .then(res => res.json())
            .then(result => {
                if (result.code === 0) {
                    loadComponents();
                    showToast('\\u7ec4\\u4ef6\\u5df2\\u5220\\u9664');
                } else {
                    showToast(result.msg || '\\u5220\\u9664\\u5931\\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\\u5220\\u9664\\u5931\\u8d25: ' + err.message, 'error');
            });
        }"""

html = html.replace(old_deleteComp, new_deleteComp)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(html)

print('nav-management.html 修改完成')

# ==== 验证 ====
import re
# 检查除 cms_logged_in, cms_username 外的 localStorage
ls_matches = re.findall(r'localStorage\.(getItem|setItem|removeItem)\([^)]+\)', html)
allowed = {'cms_logged_in', 'cms_username'}
remaining = []
for m in re.findall(r'localStorage\.(?:getItem|setItem|removeItem)\([\'\"]?(cms_[^)\'\"]+)[\'\"]?\)', html):
    key = m.strip("'").strip('"')
    if key not in allowed:
        remaining.append(key)

if remaining:
    print('警告: 仍存在以下 localStorage 键:', set(remaining))
else:
    print('验证通过: 除 cms_logged_in / cms_username 外无多余 localStorage')
