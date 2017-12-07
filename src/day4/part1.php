<?php

$valid = 0;
$input = file_get_contents('input.txt', FILE_USE_INCLUDE_PATH);

$startTime = microtime(true);

foreach (explode("\n", $input) as $row) {
    $words = preg_split('/[\s]+/', $row);
    $isValidPhrase = true;

    foreach ($words as $key => $word) {
        foreach ($words as $cKey => $cWord) {
            if ($key !== $cKey && $word === $cWord) {
                $isValidPhrase = false;
            }
        }
    }

    if ($isValidPhrase) {
        $valid++;
    }
}

$timeTaken = microtime(true) - $startTime;

print($valid . "\n" . "Script execution time: " . $timeTaken . "\n");