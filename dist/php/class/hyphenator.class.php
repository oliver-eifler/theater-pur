<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 22.01.2017
 * Time: 20:36
 */
class Hyphenator
{
    protected static $instance = NULL;

    public static function getInstance()
    {
        if (self::$instance === NULL)
        {
            require_once('php/tool/syllable/classes/autoloader.php');

            self::$instance = new Syllable('de');
            self::$instance->getCache()->setPath('cache');
        }
        return self::$instance;
    }
    protected function __construct() {}
    private function __clone() {}
}
?>