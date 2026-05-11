const fs = require('fs');
const files = ['cases.html','case-detail.html','contact.html','services.html','advantages.html','faq.html'];
const base = 'D:/yingyong/xampp/htdocs/';

for (const f of files) {
  const content = fs.readFileSync(base + f, 'utf8');
  const fIdx = content.indexOf('<footer class="footer">');
  const footContent = content.substring(fIdx, fIdx + 1300);
  const dIdx = footContent.indexOf('专业资金');
  console.log('=== ' + f + ' ===');
  console.log('footer text is exact?');
  const excerpt = footContent.substring(dIdx, dIdx + 80);
  console.log('chars hex:', Buffer.from(excerpt, 'utf8').toString('hex'));
  console.log('---');
  // Show what comes after </footer>
  const feIdx = footContent.indexOf('</footer>');
  console.log('After </footer>:');
  console.log(footContent.substring(feIdx, feIdx + 150));
  console.log('');
}
