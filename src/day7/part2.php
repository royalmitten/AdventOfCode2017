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

$unbalancedProgram = ['name' => $bottomProgram, 'ubWeight' => 0, 'nWeight' => 0];

while (true) {
    $unbalanced = getUnbalanced($programs, $unbalancedProgram['name']);

    if (false !== $unbalanced) {
        $unbalancedProgram = $unbalanced;
    } else {
        break;
    }
}

$correctWeight = $programs[$unbalancedProgram['name']]['weight'] + ($unbalancedProgram['nWeight'] - $unbalancedProgram['ubWeight']);

$timeTaken = microtime(true) - $startTime;

print($correctWeight . "\n" . "Script execution time: " . $timeTaken . "\n");

function getWeight(array $programs, string $programName): int
{
    $weight = $programs[$programName]['weight'];

    foreach ($programs[$programName]['children'] as $childProgramName) {
        $weight += getWeight($programs, $childProgramName);
    }

    return $weight;
}

function getUnbalanced(array $programs, string $programName)
{
    $weights = [];

    foreach ($programs[$programName]['children'] as $child) {
        $weights[$child] = getWeight($programs, $child);
    }

    $unbalancedWeight = array_filter(
            array_count_values($weights), function ($a) {
            return $a == 1;
        }
    );

    $normalWeight = array_keys(
        array_filter(
                array_count_values($weights), function ($a) {
                return $a != 1;
            }
        )
    )[0];

    if (empty($unbalancedWeight)) {
        return false;
    }

    $unbalancedWeight = array_keys($unbalancedWeight)[0];
    $unbalancedProgram = array_search($unbalancedWeight, $weights);

    return [
        'name' => $unbalancedProgram,
        'ubWeight' => $unbalancedWeight,
        'nWeight' => $normalWeight
    ];
}