<?php

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);

    return $text;
}

function myTestOne()
{
    $drawnNumOrder = [
        7, 4, 9, 5, 11, 17, 23, 2, 0, 14, 21, 24, 10, 16, 13, 6, 15, 25, 12, 22, 18, 20, 8, 19, 3, 26, 1
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
    var_dump($boards);

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
        23, 91, 18, 32, 73, 14, 20, 4, 10, 55, 40, 29, 13, 25, 48, 65, 2, 80, 22, 16, 93, 85, 66, 21, 9, 36, 47, 72, 88, 58,
        5, 42, 53, 69, 52, 8, 54, 63, 76, 12, 6, 99, 35, 95, 82, 49, 41, 17, 62, 34, 51, 77, 94,
        7, 28, 71, 92, 74, 46, 79, 26, 19, 97, 86, 87, 37, 57, 64, 1, 30, 11, 96, 70, 44, 83, 0, 56, 90, 59, 78,
        61, 98, 89, 43, 3, 84, 67, 38, 68, 27, 81, 39, 15, 50, 60, 24, 45, 75, 33, 31
    ];

    $values = readMyFile('text.text');
    echo "--------------------------:" . PHP_EOL;
    // var_dump($values);
    file_put_contents('values.json', json_encode($values));
    $boards2 = [];
    $counter = 1;
    foreach ($values as $line) {
        if (!(empty(trim($line)))) {
            $boards2[$counter][] = array_map(fn ($x) => intval($x), preg_split("/[\s,]+/", trim($line)));
        } else $counter++;
    }
    // var_dump($boards2);

    $winningBoard = 0;
    $winningNumber = 0;
    while (count($boards2) > 0) {
        for ($i = 5; $i < count($drawnNumOrder); $i++) {
            $pastNumbers = array_slice($drawnNumOrder, 0, $i);

            // echo "boards2 count =  " . count($boards2) . PHP_EOL;
            foreach ($boards2 as $key => $board) {
                foreach ($board as $row) {
                    // echo PHP_EOL . "itteration:  " . $i . PHP_EOL;
                    // var_dump($row);
                    // var_dump($pastNumbers);
                    // echo "---------diff--------------";
                    // var_dump(array_diff($row, $pastNumbers));
                    if (empty(array_diff($row, $pastNumbers))) {
                        $winningBoard = $key;
                        $lastWinBoard = $board;
                        $winningNumber = end($pastNumbers);
                        // echo "unsetting!!!" . PHP_EOL;
                        // unset($boards2[$winningBoard]);
                        // var_dump($boards);
                        break 3;
                    }
                }
            }
        }
    }
    $winArrayScoreNum = [];
    foreach ($lastWinBoard as $row) {
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


$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestTwo();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
