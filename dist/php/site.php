<?php
require_once('php/class/basesite.class.php');
require_once('php/components.php');

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
        $files["css/site.css"] = Component::get("CacheBust","css/site.css");
        $files["js/site.js"] = Component::get("CacheBust","js/site.js");
        $files["js/html5shiv.min.js"] = Component::get("CacheBust","js/html5shiv.min.js");

        $html.="<script>var _files=".json_encode($files).";console.log(_files);</script>";

        $html.="<link rel='stylesheet' href='".Component::get("CacheBust","css/site.css")."'>";
        $html.="<script id='sitejs' async src='".Component::get("CacheBust","js/site.js")."'></script>";
        $html.="<!--[if lt IE 9]><script src='".Component::get("CacheBust","js/html5shiv.min.js")."'></script><![endif]-->";

        $html .= "</head>";
            $html .= $this->htmlBody();
        $html .= "</html>";
        return $html;
    }


    protected function htmlBody()
    {
        $html = "";
        $html .= "<body>";
        $html .= Component::get("Banner");
        $html .= Component::get("MainNav");

        $html .= "<main>";
        $html .= Component::get("Content");
        $html .= "</main>";

        $html .= "<footer>";
        $html .= Component::get("Footer");
        $html .= "</footer>";

        $html .= "</body>";
        return $html;
    }
}
?>