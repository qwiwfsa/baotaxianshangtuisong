# -*- coding: utf-8 -*-
import os, re, shutil

base = r'D:\yingyong\xampp\htdocs\hongdu\admin'
filepath = os.path.join(base, 'visual-editor.html')
bakpath = filepath + '.bak'

shutil.copy2(filepath, bakpath)
print('Backup saved:', bakpath)

with open(filepath, 'rb') as f:
    b = f.read()

def find_pos(pattern_bytes, label):
    idx = b.find(pattern_bytes)
    assert idx >= 0, 'FAIL: ' + label + ' not found'
    print('  Found', label, 'at', idx)
    return idx

# ---- 1. loadPage: Remove localStorage check block ----
TARGET_LS = b"localStorage.getItem('page_' + pageUrl)"
TARGET_LV = b'loadExistingPage(iframe, pageUrl);'

idx_ls = find_pos(TARGET_LS, 'localStorage.getItem')
idx_lv = find_pos(TARGET_LV, 'loadExistingPage')

# After loadExistingPage line: ; then \r\n
line_end = b.find(b'\n', idx_lv)
assert line_end > 0, 'FAIL: no newline after loadExistingPage'

# After that: \r\n            }
CLOSE_P = b'\r\n            }'
close_1 = b.find(CLOSE_P, line_end + 1)
assert close_1 > 0, 'FAIL: first closing brace not found'
close_1_end = close_1 + len(CLOSE_P)

# After that: \r\n        }
CLOSE_P2 = b'\r\n        }'
close_2 = b.find(CLOSE_P2, close_1_end)
assert close_2 > 0, 'FAIL: second closing brace not found'
close_2_end = close_2 + len(CLOSE_P2)

# Now go back from idx_ls to find start of comment line
# Find \n before localStorage line, then go back to previous \n
nl_before_ls = b.rfind(b'\n', 0, idx_ls)
# The comment line is the previous line
nl_before_comment = b.rfind(b'\n', 0, nl_before_ls - 1)
# Actually, there might be whitespace before. Find the start of line after previous function's closing brace
start_comment = nl_before_comment + 1

old_block = b[start_comment:close_2_end]
print('Old block size:', len(old_block))

# Verify
assert b'localStorage' in old_block, 'FAIL: old block has no localStorage'

# New block
new_block = b'            // \xe7\x9b\xb4\xe6\x8e\xa5\xe5\x8a\xa0\xe8\xbd\xbd\xe7\x8e\xb0\xe6\x9c\x89\xe7\x9a\x84\xe5\x89\x8d\xe7\xab\xaf\xe9\xa1\xb5\xe9\x9d\xa2\r\n            loadExistingPage(iframe, pageUrl);\r\n        }'

b = b.replace(old_block, new_block)
print('OK: loadPage localStorage block replaced')

# ---- 2. createEditablePage: Remove localStorage check ----
P_COMMENT = b'// \xe4\xbb\x8e\xe6\x9c\xac\xe5\x9c\xb0\xe5\xad\x98\xe5\x82\xa8\xe5\x8a\xa0\xe8\xbd\xbd\xe5\xb7\xb2\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9'
idx_comment2 = find_pos(P_COMMENT, 'createEditablePage comment')

P_LS2 = b"localStorage.getItem('page_' + pageUrl)"
idx_ls2 = find_pos(P_LS2, 'second localStorage.getItem')

# Find the fallback default template text
P_DEFAULT = b'// \xe5\xa6\x82\xe6\x9e\x9c\xe6\xb2\xa1\xe6\x9c\x89\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9\xef\xbc\x8c\xe6\x98\xbe\xe7\xa4\xba\xe9\xbb\x98\xe8\xae\xa4\xe6\x8f\x90\xe7\xa4\xba'
idx_default = find_pos(P_DEFAULT, 'fallback comment')

# Find the 'bodyContent = `' line
P_BTICK = b'bodyContent = `'
idx_btick = b.find(P_BTICK, idx_default)
assert idx_btick > 0, 'FAIL: bodyContent template not found'

# The replacement: from the comment line to the start of bodyContent template
# We want to replace with just the default text assignment
# Find the line boundaries
nl_before_comment2 = b.rfind(b'\n', 0, idx_comment2)
# The comment line starts at nl_before_comment2+1
# Find the newline at the end of the 'if !bodyContent' line 
# Actually, find the newline just before the 'bodyContent = `' line
nl_before_btick = b.rfind(b'\n', 0, idx_btick)

# Old block: from comment start line to just before the 'bodyContent = `' line
old_block2 = b[nl_before_comment2 + 1:nl_before_btick + 1]
print('Old block2 size:', len(old_block2))
assert b'localStorage' in old_block2, 'FAIL: old block2 has no localStorage'

# Also include the 'if (!bodyContent) {' line and the indentation of bodyContent
# Actually, we want to replace from the comment up to and including 
# the 'if (!bodyContent) {' line, then put 'bodyContent = `'

# Let's find the exact pattern
# The line before bodyContent = backtick should be the if check
# Find 'if (!bodyContent) {'
P_IF = b'if (!bodyContent) {'
idx_if = b.find(P_IF, idx_default)
assert idx_if > 0

nl_before_if = b.rfind(b'\n', 0, idx_if)
nl_after_if = b.find(b'\n', idx_if)

# Old block2 goes from comment start line to end of if line
old_block2_exact = b[nl_before_comment2 + 1:nl_after_if + 1]
print('Old block2 exact size:', len(old_block2_exact))

new_block2 = b'            // \xe6\x98\xbe\xe7\xa4\xba\xe9\xbb\x98\xe8\xae\xa4\xe6\x8f\x90\xe7\xa4\xba\r\n            bodyContent = `'

b = b.replace(old_block2_exact, new_block2)
print('OK: createEditablePage localStorage replaced')

# ---- 3. savePage: Remove localStorage backup ----
P_SAVE_LS = b"localStorage.setItem('page_' + currentPage, htmlContent);"
idx_save_ls = find_pos(P_SAVE_LS, 'savePage localStorage')

b = b.replace(P_SAVE_LS, b'/* localStorage backup removed */')
print('OK: savePage localStorage backup removed')

# ---- Verify ----
s = b.decode('utf-8')
# Check for any remaining cms_* localStorage keys
ls_keys = re.findall(r"localStorage\.\w+\(['\"](cms_[^)'\"]+)['\"]?\)", s)
expected_allow = {'cms_logged_in', 'cms_username'}
remaining = [k for k in ls_keys if k not in expected_allow]
if remaining:
    print('WARNING: Remaining localStorage keys:', set(remaining))
else:
    print('VERIFY PASS: No unauthorized localStorage keys found')

all_ls = re.findall(r'localStorage\.(\w+)\(', s)
print('Total localStorage calls:', len(all_ls))
for m in re.finditer(r'localStorage\.(\w+)\(([^)]+)\)', s):
    key = m.group(2).strip().strip("'\"").strip("'").strip('"')
    if 'page_' in key or key not in expected_allow:
        print('  localStorage.' + m.group(1) + '(' + m.group(2) + ')')

with open(filepath, 'wb') as f:
    f.write(b)
print('DONE: visual-editor.html saved')
