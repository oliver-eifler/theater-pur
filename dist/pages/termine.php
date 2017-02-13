<?php
require_once("php/class/ollidate.class.php");

$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->title = "Termine";
$this->subtitle = "Wann und wo Sie unsere Vorstellungen sehen können";
$this->description = "Unsere Termine, Wann und wo Sie unsere Vorstellungen sehen können";
$this->image = "images/termine.jpg";
?>
<section class="element wrapper-narrow">
    <?php
    $termine =PageConfig::getInstance()->getRef('termine');
    $out = "";
    foreach($termine as $termin) {
        $date = new OlliDate($termin->date);
        if ($date->diffDays() < 0)
            continue;
        $out .= "<li class='event'>";
        $out .= "<div class='event-day text-bold'>".$date->weekday."</div>";
        $out .= "<div class='event-date text-bold text-right'>".$date->getDateStr()."</div>";
        $out .= "<div class='event-time text-right'>".$date->getTimeStr()."</div>";
        $out .= "<div class='event-show'><a href='".$termin->link."'><q>".$termin->name."</q></a></div>";
        $out .= "<div class='event-location'>".$termin->wo_prefix."<a href='".$termin->wo_link."'>".$termin->wo."</a></div>";
        $out .= "<div class='event-info'>";
        if ($termin->premiere === true)
            $out .="<span class='event-premiere important'>Premiere</span>";
        $out .= "</div>";
        $out .= "</li>";
    }
    $html ="";
    if ($out != "") {
        $html .= "<p class='text-center'><b>Vorbestellungen</b>: <a href='mailto:karten@theater-pur.de'>karten@theater-pur.de</a></p>";
        $html .= "<ul class='events zebra center'>".$out."</ul>";
    } else {
        $html .= "<p><b>Die Termine für die nächsten Vorstellungen sind leider noch nicht bekannt!</b></p>";
    }
    echo $html;
    ?>
</section>