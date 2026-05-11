const fs = require('fs');

let content = fs.readFileSync('case-edit.html', 'utf8');

// 修复所有语法错误
const fixes = [
  // 修复注释和代码混在一起的问题
  [/（新建案例时间\s+if/g, '（新建案例时）\n            if'],
  [/更新时间隔\s+currentCase/g, '更新时间\n            currentCase'],
  [/服务器响应超时间\)/g, '服务器响应超时）'],
  
  // 修复showToast调用
  [/showToast\('([^']+), 'error'\)/g, "showToast('$1', 'error')"],
  [/showToast\('([^']+)\);/g, "showToast('$1');"],
  
  // 修复模板字符串
  [/{remainingSlots}/g, '${remainingSlots}'],
  [/{failCount}/g, '${failCount}'],
  
  // 修复其他乱码残留
  [/只能上传张图片/g, '只能上传3张图片'],
  [/最大宽度00px/g, '最大宽度800px'],
  [/质量0%/g, '质量80%'],
  [/检查压缩后的大\s+const/g, '检查压缩后的大小\n                            const'],
  [/检查总数量限\s+const/g, '检查总数量限制\n                    const'],
  [/限制500KB原始文件\s+if/g, '限制500KB原始文件）\n                        if'],
];

fixes.forEach(([pattern, replacement]) => {
  content = content.replace(pattern, replacement);
});

fs.writeFileSync('case-edit.html', content, 'utf8');
console.log('Fixed all syntax errors');
