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




function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $textConc = [];
    for ($i = 0; $i < count($text) - 1; $i += 2) {
        $tempArr = [];
        $tempArr[0] = explode(' ', $text[$i]);
        array_pop($tempArr[0]);
        $tempArr[1] = explode(' ', $text[$i + 1]);
        var_dump($tempArr);
        $textConc[$i / 2] = $tempArr;
    }
    var_dump($textConc);
    return $textConc;
}

function readMyFile2($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);
    $textOutput = [];
    for ($i = 0; $i < count($text) - 1; $i += 2) {

        $textOutput[] = explode(' ', $text[$i + 1]);
    }
    return $textOutput;
}

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
    $numSegments = [6, 2, 5, 5, 4, 5, 6, 3, 7, 6];
    // var_dump($output);
    file_put_contents('output.json', json_encode($output));
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
    $numSegments = [6, 2, 5, 5, 4, 5, 6, 3, 7, 6];

    // var_dump($output);
    file_put_contents('output2.json', json_encode($output));
    file_put_contents('input.json', json_encode($inputs));
    $codeToNumbers = [];
    $i = 0;
    foreach ($output as $line) {
        var_dump($line);
        $correctCode = array_map(fn ($x) => mySort($x), orderTheCode($inputs[$i]));
        $codeToNumbers[] = implode(array_map(function ($x) use ($correctCode) {
            echo " x= " . mySort($x) . "   correctCode=  " . implode(',', $correctCode) . PHP_EOL;
            return array_search(mySort($x), $correctCode);
        }, $line));
        echo end($codeToNumbers);
        $i++;
    }

    var_dump($codeToNumbers);

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
    file_put_contents("arr.json", json_encode($arr));
    file_put_contents("corrCode.json", json_encode($correctCode));
    return $correctCode;
}


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestOne();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
