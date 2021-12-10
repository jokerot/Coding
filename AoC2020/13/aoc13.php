<?php

function readMyFile($fname)
{

    $text = file_get_contents($fname, FILE_IGNORE_NEW_LINES);
    return array_filter(explode(',', $text), fn ($x) => $x != 'x');
}


function lcm($x, $y){
    if ($x > $y) {
        $temp = $x;
        $x = $y;
        $y = $temp;
      }
      
      for($i = 1; $i < ($x+1); $i++) {
        if ($x%$i == 0 && $y%$i == 0)
          $gcd = $i;
      }
      
      return ($x*$y)/$gcd;
}

function myTestTwo()
{
    $buses = readMyFile("text2.text");
    file_put_contents("buses3.json", json_encode($buses));


    $offset = 0;
    $step = $buses[0];
    $time = 0;

    foreach($buses as $lateBy => $bus) {
        // if ($lateBy=0) continue;
        $matchCount = 0;
        $time = $step;
        while ($matchCount < 1) {
            $desiredTime = ($offset + $time) + $lateBy;
            $module = $desiredTime % $bus;
            if (!$module) {
                    $matchCount = 1;
                    $offset = $offset + $time;
                    $step = lcm($bus, $step);
                    echo "step= " . $step . "     offset= " . $offset . PHP_EOL;
            }
            $time += $step;
        }
    }
    return $offset;
}


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
