<?php
$opening = ["(", "[", "{", "<"];
$closing = [")", "]", "}", ">"];
$scores = array(")" => 3, "]" => 57, "}" => 1197, ">" => 25137);
$scores2 = array("(" => 1, "[" => 2, "{" => 3, "<" => 4);

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);

    return $text;
}

function myTestOne()
{
    global $opening, $closing, $scores;

    $input = readMyFile('text.text');
    file_put_contents("input.json", json_encode($input));
    $erroneusChars = [];
    foreach ($input as $line) {
        $pieces = str_split($line);
        $readLine = [];
        foreach ($pieces as $char) {
            if (in_array($char, $opening)) {
                array_push($readLine, $char);

            }
            if (in_array($char, $closing)) {
                $lastChar = array_pop($readLine);
                $index = array_search($lastChar, $opening);
                if (!($char == $closing[$index])) {
                    $erroneusChars[] = $char;
                    break;
                }
            }
        }
    }

    return array_sum(array_map(fn($x) => $scores[$x], $erroneusChars));
}


function myTestTwo()
{
    global $opening, $closing, $scores;

    $input = readMyFile('text.text');
    file_put_contents("input.json", json_encode($input));
    $incompleteLines = [];
    $erroneusChars = [];
    foreach ($input as $line) {
        $pieces = str_split($line);
        $readLine = [];
        $incomplete = true;
        foreach ($pieces as $char) {
            if (in_array($char, $opening)) {
                array_push($readLine, $char);

            }
            if (in_array($char, $closing)) {
                $lastChar = array_pop($readLine);
                $index = array_search($lastChar, $opening);
                if (!($char == $closing[$index])) {
                    $erroneusChars[] = $char;
                    $incomplete = false;
                    break;
                }
            }
        }
        if ($incomplete) $incompleteLines[] = $readLine;
    }
    file_put_contents('incomplete.json' , json_encode($incompleteLines));
    $incompleteScores = array_map(fn($x) => scoreEnding($x), $incompleteLines);
    
    file_put_contents('scores.json' , json_encode($incompleteScores));
    sort($incompleteScores);
    $middle = count($incompleteScores)/2;
    return $incompleteScores[$middle];
}

function scoreEnding($arr){
    global $scores2;
    $reversed = array_reverse($arr);
    $sum = 0;
    foreach($reversed as $char) {
        $sum = $sum*5 + $scores2[$char];
    }
    return $sum;
}

$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
