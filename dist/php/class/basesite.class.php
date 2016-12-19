<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 26.06.2016
 * Time: 19:51
 */

require_once('php/class/registry.class.php');
require_once('php/class/pagedata.class.php');

class BaseSite extends _registry
{
    protected $pagedata = null;
    protected $path = "";
    protected $pathes = ["php/","css/","js/","images/svg/"];
    public function __construct($path="")
    {
        $this->path = $path;
        $this->pagedata = PageData::getInstance();
        $this->init($path);
    }
    private function __clone() {}

    /*overwrite*/
    protected function init($path) {return $this;}
    public function render() {
        if ($this->pagedata->request_json)
            $content = $this->renderJSON();
        else
            $content = $this->renderHTML();

        $page = $this->pagedata;
        $lmodified = $page->modified;
        $md5 = md5($content);

        header("Etag: $md5");
        //make sure caching is turned on
        header('Cache-Control: public');
        if (/*(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $lmodified > 0 && @strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $lmodified)||*/
            (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == $md5)) {
            header('HTTP/1.1 304 Not Modified');
            exit();
        }
        if ($lmodified > 0) {
            header('Last-Modified: '.gmdate("D, d M Y H:i:s", $lmodified)." GMT");
        }
        if ($this->pagedata->request_json)
            header("Content-type: application/json; charset=utf-8");
        echo $content;
        return $this;
    }
    public function renderHTML() {return "";}
    public function renderJSON() {return "";}
}
?>