<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 10.07.2016
 * Time: 18:14
 */
require_once("php/util/path.inc.php");
require_once("php/class/config.class.php");

define('PHP', relativePath(ROOT,__DIR__));
define('ROOT_PHP', ROOT.DIRECTORY_SEPARATOR.PHP);

define('COMPONENTS', PHP.DIRECTORY_SEPARATOR."components");
define('ROOT_COMPONENTS', ROOT.DIRECTORY_SEPARATOR.COMPONENTS);

define('CLASSES', PHP.DIRECTORY_SEPARATOR."class");

define('RES', PHP.DIRECTORY_SEPARATOR."res");

$config = Config::getInstance();
$config->version = "1.04";
$config->pageDir = "pages";
$config->imgDir = "images";
$config->svgDir = "images/svg";
$config->avatarDir = "images/avatar";
$config->avatarSize = 128;
$config->baseTime = strtotime("2016-12-01");
$config->dbDsn = "sqlite:data/db/theaterpur";
$config->files = json_decode(file_get_contents("data/files.json"),true);


