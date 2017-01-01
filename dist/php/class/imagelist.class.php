<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 01.01.2017
 * Time: 15:04
 */
require_once('php/class/pagedata.class.php');

class ImageItem {

    public $isFile = false;
    public $index = -1;
    public $path = "images/yawn.png";
    public $width = 128;
    public $height = 128;
    public $time = 0;
    public function __construct($path,$index)
    {
        if (file_exists($path)) {
            list($this->width,$this->height) = getimagesize($path);
            $this->time = filemtime($path);
            $this->isFile = true;
            $this->path = $path;
        }
        $this->index = $index;
    }
    public function render($attrs = [],$desc="") {
        $page = PageData::getInstance();
        if ($desc == "")
            $desc = ($page->title)." Bild ".($this->index+1);

        if (!isset($attrs["class"]))
            $attrs["class"] = "image";
        else
            $attrs["class"] .= " image";

        if (!isset($attrs["style"]))
            $attrs["style"] = "width:".$this->width."px;";
        else
            $attrs["style"] .= ";width:".$this->width."px;";

        $aspect = round($this->height * 100 / $this->width,4);

        $html = "<div";
        foreach ($attrs as $key => $value) {
            $html .= " " . $key . "='" . $value . "'";
        }
        $html.=" >";
        $html.= "<div style='padding-bottom:".$aspect."%;'></div>";
        $html.= "<img src='".$this->path."' alt='".$desc."'>";
        $html.= "</div>";

        return $html;
    }


}




class ImageList
{
    static protected $images = array();

    static public function getFromPath($path)
    {
        $index = md5($path);
        if (!isset(self::$images[$index])) {
            //create new image
            $idx = count(self::$images);
            self::$images[$index] = new ImageItem($path,$idx);
        }
        return self::$images[$index];
    }
}
