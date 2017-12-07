<?php

$result = 0;
$input = file_get_contents('input.txt', FILE_USE_INCLUDE_PATH);

$startTime = microtime(true);

foreach (explode("\n", $input) as $row) {
    $row = preg_split('/[\s]+/', $row);

    $result += max($row) - min($row);
}

$timeTaken = microtime(true) - $startTime;

print($result . "\n" . "Script execution time: " . $timeTaken . "\n");