<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 18.01.2017
 * Time: 17:59
 */
require_once("php/class/pageconfig.class.php");
require_once("php/class/registry.class.php");
PageConfig::getInstance()->autoregister(array(
    registry(["name"=>"Frau Müller muss weg","link"=>"frau-mueller-muss-weg","aktuell"=>true,"year"=>2017]),
    registry(["name"=>"Mein Freund Harvey","link"=>"mein-freund-harvey","year"=>2016]),
    registry(["name"=>"Ein ungleiches Paar","link"=>"ein-ungleiches-paar","year"=>2016]),
    registry(["name"=>"Die Gerechten","link"=>"die-gerechten","year"=>2015]),
    registry(["name"=>"Alles beim Teufel","link"=>"alles-beim-teufel","year"=>2014]),
    registry(["name"=>"Bernarda Albas Haus","link"=>"bernarda-albas-haus","year"=>2013]),
    registry(["name"=>"Der nackte Wahnsinn","link"=>"der-nackte-wahnsinn","year"=>2012]),
    registry(["name"=>"Die Vögel","link"=>"die-voegel","year"=>2011]),
    registry(["name"=>"Altes Eisen","link"=>"altes-eisen","year"=>2009]),
    registry(["name"=>"Die Kriegsberichterstatterin","link"=>"die-kriegsberichterstatterin","year"=>2008]),
));
