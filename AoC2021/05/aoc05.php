<?php

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $lines = [];

    foreach ($text as $line) {

        $lines[] = preg_split("/ -> /", $line);
    }

    file_put_contents('lines_old.json', json_encode($lines));
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
    // file_put_contents('matrix.json', json_encode($matrix));
    // file_put_contents('lines.json', json_encode($lines));
    $counter = 0;
    foreach ($lines as $line) {
        $x1 = intval($line[0][0]);
        $y1 = intval($line[0][1]);
        $x2 = intval($line[1][0]);
        $y2 = intval($line[1][1]);
        // echo "x1=" . $x1 . " x2= " . $x2 . " y1=" . $y1 . " y2= " . $y2 . PHP_EOL;
        if ($x1 === $x2) {
            // echo "into y" . PHP_EOL;
            for ($k = min($y1, $y2); $k <= max($y1, $y2); $k++) {
                $matrix[$k][$x1]++;
            }
        }
        if ($y1 === $y2) {
            // echo "into x" . PHP_EOL;
            for ($k = min($x1, $x2); $k <= max($x1, $x2); $k++) {
                $matrix[$y1][$k]++;
            }
        }
        // file_put_contents('matrix_with_lines' . $counter . '.json', json_encode($matrix));
        $counter++;
    }
    // file_put_contents('matrix_with_lines.json', json_encode($matrix));
    return array_sum(array_map(fn ($x) => array_sum(array_map(fn ($y) => ($y > 1) ? 1 : 0, $x)), $matrix));
}
function myTestTwo()
{

    $dimension = 1000;
    $lines = readMyFile('text2.text');
    $matrix = array_fill(0, $dimension, array_fill(0, $dimension, 0));
    // file_put_contents('matrix.json', json_encode($matrix));
    // file_put_contents('lines.json', json_encode($lines));
    $counter = 0;
    foreach ($lines as $line) {
        $x1 = intval($line[0][0]);
        $y1 = intval($line[0][1]);
        $x2 = intval($line[1][0]);
        $y2 = intval($line[1][1]);
        // echo "x1=" . $x1 . " x2= " . $x2 . " y1=" . $y1 . " y2= " . $y2 . PHP_EOL;
        if ($x1 === $x2) {
            // echo "into y" . PHP_EOL;
            for ($k = min($y1, $y2); $k <= max($y1, $y2); $k++) {
                $matrix[$k][$x1]++;
            }
        }
        if ($y1 === $y2) {
            // echo "into x" . PHP_EOL;
            for ($k = min($x1, $x2); $k <= max($x1, $x2); $k++) {
                $matrix[$y1][$k]++;
            }
        } 
        if ($x1 != $x2 and $y1 != $y2) {
            // echo "into x an y" . PHP_EOL;
            // echo "x1=" . $x1 . " x2= " . $x2 . " y1=" . $y1 . " y2= " . $y2 . PHP_EOL;

            $delta = abs($x1 - $x2);
            $directionX = (($x1 - $x2) > 0) ? -1 : 1;
            $directionY = (($y1 - $y2) > 0) ? -1 : 1;
            // echo "delta " . $delta . " directionx " . $directionX . " directionY  " . $directionY .  PHP_EOL;
            for ($i = 0; $i <= $delta; $i++) {
                $matrix[$y1 + $directionY * $i][$x1 + $directionX * $i]++;
            }
        }
        // file_put_contents('matrix_with_lines' . $counter . '.json', json_encode($matrix));
        $counter++;
    }
    // file_put_contents('matrix_with_lines.json', json_encode($matrix));
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
