<?php

$input = (int) file_get_contents('input.txt', FILE_USE_INCLUDE_PATH);

$startTime = microtime(true);

$result = getValue($input);

$timeTaken = microtime(true) - $startTime;

print($result . "\n" . "Script execution time: " . $timeTaken . "\n");

function getValue(int $value): int
{
    $x = 0;
    $y = 0;

    $grid = ['00' => 1];

    $direction = 'right';

    $rightCheck = 1;
    $leftCheck = -1;
    $upCheck = 1;
    $downCheck = -1;

    $returnValue = 0;

    while (true) {
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

        $largerValue = 0;

        if (isset($grid[($x + 1) . '' . $y])) {
            $largerValue += $grid[($x + 1) . '' . $y];
        }
        if (isset($grid[($x - 1) . '' . $y])) {
            $largerValue += $grid[($x - 1) . '' . $y];
        }
        if (isset($grid[$x . '' . ($y + 1)])) {
            $largerValue += $grid[$x . '' . ($y + 1)];
        }
        if (isset($grid[$x . '' . ($y - 1)])) {
            $largerValue += $grid[$x . '' . ($y - 1)];
        }
        if (isset($grid[($x + 1) . '' . ($y + 1)])) {
            $largerValue += $grid[($x + 1) . '' . ($y + 1)];
        }
        if (isset($grid[($x + 1) . '' . ($y - 1)])) {
            $largerValue += $grid[($x + 1) . '' . ($y - 1)];
        }
        if (isset($grid[($x - 1) . '' . ($y + 1)])) {
            $largerValue += $grid[($x - 1) . '' . ($y + 1)];
        }
        if (isset($grid[($x - 1) . '' . ($y - 1)])) {
            $largerValue += $grid[($x - 1) . '' . ($y - 1)];
        }

        $grid[$x . '' . $y] = $largerValue;

        if ($value < $largerValue) {
            $returnValue = $largerValue;

            break;
        }
    }

    return $returnValue;
}