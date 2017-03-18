<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 18.01.2017
 * Time: 17:59
 */
require_once("php/class/registry.class.php");
require_once("php/class/pageconfig.class.php");

PageConfig::getInstance()->register("menu",array(
    registry(["name"=>"Termine","link"=>"termine"]),
    registry(["name"=>"Stücke","link"=>"stuecke"]),
    registry(["name"=>"Wer sind Wir","link"=>"wer-sind-wir"]),
    /*
    registry(["name"=>"Kontakt","link"=>"kontakt"]),
    */
    registry(["name"=>"Impressum","link"=>"impressum"])
    //,registry(["name"=>"TEST","link"=>"test"])
    ));
/*
PageConfig::getInstance()->register("aktuell",array(
    registry(["name"=>"Frau Müller muss weg","link"=>"frau-mueller-muss-weg"])
));
*/