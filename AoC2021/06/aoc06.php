<?php

function readMyFile($fname)
{

    return true;
}

function myTestOne()
{
    $fish = [
        5, 1, 5, 3, 2, 2, 3, 1, 1, 4, 2, 4, 1, 2, 1, 4, 1, 1, 5, 3, 5, 1, 5, 3, 1, 2, 4, 4, 1, 1, 3, 1, 1, 3, 1, 1, 5, 1, 5, 4, 5, 4, 5, 1, 3, 2, 4, 3, 5, 3, 5, 4, 3,
        1, 4, 3, 1, 1, 1, 4, 5, 1, 1, 1, 2, 1, 2, 1, 1, 4, 1, 4, 1, 1, 3, 3, 2, 2, 4, 2, 1, 1, 5, 3, 1, 3, 1, 1, 4, 3, 3, 3, 1, 5, 2, 3, 1, 3, 1, 5, 2, 2, 1, 2, 1, 1, 1, 3, 4, 1, 1, 1,
        5, 4, 1, 1, 1, 4, 4, 2, 1, 5, 4, 3, 1, 2, 5, 1, 1, 1, 1, 2, 1, 5, 5, 1, 1, 1, 1, 3, 1, 4, 1, 3, 1, 5, 1, 1, 1, 5, 5, 1, 4, 5, 4, 5, 4, 3, 3, 1, 3, 1, 1, 5, 5, 5, 5, 1, 2, 5, 4,
        1, 1, 1, 2, 2, 1, 3, 1, 1, 2, 4, 2, 2, 2, 1, 1, 2, 2, 1, 5, 2, 1, 1, 2, 1, 3, 1, 3, 2, 2, 4, 3,
        1, 2, 4, 5, 2, 1, 4, 5, 4, 2, 1, 1, 1, 5, 4, 1, 1, 4, 1, 4, 3, 1, 2, 5, 2, 4, 1, 1, 5, 1, 5, 4, 1, 1, 4, 1, 1, 5, 5, 1, 5, 4, 2, 5, 2, 5, 4, 1, 1, 4, 1, 2, 4, 1, 2, 2, 2, 1,
        1, 1, 5, 5, 1, 2, 5, 1, 3, 4, 1, 1, 1, 1, 5, 3, 4, 1, 1, 2, 1, 1, 3, 5, 5, 2, 3, 5, 1, 1, 1, 5, 4, 3, 4, 2, 2, 1, 3
    ];
    for ($i = 0; $i < 80; $i++) {
        $countOfNewborn = count(array_filter($fish, function ($x) {
            return ($x == 0);
        }));
        // file_put_contents("newborns" . $i . ".json", json_encode($fish));    
        // file_put_contents("fish" . $i . ".json", json_encode($fish));    
        $newBorns = array_fill(0, $countOfNewborn, 8);
        $fish = array_merge(array_map(fn ($x) => ($x > 0) ? $x - 1 : 6, $fish), $newBorns);
    }
    // file_put_contents("fish.json", json_encode($fish));
    return count($fish);
}

function myTestTwo()
{
    $fish = [
        5, 1, 5, 3, 2, 2, 3, 1, 1, 4, 2, 4, 1, 2, 1, 4, 1, 1, 5, 3, 5, 1, 5, 3, 1, 2, 4, 4, 1, 1, 3, 1, 1, 3, 1, 1, 5, 1, 5, 4, 5, 4, 5, 1, 3, 2, 4, 3, 5, 3, 5, 4, 3,
        1, 4, 3, 1, 1, 1, 4, 5, 1, 1, 1, 2, 1, 2, 1, 1, 4, 1, 4, 1, 1, 3, 3, 2, 2, 4, 2, 1, 1, 5, 3, 1, 3, 1, 1, 4, 3, 3, 3, 1, 5, 2, 3, 1, 3, 1, 5, 2, 2, 1, 2, 1, 1, 1, 3, 4, 1, 1, 1,
        5, 4, 1, 1, 1, 4, 4, 2, 1, 5, 4, 3, 1, 2, 5, 1, 1, 1, 1, 2, 1, 5, 5, 1, 1, 1, 1, 3, 1, 4, 1, 3, 1, 5, 1, 1, 1, 5, 5, 1, 4, 5, 4, 5, 4, 3, 3, 1, 3, 1, 1, 5, 5, 5, 5, 1, 2, 5, 4,
        1, 1, 1, 2, 2, 1, 3, 1, 1, 2, 4, 2, 2, 2, 1, 1, 2, 2, 1, 5, 2, 1, 1, 2, 1, 3, 1, 3, 2, 2, 4, 3,
        1, 2, 4, 5, 2, 1, 4, 5, 4, 2, 1, 1, 1, 5, 4, 1, 1, 4, 1, 4, 3, 1, 2, 5, 2, 4, 1, 1, 5, 1, 5, 4, 1, 1, 4, 1, 1, 5, 5, 1, 5, 4, 2, 5, 2, 5, 4, 1, 1, 4, 1, 2, 4, 1, 2, 2, 2, 1,
        1, 1, 5, 5, 1, 2, 5, 1, 3, 4, 1, 1, 1, 1, 5, 3, 4, 1, 1, 2, 1, 1, 3, 5, 5, 2, 3, 5, 1, 1, 1, 5, 4, 3, 4, 2, 2, 1, 3
    ];
    $fishOptimized = [];
    for ($i = 0; $i <= 8; $i++) {
        $fishOptimized[$i] =  count(array_filter($fish, fn ($x) => ($x == $i)));
    }
    // file_put_contents("fishOptimized.json", json_encode($fishOptimized));

    for ($i = 0; $i < 256; $i++) {
        $countOfNewborn = $fishOptimized[0];
        // echo "count of n= " . $countOfNewborn . "iteration = " . $i + 1 . PHP_EOL;
        for ($j = 1; $j <= 8; $j++) {
            $fishOptimized[$j - 1] = $fishOptimized[$j];
        }
        $fishOptimized[6] += $countOfNewborn;
        $fishOptimized[8] = $countOfNewborn;
        // file_put_contents("fishOptimized" . $i . ".json", json_encode($fishOptimized));
    }
    // file_put_contents("fish.json", json_encode($fish));
    return array_sum($fishOptimized);
}



$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
