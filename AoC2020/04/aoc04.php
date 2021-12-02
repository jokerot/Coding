<?php

function readMyFile($fname)
{

    $text = file_get_contents($fname);

    return explode(PHP_EOL . PHP_EOL, $text);;
}

function myTestOne()
{
    $array = readMyFile('text.text');
    $compare_array = [
        'ecl', 'pid', 'eyr', 'hcl',
        'byr', 'iyr', 'hgt'
    ];
    $counter = 0;
    foreach ($array as $line) {
        $line = str_replace(PHP_EOL, ' ', $line);
        $exploded = explode(' ', $line);
        $fields = [];
        foreach ($exploded as $member) {
            $fields[] = explode(':', $member)[0];
        }
        if (empty(array_diff($compare_array, $fields))) $counter++;
    }
    return $counter;
}

function myTestTwo()
{
    $array = readMyFile('text.text');
    $compare_array = [
        'ecl', 'pid', 'eyr', 'hcl',
        'byr', 'iyr', 'hgt'
    ];
    $counter = 0;
    foreach ($array as $line) {
        $line = str_replace(PHP_EOL, ' ', $line);
        $exploded = explode(' ', $line);
        $fields = [];
        foreach ($exploded as $member) {
            $keyvalye = explode(':', $member);
            $key = $keyvalye[0];
            $val = $keyvalye[1];
            $fields[$key] = $val;
        }
        var_dump($fields);

        $truefalse = (!(is_numeric($fields['eyr']) and ($fields['eyr']>=2020) and ($fields['eyr']<=2030)));
        var_dump($truefalse);
        echo "all " . ($truefalse) . PHP_EOL;
        if (!empty(array_diff($compare_array, array_keys($fields)))) continue;
        if (!(is_numeric($fields['byr']) and ($fields['byr']>=1920) and ($fields['byr']<=2002))) continue;
        if (!(is_numeric($fields['iyr']) and ($fields['iyr']>=2010) and ($fields['iyr']<=2020))) continue;
        if (!(is_numeric($fields['eyr']) and ($fields['eyr']>=2020) and ($fields['eyr']<=2030))) continue;


        echo "temp count|" . $counter . PHP_EOL;
        $counter++;
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
