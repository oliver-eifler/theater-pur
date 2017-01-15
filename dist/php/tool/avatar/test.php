<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 04.01.2017
 * Time: 20:04
 */
$colors = [
    "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
    "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d",
];



$slug = isset($_GET["slug"])?$_GET["slug"]:"?_?";


$hash = md5($slug);
$bkcolor = $colors[hexVal($hash,0,2)%(sizeof($colors))];
$text = getInitial($slug);

$width = 256;
$height = 256;
$size = round($width/3);
$font      = dirname(__FILE__) . '/font/rockwell.ttf';

$image = imagecreate($width,$height);
$backgroundColor = imagecolorallocate($image,hexVal($bkcolor,1,2),hexVal($bkcolor,3,2),hexVal($bkcolor,5,2));
$textColor = imagecolorallocate($image,255,255,255);
imagefilledrectangle($image,0,0,$width-1,$height-1,$backgroundColor);
$box        = calculateTextBox($text, $font, $size, 0);
imagettftext($image,
    $size,
    0,
    $box["left"] + ($width / 2) - ($box["width"] / 2),
    $box["top"] + ($height / 2) - ($box["height"] / 2),
    $textColor,
    $font,
    $text);
imagepng($image,"../../../images/avatar/".$slug.".png",6,null);




/*
header("Content-type: image/png");
imagePNG($image,null,6,null);
*/
imagedestroy($image);


exit(0);

function getInitial($name)
{
    $words = explode('_', $name);
    $initial ="";
    // if name contains single word, use first N character
    $count=count($words);
    if ($count === 1) {
        $initial = substr($words[0],0,2);
    } else {
        // otherwise, use initial char from each word
        $initial .= substr($words[0],0,1).substr($words[$count-1],0,1);
    }
    $initial = strtoupper($initial);
    return $initial;
}
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
?>