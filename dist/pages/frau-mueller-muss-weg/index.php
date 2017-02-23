<?php
require_once("php/class/ollidate.class.php");

$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "Frau Müller muss weg";
$this->subtitle = "Eine Komödie über einen Elternabend von Lutz Hübner.";
$this->description = "Eine Komödie über einen Elternabend von Lutz Hübner.";
$this->image = $this->imgDir."/plakat.jpg";
$this->imagedesc = "Den Trailer zu <q>Frau Müller muss weg</q> können Sie sich <a href='#video'>hier</a> oder auf unserer <a href='https://www.facebook.com/theaterpur.de/videos/1805472813050188/'>".Component::get("svg","images/svg/facebook.svg",["class"=>"icon icon-facebook"])." Facebook Seite</a> oder <a href='https://www.youtube.com/watch?v=42C3ELzQDFg'>".Component::get("svg","images/svg/video.svg",["class"=>"icon icon-video"])." You Tube</a> ansehen";

?>
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
    $out .= "<div class='event-location'><a href='".$termin->wo_link."'>".$termin->wo."</a></div>";
    $out .= "<div class='event-info'>";
    if ($termin->premiere === true)
        $out .="<span class='event-premiere important'>Premiere</span>";
    $out .= "</div>";
    $out .= "</li>";
}
$html ="";
if ($out != "") {
    $html .= "<section id='termine' class='element wrapper-narrow'>";
    $html .= "<h2 class='breakout'>Termine</h2>";
    $html .= "<ul class='events zebra center'>".$out."</ul>";
    $html .= "<p class='text-center'><b>Vorbestellungen</b>: <a href='mailto:karten@theater-pur.de'>karten@theater-pur.de</a></p>";
    $html .= "</section>";
}
echo $html;
?>
<section id="info" class="element wrapper-narrow">
    <h2 class="breakout">Inhalt</h2>
    <p>In der vierten Klasse werden wichtige Weichen gestellt. Aber in der 4b haben sich die schriftlichen Noten der meisten Kinder sich zum Teil dramatisch verschlechtert. Das Lernklima ist schlecht und die ständige Unruhe in der Klasse, bekommt die Lehrerin, Frau Müller, anscheinend nicht in den Griff. Was bleibt da den besorgten Eltern anderes übrig, als der überforderten oder sogar ausgebrannten Beamtin das Vertrauen zu entziehen? Dabei ist es natürlich Zufall, dass zur Grundschul-Revolte fast genau die Eltern erschienen sind, deren Kinder in der Klasse die größten Probleme verursachen. Ob Frau Müller die als Verhandlungspartner überhaupt ernst nimmt?</p>
    <p>Lutz Hübner war schon 2002 der drittmeist gespielte Dramatiker auf deutschen Bühnen. <q>Frau Müller muss weg</q> (2010) ist seit sieben Jahren ein Dauerbrenner. Die Verfilmung von Sönke Wortmann mit Anke Engelke als taffer, aber betrogener Elternklassensprecherin aus dem Jahr 2015 trägt inzwischen sein übriges dazu bei. Der Grund für diesen Erfolg liegt sicher darin, dass das Stück direkt aus der Alltagswelt seines Publikums schöpft. Auseinandersetzungen zwischen Eltern und Lehrern sind ja ebenfalls ein Dauerbrenner und das Schulsystem wird mindestens genauso lang reformiert und diskutiert, wie das Stück gespielt wird. Hinzu kommt aber noch, dass unter der frechen, bunten Oberfläche ein tieferes Thema anklingt: Die Abstiegsängste der Mittelschicht und ihre oft geradezu grotesk anmutenden Versuche ihren verhätschelten Nachwuchs angesichts der Härte der Welt in Watte zu packen.</p>
</section>
<section class="element wrapper-narrow text-center">
    <h2 class="breakout text-left">SchauspielerInnen</h2>
    <div class="element inline" style="width:320px;vertical-align:middle;">
        <div class="gallery-item">
            <?= Component::get("image", $this->imgDir."/ensemble.jpg"); ?>
        </div>
    </div>
    <div class="inline text-left" style="vertical-align:middle;">
    <ul class="sl inline tl cast leading">
        <?= Component::get("cast", "Sabine Horak","Fr. Müller"); ?>
        <?= Component::get("cast", "Lydia Mielke","Jessica, Elternsprecherin"); ?>
        <?= Component::get("cast", "Melanie Piontek","Katja"); ?>
        <?= Component::get("cast", "Barbara Kandler-Schmitt","Wolfrun"); ?>
        <?= Component::get("cast", "Roswitha Straub","Marina"); ?>
        <?= Component::get("cast", "Holger Ptacek","Patrick, ihr Mann"); ?>
    </ul>
    </div>
</section>
<section class="element wrapper-narrow">
    <div class="p text-center leading">
        <div class="gallery-item">
            <div class="caption"><h2>Regie</h2>
                <ul class="sl tl cast leading center">
                    <?= Component::get("cast", "Holger Ptacek"); ?>
                </ul>
            </div>
            <?= Component::get("image", $this->imgDir."/ensemble03.jpg"); ?></div>
    </div>
</section>
<section class="element wrapper-wide">
    <h2 id='video' class="text-center">Videos&#x200b;...</h2>
    <div class="element-list">
        <ul class="gl text-center">
            <li class="element"><?= Component::get("videoitem",
                    ["id"=>"42C3ELzQDFg",
                     "width"=>1280,
                        "height"=>720,
                        "thumb"=>$this->imgDir."/trailer.jpg"],
                    "Trailer"); ?></li>
        </ul>
    </div>
</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impressionen&#x200b;...</h2>
    <div class="element-list">
        <ul class="gl gallery-rt text-center">
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene01.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene02.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene03.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene04.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene05.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene06.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene07.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene08.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene09.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene10.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/480/szene11.jpg"); ?></li>
        </ul>
    </div>
</section>