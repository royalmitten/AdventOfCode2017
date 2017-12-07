<?php

$checksum = 0;
$input = file_get_contents('input.txt', FILE_USE_INCLUDE_PATH);

$startTime = microtime(true);

foreach (explode("\n", $input) as $row) {
    $row = preg_split('/[\s]+/', $row);

    foreach ($row as $key => $num) {
        foreach ($row as $dKey => $dNum) {
            if ($key !== $dKey && $num % $dNum == 0) {
                $checksum += $num / $dNum;
            }
        }
    }
}

$timeTaken = microtime(true) - $startTime;

print($checksum . "\n" . "Script execution time: " . $timeTaken . "\n");