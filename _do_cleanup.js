const fs = require('fs');
const path = require('path');
const root = 'D:\\yingyong\\xampp\\htdocs\\hongdu';

// Globs of files to delete (patterns)
const deletePatterns = [
    // .bak files
    name => name.endsWith('.bak'),
    // .gbk.bak
    name => name.endsWith('.gbk.bak'),
    // *backup* files
    name => name.includes('backup'),
    // _*.py
    name => name.startsWith('_') && name.endsWith('.py'),
    // _*.ps1
    name => name.startsWith('_') && name.endsWith('.ps1'),
    // _*.php
    name => name.startsWith('_') && name.endsWith('.php'),
    // _*.txt
    name => name.startsWith('_') && name.endsWith('.txt'),
    // _*.md
    name => name.startsWith('_') && name.endsWith('.md'),
    // __*.py (admin scripts)
    name => name.startsWith('__') && name.endsWith('.py'),
    // fix-encoding.ps1
    name => name === 'fix-encoding.ps1',
    // upload-commands.ps1
    name => name === 'upload-commands.ps1',
    // decode_test.txt
    name => name === 'decode_test.txt',
    // *.corrupted
    name => name.endsWith('.corrupted'),
    // *.before_fix etc.
    name => name.endsWith('.before_fix'),
    name => name.endsWith('.nostats') || name.endsWith('.nostats2'),
    name => name.endsWith('.pre-fix'),
    name => name.endsWith('.mobilefix'),
    name => name.endsWith('.copy'),
    name => name.endsWith('.clickfix'),
    name => name.endsWith('.coverfix'),
    name => name.endsWith('.pathfix'),
    name => name.endsWith('.pagestyle'),
    name => name.endsWith('.bak2') || name.endsWith('.bak3'),
    // fix_tablet_case_detail.py
    name => name === 'fix_tablet_case_detail.py',
    // remove_*.py, simplify_*.py
    name => (name.startsWith('remove_') || name.startsWith('simplify_')) && name.endsWith('.py'),
    // test-*.html in root
    name => name.startsWith('test-') && name.endsWith('.html'),
    // test-*.php in root
    name => name.startsWith('test-') && name.endsWith('.php'),
    // test_*.php in root
    name => name.startsWith('test_') && name.endsWith('.php'),
];

// Directories to delete entirely
const deleteDirs = [
    'admin\\backup',
    'admin\\bak',
];

// Directories/files to always skip
const skipDirs = new Set(['.git']);

function shouldDelete(name) {
    if (name === 'db.php.bak') return false; // PROTECT the config backup
    for (const pattern of deletePatterns) {
        if (pattern(name)) return true;
    }
    return false;
}

const toDelete = [];

function scan(dir, relative) {
    let items;
    try {
        items = fs.readdirSync(dir);
    } catch (e) { return; }

    for (const item of items) {
        if (item === 'cleanup.js') continue; // don't delete ourselves
        const fullPath = path.join(dir, item);
        let stat;
        try { stat = fs.statSync(fullPath); } catch (e) { continue; }
        const rel = relative ? path.join(relative, item) : item;

        if (stat.isDirectory()) {
            // Check if this dir should be fully deleted
            if (deleteDirs.includes(rel)) {
                toDelete.push({ path: fullPath, isDir: true });
                continue;
            }
            // Skip .git
            if (skipDirs.has(item)) continue;
            // Scan subdirectories
            scan(fullPath, rel);
        } else {
            if (shouldDelete(item)) {
                toDelete.push({ path: fullPath, isDir: false });
            }
        }
    }
}

scan(root, '');

console.log('=== FILES/DIRS TO DELETE ===');
toDelete.sort((a, b) => a.path.localeCompare(b.path)).forEach(f => {
    console.log((f.isDir ? '[DIR] ' : '      ') + f.path.substring(root.length));
});

// Also find and list admin test-* files
const adminTestFiles = [];
const adminFiles = fs.readdirSync(path.join(root, 'admin'));
for (const f of adminFiles) {
    if (f.startsWith('test-') || (f.startsWith('test_') && f.endsWith('.php'))) {
        const fullPath = path.join(root, 'admin', f);
        const stat = fs.statSync(fullPath);
        if (stat.isFile()) {
            toDelete.push({ path: fullPath, isDir: false });
            adminTestFiles.push(f);
        }
    }
}

// admin/api/test*.php
const adminApiDir = path.join(root, 'admin', 'api');
if (fs.existsSync(adminApiDir)) {
    const adminApiFiles = fs.readdirSync(adminApiDir);
    for (const f of adminApiFiles) {
        if (f.startsWith('test-') || f.startsWith('test_')) {
            const fullPath = path.join(adminApiDir, f);
            toDelete.push({ path: fullPath, isDir: false });
            adminTestFiles.push('admin/api/' + f);
        }
    }
}

// api/test-*.php
const apiDir = path.join(root, 'api');
if (fs.existsSync(apiDir)) {
    const apiFiles = fs.readdirSync(apiDir);
    for (const f of apiFiles) {
        if (f.startsWith('test-') || f.startsWith('test_')) {
            const fullPath = path.join(apiDir, f);
            toDelete.push({ path: fullPath, isDir: false });
        }
    }
}

// mobile/test_*.php
const mobileDir = path.join(root, 'mobile');
if (fs.existsSync(mobileDir)) {
    const mobileFiles = fs.readdirSync(mobileDir);
    for (const f of mobileFiles) {
        if (f.startsWith('test_') && f.endsWith('.php')) {
            const fullPath = path.join(mobileDir, f);
            toDelete.push({ path: fullPath, isDir: false });
        }
    }
}

// Additionally: delete all files in �������� (garbled name directory)
const rootItems = fs.readdirSync(root);
for (const item of rootItems) {
    const fullPath = path.join(root, item);
    let stat;
    try { stat = fs.statSync(fullPath); } catch (e) { continue; }
    if (stat.isDirectory()) {
        // Check if directory name looks garbled (contains non-ASCII and not a known dir)
        const knownDirs = ['admin','api','assets','cms','config','css','data','design','images','includes','js','mobile','tablet','uploads','wp-admin','wp-content','wp-includes','.git'];
        if (!knownDirs.includes(item)) {
            toDelete.push({ path: fullPath, isDir: true });
            console.log('      [UNKNOWN DIR] ' + item);
        }
    }
}

// De-duplicate
const seen = new Set();
const unique = toDelete.filter(f => {
    if (seen.has(f.path)) return false;
    seen.add(f.path);
    return true;
});

console.log('\nTotal to delete: ' + unique.length);
console.log('\nProceed with deletion? (Run with argument --execute to actually delete)');

if (process.argv.includes('--execute')) {
    for (const f of unique) {
        try {
            if (f.isDir) {
                fs.rmSync(f.path, { recursive: true, force: true });
                console.log('DELETED DIR: ' + f.path);
            } else {
                fs.unlinkSync(f.path);
                console.log('DELETED: ' + f.path);
            }
        } catch (e) {
            console.error('FAILED: ' + f.path + ' - ' + e.message);
        }
    }
    console.log('\nCleanup complete!');
}
