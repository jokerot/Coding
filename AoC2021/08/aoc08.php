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
    $numSegments = [6, 2, 5, 5, 4, 5, 6, 3, 7, 6];
    $code = ['cagedb', 'ab', 'gcdfa', 'fbcad', 'eafb', 'cdfbe', 'cdfgeb', 'dab', 'acedgfb', 'cefabd'];
    $code = array_map(fn ($x) => mySort($x), $code);
    // var_dump($output);
    file_put_contents('output2.json', json_encode($output));
    file_put_contents('code.json', json_encode($code));
    $codeToNumbers = [];
    foreach ($output as $line) {
        var_dump($line);
        $codeToNumbers[] = implode(array_map(function ($x) use ($code) {
            echo " x= " . mySort($x) . "   code=  " . implode(',', $code) . PHP_EOL;
            return array_search(mySort($x), $code);
        }, $line));
    }
    var_dump($codeToNumbers);
    return true;
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
            and count(array_diff(str_split($correctCode[4]), str_split($a))) == 2) $correctCode[5] = $a;
            if (count(array_diff(str_split($correctCode[4]), str_split($a))) == 2) $correctCode[2] = $a;
            if (count(array_diff(str_split($correctCode[1]), str_split($a))) == 0) $correctCode[3] = $a;
        }
    }
    file_put_contents("arr.json", json_encode($arr));
    file_put_contents("corrCode.json", json_encode($correctCode));
    return $correctCode;
}

var_dump(orderTheCode(['cagedb', 'ab', 'gcdfa', 'fbcad', 'eafb', 'cdfbe', 'cdfgeb', 'dab', 'acedgfb', 'cefabd']));

// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestOne();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
