<?php

function readMyFile($fname)
{

    $text = file($fname);
    return $text;
}

function myTestOne()
{

    $values = readMyFile('text.text');
  
    $counter = 0;
    for ($i=0; ($i<count($values)-1); $i++) {
        if ($values[$i] < $values[$i+1] ) {
         $counter++;
        }
    }


    return $counter;
}
function myTestTwo()
{
    $values = readMyFile('text.text');
  
    $counter = 0;
    for ($i=0; ($i<count($values)-3); $i++) {
        if ($values[$i] < $values[$i+3]) {
         $counter++;
        }
    }


    return $counter;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";