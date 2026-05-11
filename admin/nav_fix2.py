# -*- coding: utf-8 -*-
import os, re, shutil

base = r'D:\yingyong\xampp\htdocs\hongdu\admin'
filepath = os.path.join(base, 'nav-management.html')
bakpath = filepath + '.bak'

# Restore from bak if exists
if os.path.exists(bakpath) and not os.path.exists(filepath):
    shutil.copy2(bakpath, filepath)

# Save bak
shutil.copy2(filepath, bakpath)
print('Backup saved:', bakpath)

with open(filepath, 'r', encoding='utf-8') as f:
    html = f.read()

# ---- loadNavItems ----
old = '''        function loadNavItems() {
            const stored = localStorage.getItem('cms_nav_items');
            navItems = stored ? JSON.parse(stored) : [...defaultNavItems];
            renderNavItems();
        }'''
new = '''        function loadNavItems() {
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
                    console.error('\u52a0\u8f7d\u5bfc\u822a\u5931\u8d25:', err);
                    navItems = [];
                    renderNavItems();
                });
        }'''
assert old in html, 'FAIL: loadNavItems not found'
html = html.replace(old, new)
print('OK: loadNavItems replaced')

# ---- saveNav ----
old = '''        function saveNav() {
            const name = document.getElementById('navName').value.trim();
            const url = document.getElementById('navUrl').value.trim();
            const icon = document.getElementById('navIcon').value.trim();

            if (!name || !url) {
                showToast('\u8bf7\u586b\u5199\u83dc\u5355\u540d\u79f0\u548c\u94fe\u63a5\u5730\u5740', 'error');
                return;
            }

            if (editingId) {
                // \u7f16\u8f91
                const index = navItems.findIndex(n => n.id === editingId);
                if (index !== -1) {
                    navItems[index] = { id: editingId, name, url, icon };
                }
            } else {
                // \u65b0\u589e
                const newId = Date.now().toString();
                navItems.push({ id: newId, name, url, icon });
            }

            localStorage.setItem('cms_nav_items', JSON.stringify(navItems));
            closeModal();
            renderNavItems();
            showToast('\u4fdd\u5b58\u6210\u529f');
        }'''
new = '''        function saveNav() {
            const name = document.getElementById('navName').value.trim();
            const url = document.getElementById('navUrl').value.trim();
            const iconElement = document.getElementById('navIcon');
            const icon = iconElement ? iconElement.value.trim() : '';

            if (!name || !url) {
                showToast('\u8bf7\u586b\u5199\u83dc\u5355\u540d\u79f0\u548c\u94fe\u63a5\u5730\u5740', 'error');
                return;
            }

            const payload = {
                action: 'save',
                type: 'nav',
                item_id: editingId || '',
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
                    showToast('\u4fdd\u5b58\u6210\u529f');
                } else {
                    showToast(result.msg || '\u4fdd\u5b58\u5931\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\u4fdd\u5b58\u5931\u8d25: ' + err.message, 'error');
            });
        }'''
assert old in html, 'FAIL: saveNav not found'
html = html.replace(old, new)
print('OK: saveNav replaced')

# ---- deleteNav ----
old = '''        async function deleteNav(id) {
            if (!window.confirm('\u786e\u5b9a\u8981\u5220\u9664\u8fd9\u4e2a\u83dc\u5355\u9879\u5417?')) return;

            const item = navItems.find(n => n.id === id);
            if (!item) return;

            // \u83b7\u53d6\u9875\u9762ID\uff08\u4eceURL\u4e2d\u63d0\u53d6\uff0c\u53bb\u6389.html\u540e\u7f00\uff09
            const pageId = item.url.replace('.html', '');

            try {
                // \u8c03\u7528\u540e\u7aefAPI\u5220\u9664\u9875\u9762
                const response = await fetch('api/delete-page.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'pageId=' + encodeURIComponent(pageId)
                });

                const result = await response.json();
                
                if (result.success) {
                    // \u4ece\u672c\u5730\u5217\u8868\u4e2d\u79fb\u9664
                    navItems = navItems.filter(n => n.id !== id);
                    localStorage.setItem('cms_nav_items', JSON.stringify(navItems));
                    renderNavItems();
                    showToast('\u5220\u9664\u6210\u529f');
                } else {
                    showToast('\u5220\u9664\u5931\u8d25: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('\u5220\u9664\u8bf7\u6c42\u5931\u8d25:', error);
                // \u5373\u4f7fAPI\u8c03\u7528\u5931\u8d25\uff0c\u4e5f\u4ece\u672c\u5730\u5217\u8868\u4e2d\u79fb\u9664
                navItems = navItems.filter(n => n.id !== id);
                localStorage.setItem('cms_nav_items', JSON.stringify(navItems));
                renderNavItems();
                showToast('\u5df2\u4ece\u672c\u5730\u5217\u8868\u5220\u9664');
            }
        }'''
new = '''        function deleteNav(id) {
            if (!window.confirm('\u786e\u5b9a\u8981\u5220\u9664\u8fd9\u4e2a\u83dc\u5355\u9879\u5417?')) return;

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
                    showToast('\u5bfc\u822a\u5df2\u5220\u9664');
                } else {
                    showToast(result.msg || '\u5220\u9664\u5931\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\u5220\u9664\u5931\u8d25: ' + err.message, 'error');
            });
        }'''
assert old in html, 'FAIL: deleteNav not found'
html = html.replace(old, new)
print('OK: deleteNav replaced')

# ---- loadComponents ----
old = '''        function loadComponents() {
            const stored = localStorage.getItem('cms_components');
            components = stored ? JSON.parse(stored) : [...defaultComponents];
            renderComponents();
        }'''
new = '''        function loadComponents() {
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
                    console.error('\u52a0\u8f7d\u7ec4\u4ef6\u5931\u8d25:', err);
                    components = [];
                    renderComponents();
                });
        }'''
assert old in html, 'FAIL: loadComponents not found'
html = html.replace(old, new)
print('OK: loadComponents replaced')

# ---- saveComponent ----
old = '''        function saveComponent() {
            const name = document.getElementById('componentName').value.trim();
            const type = document.getElementById('componentType').value;
            const icon = document.getElementById('componentIcon').value.trim() || 'fas fa-cube';
            const html = document.getElementById('componentHtml').value.trim();

            if (!name || !html) {
                showToast('\u8bf7\u586b\u5199\u7ec4\u4ef6\u540d\u79f0\u548cHTML\u4ee3\u7801', 'error');
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
            showToast('\u7ec4\u4ef6\u4fdd\u5b58\u6210\u529f');
        }'''
new = '''        function saveComponent() {
            const name = document.getElementById('componentName').value.trim();
            const itemType = document.getElementById('componentType').value;
            const icon = document.getElementById('componentIcon').value.trim() || 'fas fa-cube';
            const compHtml = document.getElementById('componentHtml').value.trim();

            if (!name || !compHtml) {
                showToast('\u8bf7\u586b\u5199\u7ec4\u4ef6\u540d\u79f0\u548cHTML\u4ee3\u7801', 'error');
                return;
            }

            const payload = {
                action: 'save',
                type: 'component',
                item_id: editingComponentId || '',
                name: name,
                item_type: itemType,
                icon: icon,
                html: compHtml
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
                    showToast('\u7ec4\u4ef6\u4fdd\u5b58\u6210\u529f');
                } else {
                    showToast(result.msg || '\u4fdd\u5b58\u5931\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\u4fdd\u5b58\u5931\u8d25: ' + err.message, 'error');
            });
        }'''
assert old in html, 'FAIL: saveComponent not found'
html = html.replace(old, new)
print('OK: saveComponent replaced')

# ---- deleteComponent ----
old = '''        function deleteComponent(id) {
            if (!confirm('\u786e\u5b9a\u8981\u5220\u9664\u8fd9\u4e2a\u7ec4\u4ef6\u5417\uff1f')) return;

            components = components.filter(c => c.id !== id);
            localStorage.setItem('cms_components', JSON.stringify(components));
            renderComponents();
            showToast('\u7ec4\u4ef6\u5220\u9664\u6210\u529f');
        }'''
new = '''        function deleteComponent(id) {
            if (!confirm('\u786e\u5b9a\u8981\u5220\u9664\u8fd9\u4e2a\u7ec4\u4ef6\u5417\uff1f')) return;

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
                    showToast('\u7ec4\u4ef6\u5df2\u5220\u9664');
                } else {
                    showToast(result.msg || '\u5220\u9664\u5931\u8d25', 'error');
                }
            })
            .catch(err => {
                showToast('\u5220\u9664\u5931\u8d25: ' + err.message, 'error');
            });
        }'''
assert old in html, 'FAIL: deleteComponent not found'
html = html.replace(old, new)
print('OK: deleteComponent replaced')

# ---- Verify no remaining unauthorized localStorage ----
ls_keys = re.findall(r"localStorage\.\w+\(['\"](cms_[^)'\"]+)['\"]?\)", html)
expected_allow = {'cms_logged_in', 'cms_username'}
remaining_ls = [k for k in ls_keys if k not in expected_allow]
if remaining_ls:
    print('WARNING: Remaining localStorage keys:', set(remaining_ls))
else:
    print('VERIFY PASS: No unauthorized localStorage keys found')

# Check for any localStorage occurrences at all
all_ls = re.findall(r'localStorage\.\w+\(', html)
print('Total localStorage getItem/setItem/removeItem calls:', len(all_ls))
for m in re.finditer(r'localStorage\.(\w+)\(([^)]+)\)', html):
    print('  localStorage.' + m.group(1) + '(' + m.group(2) + ')')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(html)

print('DONE: nav-management.html saved')
