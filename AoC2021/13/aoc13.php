<?php

function readMyFile($fname)
{

    $text = file($fname, FILE_IGNORE_NEW_LINES);

    $arr = [];

    foreach ($text as $line) {
        $arr[] = [(int)explode(',', $line)[0], (int)explode(',', $line)[1]]; 
    }
    
    return $arr;
}

function hfold($arr, $pos){

    $newArr = array_map(function ($x) use ($pos){
        if ($x[0]<$pos) return [$x[0], $x[1]];
        if ($x[0]>$pos) return [$pos - ($x[0] - $pos), $x[1]];
        
    }, $arr);
    $nna = [];
    $length = count($newArr);
    for ($i=0; $i<$length; $i++){
        $temp = array_pop($newArr);
        if (!in_array($temp, $newArr)) $nna[]=$temp;
    } 
    return $nna;
}

function vfold($arr, $pos){
    $newArr = array_map(function ($x) use ($pos){
        if ($x[1]<$pos) return [$x[0], $x[1]];
        if ($x[1]>$pos) return [$x[0], $pos - ($x[1] - $pos)];
        
    }, $arr);
    $nna = [];
    $length = count($newArr);
    for ($i=0; $i<$length; $i++){
        $temp = array_pop($newArr);
        if (!in_array($temp, $newArr)) $nna[]=$temp;
    } 
    return $nna;
}

function myTestOne()
{
    $xfold = 655;
    $matrix = readMyFile('input.txt');
    $matrix = hfold($matrix, 655);
    
    return count($matrix);
}
function myTestTwo()
{
    $matrix = readMyFile('input.txt');
    $matrix = hfold($matrix, 655);
    $matrix = vfold($matrix, 447);
    $matrix = hfold($matrix, 327);
    $matrix = vfold($matrix, 223);
    $matrix = hfold($matrix, 163);
    $matrix = vfold($matrix, 111);
    $matrix = hfold($matrix, 81);
    $matrix = vfold($matrix, 55);
    $matrix = hfold($matrix, 40);
    $matrix = vfold($matrix, 27);
    $matrix = vfold($matrix, 13);
    $matrix = vfold($matrix, 6);
    $matrix = vfold($matrix, 6);

    $image = imagecreate(500, 300);
  
    // Set the vertices of polygon
    $values = array(
                50,  50,  // Point 1 (x, y)
                50, 250,  // Point 2 (x, y)
                250, 50,  // Point 3 (x, y)
                250,  250 // Point 3 (x, y)
            );
    // Set the background color of image
    $background_color = imagecolorallocate($image,  0, 153, 0);
         
    // Fill background with above selected color
    imagefill($image, 0, 0, $background_color);
       
    // Allocate a color for the polygon
    $image_color = imagecolorallocate($image, 255, 255, 255);
         
    // Draw the polygon
    imagepolygon($image, $values, 4, $image_color);
         
    // Output the picture to the browser
    header('Content-type: image/png');
         
    imagepng($image);

    file_put_contents("matrix.json", json_encode($matrix));
    return count($matrix);
}





$start = (float) array_sum(explode(' ', microtime()));

echo myTestOne();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test One COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds." . PHP_EOL;


$start = (float) array_sum(explode(' ', microtime()));

echo myTestTwo();

$end = (float) array_sum(explode(' ', microtime()));
echo PHP_EOL . "Test Two COMPLETED in:" . sprintf("%.4f", ($end - $start)) . " seconds.";
