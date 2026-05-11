const fs = require('fs');
const path = require('path');
const root = 'D:\\yingyong\\xampp\\htdocs\\hongdu';

// Extensions to process
const exts = new Set(['.html', '.php', '.css', '.js']);

// Directories to skip
const skipDirs = new Set(['.git', 'wp-admin', 'wp-content', 'wp-includes', 'uploads']);

function findImageRefs(dir) {
    let items;
    try { items = fs.readdirSync(dir); } catch(e) { return; }
    
    for (const item of items) {
        const fullPath = path.join(dir, item);
        let stat;
        try { stat = fs.statSync(fullPath); } catch(e) { continue; }
        
        if (stat.isDirectory()) {
            if (!skipDirs.has(item)) findImageRefs(fullPath);
            continue;
        }
        
        const ext = path.extname(item).toLowerCase();
        if (!exts.has(ext)) continue;
        
        let content;
        try { content = fs.readFileSync(fullPath, 'utf8'); } catch(e) { continue; }
        
        // Check for images/ references
        const imgRe = /(src|href)\s*=\s*["']images\//gi;
        const urlRe = /url\s*\(\s*images\//gi;
        
        if (imgRe.test(content) || urlRe.test(content)) {
            // Count occurrences
            const count1 = (content.match(/(src|href)\s*=\s*["']images\//gi) || []).length;
            const count2 = (content.match(/url\s*\(\s*images\//gi) || []).length;
            console.log(`${fullPath.substring(root.length+1)} (${count1 + count2} refs)`);
        }
    }
}

console.log('=== Files with images/ references ===');
findImageRefs(root);
