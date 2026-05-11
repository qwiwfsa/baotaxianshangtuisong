const fs = require('fs');

const base = 'D:/yingyong/xampp/htdocs/';

/**
 * Extract footer and its trailing scripts for each file,
 * then output the exact text as a Node-ready escaped string.
 */

const files = ['cases.html','case-detail.html','contact.html','services.html','advantages.html','faq.html'];

for (const f of files) {
  const content = fs.readFileSync(base + f, 'utf8');
  
  // Find footer start
  const startIdx = content.indexOf('<footer class="footer">');
  if (startIdx < 0) { console.log(f + ': no footer'); continue; }
  
  // Find the next footer end and capture until the next <script> or blank line
  const endIdx = content.indexOf('</footer>', startIdx);
  if (endIdx < 0) { console.log(f + ': no end'); continue; }
  
  // After </footer>, capture script tags and blanks until the next content block
  const afterEnd = endIdx + 9; // length of '</footer>'
  let endOfBlock = afterEnd;
  
  // Look for pattern: optional whitespace/lines + script tags
  const remaining = content.substring(afterEnd);
  // Match scripts and blank lines
  const scriptMatch = remaining.match(/^(\s*<script[^>]*><\/script>\s*)*/);
  if (scriptMatch) {
    endOfBlock = afterEnd + scriptMatch[0].length;
  }
  
  // Extract the FULL footer block including what comes after </footer>
  const footerBlock = content.substring(startIdx, endOfBlock);
  
  // Write to file for reference
  console.log('=== ' + f + ' ===');
  console.log('Footer block (' + footerBlock.length + ' chars):');
  // Show as escaped
  const escaped = footerBlock.replace(/\\/g, '\\\\').replace(/`/g, '\\`').replace(/\$/g, '\\$');
  console.log(escaped);
  console.log('');
}
