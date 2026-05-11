$base = "D:\yingyong\xampp\htdocs\hongdu"
$utf8 = [System.Text.UTF8Encoding]::new($false)

# Fix admin/page-builder.html
$f = "$base\admin\page-builder.html"
$c = [System.IO.File]::ReadAllText($f, $utf8)
$c = $c.Replace('/hongdu/css/style.css', '../css/style.css')
$c = $c.Replace('/hongdu/assets/css/page-builder.css', '../assets/css/page-builder.css')
$c = $c.Replace('/hongdu/js/main.js', '../js/main.js')
$c = $c.Replace('/hongdu/assets/js/page-builder.js', '../assets/js/page-builder.js')
$c = $c.Replace('/hongdu/admin/api/page-builder/', 'api/page-builder/')
# Add dynamic baseUrl variable
$oldBlock = "let html = data.html || '<div>自定义HTML内容</div>';"
$newBlock = "let html = data.html || '<div>自定义HTML内容</div>';`r`n            let baseUrl = (function() { var p = window.location.pathname.split('/'); return p.length > 2 ? '/' + p[1] + '/' : '/'; })();"
$c = $c.Replace($oldBlock, $newBlock)
# Fix the JS regex patterns
$c = $c.Replace("/hongdu)/g, 'src=", ")/g, 'src=`"+baseUrl")
$c = $c.Replace("/hongdu|#|javascript)/g, 'href=", "|#|javascript)/g, 'href=`"+baseUrl")
[System.IO.File]::WriteAllText($f, $c, $utf8)
Write-Output "Fixed: page-builder.html"

# Fix admin/visual-editor-v3.html
$f = "$base\admin\visual-editor-v3.html"
$c = [System.IO.File]::ReadAllText($f, $utf8)
$c = $c.Replace("'/hongdu/mobile/' + pageUrl", "'../mobile/' + pageUrl")
$c = $c.Replace("'/hongdu/tablet/' + pageUrl", "'../tablet/' + pageUrl")
$c = $c.Replace("'/hongdu/' + pageUrl", "'../' + pageUrl")
$c = $c.Replace("'/hongdu/mobile/' + currentPage", "'../mobile/' + currentPage")
$c = $c.Replace("'/hongdu/tablet/' + currentPage", "'../tablet/' + currentPage")
$c = $c.Replace("'/hongdu/' + currentPage", "'../' + currentPage")
$c = $c.Replace("'/hongdu/admin/api/page-builder/save-mobile-page.php'", "'api/page-builder/save-mobile-page.php'")
$c = $c.Replace("'/hongdu/admin/api/page-builder/save-tablet-page.php'", "'api/page-builder/save-tablet-page.php'")
$c = $c.Replace("'/hongdu/admin/api/page-builder/save-page.php'", "'api/page-builder/save-page.php'")
[System.IO.File]::WriteAllText($f, $c, $utf8)
Write-Output "Fixed: visual-editor-v3.html"

# Fix admin/visual-editor.html
$f = "$base\admin\visual-editor.html"
$c = [System.IO.File]::ReadAllText($f, $utf8)
$c = $c.Replace('/hongdu/admin/api/page-builder/save-page.php', 'api/page-builder/save-page.php')
[System.IO.File]::WriteAllText($f, $c, $utf8)
Write-Output "Fixed: visual-editor.html"

# Fix admin/mobile-editor.html
$f = "$base\admin\mobile-editor.html"
$c = [System.IO.File]::ReadAllText($f, $utf8)
$c = $c.Replace("'/hongdu/mobile/' + pageUrl", "'../mobile/' + pageUrl")
$c = $c.Replace("'/hongdu/mobile/' + currentPage", "'../mobile/' + currentPage")
$c = $c.Replace("'/hongdu/admin/api/page-builder/save-mobile-page.php'", "'api/page-builder/save-mobile-page.php'")
[System.IO.File]::WriteAllText($f, $c, $utf8)
Write-Output "Fixed: mobile-editor.html"

# Fix admin/components/news/article-list.html
$f = "$base\admin\components\news\article-list.html"
$c = [System.IO.File]::ReadAllText($f, $utf8)
$c = $c.Replace('/hongdu/news-detail.php?id=', '../../news-detail.php?id=')
[System.IO.File]::WriteAllText($f, $c, $utf8)
Write-Output "Fixed: article-list.html"

# Fix admin/assets/cms.js
$f = "$base\admin\assets\cms.js"
$c = [System.IO.File]::ReadAllText($f, $utf8)
$c = $c.Replace("const CMS_BASE = '/hongdu/admin/';", 
    "const CMS_BASE = (function() { var p = window.location.pathname.split('/'); if (p.length >= 3) return '/' + p[1] + '/' + p[2] + '/'; return './'; })();")
$c = $c.Replace("fetch('/hongdu/admin/api/footer-data.php')", "fetch(CMS_BASE + 'api/footer-data.php')")
[System.IO.File]::WriteAllText($f, $c, $utf8)
Write-Output "Fixed: cms.js"

Write-Output "=== Admin files complete ==="