# -*- coding: utf-8 -*-
import os, re, shutil

base = r'D:\yingyong\xampp\htdocs\hongdu\admin'
filepath = os.path.join(base, 'visual-editor.html')
bakpath = filepath + '.bak'

shutil.copy2(filepath, bakpath)
print('Backup saved:', bakpath)

with open(filepath, 'rb') as f:
    b = f.read()

# ---- 1. loadPage: Remove localStorage check block ----
# Find the localStorage getItem line
target = b"localStorage.getItem('page_' + pageUrl)"
idx_ls = b.find(target)
assert idx_ls >= 0, 'FAIL: localStorage.getItem not found'

# Go backwards to find the comment line (preceded by \n)
# The structure before it:
# \n            // \xe5\x85\x88\xe5\xb0\x9d\xe8\xaf\x95...
idx_start = b.rfind(b'\n', 0, idx_ls) + 1  # start at beginning of comment line

# Find the loadExistingPage call after the else
target2 = b'loadExistingPage(iframe, pageUrl);'
idx_lv = b.find(target2, idx_ls)
assert idx_lv >= 0, 'FAIL: loadExistingPage call not found'

# After loadExistingPage line comes: (CR)LF then '            }' (else close) then (CR)LF then '        }' (if close) then blank line
# Find the exact end
# loadExistingPage line ends with ; then \r\n or \n
line_end = b.find(b'\n', idx_lv)
# After that line: '            }\n'
close_1 = b.find(b'            }\n', line_end + 1)
# After that: '        }\n'  (the closing of the whole if block)
close_2 = b.find(b'        }\n', close_1 + 1)

assert close_2 >= 0, 'FAIL: could not find closing braces'
# The block ends at close_2 + len('        }\n'), but we need to also include the blank line
# Let's find the next non-blank line to mark the end
# Actually, we just need from idx_start to close_2 + len('        }')
# Include the closing brace
block_end = close_2 + len(b'        }')

old_block = b[idx_start:block_end]
print('Old block length:', len(old_block))

# Verify it contains localStorage
assert b'localStorage' in old_block, 'FAIL: old block missing localStorage'

# New block: just loadExistingPage call with closing braces
new_block = b'            // \xe7\x9b\xb4\xe6\x8e\xa5\xe5\x8a\xa0\xe8\xbd\xbd\xe7\x8e\xb0\xe6\x9c\x89\xe7\x9a\x84\xe5\x89\x8d\xe7\xab\xaf\xe9\xa1\xb5\xe9\x9d\xa2\n            loadExistingPage(iframe, pageUrl);\n        }'

b = b.replace(old_block, new_block)
print('OK: loadPage localStorage block replaced')

# ---- 2. createEditablePage: Remove localStorage check ----
# After first replacement, positions may have shifted, re-find
target_a = b'// \xe4\xbb\x8e\xe6\x9c\xac\xe5\x9c\xb0\xe5\xad\x98\xe5\x82\xa8\xe5\x8a\xa0\xe8\xbd\xbd\xe5\xb7\xb2\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9'
idx_a = b.find(target_a)
assert idx_a >= 0, 'FAIL: createEditablePage comment not found'

# Find the line with localStorage.getItem
target_b = b"localStorage.getItem('page_' + pageUrl)"
idx_b = b.find(target_b, idx_a)
assert idx_b >= 0, 'FAIL: second localStorage.getItem not found'

# Find the default fallback text
target_default = b'// \xe5\xa6\x82\xe6\x9e\x9c\xe6\xb2\xa1\xe6\x9c\x89\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9\xef\xbc\x8c\xe6\x98\xbe\xe7\xa4\xba\xe9\xbb\x98\xe8\xae\xa4\xe6\x8f\x90\xe7\xa4\xba'
idx_default = b.find(target_default, idx_a)
assert idx_default >= 0, 'FAIL: fallback comment not found'

# Find the backtick that starts the template literal for default content
btick = b.find(b'bodyContent = `', idx_default)
assert btick >= 0, 'FAIL: default bodyContent template not found'

# The old block: from comment to the start of default template
# Actually, replace the localStorage loading block with direct initialization
# The old structure:
# // comment about loading from localStorage
# let bodyContent = '';
# const savedContent = localStorage...;
# if (savedContent) {
#   bodyMatch...bodyContent = ...
# }
# // comment about default
# if (!bodyContent) {
#   bodyContent = `...

# We want: just "// comment\nget bodyContent = `..."
old_block2_start = b.find(b'            // \xe4\xbb\x8e\xe6\x9c\xac\xe5\x9c\xb0\xe5\xad\x98\xe5\x82\xa8\xe5\x8a\xa0\xe8\xbd\xbd\xe5\xb7\xb2\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9\n            let bodyContent = \'\';\n            const savedContent = ', idx_a)
assert old_block2_start >= 0, 'FAIL: old block2 start not found'

# Find the backtick line
# Structure after the if blocks:
#     // comment about default
#     if (!bodyContent) {
#         bodyContent = `...
# We'll replace from old_block2_start up to and including the 'bodyContent = `' line
# Find the line 'bodyContent = `'
btick_line = b.find(b'bodyContent = `', old_block2_start)
assert btick_line >= 0, 'FAIL: bodyContent = backtick not found'

# The old block goes from old_block2_start to btick_line
# We need to exclude the line that has 'bodyContent = `'
# Actually, find the newline before that line
nl_before_btick = b.rfind(b'\n', old_block2_start, btick_line)
# Include the newline at start of the 'bodyContent = `' line  
# Let's find the exact pattern
# We want to replace everything from comment up to and including the 'if (!bodyContent)' check,
# and replace with just letting bodyContent default to the template

# Simpler approach: find and replace a specific block of text
# The old:
# "            // ...\n            let bodyContent = '';\n            const savedContent = localStorage.getItem...\n            if (savedContent) {\n                ...\n            }\n            \n            // if not saved\n            if (!bodyContent) {\n"

# Let me find precise patterns
p1 = b'            // \xe4\xbb\x8e\xe6\x9c\xac\xe5\x9c\xb0\xe5\xad\x98\xe5\x82\xa8\xe5\x8a\xa0\xe8\xbd\xbd\xe5\xb7\xb2\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9'
p2 = b'\n            let bodyContent = \'\';\n            const savedContent = localStorage'
p3 = b"\n            if (savedContent) {\n                // \xe6\x8f\x90\xe5\x8f\x96body\xe5\x86\x85\xe5\xae\xb9\n                const bodyMatch = savedContent.match(/<body[^>]*>([\\s\\S]*)<\\/body>/i);\n                if (bodyMatch) {\n                    bodyContent = bodyMatch[1];\n                }\n            }\n            \n            // \xe5\xa6\x82\xe6\x9e\x9c\xe6\xb2\xa1\xe6\x9c\x89\xe4\xbf\x9d\xe5\xad\x98\xe7\x9a\x84\xe5\x86\x85\xe5\xae\xb9\xef\xbc\x8c\xe6\x98\xbe\xe7\xa4\xba\xe9\xbb\x98\xe8\xae\xa4\xe6\x8f\x90\xe7\xa4\xba\n            if (!bodyContent) {\n                bodyContent = `"

full_old_block2 = p1 + p2 + p3
idx2 = b.find(full_old_block2)
assert idx2 >= 0, 'FAIL: complete createEditablePage block not found (trying simpler match)'

# The replacement:
full_new_block = b'            // \xe6\x98\xbe\xe7\xa4\xba\xe9\xbb\x98\xe8\xae\xa4\xe6\x8f\x90\xe7\xa4\xba\n            bodyContent = `'

b = b.replace(full_old_block2, full_new_block)
print('OK: createEditablePage localStorage replaced')

# ---- 3. savePage: Remove localStorage backup ----
target_ls_save = b"localStorage.setItem('page_' + currentPage, htmlContent);"
idx3 = b.find(target_ls_save)
assert idx3 >= 0, 'FAIL: savePage localStorage setItem not found'

b = b.replace(target_ls_save, b'/* localStorage backup removed */')
print('OK: savePage localStorage backup removed')

# ---- Verify ----
s = b.decode('utf-8')
ls_keys = re.findall(r"localStorage\.\w+\(['\"](cms_[^)'\"]+)['\"]?\)", s)
expected_allow = {'cms_logged_in', 'cms_username'}
remaining = [k for k in ls_keys if k not in expected_allow]
if remaining:
    print('WARNING: Remaining localStorage keys:', set(remaining))
else:
    print('VERIFY PASS: No unauthorized localStorage keys found')

all_ls = re.findall(r'localStorage\.(\w+)\(', s)
print('Total localStorage calls:', len(all_ls))

with open(filepath, 'wb') as f:
    f.write(b)
print('DONE: visual-editor.html saved')
