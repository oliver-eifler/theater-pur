<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 01.01.2017
 * Time: 15:04
 */
require_once('php/class/registry.class.php');
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
    public function getUrl() {
        return $this->getAutoversion();
    }


    public function render($attrs = [],$desc="") {
        $page = PageData::getInstance();
        $lightbox = false;
        $crop = false;
        if ($desc == "")
            $desc = ($page->title)." Bild ".($this->index+1);
        if (isset($attrs["lightbox"])) {
            //$lightbox = ($attrs["lightbox"] === true);
            unset($attrs["lightbox"]);
        }
        if (isset($attrs["crop"])) {
            $crop = ($attrs["crop"] === true);
            unset($attrs["crop"]);

        }
        $class = "image".($crop?" crop":"");

        if (!isset($attrs["class"]))
            $attrs["class"] = $class;
        else
            $attrs["class"] = $class." ".$attrs["class"];

        $aspect = $crop?100:round($this->height * 100 / $this->width,2);

        $file =

        $html = "<div";
        foreach ($attrs as $key => $value) {
            $html .= " " . $key . "='" . $value . "'";
        }
        $html.=">";
        //Inner Image
            $html .= "<div class='imagebox'>";
                $html.= "<img src='".$this->getAutoversion()."' alt='".$desc."'>";
                $html.= "<div style='padding-bottom:".$aspect."%;'></div>";
            $html .= "</div>";

        $html .= "</div>";


        return $html;
    }
    public function imageBox($width=0,$height=0,$desc="") {
        $page = PageData::getInstance();
        if ($desc == "")
            $desc = ($page->title)." Bild ".($this->index+1);
        if ($width == 0)
            $width = $this->width;
        if ($height == 0)
            $height = $this->height;

        $aspect = round($height * 100 / $width,2);
        //Inner Image
        $html = "<div class='imagebox'>";
        $html.= "<img src='".$this->getAutoversion()."' alt='".$desc."'>";
        $html.= "<div style='padding-bottom:".$aspect."%;'></div>";
        $html .= "</div>";


        return $html;
    }
    protected function getAutoversion()
    {
            $parts = pathinfo($this->path);
            if (!isset($parts["filename"])) {
                $parts["filename"] = substr($parts["basename"],0,strlen($parts["basename"]) - (isset($parts['extension'])?(strlen($parts["extension"]) + 1):0) );
            }
            $dir = ($parts["dirname"]=="."?"":$parts["dirname"]."/");
            $ver = $this->time;
            return $dir.$parts["filename"]."_".$ver.".".$parts["extension"];
    }
    public function renderLimitSize($attrs = [],$desc="") {
        if (!isset($attrs["style"]))
            $attrs["style"] = "width:".$this->width."px;";
        else
            $attrs["style"] = "width:".$this->width."px;".$attrs["style"];

        return $this->render($attrs,$desc);
    }
    public function renderMaxSize($maxSize,$attrs = [],$desc="") {
        if (!isset($attrs["style"]))
            $attrs["style"] = "width:".$maxSize.";";
        else
            $attrs["style"] = ";width:".$maxSize.";".$attrs["style"];

        return $this->render($attrs,$desc);
    }


}




class ImageList extends _registry
{
    protected static $instance = NULL;
    protected $images = array();

    public static function getInstance()
    {
        if (self::$instance === NULL)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    protected function __construct() {}
    private function __clone() {}

    public function __invoke($path) {
        return $this->getFromPath($path);
    }

    public function getFromPath($path)
    {
        $index = md5($path);
        if (!isset($this->images[$index])) {
            //create new image
            $idx = count($this->images);
            $this->images[$index] = new ImageItem($path,$idx);
        }
        return $this->images[$index];
    }
}
/*
class ImageList
{
    static protected $images = Config::getInstance()->imageList;

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
*/