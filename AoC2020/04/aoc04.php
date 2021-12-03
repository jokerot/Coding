<?php

function readMyFile($fname)
{

    $text = file_get_contents($fname);

    return explode(PHP_EOL . PHP_EOL, $text);;
}

function myTestOne()
{
    $array = readMyFile('text.text');
    $passed = [];
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


        // $truefalse = (!(is_numeric($fields['eyr']) and ($fields['eyr']>=2020) and ($fields['eyr']<=2030)));
        // var_dump($truefalse);
        // echo "all " . ($truefalse) . PHP_EOL;
        if (!empty(array_diff($compare_array, array_keys($fields)))) {
            continue;
        }
        if (!(is_numeric($fields['byr']) and ($fields['byr'] >= 1920) and ($fields['byr'] <= 2002))) {
            continue;
        }
        if (!(is_numeric($fields['iyr']) and ($fields['iyr'] >= 2010) and ($fields['iyr'] <= 2020))) {
            continue;
        }
        if (!(is_numeric($fields['eyr']) and ($fields['eyr'] >= 2020) and ($fields['eyr'] <= 2030))) {
            continue;
        }
        // var_dump(substr($fields['hgt'], -2, 2));
        // var_dump(substr($fields['hgt'], 0, strlen($fields['hgt']) - 2));
        $height = substr($fields['hgt'], 0, strlen($fields['hgt']) - 2);
        $measure = substr($fields['hgt'], -2, 2);
        // echo "cm: ";
        // var_dump((is_numeric($height) and (intval($height) >= 150) and (intval($height) <= 193)));
        // echo "in: ";
        // var_dump((is_numeric($height) and (intval($height) >= 59) and (intval($height) <= 76)));
        switch ($measure) {
            case "cm":
                if (!(is_numeric($height) and (intval($height) >= 150) and (intval($height) <= 193))) {
                    continue 2;
                }
                break;
            case "in":
                if (!(is_numeric($height) and (intval($height) >= 59) and (intval($height) <= 76))) {
                    continue 2;
                }
                break;
            default:
                continue 2;
        }
        if (!preg_match("/#[0-9a-f]{6}/", $fields['hcl'])) {

            continue;
        }
        if (!(in_array($fields['ecl'], ["amb", "blu", "brn", "gry", "grn", "hzl", "oth"]))) {
            continue;
        }
        if (!preg_match("/^\d{9}$/", $fields['pid'])) {
            continue;
        }

        $passed[] = $fields;
        $counter++;
    }

    file_put_contents('dump.json', json_encode($passed));

    $pid = array_column($passed, 'pid');
    sort($pid);
    file_put_contents('pid.json', json_encode($pid));

    $byr = array_column($passed, 'byr');
    sort($byr);
    file_put_contents('byr.json', json_encode($byr));

    $iyr = array_column($passed, 'iyr');
    sort($iyr);
    file_put_contents('iyr.json', json_encode($iyr));

    $eyr = array_column($passed, 'eyr');
    sort($eyr);
    file_put_contents('eyr.json', json_encode($eyr));

    $hgt = array_column($passed, 'hgt');
    sort($hgt);
    file_put_contents('hgt.json', json_encode($hgt));

    $hcl = array_column($passed, 'hcl');
    sort($hcl);
    file_put_contents('hcl.json', json_encode($hcl));

    $ecl = array_column($passed, 'ecl');
    sort($ecl);
    file_put_contents('ecl.json', json_encode($ecl));

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
