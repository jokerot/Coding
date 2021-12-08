<?php

/*$numSegments = [

    [0] => 6,
    [1] => 2,
    [2] => 5,
    [3] => 5,
    [4] => 4,
    [5] => 5,
    [6] => 6,
    [7] => 3,
    [8] => 7,
    [9] => 6,
    

];*/

function readMyFile3($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $textOutput = [];
    foreach ($text as $t) {
        $textOutput[] = explode(' ', explode(' | ', $t)[1]);
    }
    return $textOutput;
}

function readMyInputs($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $textOutput = [];
    foreach ($text as $t) {
        $textOutput[] = explode(' ', explode(' | ', $t)[0]);
    }
    return $textOutput;
}

function myTestOne()
{
    $output = readMyFile3("text.text");
    $count = 0;
    foreach ($output as $line) {
        $count += count(array_filter($line, fn ($x) => in_array(strlen($x), [2, 4, 3, 7])));
    }


    return $count;
}

function myTestTwo()
{

    $output = readMyFile3("text.text");
    $inputs = readMyInputs("text.text");
    $codeToNumbers = [];
    $i = 0;
    foreach ($output as $line) {
        $correctCode = array_map(fn ($x) => mySort($x), orderTheCode($inputs[$i]));
        $codeToNumbers[] = implode(array_map(function ($x) use ($correctCode) {
            return array_search(mySort($x), $correctCode);
        }, $line));
        $i++;
    }

    return array_sum($codeToNumbers);
}

function mySort($str)
{
    $tmp = str_split($str);
    sort($tmp);
    return implode($tmp);
}

function orderTheCode($arr)
{
    $correctCode = [];
    foreach ($arr as $a) {
        switch (strlen($a)) {
            case '2':
                $correctCode[1] = $a;
                break;
            case '7':
                $correctCode[8] = $a;
                break;
            case '4':
                $correctCode[4] = $a;
                break;
            case '3':
                $correctCode[7] = $a;
                break;
        }
    }
    $arr = array_diff($arr, $correctCode);
    foreach ($arr as $a) {
        if (strlen($a) == 6) {
            if (count(array_diff(str_split($a), str_split($correctCode[7]))) == 3
            and count(array_diff(str_split($correctCode[4]), str_split($a))) == 1) $correctCode[0] = $a;
            if (count(array_diff(str_split($a), str_split($correctCode[4]))) == 2) $correctCode[9] = $a;
            if (count(array_diff(str_split($a), str_split($correctCode[7]))) == 4) $correctCode[6] = $a;
        }
        if (strlen($a) == 5) {
            if (count(array_diff(str_split($correctCode[1]), str_split($a))) == 1
            and count(array_diff(str_split($correctCode[4]), str_split($a))) == 1) $correctCode[5] = $a;
            if (count(array_diff(str_split($correctCode[4]), str_split($a))) == 2) $correctCode[2] = $a;
            if (count(array_diff(str_split($correctCode[1]), str_split($a))) == 0) $correctCode[3] = $a;
        }
    }

    return $correctCode;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
