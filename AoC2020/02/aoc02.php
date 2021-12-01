<?php

function readMyFile($fname)
{

    $text = file($fname);
    return $text;
}

function myTestOne()
{

    $values = readMyFile('text.text');
    $correct = 0;

    foreach ($values as $line) {
        $separated = explode(' ', $line);
        $minmax = explode('-', $separated[0]);
        $min = (int) $minmax[0];
        $max = (int) $minmax[1];
        $letter = $separated[1][0];
        $countletters = substr_count($separated[2], $letter);
     
        if ( ($min <= $countletters) and ($countletters <= $max) ) {
            $correct++;
        }
    }

    return $correct;
}
function myTestTwo()
{
    $values = readMyFile('text.text');
    $correct = 0;

    foreach ($values as $line) {
        $separated = explode(' ', $line);
        $minmax = explode('-', $separated[0]);
        $first = (int) $minmax[0];
        $second = (int) $minmax[1];
        $letter = $separated[1][0];

        if ( ($separated[2][$first-1] === $letter) xor ($separated[2][$second-1] === $letter) ) {
            $correct++;
        }
    }

    return $correct;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";