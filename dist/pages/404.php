<?php
require_once("php/class/database.php");
$this->nocache = true;
$this->template = "error";
$this->title = "Page not found";
?>
<div class="error">
    <img class="error-img" src="/images/yawn.png" alt="404">
    <h1 class="error-big">Page Not Found</h1>
    <p><strong>Sorry, but the page you were trying to view does not exist.</strong></p>
    <p>Maybe, you try it here:</p>
    <?php
    function getAktuell()
    {
        function aktuell($show_name, $show_link)
        {
            return "<a href='" . $show_link . "'>" . $show_name . "</a>";
        }

        $db = DataBase::Connect();
        if ($db !== false) {
            $sql = "SELECT show_name,show_link " .
                "FROM show " .
                "WHERE show_valid == 1 AND (show_flags & " . SHOW_FLAGS_AKTUELL . ")==" . SHOW_FLAGS_AKTUELL . " " .
                "ORDER BY show_date DESC";
            $stmt = $db->query($sql);
            return ($stmt === false) ? false : $stmt->fetchAll(PDO::FETCH_FUNC, "aktuell");
        }
        return false;
    }

    $html ="";
    $html .=    "<p><ul class='sl'>";

    $html .=        "<li><a href='/'>Startseite</a></li>";
    $aktuell = getAktuell();
    if (!empty($aktuell)) {
        foreach ($aktuell as &$entry) {
            $html .= "<li>" . $entry . "</li>";
        }
    }

    $menu = Config::getInstance()->getRef('mainMenu');
    foreach($menu as &$entry) {
        $html .=        "<li><a href='".$entry->link."'>".$entry->name."</a></li>";
    }
    $html .=    "</ul></p>";


    echo $html;






    ?>



</div>