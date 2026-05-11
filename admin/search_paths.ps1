$files = @(
    "page-builder.html", 
    "visual-editor-v3.html",
    "mobile-editor.html",
    "visual-editor.html"
)

foreach ($f in $files) {
    $path = Join-Path $PSScriptRoot $f
    Write-Host "=== $f ==="
    $lines = Get-Content $path -Encoding UTF8
    for ($i = 0; $i -lt $lines.Count; $i++) {
        $line = $lines[$i]
        if ($line -match '/admin/') {
            $num = $i + 1
            Write-Host "$num : $($line.Trim())"
        }
    }
    if ($i -eq $lines.Count) { Write-Host "(no /admin/ matches)" }
    Write-Host ""
}
