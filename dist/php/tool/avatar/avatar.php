<?php

/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 06.01.2017
 * Time: 19:06
 */
require_once ("php/config.php");
require_once ("php/util/functions.php");
require_once ("php/util/Stringy.php");

use Stringy\Stringy;

class Avatar
{
    protected $path = "";
    protected $name;
    protected $hash = "";
    protected $width = "";
    protected $height = "";

    protected $colors = [
        "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
        "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d",
    ];

    public function __construct($name,$width=128,$height=128) {
        $name = Stringy::create($name)->collapseWhitespace();
        if ($name->isBlank())
            $name = Stringy::create("???");

        $this->init($name,$width,$height);
    }
    public function debug() {
        return print_r($this,true);
    }
    public function getPath() {
        return $this->path;
    }
    protected function init($name,$width,$height) {
        $config = Config::getInstance();
        $this->name = $name;
        $this->hash = sha1((string)$name);
        $this->path = $config->avatarDir.DIRECTORY_SEPARATOR.$this->hash.".png";
        $this->width = $width;
        $this->height= $height;
        if (!file_exists($this->path))
            $this->create();
    }
    protected function create() {
        $initials = $this->getInitials();
        $bkcolor = $this->getBackgroundColor();
        $txcolor = $this->getTextColor();

        $size = round($this->width/3);
        $font = dirname(__FILE__) . '/font/rockwell.ttf';

        $image = imagecreate($this->width,$this->height);
        $backgroundColor = imagecolorallocate($image,$bkcolor["r"],$bkcolor["g"],$bkcolor["b"]);
        $textColor = imagecolorallocate($image,$txcolor["r"],$txcolor["g"],$txcolor["b"]);
        imagefilledrectangle($image,0,0,$this->width-1,$this->height-1,$backgroundColor);
        $box        = calculateTextBox($initials, $font, $size, 0);
        imagettftext($image,
            $size,
            0,
            $box["left"] + (($this->width - $box["width"]) / 2),
            $box["top"] + (($this->height  -$box["height"]) / 2),
            $textColor,
            $font,
            $initials);
        imagepng($image,$this->path,6,null);
    }
    protected function getInitials()
    {
        $name = $this->name->toAscii();
        $words = explode(' ', (string)$name);
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
    protected function getBackgroundColor() {
        $color=$this->colors[hexVal($this->hash,0,2)%(sizeof($this->colors))];
        return ["r"=> hexVal($color,1,2),
            "g"=>hexVal($color,3,2),
            "b"=>hexVal($color,5,2)];
    }
    protected function getTextColor() {
        $color="#ffffff";
        return ["r"=> hexVal($color,1,2),
            "g"=>hexVal($color,3,2),
            "b"=>hexVal($color,5,2)];
    }



}