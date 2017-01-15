<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 06.01.2017
 * Time: 21:00
 */

function hexVal($val,$index=0, $len=2)
{
    return hexdec(substr($val, $index, $len));
}
function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) {
    /************
    simple function that calculates the *exact* bounding box (single pixel precision).
    The function returns an associative array with these keys:
    left, top:  coordinates you will pass to imagettftext
    width, height: dimension of the image you have to create
     *************/
    $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text);
    $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6]));
    $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6]));
    $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7]));
    $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7]));

    return array(
        "left"   => abs($minX) - 1,
        "top"    => abs($minY) - 1,
        "width"  => $maxX - $minX,
        "height" => $maxY - $minY,
        "box"    => $rect
    );
}



