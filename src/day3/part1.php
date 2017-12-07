<?php

$input = (int) file_get_contents('input.txt', FILE_USE_INCLUDE_PATH);

$startTime = microtime(true);

$result = getDistance(getCoordinates($input));

$timeTaken = microtime(true) - $startTime;

print($result . "\n" . "Script execution time: " . $timeTaken . "\n");

function getDistance($end)
{
    $start = [0, 0];
    $distance = 0;

    for ($i = 0; $i < count($start); $i++) {
        $distance += abs($start[$i] - $end[$i]);
    }

    return $distance;
}

function getCoordinates(int $value): array
{
    $x = 0;
    $y = 0;

    $direction = 'right';

    $rightCheck = 1;
    $leftCheck = -1;
    $upCheck = 1;
    $downCheck = -1;

    for ($i = 1; $i < $value; $i++) {
        switch ($direction) {
            case 'right':
                $x++;

                if ($x === $rightCheck) {
                    $direction = 'up';
                    $rightCheck ++;
                }
                break;
            case 'up':
                $y++;

                if ($y === $upCheck) {
                    $direction = 'left';
                    $upCheck ++;
                }
                break;
            case 'left':
                $x--;

                if ($x === $leftCheck) {
                    $direction = 'down';
                    $leftCheck --;
                }
                break;
            case 'down':
                $y--;

                if ($y === $downCheck) {
                    $direction = 'right';
                    $downCheck --;
                }
                break;
        }
    }

    return [$x, $y];
}