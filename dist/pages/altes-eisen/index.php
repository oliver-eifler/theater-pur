<?php
$this->minify = true;
$this->title = "Altes Eisen";
$this->subtitle = "Kriminalkomödie im Altersheim";
$this->description = "Altes Eisen. Eine Kriminalkomödie im Altersheim";
$this->image = $this->imgDir."/plakat.jpg";
?>
<section class="element table wrapper-narrow">
    <h2 class="big">Presse</h2>
    <ul class="p">
        <li><a href="<?= $this->imgDir ?>/oiron-review.jpg" target="blank">"...Alteisen von höchst vitaler Konsistenz..."(SZ)</a></li>
    </ul>
        <h2 class="big">Titel</h2>
    <p>Altes Eisen <i>von Holger Ptacek</i></p>

        <h2 class="big">Regie</h2>
        <p>Holger Ptacek</p>

        <h2 class="big">Premiere</h2>
        <p>7. Oktober 2009, Bürgerhaus Pullach</p>

        <h2 class="big">Kurzbeschreibung</h2>
        <p>Die Bewohner der Seniorenresidenz Abendrot
            verleben ihren Alltag in immergleicher Routine. Der Rhythmus gemeinsamer
            Mahlzeiten und kleiner Gemeinheiten im Gemeinschaftsraum wird jäh
            durchbrochen, als ein Heimbewohner stirbt. Weil die Familie seinen letzten
            Willen ignoriert, verdichtet sich die allgemeine Unzufriedenheit in die
            Gewissheit, dass man sich nicht wegsperren lassen mag, als sei das Alter
            eine ansteckende Krankheit. Die Heimbewohner bräuchten nur etwas Geld,
            um das Schicksal noch mal in die eigene Hand nehmen zu können. Aber
            woher nehmen, wenn nicht stehlen ...?</p>

        <h2 class="big">Regiekonzept</h2>
        <p>"Altes Eisen" ist eine Screwball-Komödie,
            mit schrulligen Typen und spitzzüngigen Konflikten. Dahinter verbirgt
            sich die ernste Problematik von Einsamkeit und Enttäuschung über
            einen nicht selbstbestimmten Lebensabend. Bei aller Komik haben wir auf
            schwarz-weiß Malerei verzichtet. Auch die Heimleitung meint es
            eigentlich nur gut. Jede Figur, von den Heimbewohnern bis zum
            Pflegepersonal, bekam einen ernsthaften Hintergrund mit einem Problem, das
            es zu überwinden galt. Viel angesichts der großen Cast, aber
            lohnend, weil erst so die nötige Tiefe entstand, die das Publikum
            mitgerissen hat.</p>

        <h2 class="big">Cast</h2>
        <p>
            Christine Kuchler (Erika Ruffini, Heimleiterin),
            Juliane Braun (Anna Andelowa, Altenpflegerin),
            Petra Seitner (Martina Weinhardt, Altenpflegerin),
            Pia Bahrenburg (Corinna Reiffschitzer, Sozialdienstleistende),
            Elke Harbeck (Lydia von Hornbach, ehem. Sängerin),
            Uschi Köhler (Annette Eisenmenger, Witwe eines Krimiautors),
            Hans-Jörg Brändle (Heinrich Wismer, Ingenier i.R.),
            Fredl Helm (Hans Hergel, ehem. Übersetzer),
            Sabine Horak (Susanna Michalka, ehem. Kranführerin),
            Inge Lagally (Ottilie Horgony, Witwe eines Polizisten),
            Ingeborg Kirchhoff (Irmgard Kessler, Hausfrau und Witwe),
            Merle Kumschier (Kassandra Pechstein, ehem. Erntehelferin),
            Franziska Lachner (Vera Riezler, Hausfrau und Witwe),
            Manfred Schröter (Stefan Holm, Dorfpolizist)</p>

        <h2 class="big">Licht</h2>
        <p>Martin Oberbichler</p>

        <h2 class="big">Kostüme</h2>
        <p>Holger Ptacek</p>

        <h2 class="big">Plakatgestaltung</h2>
        <p>Holger Ptacek</p>

</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impressionen​...</h2>
    <div class="element-list">
        <ul class="gl gallery text-center">
            <?php
                $images = [
                "oiron-staging-01.jpg"=>"In der Seniorenresidenz \"Abendrot\" sind alle Tage gleich.",
                "oiron-staging-02.jpg"=>"Da verzichtet mancher gleich aufs Anziehen.",
                "oiron-staging-03.jpg"=>"Die Kleinkriminelle Corinna und der Tod eines Mitbewohners lassen Erstarrtes aufbrechen.",
                "oiron-staging-04.jpg"=>"Ein Plan entsteht, der nach und nach die Hoffnung auf ein selbstbestimmtes Alter weckt.",
                "oiron-staging-05.jpg"=>"Es fliegen die Fetzen, bevor aus den Alten ein eingeschworenes Team wird.",
                "oiron-staging-06.jpg"=>"Schließlich gibt es einen Koffer voller Geld...",
                "oiron-staging-07.jpg"=>"...für den sich auch die Polizei interessiert.",
                "oiron-staging-08.jpg"=>"Ob das wohl gut ausgehen kann?",
                "oiron-staging-09.jpg"=>"Es hat sich in jedem Fall gelohnt."];
                foreach($images as $path => $desc) {
                    echo "<li class='element'>".Component::get("galleryitem",$this->imgDir."/".$path,$desc)."</li>";
            }
            ?>
        </ul>
    </div>
</section>
