<?php




function h2b($str)
{
    $binary = '';
    foreach (str_split($str) as $char) {
        $bin = base_convert($char, 16, 2);
        $binary = $binary . $bin;
    }


    return $binary;
}

function myTestOne()
{
    $start_str1 = 'D2FE28';
    $start_str2 = '38006F45291200';
    $start_str3 = 'EE00D40C823060';
    $start_str4 = '8A004A801A8002F478';
    $start_str5 = '620080001611562C8802118E34';
    $binary_str1 = h2b($start_str1);
    $binary_str2 = h2b($start_str2);
    $binary_str3 = h2b($start_str3);
    $binary_str4 = h2b($start_str4);
    $binary_str5 = h2b($start_str5);
    // $binary_str6 = h2b($start_str);

    echo $binary_str1 . PHP_EOL;
    echo $start_str1 . PHP_EOL;
    echo $binary_str2 . PHP_EOL;
    echo $start_str2 . PHP_EOL;
    echo $binary_str3 . PHP_EOL;
    echo $start_str3 . PHP_EOL;
    echo $binary_str4 . PHP_EOL;
    echo $start_str4 . PHP_EOL;
    echo $binary_str5 . PHP_EOL;
    echo $start_str5 . PHP_EOL;

    return $binary_str1;
}

function myTestTwo()
{

    return true;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
