<?php
$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "\"Mein Freund Harvey\"";
$this->subtitle = "eine irre Komödie von Mary Chase";
$this->description = "eine irre Komödie von Mary Chase";
$this->image = "images/mein-freund-harvey/harvey-impressions-01.jpg";
?>
<section class="element wrapper-narrow">

    <h2 class="breakout">Inhalt</h2>
    <p>Vera Simmons guter Ruf ist bedroht, ihre Tochter findet weder Job noch Mann.
        Schuld ist Onkel Elwood! Der macht mit dem 1,90m großen, unsichtbaren
        Hasen Harvey Kneipentouren und wirft das Geld zum Fenster raus. Klar, der
        gehört ins Irrenhaus ...Sanatorium! Nur schade, dass Dr. Sanderson Vera
        für die Patientin hält und den charmanten Elwood türmen lässt
        - mitsamt der Frau des Klinikleiters. Da bleibt Prof. Chumley nichts übrig,
        als sich auf die Suche nach dem entlaufenen Patienten zu machen. Und schon hat er
        auch noch diese Journalistin im Nacken, die ihn nur gar zu gern in Grund und Boden
        schreiben würde! Und bald stellt sich die Frage: Wer ist hier jetzt
        eigentlich verrückt?</p>
    <p>"Mein Freund Harvey" von Mary Chase aus dem Jahr 1943 gewann schon 1945 den
        Pulitzer Preis. Längst gehört es zu den Klassikern seines Genres und
        erfreut sich bis heute großer Beliebtheit. Das liegt einmal an der ungeheuer
        reizvollen Grundidee eine unsichtbare Figur auf die Bühne zu bringen. Aber
        auch die Frage was eigentlich verrückt ist und was normal, ein echter
        Evergreen. Und so gewinnt "Mein Freund Harvey" für eine Komödie bald eine
        ungewöhnliche intellektuelle Tiefe und Hintergründigkeit. Denn
        vielleicht ist es ja eher unsere Phantasie, die uns zu Menschen macht, als das
        verhaftet sein in der Realität? In jedem Fall ist es unser Humor, der uns
        zu guten Mitmenschen werden lässt.</p>
</section>
<section class="element wrapper-narrow">
    <h2 class="breakout">SchauspielerInnen</h2>
    <ul class="sl tl cast leading">
        <?= Component::get("cast", "Barthl Sailer", "Elwood"); ?>
        <?= Component::get("cast", "Elke Harbeck", "Vera, seine Schwester"); ?>
        <?= Component::get("cast", "Jasmin Hoffmann", "Myrtle Mae, Veras Tochter"); ?>
        <?= Component::get("cast", "Christine Kuchler", "Ms. Ellerbie, Journalistin"); ?>
        <?= Component::get("cast", "Stefan Hoffmann", "Roger Kelly, Arzt im Praktikum"); ?>
        <?= Component::get("cast", "Frauke Gerbig", "Dr. Sanderson, Assistenzärztin"); ?>
        <?= Component::get("cast", "Holger Ptacek", "Prof. Chumley, Chefarzt"); ?>
        <?= Component::get("cast", "Sonja Stablo", "Betty Chumley, seine Frau"); ?>
        <?= Component::get("cast", "Sabine Horak", "Mary Wilson, Pflegerin"); ?>
    </ul>
</section>
<section class="element wrapper-narrow">
    <div class="p text-center leading">
        <div class="gallery-item">
            <div class="caption"><h2>Regie</h2>
                <ul class="sl tl cast leading center">
                    <?= Component::get("cast", "Holger Ptacek"); ?>
                </ul>
            </div>
            <?= Component::get("image", "images/mein-freund-harvey/harvey-impressions-02.jpg"); ?></div>
    </div>
</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impressionen&#x200b;...</h2>
    <ul class="gl element-list gallery text-center">
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-03.jpg", "Vera Simmons (Elke Harbeck) möchte ihren Bruder dauerhaft im Sanatorium untergebracht wissen. Dr. Sanderson (Frauke Gerbig) bemüht sich herauszufinden, wo das Problem ist.", "Foto: Fotograf"); ?></li>
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-04.jpg", "Das Problem ist Onkel Elwood (Barthl Sailer) und sein Freund Harvey. Dabei sind die beiden ganz nett und ihr Charme kommt an. Auch bei der Frau von Prof. Chumley (Sonja Stablo).", "Foto: Fotograf"); ?></li>
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-05.jpg", "Während ihre Mutter Vera im Irrenhaus sind, bemüht sich Myrtle Mae (Jasmin Hoffmann) um einen Job bei der Zeitung. Journalistin Annabelle Ellerbie (Christine Kuchler) interessiert sich jedoch mehr für Skandale.", "Foto: Fotograf"); ?></li>
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-06.jpg", "Mit ihrer zupackenden Art ist Pflegerin Mary Wilson (Sabine Horak) eine große Hilfe im Institut. Und manchmal auch ein großes Problem.", "Foto: Fotograf"); ?></li>
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-07.jpg", "Prof. Chumley (Holger Ptacek) ist nicht wenig überrascht, als er erfährt, dass seine Mitarbeiter die falsche Patientin einsperrten und der richtige getürmt ist. Und zwar mitsamt seiner Frau.", "Foto: Fotograf"); ?></li>
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-08.jpg", "Für Roger Kelly (Stefan Hoffmann) und Dr. Sanderson (Frauke Gerbig) heißt es Abschied nehmen. Und plötzlich wird ihnen klar, wie ungern sie getrennt sein möchten.", "Foto: Fotograf"); ?></li>
        <li class="element"><?= Component::get("galleryitem", "images/mein-freund-harvey/harvey-impressions-09.jpg", "Und am Ende fragt sich nicht nur Prof. Chumley (Holger Ptacek): <i>Wer ist denn nun eigentlich wirklich verrückt?</i>", "Foto: Fotograf"); ?></li>
    </ul>
</section>