<?php
require_once('php/class/basesite.class.php');
require_once('php/components.php');

class Site404 extends BaseSite
{

    protected function init($path)
    {
        $this->pagedata->notFound = true;

        $render = function($tpl){
            ob_start();
            include $tpl;
            $this->html = ob_get_contents();
            ob_end_clean();
        };

        $render = $render->bindTo($this->pagedata, $this->pagedata);
        $render($path);
        return $this;
    }
    public function renderHTML()
    {
        return $this->HTML();
    }
    public function renderJSON()
    {
        $page = $this->pagedata;
        $json = array();
        $json['error'] = true;
        return json_encode($json);
    }

    protected function HTML()
    {
        $page = $this->pagedata;
        $html = "<!DOCTYPE html><html lang='en'><head>";

        $html .= Component::get("MetaData");
        $html .= Component::get("inlineCSS","css/404.css");

        $html .= "</head>";
        $html .= "<body>";
        $html .= Component::get("Content");
        $html .= "</body>";
        $html .= "</html>";
        return $html;
    }

}
?>