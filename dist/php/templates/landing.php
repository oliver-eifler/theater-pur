<?php
require_once('php/class/template.class.php');

class LandingTemplate extends Template
{

    public function renderHTML()
    {
        return $this->HTML();
    }
    public function renderJSON()
    {
        $html = "";
        $html .= Component::get("Content");

        $page = $this->pagedata;

        $json = array();
        $json['title'] = $page->title;
        $json['content'] = $html;

        return json_encode($json);
    }

    protected function HTML()
    {
        $page = $this->pagedata;
        $html = "<!DOCTYPE html>";
        $html .= "<!--[if lt IE 8]> <html class='no-js lt-ie9 lt-ie8' lang='de'> <![endif]-->";
        $html .= "<!--[if IE 8]>    <html class='no-js lt-ie9' lang='de'> <![endif]-->";
        $html .= "<!--[if gt IE 8]><!--> <html class='no-js no-ie' lang='de'> <!--<![endif]-->";

        $html .= Component::get("MetaData");
        //<link rel="canonical" href="http://example.com/wordpress/seo-plugin/">
        /*Build the filelist*/
        $files = [];
        $files["critical.css"] = Component::get("CacheBust","css/landing.css");
        $files["site.css"] = Component::get("CacheBust","css/site.css");
        $files["nav.js"] = Component::get("CacheBust","js/site.js");
        $files["html5shiv.js"] = Component::get("CacheBust","js/html5shiv.min.js");

            $html .= "<style id='criticalcss'>";
            $html .= file_get_contents("css/landing.css");
            $html .= "</style>";

        $html.= "<link rel='preload' href='".$files["site.css"]."' as='style' onload=\"this.rel='stylesheet'\">";
        $html.= "<noscript><link rel='stylesheet' href='".$files["site.css"]."'></noscript>";
        $html.="<!--[if lt IE 9]><script src='".$files["html5shiv.js"]."'></script><![endif]-->";

        $html.= "<script id='kickstart'>";
        $html.=     file_get_contents("js/kickstart.js");
        //$html.=     "µ.i(".json_encode($files).");";
        $html.= "</script>";
        $html .= "</head>";
            $html .= $this->htmlBody();
        $html .= "</html>";
        return $html;
    }


    protected function htmlBody()
    {
        $page = $this->pagedata;
        $images = ImageList::getInstance();
        $img = $images("images/banner.jpg");

        $html = "";
        $html .= "<body style='background-image:url(".$img->getUrl().")'>";

        $html .= "<article>";
        $html .= Component::get("Content");
        $html .= "</article>";

        $html.= "<script id='domready'>";
        $html.=     "µ.ready(true);";
        //$html.=     "µ.cache();";
        $html.= "</script>";
        $html .= "</body>";
        return $html;
    }
}
