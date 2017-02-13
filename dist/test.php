<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 11.02.2017
 * Time: 17:46
 * DateTiem Test;
 */
class OlliDate {
    public $datetime = NULL;
    public $timestamp = NULL;
    public $seconds = NULL;
    public $minutes = NULL;
    public $hours = NULL;
    public $mday = NULL;
    public $wday = NULL;
    public $mon = NULL;
    public $year = NULL;
    public $yday = NULL;
    public $weekday = NULL;
    public $month = NULL;

    protected $monthstr = array("0","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember","WieAuchImmer");
    protected $daystr =array("Sonntag","Montag","Dienstag","Mitwoch","Donnerstag","Freitag","Samstag","Soonntag");

    public function __construct($string="") {
        if (empty($string))
            $this->datetime = new DateTime('now');
        else
            $this->datetime = DateTime::createFromFormat("d.m.Y G:i",$string);

       $this->init();
    }
    protected function init() {
        $this->timestamp = $this->datetime->getTimeStamp();
        $arr = getdate($this->timestamp);

        $this->seconds = $arr["seconds"];
        $this->minutes = $arr["minutes"];
        $this->hours = $arr["hours"];
        $this->mday = $arr["mday"];
        $this->wday = $arr["wday"];
        $this->mon = $arr["mon"];
        $this->year = $arr["year"];
        $this->yday = $arr["yday"];
        $this->weekday = $this->daystr[$this->wday];
        $this->month = $this->monthstr[$this->mon];
    }
    public function diffDays() {
        $now = new DateTime('now');
        $now->setTime($this->hours,$this->minutes,0);
        $diff = $now->diff($this->datetime);
        $days = $diff->days * ($diff->invert == 1?-1:1);
        return $days;
    }
}




$heute = date("Y-m-d",time());
$morgen =date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
$month = array("0","Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember","WieAuchImmer");
$day =array("Sonntag","Montag","Dienstag","Mitwoch","Donnerstag","Freitag","Samstag","Soonntag");

$timezone = new DateTimeZone("Europe/Berlin");
$now = new DateTime('now',$timezone);
echo print_r(getdate($now->getTimestamp()),true)."<br>";
$termin = DateTime::createFromFormat("d.m.Y G:i","12.02.2017 20:00",$timezone);
echo print_r(getdate($termin->getTimestamp()),true)."<br>";
echo print_r($termin->diff($now),true)."<br>";

$termin = new OlliDate("10.02.2017 20:00");
echo print_r($termin->datetime,true)."<br>";
echo print_r($termin->diffDays(),true)."<br>";


