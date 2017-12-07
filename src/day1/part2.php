<?php

$result = 0;
$index = 0;
$input = str_split(file_get_contents('input.txt', FILE_USE_INCLUDE_PATH));

$startTime = microtime(true);

foreach ($input as $char) {
    $compareIndex = $index + (count($input) / 2);

    if ($char === (!isset($input[$compareIndex]) ? $input[abs(count($input) - $compareIndex)] : $input[$compareIndex])) {
        $result += $input[$index];
    }
    $index ++;
}

$timeTaken = microtime(true) - $startTime;

print($result . "\n" . "Script execution time: " . $timeTaken . "\n");