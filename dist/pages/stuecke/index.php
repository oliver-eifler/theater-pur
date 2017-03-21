<?php
require_once('php/class/imagelist.class.php');
require_once('php/class/database.php');

$this->minify = true;
$this->title = "Unsere Theaterstücke";
$this->subtitle = "Diese Theaterstücke haben wir bereits gespielt";
$this->description = "Die Theaterstücke, die wir bereits gespielt haben";
$this->image = $this->imgDir . "/header.jpg";
?>
    <section class="element">
        <div class="p leading">
            <?php
            $data = getStuecke();
            if (!empty($data)) {
                $html = "<ul class='gl element-list badges text-center'>";

                foreach ($data as &$entry) {
                    $html .= "<li class='element'>" . $entry . "</li>";
                }
                $html .= "</ul>";

            }
            echo $html;
            ?>
        </div>
    </section>
<?php
function getStuecke()
{
    function stuecke($show_name, $show_link, $show_date)
    {
        $images = ImageList::getInstance();
        $year = getdate($show_date)["year"];
        $html = "<a class='element badge drop-shadow raised' href='" . $show_link . "#top' title='" . $show_name . "'>";
        $img = $images("images/" . $show_link . "/motiv.jpg");
        $html .= $img->renderMaxSize("320px", ["crop" => true], $show_name);
        $html .= "<div class='badge-label drop-shadow curved curved-hz-2 text-center'><strong>" . $show_name . "</strong><br>(" . $year . ")</div>";
        $html .= "</a>";
        return $html;
    }

    $db = DataBase::Connect();
    if ($db !== false) {
        $sql = "SELECT show_name,show_link,show_date " .
            "FROM show " .
            "WHERE show_valid == 1 AND (show_flags & " . SHOW_FLAGS_AKTUELL . ")!=" . SHOW_FLAGS_AKTUELL . " " .
            "ORDER BY show_date DESC";
        $stmt = $db->query($sql);
        return ($stmt === false) ? false : $stmt->fetchAll(PDO::FETCH_FUNC, "stuecke");
    }
    return false;
}

?>