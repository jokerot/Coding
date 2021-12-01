<?php

function readMyFile($fname)
{

    $text = file($fname);
    return $text;
}

function myTestOne()
{
    $values = readMyFile('text.text');

    for ($i = 0; $i < count($values); $i++)
        for ($j = $i; $j < count($values); $j++)
                if ($values[$i] + $values[$j] === 2020) return $values[$i] * $values[$j] ;

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


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";