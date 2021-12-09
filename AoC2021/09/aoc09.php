<?php

function readMyFile($fname)
{

    $text1 = file($fname, FILE_IGNORE_NEW_LINES);
    $enlarged = [];
    var_dump($text1[0]);
    $enlarged[] = array_fill(0, strlen($text1[0])+2, 9); 
    foreach($text1 as $line) {
        $enlarged[] = array_merge([9], str_split($line), [9]);
    }
    $enlarged[] = array_fill(0, strlen($text1[0]), 9);
    file_put_contents("enlarged.json", json_encode($enlarged));
    return $enlarged;
}

function myTestOne()
{

    $matrix = readMyFile('text.text');
    $lowpoints = [];
    for ($i = 1; $i<count($matrix)-1;$i++) {
        var_dump($matrix[$i]);
        for ($j = 1; $j < count($matrix[0])+1; $j++){

                echo "------------   " . $matrix[$i][$j] . PHP_EOL;
                var_dump($matrix[$i-1][$j], $matrix[$i][$j-1], $matrix[$i+1][$j], $matrix[$i][$j+1]);

        if(intval($matrix[$i][$j])<min($matrix[$i-1][$j], $matrix[$i][$j-1], $matrix[$i+1][$j], $matrix[$i][$j+1])) $lowpoints[] = $matrix[$i][$j] +1;
        }
    } 
    var_dump($lowpoints);

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
