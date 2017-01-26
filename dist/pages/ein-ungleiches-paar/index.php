<?php
$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "Ein ungleiches Paar";
$this->subtitle = "female version";
$this->description = "Ein ungleiches Paar - female version";
$this->image = $this->imgDir."/plakat.jpg";
?>
<section class="element wrapper-narrow">
    <h2 class="breakout">Inhalt</h2>
    <p>Die großzügige aber schlampige Uli nimmt ihre beste Freundin bei
        sich auf. Felizitas hat sich von ihrem Mann getrennt, nach vierzehn Jahren Ehe.
        Doch was von Uli als Arrangement zum gegenseitigen Vorteil gedacht war,
        erweist sich als starke Belastungsprobe. Und als auch noch das Rendevous mit
        den beiden feschen Italienern aus dem 7. Stock zu scheitern droht, liegen die
        Nerven blank!</p>
    <h2 class="breakout">Schauspielershy;Innen</h2>
    <p>Roswitha Straub, Lydia Mielke, Barbara Kandler-Schmitt, Inge Kirchhoff, Tatjana
        Zagel, Jasim Hoffmann, Christian Mathes und Chris Markl</p>
</section>
<section class="element wrapper-narrow">
    <div class="p text-center leading">
        <div class="gallery-item">
            <div class="caption"><h2>Regie</h2>
                <div class="leading">
                    <ul class="sl tl cast leading center">
                        <?= Component::get("cast", "Holger Ptacek"); ?>
                    </ul>
                </div>
            </div>
            <?= Component::get("image", $this->imgDir."/uepair-impressions-rosinski-01.jpg"); ?></div>
    </div>
</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impressionen&#x200b;...</h2>
    <ul class="gl element-list gallery text-center">
        <li class="element"><?= Component::get("galleryitem", $this->imgDir."/uepair-impressions-rosinski-02.jpg", "Felizitas hält so manche Überraschung für ihre Freundin bereit. Im Guten und …", "Bild: Hanspeter Rosinski"); ?></li>
        <li class="element"><?= Component::get("galleryitem", $this->imgDir."/uepair-impressions-ptacek-01.jpg", "… im Bösen. Und die Sache mit den beiden Italienern, …", "Bild: Monika Ptacek"); ?></li>
        <li class="element"><?= Component::get("galleryitem", $this->imgDir."/uepair-impressions-ptacek-02.jpg", "… die wirft sogar die Trivial-Pursuit-Runde aus der Bahn.", "Bild: Monika Ptacek"); ?></li>
    </ul>
</section>