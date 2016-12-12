<?php
require_once('php/class/basesite.class.php');
require_once('php/components.php');
require_once('php/tool/geopattern_loader.php');

class Site extends BaseSite
{

    protected function init($path)
    {
        $render = function($tpl){
            ob_start();
            include $tpl;
            $this->html = ob_get_contents();
            ob_end_clean();
            if ($this->minify === true)
                $this->html = preg_replace('/\v(?:[\v\h]+)/', '', $this->html);
        };

        $render = $render->bindTo($this->pagedata, $this->pagedata);
        $render($path);
        return $this;
    }

    public function renderHTML()
    {
        echo $this->HTML();
        return $this;
    }
    public function renderJSON()
    {
        $page = $this->pagedata;
        $json = array();
        $json['title'] = $page->title;
        $json['content'] = $page->html;

        header("Content-type: application/json; charset=utf-8");
        //sleep(10000);
        echo json_encode($json);
        return $this;
    }

    protected function HTML()
    {
        $page = $this->pagedata;
        $html = "<!DOCTYPE html><html class='no-js' lang='de'><head>";

        $html .= Component::get("MetaData");
        //<link rel="canonical" href="http://example.com/wordpress/seo-plugin/">
        /*Build the filelist*/
        $files = [];
        $files["site.css"] = Component::get("CacheBust","css/site.css");
        $files["nav.js"] = Component::get("CacheBust","js/site.js");
        $files["html5shiv.js"] = Component::get("CacheBust","js/html5shiv.min.js");

        $html.="<link rel='stylesheet' href='".Component::get("CacheBust",$files["site.css"])."'>";
        //$html.="<script id='sitejs' async src='".Component::get("CacheBust",$files["nav.js"])."'></script>";
        $html.="<!--[if lt IE 9]><script src='".Component::get("CacheBust",$files["html5shiv.js"])."'></script><![endif]-->";
        $html.= "<script data-id='kickstart'>";
        $html.=     file_get_contents("js/kickstart.js");
        $html.=     "µ.i(".json_encode($files).");";
        $html.= "</script>";


        $html .= "</head>";
            $html .= $this->htmlBody();
        $html .= "</html>";
        return $html;
    }


    protected function htmlBody()
    {
        $page = $this->pagedata;
        $geopattern = new \RedeyeVentures\GeoPattern\GeoPattern();
        $geopattern->setString($page->title);
        $bgImage = $geopattern->toDataURL();
        $bgColor = $geopattern->getBackgroundColor();


        $html = "";
        $html .= "<body>";
        $html .= Component::get("Banner");
        $html .= Component::get("MainNav");

        $html .= "<main><article>";

            $html .= "<div class='hero' style='background-color: {$bgColor};background-image: {$bgImage}'>";
                $html .= "<div class='hero-wrapper wrapper-narrow'>";
                    $html .= "<h1 class='hero-title'>".$page->title."</h1>";
                    $html .= "<p class='hero-text'>".$page->subtitle."</p>";
                $html .= "</div>";
            $html .= "</div>";

            $html .= Component::get("Content");
        $html .= "</article></main>";

        $html .= "<footer>";
            $html .= Component::get("Footer");
        $html .= "</footer>";

        $html .= "</body>";
        return $html;
    }
}
?>