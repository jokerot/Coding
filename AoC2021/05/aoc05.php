<?php

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $lines = [];

    foreach ($text as $line) {

        $lines[] = preg_split("/ -> /", $line);
    }

    $lines = array_map(
        function ($x) {
            $arr = [];
            $arr[] = explode(',', $x[0]);
            $arr[] = explode(',', $x[1]);
            return $arr;
        },
        $lines
    );

    return $lines;
}

function myTestOne()
{
    $dimension = 1000;
    $lines = readMyFile('text.text');
    $matrix = array_fill(0, $dimension, array_fill(0, $dimension, 0));
    $counter = 0;
    foreach ($lines as $line) {
        $x1 = intval($line[0][0]);
        $y1 = intval($line[0][1]);
        $x2 = intval($line[1][0]);
        $y2 = intval($line[1][1]);
        if ($x1 === $x2) {
            for ($k = min($y1, $y2); $k <= max($y1, $y2); $k++) {
                $matrix[$k][$x1]++;
            }
        }
        if ($y1 === $y2) {
            for ($k = min($x1, $x2); $k <= max($x1, $x2); $k++) {
                $matrix[$y1][$k]++;
            }
        }
        $counter++;
    }
    return array_sum(array_map(fn ($x) => array_sum(array_map(fn ($y) => ($y > 1) ? 1 : 0, $x)), $matrix));
}
function myTestTwo()
{

    $dimension = 1000;
    $lines = readMyFile('text2.text');
    $matrix = array_fill(0, $dimension, array_fill(0, $dimension, 0));
    $counter = 0;
    foreach ($lines as $line) {
        $x1 = intval($line[0][0]);
        $y1 = intval($line[0][1]);
        $x2 = intval($line[1][0]);
        $y2 = intval($line[1][1]);
        if ($x1 === $x2) {
            for ($k = min($y1, $y2); $k <= max($y1, $y2); $k++) {
                $matrix[$k][$x1]++;
            }
        }
        if ($y1 === $y2) {
            for ($k = min($x1, $x2); $k <= max($x1, $x2); $k++) {
                $matrix[$y1][$k]++;
            }
        }
        if ($x1 != $x2 and $y1 != $y2) {
            $delta = abs($x1 - $x2);
            $directionX = (($x1 - $x2) > 0) ? -1 : 1;
            $directionY = (($y1 - $y2) > 0) ? -1 : 1;
            for ($i = 0; $i <= $delta; $i++) {
                $matrix[$y1 + $directionY * $i][$x1 + $directionX * $i]++;
            }
        }
        $counter++;
    }
    return array_sum(array_map(fn ($x) => array_sum(array_map(fn ($y) => ($y > 1) ? 1 : 0, $x)), $matrix));
}





$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
