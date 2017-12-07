<?php

$steps = 0;
$index = 0;
$maze = array_map('intval', explode("\n",  file_get_contents('input.txt', FILE_USE_INCLUDE_PATH)));

$startTime = microtime(true);

while (true) {
    $jumpTo = $maze[$index];
    $maze[$index] ++;
    $index += $jumpTo;
    $steps++;

    if (!isset($maze[$index])) {
        break;
    }
}

$timeTaken = microtime(true) - $startTime;

print($steps . "\n" . "Script execution time: " . $timeTaken . "\n");