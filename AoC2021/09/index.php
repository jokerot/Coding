<?php

function readMyFile($fname)
{

    $text1 = file($fname, FILE_IGNORE_NEW_LINES);
    $enlarged = [];
    var_dump($text1);
    $enlarged[] = array_fill(0, strlen($text1)[0], 9); 
    foreach($text1 as $line) {
        $enlarged[] = array_merge([9], str_split($line), [9]);
    }
    $enlarged[] = array_fill(0, strlen($text1[0]), 9);
    file_get_contents("enlarged.json", json_encode($enlarged));
    return $enlarged;
}

function myTestOne()
{

    $values = readMyFile('text.text');



    return true;
}


function myTestTwo()
{

}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
