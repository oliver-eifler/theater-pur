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
        return $this->HTML();
    }
    public function renderJSON()
    {
        return $this->template->renderJSON();
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
        $cached = (strcasecmp(($_COOKIE['critical']??""),$files["critical.css"])===0);


        //if (!$cached) {
            $html .= "<style id='criticalcss'>";
            $html .= file_get_contents("css/critical.css");
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
        $html .= "</head>";
            $html .= $this->htmlBody();
        $html .= "</html>";
        return $html;
    }


    protected function htmlBody()
    {
        $page = $this->pagedata;
        $href = trim($page->uri,"/");
        /*
        $geopattern = new \RedeyeVentures\GeoPattern\GeoPattern();
        $geopattern->setString($page->title);
        $bgImage = $geopattern->toDataURL();
        $bgColor = $geopattern->getBackgroundColor();
        */
        $html = "";
        $html .= "<body>";
        /* additional css for current page only */
        $html .= "<style>";
        $html .= "a[href=".$href." i],";
        $html .= "a[href^=".$href."_ i]";
        $html .= "{pointer-events:none;color:inherit !important;}";
        $html .= "a[href=".$href." i] > span,";
        $html .= "a[href^=".$href."_ i] > span";
        $html .= "{border-bottom:1px solid;margin-bottom:-1px;}";
        $html .= "</style>";

        $html .= Component::get("Banner");
        $html .= Component::get("MainNav");

        $html .= "<article class='container'>";
        $html .= Component::get("HeroHeader");
        $html .= Component::get("Content");
        $html .= "</article>";

        $html .= "<footer class='nc container footer'>";
        $html .= Component::get("Footer");
        $html .= "</footer>";

        $html.= "<script id='domready'>";
        $html.=     "µ.ready(true);";
        //$html.=     "µ.cache();";
        $html.= "</script>";
        $html .= "</body>";
        return $html;
    }
}
