<?php
$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "Frau Müller muss weg";
$this->subtitle = "Eine Komödie über einen Elternabend von Lutz Hübner.";
$this->description = "Eine Komödie über einen Elternabend von Lutz Hübner.";
$this->image = $this->imgDir."/plakat.jpg";
?>
<section class="element wrapper-narrow">
    <p><i>Text und Bild geklaut</i></p>

    <h2 class="breakout">Inhalt</h2>
    <p>Die Schulnoten einiger Schüler einer Klasse in einer Dresdner Grundschule werden schlechter. Da nun das Zeugnis naht, das über die Art der weiterführenden Schule entscheidet, sind viele Eltern besorgt. Sie entschließen sich, dafür zu sorgen, dass die Klassenlehrerin Frau Müller die Klasse abgibt. Dazu vereinbaren einige einen Termin mit ihr, übergeben ihr eine Unterschriftenliste und behaupten fest, dass die Lehrerin schuld an den schlechten Noten sei. Den Eltern geht es nicht um die geeignete weiterführende Schule, sondern nur um den formalen Abschluss. Später verlässt die Lehrerin für einige Zeit den Klassenraum und lässt ihre Tasche liegen. Nach verschiedenen Auseinandersetzungen untereinander schauen einige Eltern in die Tasche nach den mündlichen Noten ihrer Kinder. Da die Zensuren viel besser sind als erwartet und somit nichts mehr dagegen spricht, dass ihre Kinder das Gymnasium besuchen können, versuchen sie, Frau Müller, die inzwischen bereit ist, die Klasse abzugeben, nun vom Gegenteil zu überzeugen, was ihnen auch gelingt. Am Ende möchte die Lehrerin den Eltern noch die Noten mitteilen, wobei sich herausstellt, dass sie die aktuellen Zensuren nicht dabei hat und auf dem von den Eltern gefundenen Zettel jene des Vorjahres stehen.</p>
</section>
<section class="element wrapper-narrow">
    <h2 class="breakout">Schau&shy;spieler&shy;Innen</h2>
    <p>Keine Info</p>
</section>
<section class="element wrapper-narrow">
    <div class="p text-center leading">
        <div class="gallery-item">
            <div class="caption"><h2>Regie</h2>
                <ul class="sl tl cast leading center">
                    <?= Component::get("cast", "Holger Ptacek"); ?>
                </ul>
            </div>
            <?= Component::get("image", $this->imgDir."/plakat.jpg"); ?></div>
    </div>
</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impres&shy;sionen&shy;...</h2>
    <p>Keine Bilder</p>
</section>