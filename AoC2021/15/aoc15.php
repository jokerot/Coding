<?php

$matrix = [];
$matrix_calculated = [];
$big_matrix = [];
$big_matrix_calculated = [];
$corrected = false;

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
    if ($sum_of_curr_path % 400 == 0) echo $counter . "  ";
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
        move($sum_of_curr_path, $x, $y - 1, $counter);
    }

    if (($y < (count($matrix) - 1) and $y >= 0) and (empty($matrix_calculated[$x][$y + 1]) or ($sum_of_curr_path + $matrix[$x][$y + 1] < $matrix_calculated[$x][$y + 1][0]))) {
        move($sum_of_curr_path, $x, $y + 1, $counter);
    }

    if (($x < (count($matrix[0]) - 1) and $x >= 0) and (empty($matrix_calculated[$x + 1][$y]) or ($sum_of_curr_path + $matrix[$x + 1][$y] < $matrix_calculated[$x + 1][$y][0]))) {
        move($sum_of_curr_path, $x + 1, $y, $counter);
    }

    return;
}


function stomp_small($x, $y)
{
    global $matrix, $matrix_calculated, $corrected;


    if (isset($matrix_calculated[$x][$y])) {
        $sum_of_curr_path = $matrix_calculated[$x][$y];

    } else $sum_of_curr_path = 0;

    if (($x > 0 and $x < count($matrix[0])) and (!isset($matrix_calculated[$x - 1][$y]) or (($sum_of_curr_path + $matrix[$x - 1][$y]) < $matrix_calculated[$x - 1][$y]))) {

        $matrix_calculated[$x - 1][$y] = $sum_of_curr_path + $matrix[$x - 1][$y];
        $corrected = true;
    }

    if (($y > 0 and $y < count($matrix)) and (!isset($matrix_calculated[$x][$y - 1]) or (($sum_of_curr_path + $matrix[$x][$y - 1]) < $matrix_calculated[$x][$y - 1]))) {

        $matrix_calculated[$x][$y - 1] = $sum_of_curr_path + $matrix[$x][$y - 1];
        $corrected = true;
    }

    if (($y >= 0 and $y < (count($matrix) - 1)) and (!isset($matrix_calculated[$x][$y + 1]) or (($sum_of_curr_path + $matrix[$x][$y + 1]) < $matrix_calculated[$x][$y + 1]))) {

        $matrix_calculated[$x][$y + 1] = $sum_of_curr_path + $matrix[$x][$y + 1];
        $corrected = true;
    }

    if (($x >= 0 and $x < (count($matrix[0]) - 1)) and (!isset($matrix_calculated[$x + 1][$y]) or (($sum_of_curr_path + $matrix[$x + 1][$y]) < $matrix_calculated[$x + 1][$y]))) {
        $matrix_calculated[$x + 1][$y] = $sum_of_curr_path + $matrix[$x + 1][$y];
        $corrected = true;
    }
}


function stomp($x, $y)
{
    global $big_matrix, $big_matrix_calculated, $corrected;


    if (isset($big_matrix_calculated[$x][$y])) {
        $sum_of_curr_path = $big_matrix_calculated[$x][$y];
        // $x0 = $big_matrix_calculated[$x][$y];
    } else $sum_of_curr_path = 0;

    if (($x > 0 and $x < count($big_matrix[0])) and (!isset($big_matrix_calculated[$x - 1][$y]) or (($sum_of_curr_path + $big_matrix[$x - 1][$y]) < $big_matrix_calculated[$x - 1][$y]))) {
        // if (!!isset($big_matrix_calculated[$x - 1][$y])) $x1 = $big_matrix_calculated[$x - 1][$y];
        // $y1 = $big_matrix[$x - 1][$y];
        $big_matrix_calculated[$x - 1][$y] = $sum_of_curr_path + $big_matrix[$x - 1][$y];
        $corrected = true;
    }

    if (($y > 0 and $y < count($big_matrix)) and (!isset($big_matrix_calculated[$x][$y - 1]) or (($sum_of_curr_path + $big_matrix[$x][$y - 1]) < $big_matrix_calculated[$x][$y - 1]))) {
        // if (!!isset($big_matrix_calculated[$x][$y - 1])) $x2 = $big_matrix_calculated[$x][$y - 1];
        // $y2 = $big_matrix[$x][$y - 1];
        $big_matrix_calculated[$x][$y - 1] = $sum_of_curr_path + $big_matrix[$x][$y - 1];
        $corrected = true;
    }

    if (($y >= 0 and $y < (count($big_matrix) - 1)) and (!isset($big_matrix_calculated[$x][$y + 1]) or (($sum_of_curr_path + $big_matrix[$x][$y + 1]) < $big_matrix_calculated[$x][$y + 1]))) {

        // if (!!isset($big_matrix_calculated[$x][$y + 1])) $x3 = $big_matrix_calculated[$x][$y + 1];
        // $y3 = $big_matrix[$x][$y + 1];
        $big_matrix_calculated[$x][$y + 1] = $sum_of_curr_path + $big_matrix[$x][$y + 1];
        $corrected = true;
    }

    if (($x >= 0 and $x < (count($big_matrix[0]) - 1)) and (!isset($big_matrix_calculated[$x + 1][$y]) or (($sum_of_curr_path + $big_matrix[$x + 1][$y]) < $big_matrix_calculated[$x + 1][$y]))) {
        // if (!!isset($big_matrix_calculated[$x + 1][$y])) $x4 = $big_matrix_calculated[$x + 1][$y];
        // $y4 = $big_matrix[$x + 1][$y];
        $big_matrix_calculated[$x + 1][$y] = $sum_of_curr_path + $big_matrix[$x + 1][$y];
        $corrected = true;
    }
}

function myTestOne()
{
    global $matrix, $matrix_calculated, $corrected;
    $matrix = readMyFile("input.txt");
    // move(0, 0, 0, 0);


    $matrix_calculated[0][0] = 0;
    $corrected = true;
    while ($corrected) {
        $corrected = false;
        for ($i = 0; $i < count($matrix[0]); $i++) {
            for ($j = 0; $j <= $i; $j++) {
                stomp_small($i, $j);
                stomp_small($j, $i);
            }
        }

        echo "iterating..." . PHP_EOL;
        echo $matrix_calculated[count($matrix_calculated[0]) - 1][count($matrix_calculated) - 1] . PHP_EOL;
    }
    file_put_contents("matrix1.json", json_encode($matrix_calculated));
    echo "Final decision:   " . PHP_EOL;



    return $matrix_calculated[count($matrix_calculated[0]) - 1][count($matrix_calculated) - 1];
}

function build_big()
{
    global $matrix, $big_matrix;
    $help_matrix = $matrix;
    for ($i = 1; $i <= 4; $i++) {
        foreach ($matrix as $m) {
            $help_matrix[] = array_map(fn ($x) => intval($x) + $i > 9 ? intval($x) + $i - 9  : intval($x) + $i, $m);
        }
    }

    $matrix = $help_matrix;
    $help_matrix = [];

    foreach ($matrix as $m) {
        $row = $m;
        for ($i = 1; $i <= 4; $i++) {
            $row = array_merge($row, array_map(fn ($x) => intval($x) + $i > 9 ? intval($x) + $i - 9  : intval($x) + $i, $m));
        }
        $help_matrix[] = $row;
    }

    $big_matrix = $help_matrix;

    return;
}

function myTestTwo()
{
    global $big_matrix, $big_matrix_calculated, $matrix, $corrected;
    $matrix = readMyFile("input.txt");

    build_big();
    $big_matrix_calculated[0][0] = 0;
    $corrected = true;
    while ($corrected) {
        $corrected = false;
        for ($i = 0; $i < count($big_matrix[0]); $i++) {
            for ($j = 1; $j <= $i; $j++) {
                stomp($i, $i - $j);
                stomp($i - $j, $i);
            }
            stomp($i, $i);
        }
        $length = count($big_matrix[0]) - 1;
        for ($i = $length; $i > 0; $i--) {
            for ($j = $length; $j > 0; $j--) {
                stomp($i, $j);
            }
        }
        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length; $j++) {
                stomp($i, $j);
            }
        }
        for ($i = $length; $i > 0; $i--) {
            for ($j = $length; $j > 0; $j--) {
                stomp($j, $i);
            }
        }
        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length; $j++) {
                stomp($j, $i);
            }
        }
        for ($i = 0; $i < count($big_matrix[0]); $i++) {
            for ($j = 0; $j <= $i; $j++) {
                stomp($i, $j);
                stomp($j, $i);
            }
        }
        echo "iterating..." . PHP_EOL;
        echo $big_matrix_calculated[count($big_matrix_calculated[0]) - 1][count($big_matrix_calculated) - 1] . PHP_EOL;
    }
    file_put_contents("matrix.json", json_encode($big_matrix_calculated));
    echo "Final decision:   " . PHP_EOL;
    return $big_matrix_calculated[count($big_matrix_calculated[0]) - 1][count($big_matrix_calculated) - 1];
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
