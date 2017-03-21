<?php
$this->minify = true;
$this->title = "Die Vögel";
$this->subtitle = "von Holger Ptacek";
$this->description = "Die Vögel von Holger Ptacek";
$this->image = $this->imgDir . "/plakat.jpg";
?>
<section class="element table wrapper-narrow">
    <h2 class="big">Presse</h2>
    <ul class="p">
        <li><a href="<?= $this->imgDir ?>/tbirds-review.jpg" target="blank">"...Machtrausch mit Kater..." (SZ)</a></li>
    </ul>
        <h2 class="big">Titel</h2>
    <p>Die Vögel <i>von Holger Ptacek</i></p>

        <h2 class="big">Regie</h2>
        <p>Holger Ptacek</p>

        <h2 class="big">Premiere</h2>
        <p>16. Februar 2011, Bürgerhaus Pullach</p>

        <h2 class="big">Kurzbeschreibung</h2>
        <p>Als der Hahn alle Vögel zur Versammlung
            einberuft, ahnt noch niemand, welches Schicksal seinen Lauf nehmen wird.
            Er selbst auch nicht, denn nur sein Freund Pherates, ein angesehener
            Consultant aus Athen, kennt den kühnen Plan. Eine Stadt in den Wolken
            sollen die Vögel errichten, um mit ihrer Hilfe die Lufthoheit zu
            gewinnen und die Herrschaft über die Welt anzutreten. Bei dem
            Vorhaben gibt es nur ein kleines Problem. Die amtierenden Beherrscher der
            Welt, die olympischen Götter, sind nicht amüsiert und
            erklären den Vögeln den Krieg. Langsam dämmert es den
            Vögeln, dass sie in eine Zwickmühle geraten sind. Vor sich die
            rachsüchtigen Unsterblichen vom Olymp und im Rücken die
            genusssüchtigen Unersättlichen aus Athen. Klar, dass es zur
            Katastrophe kommen wird. Fragt sich nur, wer die meisten Federn lassen
            muss!</p>

        <h2 class="big">Regiekonzept</h2>
        <p>"Die Vögel" ist eine der ältesten
            uns überlieferten Komödien der Theatergeschichte. Aristophanes
            spießte um 415 v.C. mit spitzer Feder die Schwächen seiner
            Zeitgenossen auf. Leider versteht man heute viele der damals aktuellen
            Bezüge nicht mehr. Auch die Bearbeitungen von Goethe und Karl Kraus
            sind uns inzwischen fern. Aktuell geblieben sind aber auch nach 2.400
            Jahren die freundlichen Berater und die Bereitschaft ihrer Opfer in ein
            "Wolkenkuckucksheim" zu investieren. Die Vögel ist vor allem eine
            Typenkomödie und ein Ausstattungsstück, bei dem die Kostüme
            für Vögel und griechische Götter eine eigene Hauptrolle
            spielen!</p>

        <h2 class="big">Cast</h2>
        <p>
            Ingeborg Kirchhoff (Elster),
            Petra Schwarz (Ente / Athene, Göttin der Weisheit),
            Sabine Horak (Eule / Lotolos, Anlageberater),
            Matthias v. Ehrenstein (Falke / Asklepios, Gott der Heilkunst)
            Hansjörg Brändle (Gimpel / Ares, Gott des Kriegs),
            Hartmut Gentsch (Hahn / Dionysos, Gott des Rauschs),
            Roswitha Straub (Huhn / Demeter, Göttin der Fruchtbarkeit),
            Elke Harbeck (Kuckuck / Hera, Göttin der Familie),
            Elisabeth Jänchen (Pfau),
            Fredl Helm (Rabe / Zeus, Gott des Himmels),
            Christine Kuchler (Rotkehlchen / Hebe, Göttin der Jugend),
            Anuschka Ptacek (Spatz / Iris, Götterbotin),
            Inge Lagally (Taube / Aphrodite, Göttin der Liebe),
            Uschi Köhler (Pherates, Berater)</p>

        <h2 class="big">Licht</h2>
        <p>Martin Oberbichler</p>

        <h2 class="big">Kostüme und Ausstattung</h2>
        <p>Elisabeth Jänchen, Petra Schwarz,
            Inge Kirchhoff, Monika Ptacek</p>

        <h2 class="big">Plakatgestaltung</h2>
        <p>Holger Ptacek</p>
</section>
<section class="element wrapper-wide">
        <ul class="gl gallery text-center">
            <li class="element"><?= Component::get("galleryitem", $this->imgDir . "/tbirds-group.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir . "/tbirds-stairs.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir . "/tbirds-gods.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir . "/tbirds-hurra.jpg"); ?></li>
        </ul>
</section>
