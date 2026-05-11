# -*- coding: utf-8 -*-
import os, re, shutil

base = r'D:\yingyong\xampp\htdocs\hongdu\admin'
filepath = os.path.join(base, 'visual-editor.html')
bakpath = filepath + '.bak'

shutil.copy2(filepath, bakpath)
print('Backup saved:', bakpath)

with open(filepath, 'r', encoding='utf-8') as f:
    html = f.read()

# ---- 1. loadPage: Remove localStorage check before loadExistingPage ----
old = '''            // \u5148\u5c1d\u8bd5\u4ece\u672c\u5730\u5b58\u50a8\u52a0\u8f7d\u5df2\u4fdd\u5b58\u7684\u5185\u5bb9
            const savedContent = localStorage.getItem('page_' + pageUrl);
            if (savedContent) {
                console.log('\u4ece\u672c\u5730\u5b58\u50a8\u52a0\u8f7d\u5df2\u4fdd\u5b58\u5185\u5bb9');
                // \u4f7f\u7528\u4fdd\u5b58\u7684\u5185\u5bb9\uff0c\u4f46\u9700\u8981\u6dfb\u52a0\u7f16\u8f91\u6837\u5f0f
                const editableHtml = makePageEditable(savedContent);
                iframe.srcdoc = editableHtml;
                iframe.onload = function() {
                    console.log('iframe onload (localStorage)');
                    showLoading(false);
                    iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

                    // \u5ef6\u8fdf\u521d\u59cb\u5316\u4ee5\u786e\u4fdd\u676f\u5b8c\u5168\u52a0\u8f7d
                    setTimeout(function() {
                        console.log('\u5f00\u59cb\u521d\u59cb\u5316\u7f16\u8f91\u5668 (localStorage)...');
                        initEditor();
                        setupIframeDropZone(iframe);
                    }, 500);
                };
            } else {
                // \u5c1d\u8bd5\u52a0\u8f7d\u73b0\u6709\u7684\u524d\u7aef\u9875\u9762
                loadExistingPage(iframe, pageUrl);
            }'''

new = '''            // \u76f4\u63a5\u52a0\u8f7d\u73b0\u6709\u7684\u524d\u7aef\u9875\u9762
            loadExistingPage(iframe, pageUrl);'''

assert old in html, 'FAIL: loadPage localStorage block not found'
html = html.replace(old, new)
print('OK: loadPage localStorage check removed')

# ---- 2. createEditablePage: Remove localStorage check ----
old = '''            // \u4ece\u672c\u5730\u5b58\u50a8\u52a0\u8f7d\u5df2\u4fdd\u5b58\u7684\u5185\u5bb9
            let bodyContent = '';
            const savedContent = localStorage.getItem('page_' + pageUrl);
            if (savedContent) {
                // \u63d0\u53d6body\u5185\u5bb9
                const bodyMatch = savedContent.match(/<body[^>]*>([\\s\\S]*)<\\/body>/i);
                if (bodyMatch) {
                    bodyContent = bodyMatch[1];
                }
            }
            
            // \u5982\u679c\u6ca1\u6709\u4fdd\u5b58\u7684\u5185\u5bb9\uff0c\u663e\u793a\u9ed8\u8ba4\u63d0\u793a
            if (!bodyContent) {
                bodyContent = `
                    <div style="padding: 40px; text-align: center; color: #9ca3af;">
                        <i class="fas fa-plus-circle" style="font-size: 48px; margin-bottom: 16px;"></i>
                        <p>\u7a7a\u767d\u9875\u9762 - \u70b9\u51fb\u6216\u62d6\u62fd\u5de6\u4fa7\u7ec4\u4ef6\u5f00\u59cb\u7f16\u8f91</p>
                    </div>
                `;
            }'''

new = '''            // \u663e\u793a\u9ed8\u8ba4\u63d0\u793a
            let bodyContent = `
                    <div style="padding: 40px; text-align: center; color: #9ca3af;">
                        <i class="fas fa-plus-circle" style="font-size: 48px; margin-bottom: 16px;"></i>
                        <p>\u7a7a\u767d\u9875\u9762 - \u70b9\u51fb\u6216\u62d6\u62fd\u5de6\u4fa7\u7ec4\u4ef6\u5f00\u59cb\u7f16\u8f91</p>
                    </div>
                `;'''

assert old in html, 'FAIL: createEditablePage localStorage check not found'
html = html.replace(old, new)
print('OK: createEditablePage localStorage check removed')

# ---- 3. savePage: Remove localStorage backup call ----
old = '''                    // \u540c\u65f6\u4fdd\u5b58\u5230\u672c\u5730\u5b58\u50a8\u4f5c\u4e3a\u5907\u4efd
                    localStorage.setItem('page_' + currentPage, htmlContent);'''

new = '''                    // \u526f\u4f5c\u7528\u5929\uff1a\u4e0d\u518d\u5199\u5165\u672c\u5730\u5b58\u50a8'''

assert old in html, 'FAIL: savePage localStorage setItem not found'
html = html.replace(old, new)
print('OK: savePage localStorage backup removed')

# ---- Verify ----
ls_keys = re.findall(r"localStorage\.\w+\(['\"](cms_[^)'\"]+)['\"]?\)", html)
expected_allow = {'cms_logged_in', 'cms_username'}
remaining_ls = [k for k in ls_keys if k not in expected_allow]
if remaining_ls:
    print('WARNING: Remaining localStorage keys:', set(remaining_ls))
else:
    print('VERIFY PASS: No unauthorized localStorage keys found')

all_ls = re.findall(r'localStorage\.\w+\(', html)
print('Total localStorage calls:', len(all_ls))
for m in re.finditer(r'localStorage\.(\w+)\(([^)]+)\)', html):
    print('  localStorage.' + m.group(1) + '(' + m.group(2) + ')')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(html)
print('DONE: visual-editor.html saved')
