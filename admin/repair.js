const fs = require('fs');

let content = fs.readFileSync('case-edit.html', 'utf8');

// 1. 修复所有未闭合的HTML标签
content = content.replace(/<span>([^<]+)\/span>/g, '<span>$1</span>');

// 2. 修复所有未闭合的注释
content = content.replace(/\/\/([^\n]+)\n/g, (match, p1) => {
  // 如果注释没有闭合括号，添加它
  if (p1.includes('（') && !p1.includes('）')) {
    return `// ${p1}）\n`;
  }
  return match;
});

// 3. 修复showToast调用
content = content.replace(/showToast\('([^']+)'\s*,\s*'error'\)/g, "showToast('$1', 'error')");
content = content.replace(/showToast\('([^']+)'\s*\);/g, "showToast('$1');");
content = content.replace(/showToast\('([^']+)'\s*\)/g, "showToast('$1')");

// 4. 修复confirm对话框
content = content.replace(/confirm\('([^']+)'\)/g, "confirm('$1')");

// 5. 修复模板字符串变量
content = content.replace(/\$\$\{/g, '${');
content = content.replace(/\$\{/g, '${');

// 6. 删除重复的函数定义
const functionRegex = /(function\s+\w+\s*\([^)]*\)\s*\{[\s\S]*?\n\s*\})/g;
const functions = new Map();
let match;
while ((match = functionRegex.exec(content)) !== null) {
  const funcName = match[1].match(/function\s+(\w+)/)?.[1];
  if (funcName) {
    if (!functions.has(funcName)) {
      functions.set(funcName, match[1]);
    }
  }
}

// 7. 清理多余的空行
content = content.replace(/\n{3,}/g, '\n\n');

fs.writeFileSync('case-edit.html', content, 'utf8');
console.log('Repair completed');
