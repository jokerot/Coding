<?php

function readMyFile($fname)
{

    $text1 = file($fname, FILE_IGNORE_NEW_LINES);
    $text = array_map(function ($line) {
        return str_split($line);
    }, $text1);
    return $text;
}

function myTestOne()
{

    $values = readMyFile('text.text');
    file_put_contents('values.json', json_encode($values));
    $valuesCount = count($values);
    $gammaRate = [];
    $epsilonRate = [];
    $sums = array_fill(0, count($values[0]), 0);

    foreach ($values as $line) {
        for ($i = 0; $i < count($line); $i++) {
            $sums[$i] += $line[$i];
        }
    }
    $gammaRate = implode("", array_map(function ($x) use ($valuesCount) {
        return ($x > $valuesCount / 2) ? 1 : 0;
    }, $sums));
    $epsilonRate = implode("", array_map(function ($x) use ($valuesCount) {
        return ($x > $valuesCount / 2) ? 0 : 1;
    }, $sums));
    // echo 'gama array:  ';
    // var_dump($gammaRate);

    return bindec($gammaRate) * bindec($epsilonRate);
}
function myTestTwo()
{
    $values = readMyFile('text.text');
    $workingArray = $values;
    file_put_contents('values.json', json_encode($values));
    $valuesCount = count($values);
    echo "vCount= " . $valuesCount . PHP_EOL;
    $gammaRate = [];
    $epsilonRate = [];
    $sums = array_fill(0, count($values[0]), 0);
    $foundIt = false;
    $k = 0;
    while (!$foundIt) {
        $sum = 0;
        foreach ($workingArray as $line) {
            echo "line= " . $line[$k] . PHP_EOL;
            $sum += $line[$k];
        }
        // echo "sum= " . $sum . PHP_EOL;
        $matchingValue = ($sum >= count($workingArray) / 2) ? 1 : 0;
        $workingArray = array_filter(
            $workingArray,
            function ($x) use ($matchingValue, $k) {
                return ($x[$k] == $matchingValue);
            }
        );
        // echo "------matchingV-----------workingArr---------" . PHP_EOL;
        // var_dump($matchingValue, $workingArray);
        $foundIt = (count($workingArray) === 1) ? true : false;
        $k++;
    }
    // echo "!!!!!!!!!!!!!!!!!!!!!!!! oxy" . PHP_EOL;
    // var_dump($workingArray);
    foreach ($workingArray as $flat) {
        $flatArray = $flat;
    }
    var_dump($flatArray);
    $oxygen = implode("", $flatArray);
    
    
    $workingArray = $values;
    $foundIt = false;
    $k = 0;
    while (!$foundIt) {
        $sum = 0;
        foreach ($workingArray as $line) {
            // echo "line= " . $line[$k] . PHP_EOL;
            $sum += $line[$k];
        }
        // echo "sum= " . $sum . PHP_EOL;
        $matchingValue = ($sum >= count($workingArray) / 2) ? 0 : 1;
        $workingArray = array_filter(
            $workingArray,
            function ($x) use ($matchingValue, $k) {
                return ($x[$k] == $matchingValue);
            }
        );
        // echo "------matchingV-----------workingArr---------" . PHP_EOL;
        // var_dump($matchingValue, $workingArray);
        $foundIt = (count($workingArray) === 1) ? true : false;
        $k++;
    }

    // echo "!!!!!!!!!!!!!!!!!!!!!!!! co2" . PHP_EOL;
    // var_dump($workingArray);
    // var_dump($workingArray);
    foreach ($workingArray as $flat) {
        $flatArray = $flat;
    }
    $co2 = implode("", $flatArray);
    // echo "oxygen= " . $oxygen;
    // echo "co2= " . $co2;
    return bindec($oxygen) * bindec($co2);
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
