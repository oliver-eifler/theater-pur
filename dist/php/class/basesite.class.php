<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 26.06.2016
 * Time: 19:51
 */

require_once('php/class/pagedata.class.php');
require_once('php/class/database.php');
require_once(Config::getInstance()->pageDir.'/config.php');

class BaseSite extends _registry
{
    protected $pagedata = null;
    protected $path = "";
    protected $pathes = ["php/","css/","js/","images/svg/"];
    public function __construct($path="")
    {
        $this->path = $path;
        $this->pagedata = PageData::getInstance();
        $this->init($path);
    }
    private function __clone() {}

    /*overwrite*/
    protected function init($path) {return $this;}
    public function render() {
        $page = $this->pagedata;
        $modified = time();

        if ($page->request_json)
            $content = $this->renderJSON();
        else
            $content = $this->renderHTML();

        if ($page->notFound === true) {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        } else {
            //make sure caching is turned on
            header('Cache-Control: public, must-revalidate');

            if ($page->nocache !== true) {
                $md5 = md5($content);
                $modified = $this->lastModified(trim($page->uri, "/"), $md5, $page->request_json ?? false);

                if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $modified > 0 && @strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $modified) {
                    header($_SERVER["SERVER_PROTOCOL"] . ' 304 Not Modified');
                    exit();
                }
            }

            if ($modified > 0) {
                header('Last-Modified: ' . gmdate("D, d M Y H:i:s", $modified) . " GMT", true);
            }

        }

        if ($page->request_json)
            header("Content-type: application/json; charset=utf-8",true);
        else
            header("Content-type: text/html; charset=utf-8",true);
        echo $content;
        return $this;
    }
    protected function lastModified($path,$hash,$json) {
        if (empty($path))
            $path = "*";
        $table = "xhash_html";
        if ($json)
            $table = "xhash_json";
        $modified = time();
        $db = DataBase::Connect();
        if ($db === false)
            return $modified;
        $sql = "SELECT hash,modified FROM '".$table."' WHERE uri == '".$path."' LIMIT 1";
        $stmt = $db->query($sql);
        if ($stmt === false)
            return $modified;
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $stmt->closeCursor();
        if (!$data || $data->hash != $hash) {
            $db->query("INSERT OR REPLACE INTO '".$table."' (uri,hash,modified) VALUES ('".$path."','".$hash."',".$modified.")");
        } else {
            $modified = (int)$data->modified;
        }
        return $modified;
    }
    public function renderHTML() {return "";}
    public function renderJSON() {return "";}
}
?>