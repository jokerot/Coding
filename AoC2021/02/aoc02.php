<?php

function readMyFile($fname)
{

    $text = file($fname);
    return $text;
}

function myTestOne()
{

    $values = readMyFile('text.text');

    $sumForward = 0;
    $sumDepth = 0;

    foreach ($values as $line) {
        $exploded = explode(' ', $line);
        $movement = $exploded[0];
        $val = (int) $exploded[1];

        switch ($movement) {
            case 'forward':
                $sumForward += $val;
                break;
            case 'down':
                $sumDepth += $val;
                break;
            case 'up':
                $sumDepth -= $val;
                break;
        }
    }


    return $sumForward * $sumDepth;
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


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";