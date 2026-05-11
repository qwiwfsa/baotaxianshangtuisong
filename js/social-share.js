// Social Share Functionality
(function() {
    'use strict';

    // Helper: safe get of data attribute with fallback
    function getShareText(key, fallback) {
        return document.documentElement.getAttribute(key) || fallback || '';
    }

    // Get current page URL and title
    function getShareUrl() {
        return window.location.href.split('#')[0];
    }

    function getShareTitle() {
        var t = document.title || '';
        return t.replace(/ - .*$/, '').trim() || t;
    }

    // === QR Code for WeChat ===
    var qrModalEl = null;

    function buildQrModal(url) {
        var qrSrc = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(url);
        var title = getShareTitle();
        var desc = getShareText('data-share-wx-desc', '打开微信扫一扫，分享给好友或朋友圈');
        var hint = getShareText('data-share-wx-hint', '打开微信「扫一扫」分享');
        var closeText = getShareText('data-share-close', '关闭');
        var html = '<div class="wechat-share-modal" id="wxQrModal">'
            + '<div class="wechat-share-content">'
            + '<div class="wechat-share-title">' + title + '</div>'
            + '<div class="wechat-share-desc">' + desc + '</div>'
            + '<div class="wechat-qr-container">'
            + '<img src="' + qrSrc + '" alt="QR Code" id="wxQrImg">'
            + '</div>'
            + '<p style="font-size:13px;color:#9ca3af;margin:-8px 0 20px">' + hint + '</p>'
            + '<button class="wechat-share-close" onclick="closeWechatShare()">' + closeText + '</button>'
            + '</div></div>';
        return html;
    }

    window.openWechatShare = function(url) {
        var existing = document.getElementById('wxQrModal');
        if (existing) existing.remove();
        document.body.insertAdjacentHTML('beforeend', buildQrModal(url));
        qrModalEl = document.getElementById('wxQrModal');
        setTimeout(function() {
            if (qrModalEl) qrModalEl.classList.add('show');
        }, 10);
        if (qrModalEl) {
            qrModalEl.addEventListener('click', function(e) {
                if (e.target === this) closeWechatShare();
            });
        }
    };

    window.closeWechatShare = function() {
        if (qrModalEl) {
            qrModalEl.classList.remove('show');
            setTimeout(function() {
                if (qrModalEl) qrModalEl.remove();
                qrModalEl = null;
            }, 300);
        }
    };

    // === Copy Link ===
    window.copyLink = function(url, btnEl) {
        var ta = document.createElement('textarea');
        ta.value = url;
        ta.style.cssText = 'position:fixed;left:-9999px;top:0;opacity:0';
        document.body.appendChild(ta);
        ta.select();
        try {
            document.execCommand('copy');
            showCopyToast(getShareText('data-share-copied', '链接已复制'));
            if (btnEl) {
                var origHtml = btnEl.innerHTML;
                btnEl.classList.add('copied');
                btnEl.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(function() {
                    btnEl.classList.remove('copied');
                    btnEl.innerHTML = origHtml;
                }, 2000);
            }
        } catch(e) {
            showCopyToast(getShareText('data-share-copy-fail', '复制失败'));
        }
        document.body.removeChild(ta);
    };

    function showCopyToast(msg) {
        var existing = document.getElementById('shareCopyToast');
        if (existing) existing.remove();
        var toast = document.createElement('div');
        toast.id = 'shareCopyToast';
        toast.className = 'copy-toast';
        toast.innerHTML = '<i class="fas fa-check-circle" style="margin-right:8px"></i>' + msg;
        document.body.appendChild(toast);
        setTimeout(function() { toast.classList.add('show'); }, 10);
        setTimeout(function() {
            toast.classList.remove('show');
            setTimeout(function() { toast.remove(); }, 300);
        }, 3000);
    }

    // === Build Share HTML ===
    function buildShareCompact(url, title) {
        var u = encodeURIComponent(url);
        var t = encodeURIComponent(title || getShareTitle());
        var label = getShareText('data-share-label', '分享到：');
        return '<div class="article-share-compact">'
            + '<span class="social-share-label">' + label + '</span>'
            + '<button class="share-btn wechat" onclick="openWechatShare(\'' + url.replace(/'/g, "\\'") + '\')" title="微信"><i class="fab fa-weixin"></i></button>'
            + '<button class="share-btn wechat-moments" onclick="openWechatShare(\'' + url.replace(/'/g, "\\'") + '\')" title="朋友圈"><i class="fas fa-users"></i></button>'
            + '<button class="share-btn qq" onclick="window.open(\'https://connect.qq.com/widget/shareqq/index.html?url=' + u + '&title=' + t + '\',\'_blank\',\'width=680,height=520\')" title="QQ"><i class="fab fa-qq"></i></button>'
            + '<button class="share-btn weibo" onclick="window.open(\'https://service.weibo.com/share/share.php?url=' + u + '&title=' + t + '\',\'_blank\',\'width=680,height=520\')" title="微博"><i class="fab fa-weibo"></i></button>'
            + '<button class="share-btn copy" onclick="copyLink(\'' + url.replace(/'/g, "\\'") + '\',this)" title="复制链接"><i class="fas fa-link"></i></button>'
            + '</div>';
    }

    function buildShareFull(url, title) {
        var u = encodeURIComponent(url);
        var t = encodeURIComponent(title || getShareTitle());
        var shareTo = '分享到';
        return '<div class="article-share-full">'
            + '<div class="share-left">'
            + '<span class="share-title">' + shareTo + '</span>'
            + '<div class="share-buttons">'
            + '<button class="share-btn wechat" onclick="openWechatShare(\'' + url.replace(/'/g, "\\'") + '\')" title="微信"><i class="fab fa-weixin"></i><span class="share-btn-label">微信</span></button>'
            + '<button class="share-btn wechat-moments" onclick="openWechatShare(\'' + url.replace(/'/g, "\\'") + '\')" title="朋友圈"><i class="fas fa-users"></i><span class="share-btn-label">朋友圈</span></button>'
            + '<button class="share-btn qq" onclick="window.open(\'https://connect.qq.com/widget/shareqq/index.html?url=' + u + '&title=' + t + '\',\'_blank\',\'width=680,height=520\')" title="QQ"><i class="fab fa-qq"></i><span class="share-btn-label">QQ</span></button>'
            + '<button class="share-btn weibo" onclick="window.open(\'https://service.weibo.com/share/share.php?url=' + u + '&title=' + t + '\',\'_blank\',\'width=680,height=520\')" title="微博"><i class="fab fa-weibo"></i><span class="share-btn-label">微博</span></button>'
            + '<button class="share-btn copy" onclick="copyLink(\'' + url.replace(/'/g, "\\'") + '\',this)" title="复制链接"><i class="fas fa-link"></i><span class="share-btn-label">复制链接</span></button>'
            + '</div></div></div>';
    }

    function resolveUrl(href) {
        if (!href) return window.location.href;
        if (href.indexOf('http://') === 0 || href.indexOf('https://') === 0) return href;
        var base = window.location.origin + window.location.pathname.replace(/[^/]+$/, '');
        if (href.indexOf('/') === 0) {
            return window.location.origin + href;
        }
        return base + href;
    }

    // === Add share to list page ===
    function addShareToListPage() {
        // Priority 1: PC list page with .news-card structure
        var cards = document.querySelectorAll('.news-card');
        if (cards.length > 0) {
            cards.forEach(function(card) {
                if (card.querySelector('.article-share-compact')) return;
                var link = card.querySelector('a[href*="news-detail"]');
                var titleEl = card.querySelector('h3');
                if (link && titleEl) {
                    var href = link.getAttribute('href');
                    var absUrl = resolveUrl(href);
                    var title = titleEl.textContent.trim();
                    var content = card.querySelector('.news-content');
                    if (content) {
                        content.insertAdjacentHTML('beforeend', buildShareCompact(absUrl, title));
                    }
                }
            });
            return;
        }

        // Priority 2: Mobile list page - articles rendered as divs inline in .news-list-container
        var container = document.querySelector('.news-list-container');
        if (!container) return;

        var items = container.querySelectorAll(':scope > div');
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            if (!item || item.tagName !== 'DIV') continue;
            if (item.querySelector('.article-share-compact')) continue;
            // Check it's an article item (has a link to news-detail and h3)
            var link = item.querySelector('a[href*="news-detail"]');
            var titleEl = item.querySelector('h3');
            if (link && titleEl) {
                var href = link.getAttribute('href');
                var absUrl = resolveUrl(href);
                var title = titleEl.textContent.trim();

                // Try to find the flex-1 content wrapper (inline style or any text container)
                // Mobile renders: <div style="flex:1;padding:...">
                var contentWrapper = item.querySelector('div[style*="flex:"]');
                if (!contentWrapper) {
                    // Fallback: find any div that contains the h3 and isn't the thumb
                    var childDivs = item.querySelectorAll(':scope > div');
                    for (var j = 0; j < childDivs.length; j++) {
                        if (childDivs[j].querySelector('h3')) {
                            contentWrapper = childDivs[j];
                            break;
                        }
                    }
                }
                if (contentWrapper) {
                    contentWrapper.insertAdjacentHTML('beforeend', buildShareCompact(absUrl, title));
                } else {
                    item.insertAdjacentHTML('beforeend', buildShareCompact(absUrl, title));
                }
            }
        }
    }

    // === Add share bar to detail page ===
    function addShareToDetailPage() {
        // Skip if already injected by the HTML template
        if (window.__shareBarInjected) return;
        if (document.querySelector('.article-share-full')) return;

        var titleEl = document.querySelector('h1.article-detail-title');
        if (!titleEl) {
            // Content not yet loaded, retry
            setTimeout(addShareToDetailPage, 500);
            return;
        }
        var title = titleEl.textContent.trim();
        var url = getShareUrl();

        // Look for the content container: insert share bar after article-detail-main (article body)
        // to place it between article body and related-articles section
        var main = document.querySelector('.article-detail-main');
        
        if (main) {
            var shareHtml = buildShareFull(url, title);
            // Insert after .article-detail-main, inside #articleContent
            main.insertAdjacentHTML('afterend', shareHtml);
        } else {
            // Fallback: find the content area
            var content = document.querySelector('#articleContent') ||
                          document.querySelector('.article-detail-content') ||
                          document.querySelector('.article-detail-container');
            if (content && !content.querySelector('.article-share-full')) {
                var shareHtml = buildShareFull(url, title);
                content.insertAdjacentHTML('beforeend', shareHtml);
            }
        }
    }

    // Also expose the share URL/title for inline usage
    window.__getShareUrl = getShareUrl;
    window.__getShareTitle = getShareTitle;

    // === Init ===
    document.addEventListener('DOMContentLoaded', function() {
        var path = window.location.pathname;

        // Check if it's a detail page
        if (path.indexOf('news-detail') !== -1) {
            // Wait for dynamic content to load, then add share
            setTimeout(addShareToDetailPage, 500);
            setTimeout(addShareToDetailPage, 2000);
            setTimeout(addShareToDetailPage, 4000);
            return;
        }

        // Check if it's a list page
        if (path.indexOf('news') !== -1) {
            function tryAddList() {
                addShareToListPage();
                var retries = 0;
                var interval = setInterval(function() {
                    retries++;
                    addShareToListPage();
                    if (retries > 5) clearInterval(interval);
                }, 2000);
            }
            setTimeout(tryAddList, 1000);
        }
    });
})();
