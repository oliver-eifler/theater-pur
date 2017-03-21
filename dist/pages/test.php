<?php
require_once("php/class/database.php");
//date(date,'unixepoch','localtime');
$this->nocache = true;
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
    $config = Config::getInstance();
    echo print_r($config->files['images/yawn.png'],true);


}

?>
</section>