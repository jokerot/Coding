<?php

function readMyFile($fname)
{

    $text = file_get_contents($fname, FILE_IGNORE_NEW_LINES);
    return array_filter(explode(',', $text), fn ($x) => $x != 'x');
}

function readMyFile2($fname)
{

    $text = file_get_contents($fname, FILE_IGNORE_NEW_LINES);
    return explode(',', $text);
}

function myTestOne()
{
    $buses = readMyFile("text.text");
    $timeDeparture = 1008141;
    file_put_contents("buses.json", json_encode($buses));
    $minTimeDiff = $timeDeparture;
    $busID = 0;
    foreach ($buses as $bus) {
        $waitTimeTillNext = ($bus - ($timeDeparture % $bus));
        echo "loop timeDiff= " . $waitTimeTillNext . "    loop busID= " . $bus . PHP_EOL;
        if ($waitTimeTillNext < $minTimeDiff) {

            $minTimeDiff = $waitTimeTillNext;
            $busID = $bus;
        }
    }
    echo "timeDiff= " . $minTimeDiff . "  busID= " . $busID . PHP_EOL;
    return $minTimeDiff * $busID;
}

function myTestTwoOld()
{
    $buses = readMyFile("text2.text");
    arsort($buses);
    $perfectOrder = false;
    $maxElement = max(readMyFile("text2.text"));
    $timeslowBus = intval($maxElement);
    $keySlowBus = array_search($timeslowBus, $buses);
    unset($buses[$keySlowBus]);
    file_put_contents("buses2.json", json_encode($buses));
    echo "loop time= " . $timeslowBus . "    slowbusID= " . $keySlowBus . PHP_EOL;
    $time = 0;
    while (!$perfectOrder) {
        $time += $timeslowBus;
        $perfectOrder = true;
        foreach ($buses as $key => $bus) {
            if ((($time + ($key - $keySlowBus)) % $bus) != 0) {
                $perfectOrder = false;
                break;
            }
        }
    }
    return $time - $keySlowBus;
}

function myTestTwo()
{
    $buses = readMyFile("text2.text");
    file_put_contents("buses3.json", json_encode($buses));
    $maxElement = max($buses);
    $timeslowBus = intval($maxElement);
    $keySlowBus = array_search($timeslowBus, $buses);
    unset($buses[$keySlowBus]);

    $offset = 0;
    $step = $timeslowBus;
    $time = 0;

    while (count($buses) > 0) {

        $matchCount = 0;
        $firstMatchOffset = 0;
        $nextBus = max($buses);
        $timeNextBus = intval($nextBus);
        $keyNextBus = array_search($timeNextBus, $buses);
        file_put_contents("buses4.json", json_encode($buses));
        unset($buses[$keyNextBus]);
        file_put_contents("buses44.json", json_encode($buses));
        while ($matchCount < 2) {
            file_put_contents("buses3" . $keyNextBus . ".json", json_encode($buses));
            if ((($offset + $time + ($keyNextBus - $keySlowBus)) % $timeNextBus) == 0) {
                if ($matchCount == 0) {
                    $matchCount = 1;
                    $firstMatchOffset = $offset + $time;
                } else {
                    $matchCount = 2;
                    $step = ($offset + $time) - $firstMatchOffset;
                    $offset = $firstMatchOffset;
                    echo "step= " . $step . "     offset= " . $offset . PHP_EOL;
                }
            }
            $time += $step;
        }
    }
    return $offset;
}


// $start = (float) array_sum(explode(' ', microtime()));

// echo myTestOne();

// $end = (float) array_sum(explode(' ', microtime()));
// echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
