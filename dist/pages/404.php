<?php
$this->created = 1467475900;
$this->modified = filemtime(__FILE__);
$this->template = "error";
$this->title = "Page not found";
?>
<div class="error">
    <img class="error-img" src="/images/yawn.png" alt="404">
    <h1 class="error-big">Page Not Found</h1>
    <p><strong>Sorry, but the page you were trying to view does not exist.</strong></p>
    <p>Maybe, you try it here:</p>
    <?php
    $html ="";
    $html .=    "<p><ul class='sl'>";

    $html .=        "<li><a href='/'>Startseite</a></li>";
    $menu = ($this->config)->menu;
    foreach($menu as &$entry) {
        $html .=        "<li><a href='".$entry->link."'>".$entry->name."</a></li>";
    }
    /*
    $html .=        "<li><a href='termine'>Termine</a></li>";
    $html .=        "<li><a href='stuecke'>Stücke</a></li>";
    $html .=        "<li><a href='ueber'>Wer sind wir</a></li>";
    $html .=        "<li><a href='kontakt'>Kontakt</a></li>";
    $html .=        "<li><a href='impressum'>Impressum</a></li>";
    */
    $html .=    "</ul></p>";


    echo $html;
    ?>



</div>