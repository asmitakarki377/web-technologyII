<?php
$handle = fopen('numbers.txt', 'r');
if (!$handle) die("Cannot open file.");

$freq = [];

while (!feof($handle)) {
    // Read ~30 bytes ≈ 10 numbers + spaces
    $chunk   = fread($handle, 30);
    $nums    = preg_split('/\s+/', trim($chunk), -1, PREG_SPLIT_NO_EMPTY);

    foreach ($nums as $n) {
        $n = (int)$n;
        $freq[$n] = ($freq[$n] ?? 0) + 1;
    }
}
fclose($handle);

/* ---- print only odd-count numbers ---- */
echo "Numbers occurring odd number of times:\n";
foreach ($freq as $n => $count) {
    if ($count % 2 !== 0) {
        echo $n . " ";
    }
}
echo PHP_EOL;
