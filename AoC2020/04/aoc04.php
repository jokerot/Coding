<?php

function readMyFile($fname)
{

    $text = file_get_contents($fname);

    return explode(PHP_EOL.PHP_EOL, $text);;
}

function myTestOne()
{
    $array = readMyFile('text.text');
    $compare_array = ['ecl', 'pid', 'eyr', 'hcl',
    'byr', 'iyr', 'hgt'];
    $counter = 0;
    foreach($array as $line) {
        $line = str_replace(PHP_EOL, ' ', $line);
        $exploded = explode(' ', $line);
        $fields = [];
        foreach($exploded as $member) {
            $fields[] = explode(':', $member)[0];
        }
        if (empty(array_diff($compare_array, $fields))) $counter++;
    }
    return $counter;
}
function myTestTwo()
{
    $array = readMyFile('text.text');
    $divider = strlen($array[0]) - 2;
    $product = 1;
    for ($step = 1; $step <= 7; $step += 2) {
        $slopeDistance = 0;
        $treeHits = 0;
        foreach ($array as $line) {
            if ($line[$slopeDistance % $divider] === "#") {
                $treeHits++;
            }
            $slopeDistance += $step;
        }

        $product *= $treeHits;
    }

    $slopeDistance = 0;
    $treeHits = 0;
    for ($i = 0; $i < count($array); $i += 2) {
        if ($array[$i][$slopeDistance % $divider] === "#") {
            $treeHits++;
        }
        $slopeDistance++;
    }

    $product *= $treeHits;


    return $product;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
