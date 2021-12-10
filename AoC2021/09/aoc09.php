<?php
$enlargedM = [];
$basinCounter = 0;
function readMyFile($fname)
{

    $text1 = file($fname, FILE_IGNORE_NEW_LINES);
    $enlarged = [];
    $enlarged[] = array_fill(0, strlen($text1[0]) + 2, 9);
    foreach ($text1 as $line) {
        $enlarged[] = array_merge([9], array_map(fn ($x) => intval($x), str_split($line)), [9]);
    }
    $enlarged[] = array_fill(0, strlen($text1[0]) + 2, 9);
    foreach ($enlarged as $e) echo implode('', $e) . PHP_EOL;
    return $enlarged;
}

function walkTheBasin($x, $y) {
    global $basinCounter, $enlargedM;
    $enlargedM[$x][$y] = 9;
    $basinCounter++;
    if ($enlargedM[$x-1][$y] < 9) walkTheBasin($x-1, $y);
    if ($enlargedM[$x+1][$y] < 9) walkTheBasin($x+1, $y);
    if ($enlargedM[$x][$y+1] < 9) walkTheBasin($x, $y+1);
    if ($enlargedM[$x][$y-1] < 9) walkTheBasin($x, $y-1);
}

function myTestOne()
{

    $matrix = readMyFile('text.text');
    
    $lowpoints = [];
    for ($i = 1; $i < count($matrix) - 1; $i++) {
        for ($j = 1; $j < count($matrix[0]) - 1; $j++) {

            if (intval($matrix[$i][$j]) < min($matrix[$i - 1][$j], $matrix[$i][$j - 1], $matrix[$i + 1][$j], $matrix[$i][$j + 1])) $lowpoints[] = $matrix[$i][$j] + 1;
        }
    }
    return array_sum($lowpoints);
}


function myTestTwo()
{
    global $basinCounter, $enlargedM;

    $matrix = readMyFile('text.text');
    for ($i = 1; $i < count($matrix) - 1; $i++) {
        for ($j = 1; $j < count($matrix[0]) - 1; $j++) {

            if (intval($matrix[$i][$j]) < min($matrix[$i - 1][$j], $matrix[$i][$j - 1], $matrix[$i + 1][$j], $matrix[$i][$j + 1])) {
                $lowpointsCoordinates[] = [$i, $j];
            }
        }
    }
    $basins = [];
    foreach($lowpointsCoordinates as $basin) {
        $enlargedM = $matrix;
        $basinCounter = 0;
        walkTheBasin($basin[0], $basin[1]);
        $basins[] = $basinCounter;

    }
    rsort($basins);
    return array_product(array_slice($basins, 0, 3));
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
