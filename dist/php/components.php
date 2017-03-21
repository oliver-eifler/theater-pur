<?php

/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 25.06.2016
 * Time: 15:06
 * Shared Components for Layout
 */
require_once("php/class/component.class.php");
require_once("php/class/pagedata.class.php");
require_once("php/class/config.class.php");


Component::register("inlineCSS",
    function ($path) {
        $html = "<style>@namespace svg url(http://www.w3.org/2000/svg);" . file_get_contents($path) . "</style>";
        //$html = "<style>" . file_get_contents($path) . "</style>";
        return $html;
    });
Component::register("Content",
    function() {
        return PageData::GetInstance()->html;
    });

Component::register("CacheBustOld",
    function($path) {
        if (file_exists($path))
        {
            $ver = filemtime($path)-Config::getInstance()->baseTime;
            if ($ver < 0)
                $ver = $ver * -1;
            $parts = pathinfo($path);
            if (!isset($parts["filename"])) {
                $parts["filename"] = substr($parts["basename"],0,strlen($parts["basename"]) - (isset($parts['extension'])?(strlen($parts["extension"]) + 1):0) );
            }
            $dir = ($parts["dirname"]=="."?"":$parts["dirname"]."/");
            return $dir.$parts["filename"]."_".$ver.".".$parts["extension"];
        }
        return $path;
    });
Component::register("CacheBust",
    function($path) {
        $files = Config::getInstance()->files;
        $fileinfo = $files[$path] ?? false;
        if ($fileinfo !== false)
        {
            $ver = $fileinfo["hash"];
            $parts = pathinfo($path);
            if (!isset($parts["filename"])) {
                $parts["filename"] = substr($parts["basename"],0,strlen($parts["basename"]) - (isset($parts['extension'])?(strlen($parts["extension"]) + 1):0) );
            }
            $dir = ($parts["dirname"]=="."?"":$parts["dirname"]."/");
            return $dir.$parts["filename"]."_".$ver.".".$parts["extension"];
        }
        return $path;
    });

