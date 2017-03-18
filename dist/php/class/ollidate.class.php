<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 11.02.2017
 * Time: 21:00
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

        else if (is_string($string))
            $this->datetime = DateTime::createFromFormat("d.m.Y G:i",$string);

        else $this->datetime = DateTime::createFromFormat("d.m.Y G:i",date("d.m.Y G:i",$string));

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
    public function isToday() {
        return ($this->diffDays()==0);
    }
    public function isTomorrow() {
        return ($this->diffDays()==1);
    }
    public function getDateStr() {
        $str = sprintf("%d. %s %04d",$this->mday,$this->month,$this->year);
        return $str;
    }
    public function getTimeStr() {
        $str = sprintf("%02d:%02d Uhr",$this->hours,$this->minutes);
        return $str;
    }
}
