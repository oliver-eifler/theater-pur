<?php
require_once("php/class/database.php");
//date(date,'unixepoch','localtime');
$this->created = 1465034394;
$this->modified = filemtime(__FILE__);
$this->title = "TEST";
$this->subtitle = "for internal use only";
?>
<section class="element wrapper-narrow">
<?php
test();
/*
 *
    $stmt = $pdo->query("SELECT * FROM event WHERE date(date,'unixepoch','localtime') >= date(".$now.",'unixepoch','localtime') ORDER BY date ASC");
$stmt = $pdo->query("SELECT event.*,show.name as showname,show.link as showlink FROM event,show WHERE event.'show-id' = show.id AND date(event.date,'unixepoch','localtime') >= date(".$now.",'unixepoch','localtime') ORDER BY event.date ASC");
if ($stmt) {
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<li>" . print_r($row, true) . " - " . date("d.m.Y G:i", $row->date) . ($row->premiere == true ? "- Premiere" : "") . "</li>";
    }
    echo "</ul>";
    $stmt->closeCursor();
}
 *
 */
function test() {
    $now = time();
    //$now = strtotime("2017-10-25");
    $termine = DataBase::getTermine($now);
    if ($termine === false) {
        echo "<p class='strong'>".Database::getErrorInfo()."</p>";
        return;
    }
    echo "<ul>";
    foreach ($termine as &$termin) {
        echo "<li>".print_r($termin,true)."</li>";
    }
    echo "</ul>";

}

function test2()
{
    $now = time();//strtotime("2017-03-25");
    //$now = strtotime("2017-03-25");

    $pdo = DataBase::Connect();
    if ($pdo === false) {
        echo "<p class='strong'>Sorry, there is a Database Error, please inform Olli</p>";
        return;
    }

    $sql = "SELECT event.event_date,event.event_info,event.event_flags " .
        ",show.show_name,show.show_link,show.show_flags ".
        ",stage.stage_name,stage.stage_link,stage.stage_prefix ".
        "FROM event, show, stage " .
        "WHERE event.event_valid == 1 AND date(event.event_date,'unixepoch','localtime') >= date(".$now.",'unixepoch','localtime') AND event.show_id == show.show_id AND event.stage_id == stage.stage_id " .
        "ORDER BY event.event_date ASC";
    $stmt = $pdo->query($sql);
    if ($stmt) {
        echo "<ul>";
        $termine = $stmt->fetchAll(PDO::FETCH_CLASS,"TableTermine");
            foreach ($termine as &$termin) {
                echo "<li>".print_r($termin,true)."</li>";
            }
        echo "</ul>";
    } else {
        echo "<p>".implode(" : ",$pdo->errorInfo())."</p>";
    }

}

?>








</section>