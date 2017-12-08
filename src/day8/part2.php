<?php

$input = explode("\n", file_get_contents('input.txt', FILE_USE_INCLUDE_PATH));
$registers = [];
$highestValue = 0;

foreach ($input as $instruction) {
    $instruction = explode(' ', $instruction);

    $operationRegister = $instruction[0];
    $operator = $instruction[1];
    $operatorValue = (int) $instruction[2];
    $conditionRegister = $instruction[4];
    $conditionOperator = $instruction[5];
    $conditionValue = (int) $instruction[6];

    $registers[$operationRegister] = $registers[$operationRegister] ?? 0;
    $registers[$conditionRegister] = $registers[$conditionRegister] ?? 0;

    if (getCondition($conditionOperator, $registers[$conditionRegister], $conditionValue)) {
        $registers[$operationRegister] = getOperation($operator, $registers[$operationRegister], $operatorValue);
    }

    $currentHighest = max($registers);

    if ($highestValue < $currentHighest) {
        $highestValue = $currentHighest;
    }
}

function getOperation(string $operator, int $item, int $value): int
{
    switch ($operator) {
        case 'inc':
            $item += $value;
            break;
        case 'dec':
            $item -= $value;
            break;
    }

    return $item;
}

function getCondition(string $operator, int $item, int $value)
{
    switch ($operator) {
        case '>':
            return $item > $value;
        case '<':
            return $item < $value;
        case '>=':
            return $item >= $value;
        case '<=':
            return $item <= $value;
        case '!=':
            return $item != $value;
        case '==':
            return $item == $value;
    }
}

$startTime = microtime(true);

$timeTaken = microtime(true) - $startTime;

print($highestValue . "\n" . "Script execution time: " . $timeTaken . "\n");