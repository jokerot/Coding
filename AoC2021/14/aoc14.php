<?php
$global_polymer_count = [];
$global_pair_counter = [];
$global_polymer_l_count = [];
$code = [];

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);

    $arr = [];

    foreach ($text as $line) {
        $l = explode(' -> ', $line);
        $arr[$l[0]] = $l[1];
    }

    return $arr;
}

function insert_elements($arr, $code)
{
    $newarr = [];
    for ($i = 0; $i < count($arr) - 1; $i++) {
        $newarr[] = $arr[$i];
        $newarr[] = $code[$arr[$i] . $arr[$i + 1]];
    }
    $newarr[] = end($arr);
    return $newarr;
}

function insert_letter($arr, $code)
{
}

function step()
{
    global $global_pair_counter, $global_polymer_l_count, $code;
    $new_pair_counter = $global_pair_counter;
    $new_pair_counter = array_fill_keys (array_keys($new_pair_counter), 0);
    foreach ($global_pair_counter as $pair => $count) {
        if ($count>0) {
        $new_letter = $code[$pair];
        $new_pair_1 = $pair[0] . $new_letter;
        $new_pair_2 = $new_letter . $pair[1];
        $new_pair_counter[$new_pair_1] += $count;
        $new_pair_counter[$new_pair_2] += $count;
        $global_polymer_l_count[$new_letter] += $count;
        }
    }
    $global_pair_counter = $new_pair_counter;
}

function myTestTwo()
{
    global $global_pair_counter, $global_polymer_l_count, $code;
    $polymer = "VFHKKOKKCPBONFHNPHPN";
    $code = readMyFile('input.txt');
    $pairs = [];

    for ($j = 0; $j < strlen($polymer) - 1; $j++) {
        $pairs[] = substr($polymer, $j, 2);
    }

    foreach ($code as $key => $c) {
        $global_pair_counter[$key] = 0;
        $global_polymer_l_count[$c] = 0;
    }

    foreach(str_split($polymer) as $letter){
        $global_polymer_l_count[$letter]++;
    }

    foreach ($pairs as $p) {
        $global_pair_counter[$p] += 1;
    }

    for ($j = 0; $j < 40; $j++) {
        step();
    }

    return max($global_polymer_l_count) - min($global_polymer_l_count);
}
function myTestOne()
{
    $polymer = "VFHKKOKKCPBONFHNPHPN";

    $polymer = str_split($polymer);

    $code = readMyFile('input.txt');
    for ($j = 0; $j < 10; $j++) {
        $polymer = insert_elements($polymer, $code);
    }

    $counts = array_count_values($polymer);

    return max($counts) - min($counts);
}





$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
