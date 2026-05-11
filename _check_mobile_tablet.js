const fs = require('fs');
const root = 'D:\\yingyong\\xampp\\htdocs\\hongdu';

function checkSubdir(subdir) {
    console.log(`=== ${subdir.toUpperCase()} uploads refs ===`);
    const files = fs.readdirSync(subdir);
    for (const f of files) {
        const full = subdir + '/' + f;
        const stat = fs.statSync(full);
        if (!stat.isFile()) continue;
        const ext = f.split('.').pop().toLowerCase();
        if (!['html', 'php', 'css', 'js'].includes(ext)) continue;
        let content;
        try { content = fs.readFileSync(full, 'utf8'); } catch(e) { continue; }
        
        const refs = [];
        // Quick check for uploads/ references
        const lines = content.split('\n');
        for (let i = 0; i < lines.length; i++) {
            const line = lines[i];
            if (line.includes('uploads/')) {
                refs.push((i + 1) + ': ' + line.trim().substring(0, 80));
            }
        }
        if (refs.length > 0) {
            console.log(`\n${f} (${refs.length} refs):`);
            refs.forEach(r => console.log('  ' + r));
        }
    }
}

checkSubdir('mobile');
checkSubdir('tablet');
