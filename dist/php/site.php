<?php
require_once('php/class/basesite.class.php');
require_once('php/components.php');
require_once('php/tool/geopattern_loader.php');

class Site extends BaseSite
{
    protected $template = null;
    protected function init($path)
    {
        $render = function($tpl){
            ob_start();
            include $tpl;
            $this->html = ob_get_contents();
            ob_end_clean();
            if ($this->minify === true) {
                $this->html = preg_replace('#(/.*>)\s+?(<)#', '$1$2', $this->html);

            }
        };
        $render->call($this->pagedata,$path);

        //loading template
        $tmpl = "";
        if (!isset($this->pagedata->template) || !file_exists("php/templates/".$this->pagedata->template.".php")) {
            $this->pagedata->template = "default";
        }
        require_once("php/templates/".$this->pagedata->template.".php");
        $template = ucfirst($this->pagedata->template)."Template";
        $this->template = new $template($this->pagedata);

      return $this;
    }

    public function renderHTML()
    {
        return $this->template->renderHTML();
    }
    public function renderJSON()
    {
        return $this->template->renderJSON();
    }

}
