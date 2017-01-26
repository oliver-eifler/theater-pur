<?php
/*
   Olli PHP Framework
    Readable Config for Site
    Invoked from pages/config.php
*/
require_once('php/config.php');
require_once('php/class/registry.class.php');

class PageConfig extends _registry
{
   protected static $instance = NULL;
   protected $pagedir ="";
    protected $tempname = "";

   public static function getInstance()
    {
        if (self::$instance === NULL)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    protected function __construct() {
       $this->pagedir = Config::getInstance()->pageDir;
    }
    private function __clone() {}

    /* Overwriten getter to read config files from pages/config/*.php */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            $this->getData($offset);
        }
        return parent::offsetGet($offset);
    }
    public function & getRef($offset)
    {
        if (!$this->offsetExists($offset)) {
            $this->getData($offset);
        }
        return parent::getRef($offset);
    }
    protected function getData($offset) {
        $this->offsetSet($offset,null);
        $path = $this->pagedir.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR.strtolower($offset).".php";
        if (file_exists($path)) {
            $this->tempname = $offset;
            require_once $path;
        }
        $this->tempname = "";
    }
    protected function registryFromArray(&$arr)
    {
        $reg = new _registry();
        foreach ($arr as $key => $val) {
            $reg[$key] = $val;
        }
        return $reg;
    }
    public function register($offset,$value=null) {
        /*
        if (is_array($value)) {
            foreach($value as $key=>$val) {
                if (is_array($val)) {
                    $value[$key] = $this->registryFromArray($val);
                }
            }
        }
        */
        return $this->offsetSet($offset,$value);
        /* construct from array */

    }
    public function autoregister($value=null) {
        $this->register($this->tempname,$value);
    }
}
?>