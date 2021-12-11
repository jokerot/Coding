<?php
$glMatrix = [];
$counter = 0;

function readMyFile($fname)
{
    $text1 = file($fname, FILE_IGNORE_NEW_LINES);
    $enlarged = [];
    $enlarged[] = array_fill(0, strlen($text1[0]) + 2, 0);
    foreach ($text1 as $line) {
        $enlarged[] = array_merge([0], array_map(fn ($x) => intval($x), str_split($line)), [0]);
    }
    $enlarged[] = array_fill(0, strlen($text1[0]) + 2, 0);
    return $enlarged;
}

function flash($x, $y)
{
    global $glMatrix;
    $adjanced = [[-1, -1], [-1, 0], [-1, 1], [0, 1], [1, 1], [1, 0], [1, -1], [0, -1]];
    foreach ($adjanced as $a) {
        $glMatrix[$x + $a[0]][$y + $a[1]] += 1;
        $glMatrix[$x][$y] += 1000;
    }
}

function checkSync()
{
    global $glMatrix;

    for ($i = 1; $i < count($glMatrix) - 1; $i++) {
        for ($j = 1; $j < count($glMatrix[0]) - 1; $j++) {
            if ($glMatrix[$i][$j] < 9) {
                return false;
            }
        }
    }
    return true;
}

function lightTheMatrix()
{
    global $glMatrix, $counter;
    $hadLight = true;
    while ($hadLight) {
        $hadLight = false;
        for ($i = 1; $i < count($glMatrix) - 1; $i++) {
            for ($j = 1; $j < count($glMatrix[0]) - 1; $j++) {

                if ($glMatrix[$i][$j] > 9 and $glMatrix[$i][$j] < 1000) {
                    $hadLight = true;
                    $counter += 1;
                    flash($i, $j);
                }
            }
        }
    }
}

function myTestOne()
{
    global $glMatrix, $counter;
    $glMatrix = readMyFile('text.text');

    for ($k = 0; $k < 100; $k++) {
        $glMatrix = array_map(fn ($x) => array_map(fn ($y) => ($y > 9) ? 0 : $y, $x), $glMatrix);
        $glMatrix = array_map(fn ($x) => array_map(fn ($y) => $y + 1, $x), $glMatrix);
        lightTheMatrix();
    }

    return $counter;
}


function myTestTwo()
{
    global $glMatrix;
    $glMatrix = readMyFile('text.text');
    $notSync = true;
    $countSync = 0;
    while ($notSync) {
        $glMatrix = array_map(fn ($x) => array_map(fn ($y) => ($y > 9) ? 0 : $y, $x), $glMatrix);
        $glMatrix = array_map(fn ($x) => array_map(fn ($y) => $y + 1, $x), $glMatrix);
        lightTheMatrix();
        $countSync += 1;
        if (checkSync()) break;
    }

    return $countSync;
}

$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
