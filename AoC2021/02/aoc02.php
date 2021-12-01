<?php

function readMyFile($fname)
{

    $text = file($fname);
    return $text;
}

function myTestOne()
{
    $val = "1-3 a: abcde
    1-3 b: cdefg
    2-9 c: ccccccccc";

    $values = readMyFile('text.text');
  
    $correct = [];

    foreach ($values as $line ) {
        $separated = explode(' ', $line);
        $minmax = explode('-', $separated[0]);
        $min = $minmax[0];
        $max = $minmax[1];
        echo $max;
    }


    return 0;
}
function myTestTwo()
{
    $values = readMyFile('text.text');

    for ($i = 0; $i < count($values); $i++)
        for ($j = $i; $j < count($values); $j++)
            for ($k = $j; $k < count($values); $k++)
                if ($values[$i] + $values[$j] + $values[$k] === 2020) return $values[$i] * $values[$j] * $values[$k] ;

    return 0;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";