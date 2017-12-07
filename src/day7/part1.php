<?php

$input = explode("\n", file_get_contents('input.txt', FILE_USE_INCLUDE_PATH));
$programs = [];
$bottomProgram = '';

$startTime = microtime(true);

foreach ($input as $row) {
    $name = substr($row, 0, strpos($row, '(') - 1);
    $children = [];

    if (false !== $arrowPosition = strpos($row, '->')) {
        $children = explode(', ', substr($row, strpos($row, '->') + 3));
    }

    preg_match('/\((.*?)\)/', $row, $weight);
    $weight = $weight[1];

    $programs[$name] = ['children' => $children, 'weight' => $weight];
}

foreach ($programs as $name => $program) {
    $hasParent = false;

    foreach ($programs as $cProgram) {
        if (in_array($name, $cProgram['children'])) {
            $hasParent = true;
            break;
        }
    }

    if (!$hasParent && !empty($program['children'])) {
        $bottomProgram = $name;
    }
}

$timeTaken = microtime(true) - $startTime;

print($bottomProgram . "\n" . "Script execution time: " . $timeTaken . "\n");