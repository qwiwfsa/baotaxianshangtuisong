# -*- coding: utf-8 -*-
import os, re, shutil

base = r'D:\yingyong\xampp\htdocs\hongdu\admin'
filepath = os.path.join(base, 'visual-editor.html')
bakpath = filepath + '.bak'

shutil.copy2(filepath, bakpath)
print('Backup saved:', bakpath)

with open(filepath, 'r', encoding='utf-8') as f:
    html = f.read()

# Find each section by unique surrounding text

# ---- 1. loadPage: Remove localStorage check block ----
# Find the section: starts with comment about trying localStorage, ends before loadExistingPage function
start_marker = '// \u5148\u5c1d\u8bd5\u4ece\u672c\u5730\u5b58\u50a8\u52a0\u8f7d\u5df2\u4fdd\u5b58\u7684\u5185\u5bb9'
end_marker = '        }\n        \n        // \u52a0\u8f7d\u73b0\u6709\u7684\u524d\u7aef\u9875\u9762'

idx_start = html.find(start_marker)
assert idx_start >= 0, 'FAIL: loadPage start_marker not found'

idx_end = html.find(end_marker, idx_start)
# The end_marker includes the closing brace and blank line before the next function
# We need to find the actual closing brace for the if/else block
# Let me find the exact replacement block by finding the complete if-else for localStorage check

# Find the localStorage check block more carefully
# It goes: comment -> const savedContent -> if (savedContent) { ... } else { loadExistingPage }
ls_line = html.find('localStorage.getItem(\'page_\'', idx_start)
assert ls_line >= 0, 'FAIL: localStorage.getItem not found in loadPage'

# Find the matching '} else {' that follows
else_marker = html.find('        } else {', ls_line)
assert else_marker >= 0, 'FAIL: else clause not found'

# Find the closing brace of the else block
# After the else block, there should be the loadExistingPage function declaration
after_else = html.find('            loadExistingPage(iframe, pageUrl);', else_marker)
if after_else < 0:
    # try with different quote style
    after_else = html.find('loadExistingPage(iframe, pageUrl)', else_marker)
assert after_else >= 0, 'FAIL: loadExistingPage call not found after else'

# The localStorage block ends with the closing brace of else
# Search for the closing brace patterns
closing_brace_1 = html.find('\n            }\n        }', after_else)
closing_brace_2 = html.find('\n            }\n        }\n', after_else)
if closing_brace_2 >= 0:
    block_end = closing_brace_2 + len('\n            }\n        }')
elif closing_brace_1 >= 0:
    block_end = closing_brace_1 + len('\n            }\n        }')
else:
    assert False, 'FAIL: cannot find closing brace'

# Now extract the old block
old_block = html[idx_start:block_end]
# Verify it contains localStorage
assert 'localStorage' in old_block, 'FAIL: old_block does not contain localStorage'
print('Old block found, length:', len(old_block))

new_block = '''            // \u76f4\u63a5\u52a0\u8f7d\u73b0\u6709\u7684\u524d\u7aef\u9875\u9762
            loadExistingPage(iframe, pageUrl);
        }'''

html = html.replace(old_block, new_block)
print('OK: loadPage localStorage block replaced')
# Verify no localStorage remains in loadPage area
idx_check = html.find('loadExistingPage')
assert idx_check >= 0, 'FAIL: loadExistingPage still exists?'
# Verify the localStorage removed successfully
assert 'localStorage.getItem(\'page_\'' not in html[:html.find('function loadExistingPage')], 'FAIL: localStorage still present in loadPage area'

# ---- 2. createEditablePage: Remove localStorage check ----
# Find the comment about loading from localStorage
marker = '// \u4ece\u672c\u5730\u5b58\u50a8\u52a0\u8f7d\u5df2\u4fdd\u5b58\u7684\u5185\u5bb9'
idx_marker = html.find(marker)
assert idx_marker >= 0, 'FAIL: createEditablePage localStorage marker not found'

# Find the localStorage call
ls_line2 = html.find("localStorage.getItem('page_'", idx_marker)
assert ls_line2 >= 0, 'FAIL: localStorage not found in createEditablePage'

# Find the fallback text marker
fallback = 'if (!bodyContent)'
idx_fallback = html.find(fallback, idx_marker)
assert idx_fallback >= 0, 'FAIL: bodyContent fallback not found'

# The block to remove is from marker to the start of the fallback if block
# We want to replace the localStorage loading section while keeping the fallback text
# Actually, we want to replace the whole section from the marker to the end of the 'if (!bodyContent)' block

# Find the closing brace of the if (!bodyContent) block
# After it, bodyContent will be used
body_after = html.find('            ', idx_fallback + 50)
body_after = html.find('            // \u5982\u679c\u6ca1\u6709\u4fdd\u5b58\u7684\u5185\u5bb9', idx_marker)
assert body_after >= 0, 'FAIL: fallback comment not found'
new_idx = body_after

# The section from marker to the default content
# We want to paste the default fallback text directly
old_section = html[idx_marker:new_idx]

# Find the default fallback content
fallback_comment = '// \u5982\u679c\u6ca1\u6709\u4fdd\u5b58\u7684\u5185\u5bb9\uff0c\u663e\u793a\u9ed8\u8ba4\u63d0\u793a'
idx_fallback_comment = html.find(fallback_comment, idx_marker)
assert idx_fallback_comment >= 0, 'FAIL: fallback comment 2 not found'

# From the fallback comment to the start of the template literal backtick
# Find the backtick
btick = html.find('`', idx_fallback_comment)
assert btick >= 0, 'FAIL: backtick not found'

# Old block to replace: everything from marker to the end of the default content block
# Find the semicolon after the backtick
semi = html.find(';', btick)
# The block ends with a space and then maybe more code
# Actually the block is:
# let bodyContent = ''; 
# const savedContent = ...;
# if (savedContent) { ... }
# if (!bodyContent) { bodyContent = `...`; }

simple_old = '''            // \u4ece\u672c\u5730\u5b58\u50a8\u52a0\u8f7d\u5df2\u4fdd\u5b58\u7684\u5185\u5bb9
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
                bodyContent = `'''

simple_new = '''            // \u663e\u793a\u9ed8\u8ba4\u63d0\u793a
            let bodyContent = `'''

count = html.count(simple_old)
assert count == 1, 'FAIL: createEditablePage block not found or ambiguous (count=' + str(count) + ')'
html = html.replace(simple_old, simple_new)
print('OK: createEditablePage localStorage replaced')

# ---- 3. savePage: Remove localStorage backup call ----
save_ls = "localStorage.setItem('page_' + currentPage, htmlContent);"
count2 = html.count(save_ls)
assert count2 == 1, 'FAIL: savePage localStorage setItem not found (count=' + str(count2) + ')'
html = html.replace(save_ls, '/* localStorage backup removed */')
print('OK: savePage localStorage backup removed')

# ---- Verify ----
ls_keys = re.findall(r"localStorage\.\w+\(['\"](cms_[^)'\"]+)['\"]?\)", html)
expected_allow = {'cms_logged_in', 'cms_username'}
remaining = [k for k in ls_keys if k not in expected_allow]
if remaining:
    print('WARNING: Remaining localStorage keys:', set(remaining))
else:
    print('VERIFY PASS: No unauthorized localStorage keys')

all_ls = re.findall(r'localStorage\.(\w+)\(', html)
print('Total localStorage calls:', len(all_ls))
for m in re.finditer(r'localStorage\.(\w+)\(([^)]+)\)', html):
    key = m.group(2).strip().strip("'\"").strip("'").strip('"')
    if key not in expected_allow:
        print('  localStorage.' + m.group(1) + '(' + m.group(2) + ')')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(html)
print('DONE: visual-editor.html saved')
