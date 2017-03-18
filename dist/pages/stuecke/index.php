<?php
require_once('php/class/imagelist.class.php');

$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->minify = true;
$this->title = "Unsere Theaterstücke";
$this->subtitle = "Diese Theaterstücke haben wir bereits gespielt";
$this->description = "Die Theaterstücke, die wir bereits gespielt haben";
$this->image = $this->imgDir . "/header.jpg";
?>
<section class="element">
    <div class="p leading">
    <ul class="gl element-list badges text-center">
        <?php
        $images = ImageList::getInstance();
        $stuecke = $this->config->getRef('stuecke');
        $html="";
        foreach ($stuecke as &$entry) {

            if ($entry->aktuell === true)
                continue;




            $html .= "<li class='element'>";
            $html .= "<a class='element badge drop-shadow raised' href='" . $entry->link . "#top' title='".$entry->name."'>";
            $img = $images("images/" . $entry->link . "/motiv.jpg");
            $html .= $img->renderMaxSize("320px",["crop"=>true],$entry->name);
            $html .= "<div class='badge-label drop-shadow curved curved-hz-2 text-center'><strong>".$entry->name."</strong><br>(".$entry->year.")</div>";
            $html .= "</a>";
            $html .= "</li>";
        }
        echo $html;


        ?>
    </ul>
    </div>
</section>