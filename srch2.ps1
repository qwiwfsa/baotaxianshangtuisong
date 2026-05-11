$base = 'D:\yingyong\xampp\htdocs\hongdu\'
$patterns = @('"/hongdu/', "'/hongdu/", 'href="/hongdu/', "href='/hongdu/", 'src="/hongdu/', "src='/hongdu/", 'url(/hongdu/', 'url("/hongdu/', "url('/hongdu/", '=/hongdu/')
$exclude = @('node_modules', 'vendor', 'composer', 'wp-includes', 'wp-content\plugins', 'wp-content\themes', 'search_hongdu')
$extensions = @('*.php', '*.html', '*.js', '*.css', '*.json')
$count = 0
$max = 150

foreach ($ext in $extensions) {
    $files = Get-ChildItem -Path $base -Filter $ext -Recurse -ErrorAction SilentlyContinue
    foreach ($f in $files) {
        $skip = $false
        foreach ($excl in $exclude) {
            if ($f.FullName -match [regex]::Escape($excl)) { $skip = $true; break }
        }
        if ($skip) { continue }
        try {
            $content = Get-Content $f.FullName -Raw -ErrorAction Stop
            foreach ($pat in $patterns) {
                if ($content.Contains($pat)) {
                    $rel = $f.FullName.Replace($base, '')
                    Write-Output "$rel | $pat"
                    $count++
                    break
                }
            }
            if ($count -ge $max) { break }
        } catch {}
    }
    if ($count -ge $max) { break }
}
Write-Output "---TOTAL: $count"
