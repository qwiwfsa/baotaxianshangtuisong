const fs = require('fs');

const baseDir = 'D:/yingyong/xampp/htdocs/';

// File-specific footer replacements: [file, oldFooter, newFooter]
const replacements = [];

// ===== cases.html =====
const casesFooterOld = `<footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="./uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务</p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">                   <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"><li><a href="http://localhost/index.html">首页</a></li><li><a href="http://localhost/services.html">业务范围</a></li><li><a href="http://localhost/cases.html">成功案例</a></li><li><a href="http://localhost/advantages.html">服务优势</a></li></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">                   <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"><li><a href="http://localhost/news.html">行业资讯</a></li><li><a href="http://localhost/faq.html">常见问题</a></li><li><a href="http://localhost/contact.html">联系我们</a></li></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">                   <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"><li><i class="fas fa-user"></i> 王总</li><li><i class="fas fa-phone"></i> 13552883008 </li><li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">© 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，理财需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

const casesFooterNew = `    <!-- 页脚（动态加载 - js/footer-loader.js） -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="./uploads/logo/logo_20260502_190529_69f62ed969290.png" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>
    <script src="js/footer-loader.js"></script>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

// ===== case-detail.html =====
const caseDetailFooterOld = `<footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务</p>
                </div>
                <div class="footer-nav">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <li><a href="index.html">首页</a></li>
                        <li><a href="services.html">业务范围</a></li>
                        <li><a href="cases.html">成功案例</a></li>
                        <li><a href="advantages.html">服务优势</a></li>
                    </ul>
                </div>
                <div class="footer-nav">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <li><a href="news.php">行业资讯</a></li>
                        <li><a href="faq.html">常见问题</a></li>
                        <li><a href="contact.html">联系我们</a></li>
                    </ul>
                </div>
                <div class="footer-nav">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>`;

const caseDetailFooterNew = `    <!-- 页脚（动态加载 - js/footer-loader.js） -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>
    <script src="js/footer-loader.js"></script>`;

// ===== contact.html =====
const contactFooterOld = `<footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务</p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">                   <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <li><a href="index.html">首页</a></li>
                        <li><a href="services.html">业务范围</a></li>
                        <li><a href="cases.html">成功案例</a></li>
                        <li><a href="advantages.html">服务优势</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">                   <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <li><a href="news.php">行业资讯</a></li>
                        <li><a href="faq.html">常见问题</a></li>
                        <li><a href="contact.html">联系我们</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">                   <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

const contactFooterNew = `    <!-- 页脚（动态加载 - js/footer-loader.js） -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>
    <script src="js/footer-loader.js"></script>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

// ===== services.html =====
const servicesFooterOld = `<footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务</p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">                   <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <li><a href="index.html">首页</a></li>
                        <li><a href="services.html">业务范围</a></li>
                        <li><a href="cases.html">成功案例</a></li>
                        <li><a href="advantages.html">服务优势</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">                   <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <li><a href="news.php">行业资讯</a></li>
                        <li><a href="faq.html">常见问题</a></li>
                        <li><a href="contact.html">联系我们</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">                   <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

const servicesFooterNew = `    <!-- 页脚（动态加载 - js/footer-loader.js） -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>
    <script src="js/footer-loader.js"></script>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

// ===== advantages.html =====
const advFooterOld = `<footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务</p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">                   <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <li><a href="index.html">首页</a></li>
                        <li><a href="services.html">业务范围</a></li>
                        <li><a href="cases.html">成功案例</a></li>
                        <li><a href="advantages.html">服务优势</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">                   <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <li><a href="news.php">行业资讯</a></li>
                        <li><a href="faq.html">常见问题</a></li>
                        <li><a href="contact.html">联系我们</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">                   <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

const advFooterNew = `    <!-- 页脚（动态加载 - js/footer-loader.js） -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>
    <script src="js/footer-loader.js"></script>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

// ===== faq.html =====
const faqFooterOld = `<footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo/biaoqianlogo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>

                    <p class="footer-desc">专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、云信融资出表等全方位资金服务</p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">                   <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list">
                        <li><a href="index.html">首页</a></li>
                        <li><a href="services.html">业务范围</a></li>
                        <li><a href="cases.html">成功案例</a></li>
                        <li><a href="advantages.html">服务优势</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">                   <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list">
                        <li><a href="news.php">行业资讯</a></li>
                        <li><a href="faq.html">常见问题</a></li>
                        <li><a href="contact.html">联系我们</a></li>
                    </ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">                   <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list">
                        <li><i class="fas fa-phone"></i> 13552883008</li>
                        <li><i class="fas fa-user"></i> 王总</li>
                        <li><i class="fas fa-envelope"></i> wanglizhongguo@126.com</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2024 Yao资金网 版权所有</p>
                <p class="footer-disclaimer">投资有风险，入市需谨慎。本网站内容仅供参考，不构成投资建议。</p>
            </div>
        </div>
    </footer>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

const faqFooterNew = `    <!-- 页脚（动态加载 - js/footer-loader.js） -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="footer-logo"><img src="uploads/logo/biaoqianlogo.png?v=20260502041100" alt="Yao资金网" style="height:48px;width:auto;"></div>
                    <p class="footer-desc"></p>
                </div>
                <div class="footer-nav" data-footer-group="quick_links">
                    <h4 class="footer-nav-title">快速链接</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="service_links">
                    <h4 class="footer-nav-title">更多内容</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
                <div class="footer-nav" data-footer-group="contact">
                    <h4 class="footer-nav-title">联系方式</h4>
                    <ul class="footer-nav-list"></ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright"></p>
                <p class="footer-disclaimer"></p>
            </div>
        </div>
    </footer>
    <script src="js/footer-loader.js"></script>
    <script src="admin/assets/cms.js"></script>

    <script src="js/main.js"></script>`;

// Process each file
const patches = [
  ['cases.html', casesFooterOld, casesFooterNew],
  ['case-detail.html', caseDetailFooterOld, caseDetailFooterNew],
  ['contact.html', contactFooterOld, contactFooterNew],
  ['services.html', servicesFooterOld, servicesFooterNew],
  ['advantages.html', advFooterOld, advFooterNew],
  ['faq.html', faqFooterOld, faqFooterNew],
];

let allOk = true;
for (const [file, oldText, newText] of patches) {
  const path = baseDir + file;
  let content;
  try {
    content = fs.readFileSync(path, 'utf8');
  } catch (e) {
    console.log(file + ': ERROR reading - ' + e.message);
    allOk = false;
    continue;
  }

  if (content.includes(oldText)) {
    content = content.replace(oldText, newText);
    fs.writeFileSync(path, 'utf8');
    console.log(file + ': ✓ UPDATED');
  } else {
    // Try to find the footer region
    const fIdx = content.indexOf('<footer class="footer">');
    if (fIdx >= 0) {
      console.log(file + ': ✗ OLD TEXT MISMATCH - footer found at char ' + fIdx);
      console.log('   First 80 chars: ' + JSON.stringify(content.substring(fIdx, fIdx+80)));
      allOk = false;
    } else {
      console.log(file + ': ✗ NO FOOTER FOUND');
      allOk = false;
    }
  }
}

if (allOk) {
  console.log('\nAll files updated successfully!');
} else {
  console.log('\nSome files had issues!');
}
