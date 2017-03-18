<?php
require_once("php/class/config.class.php");
require_once("php/class/ollidate.class.php");
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 12.03.2017
 * Time: 14:24
 */
class DataBase
{
    protected static $db = NULL;


    public static function Connect()
    {
        if (self::$db === NULL)
        {
            $config = $config = Config::getInstance();
            try {
                self::$db  = new PDO($config->dbDsn);
            } catch (PDOException $e) {
                self::$db = false;
            } catch (Throwable $e) {
                self::$db = false;
            }
        }
        return self::$db;
    }
    public static function getErrorInfo() {
        if (self::$db !== false)
            return implode(" : ",self::$db->errorInfo());
        else {
            return "can't connect to database";
        }
    }
    public static function getTermine($now=false) {
        $db = self::Connect();
        if ($db === false)
            return false;

        $sql = "SELECT event.event_date,event.event_info,event.event_flags " .
            ",show.show_name,show.show_link,show.show_flags ".
            ",stage.stage_name,stage.stage_link,stage.stage_prefix ".
            "FROM event, show, stage " .
            "WHERE event.event_valid == 1 ".($now===false?"":"AND date(event.event_date,'unixepoch','localtime') >= date(".$now.",'unixepoch','localtime') ").
            "AND event.show_id == show.show_id AND event.stage_id == stage.stage_id " .
            "ORDER BY event.event_date ASC";
        $stmt = $db->query($sql);
        return ($stmt === false) ? false : $stmt->fetchAll(PDO::FETCH_CLASS, "TableTermine");
    }
    public static function getTermineByID($id=0,$now=false) {
        $db = self::Connect();
        if ($db === false)
            return false;

        $sql = "SELECT event.event_date,event.event_info,event.event_flags " .
            ",stage.stage_name,stage.stage_link,stage.stage_prefix ".
            "FROM event, stage " .
            "WHERE event.event_valid == 1 ".($now===false?"":"AND date(event.event_date,'unixepoch','localtime') >= date(".$now.",'unixepoch','localtime') ").
            "AND event.show_id == ".$id." AND event.stage_id == stage.stage_id " .
            "ORDER BY event.event_date ASC";
        $stmt = $db->query($sql);
        return ($stmt === false) ? false : $stmt->fetchAll(PDO::FETCH_CLASS, "TableTermine");
    }
    public static function getPremiereByID($id=0,$now=false) {
        $db = self::Connect();
        if ($db === false)
            return false;

        $sql = "SELECT event.event_date" .
            ",stage.stage_name ".
            "FROM event, stage " .
            "WHERE event.event_valid == 1 ".($now===false?"":"AND date(event.event_date,'unixepoch','localtime') < date(".$now.",'unixepoch','localtime') ").
            "AND event.show_id == ".$id." AND event.stage_id == stage.stage_id AND (event.event_flags & ".EVENT_FLAGS_PREMIERE.") == ".EVENT_FLAGS_PREMIERE." ".
            "ORDER BY event.event_date ASC";
        $stmt = $db->query($sql);
        return ($stmt === false) ? false : $stmt->fetchAll(PDO::FETCH_CLASS, "TableTermine");
    }
    public static function getShowID($link) {
        $db = self::Connect();
        if ($db === false)
            return false;
        $sql = "SELECT show.show_id FROM show WHERE show.show_link == '".trim($link,"\/\\")."' LIMIT 1";
        $stmt = $db->query($sql);
        $id = false;
        if ($stmt) {
            $id = $stmt->fetchColumn(0);
            $stmt->closeCursor();
        }
        return $id;
    }
}
/* Table:show FLAGS */
define("SHOW_FLAGS_NULL",0x00);
define("SHOW_FLAGS_AKTUELL",0x01);
/* Table:event FLAGS */
define("EVENT_FLAGS_NULL",0x00);
define("EVENT_FLAGS_PREMIERE",0x01);
define("EVENT_FLAGS_AUSVERKAUFT",0x02);
define("EVENT_FLAGS_VERSCHOBEN",0x04);
define("EVENT_FLAGS_ABGESAGT",0x08);


class TableTermine {
    public $event_date = 0;
    public $event_info = "";
    public $event_flags = 0;

    public $show_name = "";
    public $show_link = "";
    public $show_flags = 0;

    public $stage_name = "";
    public $stage_link = "";
    public $stage_prefix = "";

    public function __construct() {
        $this->event_date = new OlliDate(intval($this->event_date));
        $this->event_flags = intval($this->event_flags);
        $this->show_flags = intval($this->show_flags);
    }
    public function premiere() {
        return (($this->event_flags & EVENT_FLAGS_PREMIERE) == EVENT_FLAGS_PREMIERE);
    }
    public function ausverkauft() {
        return (($this->event_flags & EVENT_FLAGS_AUSVERKAUFT) == EVENT_FLAGS_AUSVERKAUFT);
    }
    public function verschoben() {
        return (($this->event_flags & EVENT_FLAGS_VERSCHOBEN) == EVENT_FLAGS_VERSCHOBEN);
    }
    public function abgesagt() {
        return (($this->event_flags & EVENT_FLAGS_VERSCHOBEN) == EVENT_FLAGS_VERSCHOBEN);
    }
    public function aktuell() {
        return (($this->show_flags & SHOW_FLAGS_AKTUELL) == SHOW_FLAGS_AKTUELL);
    }
}
