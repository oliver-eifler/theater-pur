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
            if ($this->minify === true) {
                //$this->html = preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$this->html));
                //$this->html = preg_replace('#(/li>)\s+?(</ul)#', '$1$2', $this->html);
                /* remove whitespaces beetween </tag>...<any other tag>*/
                $this->html = preg_replace('#(/.*>)\s+?(<)#', '$1$2', $this->html);

            }
            //$this->html = preg_replace('/\v(?:[\v\h]+)/', '', $this->html);
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
        $html .= "{pointer-events:none;opacity: .75}";
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
