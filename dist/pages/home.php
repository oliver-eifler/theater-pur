<?php
require_once('php/class/imagelist.class.php');
require_once("php/class/ollidate.class.php");

$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->template = "landing";
$this->minify = true;
$this->title = "Theater PUR";
$this->subtitle = "Frau Müller muss weg";
$this->description = "Theater PUR präsentiert: Frau Müller muss weg";
?>
<section class="element text-center">
    <header>
    <a class="logo" href="/frau-mueller-muss-weg"><?=Component::get("svg","images/svg/pur.svg",["class"=>"logo-pur","width"=>268,"height"=>132]);?></a>
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
            $html .= "<div class='big'><strong>Frau Müller muss weg</strong></div>";
            $html .= "<div>Für weitere Informationen hier klicken...</div>";
            $html.="</div>";
                $html .= "</a>";
                echo $html;
            ?>
    </li>
    </ul>
    <?php
    $termine =PageConfig::getInstance()->getRef('termine');
    $out = "";
    $count = 0;
    foreach($termine as $termin) {
    $date = new OlliDate($termin->date);
    if ($date->diffDays() < 0)
        continue;
    if ($count > 2)
        break;
    $count++;
    $out .= "<li class='event'>";
        $out .= "<div class='event-day'>".$date->weekday."</div>";
        $out .= "<div class='event-date text-right'>".$date->getDateStr()."</div>";
        $out .= "<div class='event-time text-right'>".$date->getTimeStr()."</div>";
        $out .= "<div class='event-location'><a href='".$termin->wo_link."'>".$termin->wo."</a></div>";
        $out .= "</li>";
    }
    $html ="";
    if ($out != "") {
    $html .= "<div class='element stroke inline text-left' style='vertical-align:middle'>";
    $html .= "<ul class='events zebra center'>".$out."</ul>";
    if ($count > 2)
        $html .= "<div class='element text-left'>... Weitere Termine <a href='/frau-mueller-muss-weg#termine'>finden Sie hier ...</a></div>";
    $html .= "<div class='element text-center'><b>Vorbestellungen</b>: <a href='mailto:karten@theater-pur.de'>karten@theater-pur.de</a></div>";
    $html .= "</div>";
    }
    echo $html;
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
$html .= "<a class='inline' href='/frau-mueller-muss-weg' title='Theater PUR'>";
$img = $images("images/pur-banner.jpg");
$html .= $img->renderLimitSize([],"Theater PUR");
$html .= "</a>";
echo $html;
?>
</footer>