<?php

$matrix = [];
$matrix_calculated = [];
$big_matrix = [];
$big_matrix_calculated = [];


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

function stomp($x, $y)
{
    global $big_matrix, $big_matrix_calculated;

    if ($x>7 and $y>7) {
        $test = "blah";
    }

    if (isset($big_matrix_calculated[$x][$y])) {
        $sum_of_curr_path = $big_matrix_calculated[$x][$y];
        $x0 = $big_matrix_calculated[$x][$y];
    } else $sum_of_curr_path = 0;
    
    if (($x > 0 and $x < count($big_matrix[0])) and (!isset($big_matrix_calculated[$x - 1][$y]) or (($sum_of_curr_path + $big_matrix[$x - 1][$y]) < $big_matrix_calculated[$x - 1][$y]))) {
        if(!!isset($big_matrix_calculated[$x - 1][$y])) $x1 = $big_matrix_calculated[$x-1][$y];
        $y1 = $big_matrix[$x-1][$y];
        $big_matrix_calculated[$x - 1][$y] = $sum_of_curr_path + $big_matrix[$x - 1][$y];
    }
    
    if (($y > 0 and $y < count($big_matrix)) and (!isset($big_matrix_calculated[$x][$y - 1]) or (($sum_of_curr_path + $big_matrix[$x][$y - 1]) < $big_matrix_calculated[$x][$y - 1]))) {
        if(!!isset($big_matrix_calculated[$x][$y - 1])) $x2 = $big_matrix_calculated[$x][$y-1];
        $y2 = $big_matrix[$x][$y-1];
        $big_matrix_calculated[$x][$y - 1] = $sum_of_curr_path + $big_matrix[$x][$y - 1];
    }
    
    if (($y >= 0 and $y < (count($big_matrix) - 1)) and (!isset($big_matrix_calculated[$x][$y + 1]) or (($sum_of_curr_path + $big_matrix[$x][$y + 1]) < $big_matrix_calculated[$x][$y + 1]))) {
        
        if(!!isset($big_matrix_calculated[$x][$y + 1])) $x3 = $big_matrix_calculated[$x][$y+1];
        $y3 = $big_matrix[$x][$y+1];
        $big_matrix_calculated[$x][$y + 1] = $sum_of_curr_path + $big_matrix[$x][$y + 1];
    }
    
    if (($x >= 0 and $x < (count($big_matrix[0]) - 1)) and (!isset($big_matrix_calculated[$x + 1][$y]) or (($sum_of_curr_path + $big_matrix[$x + 1][$y]) < $big_matrix_calculated[$x + 1][$y]))) {
        if(!!isset($big_matrix_calculated[$x + 1][$y])) $x4 = $big_matrix_calculated[$x+1][$y];
        $y4 = $big_matrix[$x+1][$y];
        $big_matrix_calculated[$x + 1][$y] = $sum_of_curr_path + $big_matrix[$x + 1][$y];
    }
}

// function myTestOne()
// {
//     global $matrix, $matrix_calculated;
//     $matrix = readMyFile("input.txt");
//     move(0, 0, 0, 0);

//     return $matrix_calculated[count($matrix_calculated[0]) - 1][count($matrix_calculated) - 1][0];
// }

function myTestTwo()
{
    global $big_matrix, $big_matrix_calculated;
    $big_matrix = readMyFile("input.txt");
    $big_matrix_calculated[0][0] = 0;
    for ($i = 0; $i < count($big_matrix[0]); $i++) {
        for ($j = 0; $j <= $i; $j++) {
            stomp($i, $j);
            stomp($j, $i);
        }
    }
    file_put_contents("matrix.json", json_encode($big_matrix_calculated));

    return $big_matrix_calculated[count($big_matrix_calculated[0]) - 1][count($big_matrix_calculated) - 1];
}


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestOne();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
