<?php
require_once('php/class/template.class.php');

$templatename = "DefaultTemplate";
class DefaultTemplate extends Template
{

    public function renderHTML()
    {
        return $this->HTML();
    }
    public function renderJSON()
    {
        $html = "";
        $html .= Component::get("HeroHeader");
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
        $href = trim($page->uri,"/");



        $html = "<!DOCTYPE html>";
        $html .= "<!--[if lt IE 8]> <html class='no-js lt-ie9 lt-ie8' lang='de'> <![endif]-->";
        $html .= "<!--[if IE 8]>    <html class='no-js lt-ie9' lang='de'> <![endif]-->";
        $html .= "<!--[if gt IE 8]><!--> <html class='no-js no-ie' lang='de'> <!--<![endif]-->";

        $html .= Component::get("MetaData");
        //<link rel="canonical" href="http://example.com/wordpress/seo-plugin/">
        /*Build the filelist*/
        $files = [];
        $files["critical.css"] = Component::get("CacheBust","css/critical.css");
        $files["site.css"] = Component::get("CacheBust","css/site.css");
        $files["nav.js"] = Component::get("CacheBust","js/site.js");
        $files["html5shiv.js"] = Component::get("CacheBust","js/html5shiv.min.js");
        //$cookie = "critical=".$files["critical.css"]."; expires=Tue, 19 Jan 2038 03:14:07 GMT";
        //$cached = (strcasecmp(($_COOKIE['critical']??""),$files["critical.css"])===0);


        //if (!$cached) {
            $html .= "<style id='criticalcss'>";
            $html .= file_get_contents("css/critical.css");
            /* additional css for current page only */
            $html .= "a[href=".$href." i],";
            $html .= "a[href^=".$href."_ i]";
            $html .= "{pointer-events:none;color:inherit !important;}";
            $html .= "a[href=".$href." i] > span,";
            $html .= "a[href^=".$href."_ i] > span";
            $html .= "{border-bottom:1px solid;margin-bottom:-1px;}";
            /* additional style for the banner background */
            //$images = ImageList::getInstance();
            //$img = $images("images/banner.jpg");
            //$html .= ".banner {background-image:url(".$img->getUrl().")}";

            $html .= "</style>";
        //} else {
        //    $html.= "<link rel='stylesheet' href='".$files["critical.css"]."'>";
        //}
        $html.= "<link rel='preload' href='".$files["site.css"]."' as='style' onload=\"this.rel='stylesheet'\">";
        $html.= "<noscript><link rel='stylesheet' href='".$files["site.css"]."'></noscript>";

        $html.="<!--[if lt IE 9]><script src='".$files["html5shiv.js"]."'></script><![endif]-->";

        $html.= "<script id='kickstart'>";
        $html.=     file_get_contents("js/kickstart.js");
        $html.=     "µ.i(".json_encode($files).");";
       /*
        if (!$cached) {
            $html .= "µ.ready(function(){µ.loadCSS('" . $files["critical.css"] . "',false,'hidden',function(){document.cookie='" . $cookie . "';});});";
        }
       */
        $html.= "</script>";
/*
        if ($page->canonical)
            $html.="<link rel='canonical' href='".$page->canonical."'>";
*/
        $html .= "</head>";
            $html .= $this->htmlBody();
        $html .= "</html>";
        return $html;
    }


    protected function htmlBody()
    {
        $page = $this->pagedata;
        $href = trim($page->uri,"/");

        $html = "";
        $html .= "<body>";

        $html .= Component::get("Banner");
        $html .= Component::get("MainNav");

        $html .= "<article id='top' class='container'>";
        $html .= Component::get("HeroHeader");
        $html .= Component::get("Content");
        $html .= "</article>";

        $html .= "<footer class='nc container footer'>";
        $html .= Component::get("Footer");
        $html .= "</footer>";

        $html.= "<script id='domready'>";
        $html.=     "µ.ready(true);";
        $html.= "</script>";
        $html .= "</body>";
        return $html;
    }
}
