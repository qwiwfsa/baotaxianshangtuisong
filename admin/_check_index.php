<?php
$data = json_decode(file_get_contents(__DIR__ . "/../data/cases-index.json"), true);
foreach ($data as $c) {
    $img = $c["image"] ?? "(none)";
    echo "  \"{$c["id"]}\" title=\"{$c["title"]}\" type=\"{$c["type"]}\" img=\"{$img}\"" . PHP_EOL;
}
