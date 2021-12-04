<?php

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);

    return $text;
}

function myTestOne()
{
    $drawnNumOrder = [
        7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1
    ];

    $values = readMyFile('text.text');
    echo "--------------------------:" . PHP_EOL;
    // var_dump($values);
    file_put_contents('values.json', json_encode($values));
    $boards = [];
    $counter = 1;
    foreach ($values as $line) {
        if (!(empty(trim($line)))) {
            $boards[$counter][] = array_map(fn ($x) => intval($x), preg_split("/[\s,]+/", trim($line)));
        } else $counter++;
    }
    // var_dump($boards);

    $winningBoard = 0;
    $winningNumber = 0;

    for ($i = 5; $i < count($drawnNumOrder); $i++) {
        $pastNumbers = array_slice($drawnNumOrder, 0, $i);
        foreach ($boards as $key => $board) {
            foreach ($board as $row) {
                // echo PHP_EOL . "itteration:  " . $i . PHP_EOL;
                // var_dump($row);
                // var_dump($pastNumbers);
                // echo "---------diff--------------";
                // var_dump(array_diff($row, $pastNumbers));
                if (empty(array_diff($row, $pastNumbers))) {
                    $winningBoard = $key;
                    $winningNumber = end($pastNumbers);
                    break 3;
                }
            }
        }
    }
    $winArrayScoreNum = [];
    foreach ($boards[$winningBoard] as $row) {
        // var_dump($row);
        // var_dump($pastNumbers);
        // echo "__________________" . PHP_EOL;
        // var_dump(array_diff($row, $pastNumbers));
        $winArrayScoreNum = array_merge($winArrayScoreNum, array_diff($row, $pastNumbers));
    }
    $boardScore = array_sum($winArrayScoreNum);
    echo "-------------------" . PHP_EOL;
    echo "wining num:  " . $winningNumber;
    echo "   winning board:  " . $winningBoard . PHP_EOL;
    echo "   winning board sum:  " . $boardScore . PHP_EOL;

    return $winningNumber * $boardScore;
}
function myTestTwo()
{
    $drawnNumOrder = [
        7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1
    ];

    $values = readMyFile('text2.text');
    echo "--------------------------:" . PHP_EOL;
    // var_dump($values);
    file_put_contents('values2.json', json_encode($values));
    $boards = [];
    $counter = 1;
    foreach ($values as $line) {
        if (!(empty(trim($line)))) {
            $boards[$counter][] = array_map(fn ($x) => intval($x), preg_split("/[\s,]+/", trim($line)));
        } else $counter++;
    }
    


    
}

function dumpTheWinningBoard($boards, $drawnNumOrder, $iteration) {

    $winningBoard = 0;
    $winningNumber = 0;

    for ($i = $iteration; $i < count($drawnNumOrder); $i++) {
        $pastNumbers = array_slice($drawnNumOrder, 0, $i);
        foreach ($boards as $key => $board) {
            foreach ($board as $row) {
                // echo PHP_EOL . "itteration:  " . $i . PHP_EOL;
                // var_dump($row);
                // var_dump($pastNumbers);
                // echo "---------diff--------------";
                // var_dump(array_diff($row, $pastNumbers));
                if (empty(array_diff($row, $pastNumbers))) {
                    unset($boards[$key]);
                    return $boards;
                    break 3;
                }
            }
        }
    }


}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";