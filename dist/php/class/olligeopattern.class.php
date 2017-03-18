<?php
require_once('php/tool/geopattern_loader.php');

/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 24.02.2017
 * Time: 20:40
 */
class OlliGeoPattern extends \RedeyeVentures\GeoPattern\GeoPattern
{
 public function cssBackgroundColor() {
    /* from generateBackground() */
     $hueOffset = $this->map($this->hexVal(14, 3), 0, 4095, 0, 359);
     $satOffset = $this->hexVal(17, 1);
     $baseColor = $this->hexToHSL($this->baseColor);
     $color     = $this->color;

     $baseColor['h'] = $baseColor['h'] - $hueOffset;


     if ($satOffset % 2 == 0)
         $baseColor['s'] = $baseColor['s'] + $satOffset/100;
     else
         $baseColor['s'] = $baseColor['s'] - $satOffset/100;

     if (isset($color))
         $rgb = $this->hexToRGB($color);
     else
         $rgb = $this->hslToRGB($baseColor['h'], $baseColor['s'], $baseColor['l']);

     return $this->rgbToHex($rgb['r'],$rgb['g'], $rgb['b']);
 }
 public function getHash() {
     return $this->hash;
 }
}