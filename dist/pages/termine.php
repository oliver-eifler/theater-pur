<?php
require_once("php/class/database.php");

$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->title = "Termine";
$this->subtitle = "Wann und wo Sie unsere Vorstellungen sehen können";
$this->description = "Unsere Termine, Wann und wo Sie unsere Vorstellungen sehen können";
$this->image = "images/termine.jpg";
?>
<section class="element wrapper-narrow">
    <?php
    $termine = DataBase::getTermine(time());
    if ($termine === false) {
        echo "<p class='strong'>".DataBase::getErrorInfo()."</p>";
    }
    else if (count($termine) < 1) {
        echo "<p class='strong'>Die Termine für die nächsten Vorstellungen sind leider noch nicht bekannt!</p>";

    } else {
        $html = "<p class='text-center'><b>Vorbestellungen</b>: <a href='mailto:karten@theater-pur.de'>karten@theater-pur.de</a></p>";
        $html .= "<ul class='events zebra center'>";
        foreach($termine as &$termin) {
            $day = $termin->event_date->weekday;
            $diff = $termin->event_date->diffDays();
            $class="event";
            if ($diff==0) {
                $day = "<em>Heute</em>";
                $class .= " event--today";
            } else if ($diff==1) {
                $day = "<em>Morgen</em>";
                $class .= " event--tomorrow";
            }
            $html .= "<li class='".$class."'>";
            $html .= "<div class='event-day'>".$day."</div>";
            $html .= "<div class='event-date text-right'>".$termin->event_date->getDateStr()."</div>";
            $html .= "<div class='event-time text-right'>".$termin->event_date->getTimeStr()."</div>";
            $html .= "<div class='event-show'><a href='".$termin->show_link."'><q>".$termin->show_name."</q></a></div>";
            $html .= "<div class='event-location'>";
            if (!empty($termin->stage_prefix))
                $html .= $termin->stage_prefix." ";
            $html .= "<a href='".$termin->stage_link."'>".$termin->stage_name."</a></div>";
            $html .= "<div class='event-info'>";
            if ($termin->premiere() === true)
                $html .="<span class='event-premiere important'>Premiere</span>";
            $html .= "</div>";

            $html .= "</li>";
        }
        $html .= "</ul>";
        echo $html;
    }
    ?>
</section>
