<?php

function readMyFile($fname)
{

    $text1 = file($fname, FILE_IGNORE_NEW_LINES);
    $text = array_map(function ($line){
        return str_split($line);
    }, $text1);
    return $text;
}

function myTestOne()
{

    $values = readMyFile('text.text');
    echo "--------------------------:" . PHP_EOL;
    var_dump($values);
    file_put_contents('values.json', json_encode($values));
    $gammaRate = [];
    $epsilonRate = [];
    $sums = [];

    for ($i=0; $i<count($values); $i++) {

        // $gammaRate[]  = (array_sum(array_column($values, array_shift(array_keys($values))))>count($values)) ? 1 : 0;
        // $epsilonRate[] = $gammaRate[$i] ? 0 : 1;
      
    }
    var_dump($gammaRate);
    var_dump($epsilonRate);


    // return $gammaRate * $epsilonRate;
}
function myTestTwo()
{
    $values = readMyFile('text.text');

    $sumForward = 0;
    $sumDepth = 0;
    $aim = 0;

    foreach ($values as $line) {
        $exploded = explode(' ', $line);
        $movement = $exploded[0];
        $val = (int) $exploded[1];

        switch ($movement) {
            case 'forward':
                $sumForward += $val;
                $sumDepth += $val * $aim;
                break;
            case 'down':
                $aim += $val;
                break;
            case 'up':
                $aim -= $val;
                break;
        }
    }


    return $sumForward * $sumDepth;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";