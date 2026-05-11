$base = 'D:\yingyong\xampp\htdocs\hongdu\'
$extensions = @('*.php', '*.html', '*.js', '*.css', '*.json')
$exclude = @('node_modules', 'vendor', 'composer', 'wp-includes', 'wp-content\plugins', 'wp-content\themes')
$count = 0
$max = 100

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
            if ($content -match '/hongdu/') {
                Write-Output $f.FullName.Replace($base, '')
                $count++
                if ($count -ge $max) { break }
            }
        } catch {}
    }
    if ($count -ge $max) { break }
}
Write-Output "---TOTAL: $count"
