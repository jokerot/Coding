<?php

$matrix = [];
$matrix_calculated = [];


function readMyFile($fname)
{
    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $arr = [];

    foreach ($text as $line) {
        $l = str_split($line);
        $arr[] = $l;
    }


    return $arr;
}

function move($sum_of_curr_path, $x, $y, $counter)
{
    global $matrix, $matrix_calculated;
    if ($sum_of_curr_path%100 == 0 ) echo $counter . "  ";
    $c = count($matrix);
    $d = count($matrix[0]);
    if (!($x == 0 and $y == 0)) {
        // $curr_path[] = [$x, $y];
        $sum_of_curr_path += $matrix[$x][$y];
        $counter++;
    }
    $matrix_calculated[$x][$y] = [$sum_of_curr_path];

    if (($x > 0 and $x < count($matrix[0])) and (empty($matrix_calculated[$x - 1][$y]) or ($sum_of_curr_path + $matrix[$x - 1][$y] < $matrix_calculated[$x - 1][$y][0]))) {
        move($sum_of_curr_path, $x - 1, $y, $counter);
    }

    if (($y > 0 and $y < count($matrix)) and (empty($matrix_calculated[$x][$y - 1]) or ($sum_of_curr_path + $matrix[$x][$y - 1] < $matrix_calculated[$x][$y - 1][0]))) {
        move( $sum_of_curr_path, $x, $y - 1, $counter);
    }

    if (($y < (count($matrix) - 1) and $y >= 0) and (empty($matrix_calculated[$x][$y + 1]) or ($sum_of_curr_path + $matrix[$x][$y + 1] < $matrix_calculated[$x][$y + 1][0]))) {
        move( $sum_of_curr_path, $x, $y + 1, $counter);
    }

    if (($x < (count($matrix[0]) - 1) and $x >= 0) and (empty($matrix_calculated[$x + 1][$y]) or ($sum_of_curr_path + $matrix[$x + 1][$y] < $matrix_calculated[$x + 1][$y][0]))) {
        move( $sum_of_curr_path, $x + 1, $y, $counter);
    }

    return;
}



function myTestOne()
{
    global $matrix, $matrix_calculated;
    $matrix = readMyFile("input.txt");
    move(0, 0, 0, 0);

    return $matrix_calculated[count($matrix_calculated[0]) - 1][count($matrix_calculated) - 1][0];
}

function myTestTwo()
{

    return true;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
