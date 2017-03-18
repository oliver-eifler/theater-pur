<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 26.06.2016
 * Time: 19:51
 */

require_once('php/class/registry.class.php');
require_once('php/class/pagedata.class.php');
require_once('php/class/imagelist.class.php');
require_once('pages/config.php');

class Template extends _registry
{
    protected $pagedata = null;
    public function __construct(&$data)
    {
        $this->pagedata = $data;
        $this->init();
    }
    private function __clone() {}

    public function renderHTML() {return "";}
    public function renderJSON() {return "";}
    protected function init() {return $this;}
}
?>