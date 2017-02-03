<?php
$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "Frau Müller muss weg";
$this->subtitle = "Eine Komödie über einen Eltern&shy;abend von Lutz Hübner.";
$this->description = "Eine Komödie über einen Eltern&shy;abend von Lutz Hübner.";
$this->image = $this->imgDir."/plakat.jpg";
?>
<section class="element wrapper-narrow">
    <h2 class="breakout">Inhalt</h2>
    <p>Was würden Eltern nicht alles für ihre Kinder machen?
    Die Hausaufgaben zum Beispiel. Aber wenn das nicht
    genügt, um den Übertritt ins Gymnasium zu sichern,
    dann ist die Lehrerin schuld! (Wer denn sonst?)</p>
    <p>Am Elternabend werden keine Gefangenen gemacht!
        Das lehrreiche und unterhaltsame Stück über den real
        existierenden Wahnsinn an unseren Grundschulen
        ist ein Dauerbrenner auf deutschen Bühnen und kam
        2015 ins Kino!</p>
</section>
<section class="element wrapper-narrow">
    <h2 class="breakout">SchauspielerInnen</h2>
    <ul class="sl tl cast leading">
        <?= Component::get("cast", "Sabine Horak","Fr. Müller"); ?>
        <?= Component::get("cast", "Lydia Mielke","Jessica"); ?>
        <?= Component::get("cast", "Melanie Piontek","Katja"); ?>
        <?= Component::get("cast", "Roswitha Straub","Marina"); ?>
        <?= Component::get("cast", "Holger Ptacek","Patrick"); ?>
        <?= Component::get("cast", "Barbara Kandler-Schmitt","Wolfrun"); ?>
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
            <?= Component::get("image", $this->imgDir."/entwurf-1.jpg"); ?></div>
    </div>
</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impressionen&#x200b;...</h2>
    <div class="element-list">
        <ul class="gl gallery text-center">
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer01.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer02.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer03.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer04.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer05.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer06.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer07.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer08.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer09.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer10.jpg"); ?></li>
            <li class="element"><?= Component::get("galleryitem", $this->imgDir."/trailer11.jpg"); ?></li>
        </ul>
    </div>
</section>