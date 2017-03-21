<?php
require_once('php/class/imagelist.class.php');
require_once("php/class/database.php");

$this->template = "landing";
$this->minify = true;
$this->title = "Theater PUR";
$this->description = "Theater PUR aus Pullach im Isartal ist eine freie Theatergruppe. Unsere Spielstätten sind das Bürgerhaus Pullach, das Gasthaus Iberl und weitere Bühnen in München u. a. Aktuell spielen wir \"Frau Müller muss weg\"";
?>
<section class="element text-center">
    <header>
    <a class="logo" href="/info#top"><?=Component::get("svg","images/svg/pur.svg",["class"=>"logo-pur","width"=>268,"height"=>132]);?></a>
        <span class="inline bigger stroke"><strong>präsentiert:</strong></span>
    </header>
    <ul class="element badges inline" style="vertical-align:middle">
    <li>
            <?php
            $images = ImageList::getInstance();
            $html="";
                $html .= "<a class='element badge drop-shadow raised' href='/frau-mueller-muss-weg#top' title='Frau Müller muss weg'>";
                $img = $images("images/plakatmotiv.jpg");
                $html .= $img->renderMaxSize("500px",["crop"=>true],"Frau Müller muss weg");
                $html .= "<div class='badge-label drop-shadow curved curved-hz-2 text-center'>";
            $html .= "<p class='big'><strong>Frau Müller muss weg</strong></p>";
            $html .= "<p>Für weitere Informationen hier klicken...</p>";
            $html.="</div>";
                $html .= "</a>";
                echo $html;
            ?>
    </li>
    </ul>
    <?php
    $termine =DataBase::getTermineByID(10,time());
    if (!empty($termine)) {
        $more = false;
        $html = "<div class='element stroke inline text-left' style='vertical-align:middle'>";
        $html .= "<ul class='events zebra center'>";

        foreach($termine as $idx => &$termin) {
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
            $html .= "<div class='event-location'>";
            $html .= "<a href='".$termin->stage_link."'>".$termin->stage_name."</a></div>";
            $html .= "</li>";
            if ($idx >= 2) {
                $more = true;
                break;
            }
        }
        $html .= "</ul>";
        if ($more === true)
            $html .= "<div class='element text-left'>... Weitere Termine <a href='/frau-mueller-muss-weg#termine'>finden Sie hier ...</a></div>";

        $html .= "<div class='element text-center'><b>Vorbestellungen</b>: <a href='mailto:karten@theater-pur.de'>karten@theater-pur.de</a></div>";
        $html .= "</div>";

        echo $html;
    }
    ?>
    <ul class="p stroke">
    <li>Den Trailer zu <q>Frau Müller muss weg</q> können Sie sich <a href='/frau-mueller-muss-weg#video'>hier</a> oder auf unserer <a href='https://www.facebook.com/theaterpur.de/videos/1805472813050188/'>Facebook-Seite</a> oder <a href='https://www.youtube.com/watch?v=42C3ELzQDFg'>You Tube</a> ansehen</li>
    <li>Weitere Informationen zu <q>Frau Müller muss weg</q> <a href="/frau-mueller-muss-weg#top">finden Sie hier...</a></li>
    </ul>
</section>
<footer class="element text-center">
<?php
$images = ImageList::getInstance();
$html="";
$html .= "<a class='inline' href='/info#top' title='Theater PUR'>";
$img = $images("images/pur-banner.jpg");
$html .= $img->renderLimitSize([],"Theater PUR");
$html .= "</a>";
echo $html;
?>
</footer>