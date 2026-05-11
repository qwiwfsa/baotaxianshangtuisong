const fs = require('fs');
const path = require('path');
const root = 'D:\\yingyong\\xampp\\htdocs\\hongdu';

const exts = new Set(['.html', '.php', '.css', '.js']);
const skipDirs = new Set(['.git', 'config', 'uploads']);

let totalReplaced = 0;
let totalFiles = 0;

function processDir(dir) {
    let items;
    try { items = fs.readdirSync(dir); } catch(e) { return; }
    
    for (const item of items) {
        const fullPath = path.join(dir, item);
        let stat;
        try { stat = fs.statSync(fullPath); } catch(e) { continue; }
        
        if (stat.isDirectory()) {
            if (!skipDirs.has(item)) processDir(fullPath);
            continue;
        }
        
        const ext = path.extname(item).toLowerCase();
        if (!exts.has(ext)) continue;
        
        let content;
        try { content = fs.readFileSync(fullPath, 'utf8'); } catch(e) { continue; }
        
        let modified = content;
        let count = 0;
        
        // Replace src="uploads/ -> src="uploads/
        modified = modified.replace(/(src\s*=\s*["'])images\//gi, (match, prefix) => {
            count++;
            return prefix + 'uploads/';
        });
        
        // Replace href="uploads/ -> href="uploads/
        modified = modified.replace(/(href\s*=\s*["'])images\//gi, (match, prefix) => {
            count++;
            return prefix + 'uploads/';
        });
        
        // Replace url(uploads/ -> url(uploads/
        modified = modified.replace(/(url\s*\(\s*)images\//gi, (match, prefix) => {
            count++;
            return prefix + 'uploads/';
        });
        
        if (count > 0) {
            fs.writeFileSync(fullPath, modified, 'utf8');
            totalReplaced += count;
            totalFiles++;
            console.log(`[${count}x] ${fullPath.substring(root.length+1)}`);
        }
    }
}

console.log('=== Replacing images/ -> uploads/ ===');
processDir(root);
console.log(`\nDone: ${totalReplaced} replacements in ${totalFiles} files`);
