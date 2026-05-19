/**
 * PATCHED_v3: Hide empty contact section
 */
(function() {
    'use strict';
    if (window.__footerLoaded) return;
    window.__footerLoaded = true;
    var API = '/admin/api/footer-data.php';
    function gv(g, grp, key, def) {
        if (g && g[grp]) {
            for (var i = 0; i < g[grp].length; i++) {
                if (g[grp][i].item_key === key) {
                    var v = (g[grp][i].item_value || '').trim();
                    return v !== '' ? v : def;
                }
            }
        }
        return def;
    }
    function gu(g, grp, key) {
        if (g && g[grp]) for (var i = 0; i < g[grp].length; i++) if (g[grp][i].item_key === key) return g[grp][i].item_url || '';
        return '';
    }
    function gl(g, grp) { return (g && g[grp]) ? g[grp] : []; }
    function hv(g, grp) {
        if (g && g[grp]) for (var i = 0; i < g[grp].length; i++) if ((g[grp][i].item_value || '').trim() !== '') return true;
        return false;
    }
    function ep() {
        if (document.querySelector('.footer-provinces')) return;
        var fc = document.querySelector('.footer-container'); if (!fc) return;
        var fb = fc.querySelector('.footer-bottom');
        var h = '<div class="footer-provinces"><div class="footer-provinces-inner"><h4 class="footer-provinces-title">全国省份</h4><div class="footer-province-links">';
        var p = [['上海','shanghai'],['云南','yun-nan'],['内蒙古','nei-meng-gu'],['北京','beijing'],['吉林','ji-lin'],['四川','si-chuan'],['天津','tianjin'],['宁夏','ning-xia'],['安徽','an-hui'],['山东','shan-dong'],['山西','shan-xi'],['广东','guang-dong'],['广西','guang-xi'],['新疆','xin-jiang'],['江苏','jiang-su'],['江西','jiang-xi'],['河北','he-bei'],['河南','he-nan'],['浙江','zhe-jiang'],['海南','hai-nan'],['港澳台','gang-ao-tai'],['湖北','hu-bei'],['湖南','hu-nan'],['甘肃','gan-su'],['福建','fu-jian'],['西藏','xi-zang'],['贵州','gui-zhou'],['辽宁','liao-ning'],['重庆','chongqing'],['陕西','shaan-xi'],['青海','qing-hai'],['黑龙江','hei-long-jiang']];
        for (var i = 0; i < p.length; i++) h += '<a href="/fenzhan/province-' + p[i][1] + '.html" class="footer-province-item">' + p[i][0] + '资金服务</a>';
        h += '</div></div></div>';
        var d = document.createElement('div'); d.innerHTML = h;
        if (fb) fc.insertBefore(d.firstElementChild, fb); else fc.appendChild(d.firstElementChild);
    }
    function uf(g) {
        var de = document.querySelector('.footer-desc'); if (de) de.textContent = gv(g, 'brand', 'company_desc', '专业资金业务服务商，提供上市公司过桥、企业摆账、银行存款、应收账款融资等全方位资金服务');
        var qn = document.querySelector('.footer-nav[data-footer-group="quick_links"]'); if (qn) { var ql = qn.querySelector('.footer-nav-list'); if (ql) { var ln = gl(g, 'quick_links'); if (ln.length > 0) { ql.innerHTML = ''; for (var i = 0; i < ln.length; i++) { var li = document.createElement('li'); var a = document.createElement('a'); a.href = ln[i].item_url || '#'; a.textContent = ln[i].item_value || ln[i].item_label; li.appendChild(a); ql.appendChild(li); } } } }
        var cn = document.querySelector('.footer-nav[data-footer-group="contact"]'); if (cn) { if (hv(g, 'contact')) { cn.style.display = ''; var cl = cn.querySelector('.footer-nav-list'); if (cl) { cl.innerHTML = ''; var ct = gl(g, 'contact'); for (var j = 0; j < ct.length; j++) { var v = (ct[j].item_value || '').trim(); if (v === '') continue; var ic = ct[j].item_key === 'phone' ? 'fa-phone' : ct[j].item_key === 'email' ? 'fa-envelope' : 'fa-user'; var l2 = document.createElement('li'); l2.innerHTML = '<i class="fas ' + ic + '"></i> ' + v; cl.appendChild(l2); } } } else { cn.style.display = 'none'; } }
        var ce = document.querySelector('.footer-copyright'); if (ce) { var cr = gv(g, 'bottom', 'copyright_text', '© 2026 Yao资金网 宏都资本版权所有'); var cu = gu(g, 'bottom', 'copyright_text'); ce.innerHTML = cu ? '<a href="' + cu + '">' + cr + '</a>' : cr; }
        var de2 = document.querySelector('.footer-disclaimer'); if (de2) { var di = gv(g, 'bottom', 'disclaimer_text', '粤ICP备2026052915号'); var du = gu(g, 'bottom', 'disclaimer_text'); de2.innerHTML = du ? '<a href="' + du + '">' + di + '</a>' : di; }
        ep();
    }
    function lf() { var x = new XMLHttpRequest(); x.open('GET', API + '?t=' + Date.now(), true); x.onreadystatechange = function() { if (x.readyState === 4 && x.status === 200) { try { var r = JSON.parse(x.responseText); if (r.code === 0 && r.grouped) uf(r.grouped); } catch(e) {} } }; x.send(); }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', lf); else lf();
})();
