<?php
$this->minify = true;
$this->title = "Die Kriegsberichterstatterin";
$this->subtitle = "von 	Theresia Walser";
$this->description = "Die Kriegsberichterstatterin von Theresia Walser";
$this->image = $this->imgDir."/plakat.jpg";
?>
<section class="element table wrapper-narrow">
    <h2 class="big">Presse</h2>
    <ul class="p">
        <li><a href="documents/wcorr-sz.html">"...Theatergruppe PUR begeistert Publikum..." (SZ)</a></li>
    </ul>
    <h2 class="big">Titel</h2>
    <p>Die Kriegsberichterstatterin <i>von Theresia Walser</i></p>
        <h2 class="big">Regie</h2>
        <p>Holger Ptacek</p>
        <h2 class="big">Premiere</h2>
        <p>20. Februar 2008, Bürgerhaus Pullach</p>
        <h2 class="big">Kurzbeschreibung</h2>
        <p>Die Belegschaft eines wissenschaftlichen
            Instituts kommt zur Gartenparty beim Institutsleiter zusammen. Leider ist
            es schon herbstlich kühl und beginnt zu regnen, aber der alte Herr
            scheint davon genauso wenig zu merken, wie von den Wünschen seiner
            Mitarbeiter ihn endlich los zu werden. Da erscheint auf einmal eine fremde
            Frau im Garten und berichtet von einem Krieg in der Nachbarschaft. Die
            Institutsmitarbeiter sind jedoch unwillig oder unfähig mit der
            Fremden und ihrer Botschaft umzugehen. Die nur schwach
            übertünchten Konflikte brechen auf und der Institutsleiter steht
            am Ende vor den Scherben seiner Existenz.</p>
        <h2 class="big">Regiekonzept</h2>
        <p>Dieses Stück ist eigentlich eine relativ
            konventionelle Komödie, wäre da nicht die Figur der
            Kriegsberichterstatterin. Die Partygäste spotten zunächst, ekeln
            sich und empören sich ein wenig über den Krieg. Ihre
            Alltagssorgen sind aber wichtiger. Damit stehen sie stellvertretend
            für uns alle, die täglich mit Konflikten und Verbrechen
            konfrontiert werden und ebenfalls keine Konsequenzen daraus ziehen:
            "Stell Dir vor es ist Krieg  und keiner sieht hin."</p>
<p>
            Die Zweiteilung in Komödie und verstörendes Element wurde in der
            Inszenierung bewusst verstärkt. Die Kriegsberichterstatterin betont
            grau, nüchtern und distanziert gegen die bunten, emotionalen Menschen
            gesetzt. Sie erfuhr keine Interpretation. Der Zuschauer sollte sich selber
            einen Reim darauf machen, ob sie als Allegorie, Schicksalsgöttin oder
            Verrückte zu sehen ist.</p>
        <h2 class="big">Cast</h2>
        <p>Hans Jörg Brändle (Herr
            Fütterer, Institutsleiter), Juliane Braun (Beate Fütterer, seine
            Frau), Fredl Helm (Robert Mückenmüller, IT-Spezialist), Gabi
            Floss (Susanne Mückenmüller, seine Frau), Elke Harbeck (Claudia
            Kanopke, Mitarbeiterin), Uschi Köhler (Frau Jessi, Mitarbeiterin),
            Rainer Gienandt (Herr Sommer, Mitarbeiter), Stephanie Lichtenberg (Olga,
            Doktorandin), Christina Lechner (Iris Schwerdtfeger, Sekretärin),
            Inge Lagally (Kriegsberichterstatterin)</p>
        <h2 class="big">Licht</h2>
        <p>Martin Oberbichler</p>
        <h2 class="big">Kostüme</h2>
        <p>Holger Ptacek</p>
        <h2 class="big">Plakatgestaltung</h2>
        <p>Holger Ptacek</p>
        <h2 class="big">Fotos</h2>
        <p>Hans Harbeck u.a.</p>
</section>
<section class="element wrapper-wide">
    <h2 class="text-center">Impressionen​...</h2>
    <div class="element-list">
        <ul class="gl gallery text-center">
            <?php
            $images = [
                "wcorr-01-fuetterer1.jpg"=>"Herr F&uuml;tterer l&auml;dt seine Mitarbeiter zum Gartenfest.",
                "wcorr-02-iris.jpg"=>"Diese hoffen auf Lob...",
                "wcorr-03-jessi.jpg"=>"...oder auf das baldige Ableben des Alten.",
                "wcorr-04-correspondent1.jpg"=>"Da taucht eine Fremde auf...",
                "wcorr-05-correspondent2.jpg"=>"...und berichtet von Krieg in den Nachbargärten.",
                "wcorr-06-fuetterer2.jpg"=>"Herr Fütterer versucht die Ordnung wieder herzustellen,...",
                "wcorr-07-party.jpg"=>"...aber Disziplinlosigkeit greift um sich",
                "wcorr-08-argument.jpg"=>"Es kommt zu Streit und sogar Gewalt.",
                "wcorr-09-final1.jpg"=>"Nur noch auf den Krieg scheint Verlass zu sein.",
                "wcorr-10-final2.jpg"=>"Doch im Institut wird auch nächstes Jahr wieder gefeiert."
            ];
            foreach($images as $path => $desc) {
                echo "<li class='element'>".Component::get("galleryitem",$this->imgDir."/".$path,$desc)."</li>";
            }
            ?>
        </ul>
    </div>
</section>
