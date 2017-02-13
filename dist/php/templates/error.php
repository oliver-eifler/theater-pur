<?php
require_once('php/class/template.class.php');

class ErrorTemplate extends Template
{

    protected function init()
    {
        $this->pagedata->notFound = true;
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