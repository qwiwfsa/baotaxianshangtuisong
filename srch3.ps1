param([string]$File)
$lines = Select-String -Path $File -Pattern '/hongdu' -SimpleMatch
foreach ($line in $lines) {
    "$($line.LineNumber): $($line.Line)"
}
