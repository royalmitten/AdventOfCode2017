<?php

$banks = preg_split('/[\s]+/', file_get_contents('input.txt', FILE_USE_INCLUDE_PATH));
$cycles = 0;
$startTime = microtime(true);
$seenResults = [];
$result = '';

while (true) {
    $cycles ++;
    $index = $indexToMove = array_keys($banks, max($banks))[0];
    $numToMove = $banks[$indexToMove];
    $banks[$indexToMove] = 0;

    for ($i = 0; $i < $numToMove; $i++) {
        $index++;

        if (!isset($banks[$index])) {
            $index = 0;
        }

        $banks[$index]++;
    }

    $result = implode(",", $banks);

    if (in_array($result, $seenResults)) {
        break;
    }

    $seenResults[] = $result;
}

$searchKey = (array_search($result, $seenResults)) + 1;

$timeTaken = microtime(true) - $startTime;

print($cycles - $searchKey . "\n" . "Script execution time: " . $timeTaken . "\n");