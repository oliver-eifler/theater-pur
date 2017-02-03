<?php
require_once('php/class/imagelist.class.php');

$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "Theater PUR";
$this->subtitle = "Aktuell";
$this->description = "Theater PUR aktuell";
$this->image = $this->imgDir . "stuecke/header.jpg";
?>
<section class="element">
    <h2 class="text-center">Theater Pur präsentiert:</h2>
    <div class="p leading">
        <ul class="gl element-list badges text-center">
            <?php
            $images = ImageList::getInstance();
            $stuecke = $this->config->getRef('stuecke');
            $html="";
            foreach ($stuecke as &$entry) {

                if ($entry->aktuell !== true)
                    continue;




                $html .= "<li class='element'>";
                $html .= "<a class='element badge drop-shadow raised' href='" . $entry->link . "' title='".$entry->name."'>";
                $img = $images("images/" . $entry->link . "/plakat.jpg");
                $html .= $img->renderMaxSize("500px",["crop"=>true],$entry->name);
                $html .= "<div class='badge-label drop-shadow curved curved-hz-2 text-center'><strong>".$entry->name."</strong><br>(".$entry->year.")</div>";
                $html .= "</a>";
                $html .= "</li>";
            }
            echo $html;


            ?>
        </ul>
    </div>
</section>