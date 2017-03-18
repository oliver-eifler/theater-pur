<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 05.03.2017
 * Time: 16:08

SELECT date(date,'unixepoch','localtime'),time(date,'unixepoch','localtime') FROM "event" WHERE date(date,'unixepoch','localtime') >= date(strtotime('2017-03-25'),'unixepoch','localtime')
SELECT date(date,'unixepoch','localtime'),time(date,'unixepoch','localtime') FROM "event" WHERE date(date,'unixepoch','localtime') >= date('now','unixepoch','localtime')

 */
$params = [
    'db'   => __DIR__ . '/db/theaterpur'
];
try {
    $dsn  = sprintf('sqlite:' . $params['db']);
    $pdo  = new PDO($dsn);
} catch (PDOException $e) {
    echo $e->getMessage();
} catch (Throwable $e) {
    echo $e->getMessage();
}
insertStage($pdo);
insertShow($pdo);
insertEvent($pdo);



function ollitimestamp($string) {
    $datetime = DateTime::createFromFormat("d.m.Y G:i",$string);
    return $datetime->getTimestamp();
}
function insertStage($pdo) {
    $stage = [
        ["name"=>'Sollner Kultbühne im Iberl',"prefix"=>'in der',"link"=>'http://www.iberls.de/#sonderveranstaltungen',"str" => 'Wilhelm-Leibl-Str. 22',"ort"=>'München',"plz"=>'81479']
    ];
    $pdo->exec("DROP TABLE IF EXISTS \"stage\";");
    $pdo->exec("CREATE TABLE 'stage' ('stage_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'stage_name' TEXT, 'stage_prefix' TEXT DEFAULT NULL, 'stage_link' TEXT DEFAULT NULL, 'stage_str' TEXT DEFAULT NULL, 'stage_ort' TEXT DEFAULT NULL, 'stage_plz' TEXT DEFAULT NULL, 'stage_info' TEXT DEFAULT NULL, 'stage_valid' BOOLEAN NOT NULL DEFAULT 1);");

    try {
        $pdo->beginTransaction();
        $sql = "INSERT INTO 'stage' ('stage_name','stage_prefix','stage_link','stage_str','stage_ort','stage_plz') VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);

        foreach ($stage as $row) {

            $stmt->execute([
                $row["name"] ?? "",
                $row["prefix"] ?? "",
                $row["link"] ?? "",
                $row["str"] ?? "",
                $row["ort"] ?? "",
                $row["plz"] ?? "",
            ]);






            echo "<p>" . print_r($row, true) . "</p>";
        }
        $pdo->commit();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $pdo->rollBack();
    }
}

function insertShow($pdo)
{
    $show_flags_null = 0x00;
    $show_flags_aktuell = 0x01;

    $show = [
        ["name" => "Frau Müller muss weg", "link" => "frau-mueller-muss-weg", "date" => strtotime("2017-03-17"), "flags" => $show_flags_aktuell]/*10*/,
        ["name" => "Mein Freund Harvey", "link" => "mein-freund-harvey", "date" => strtotime("2016-10-14")]/*09*/,
        ["name" => "Ein ungleiches Paar", "link" => "ein-ungleiches-paar", "date" => strtotime("2016-03-04")]/*08*/,
        ["name" => "Die Gerechten", "link" => "die-gerechten", "date" => strtotime("2015-10-24")]/*07*/,
        ["name" => "Alles beim Teufel", "link" => "alles-beim-teufel", "date" => strtotime("2014-11-02")]/*06*/,
        ["name" => "Bernarda Albas Haus", "link" => "bernarda-albas-haus", "date" => strtotime("2013-05-01")]/*05*/,
        ["name" => "Der nackte Wahnsinn", "link" => "der-nackte-wahnsinn", "date" => strtotime("2012-10-25")]/*04*/,
        ["name" => "Die Vögel", "link" => "die-voegel", "date" => strtotime("2011-02-16")]/*03*/,
        ["name" => "Altes Eisen", "link" => "altes-eisen", "date" => strtotime("2009-10-07")]/*02*/,
        ["name" => "Die Kriegsberichterstatterin", "link" => "die-kriegsberichterstatterin", "date" => strtotime("2008-02-26")]/*01*/
    ];
    $data = array_reverse($show);
//recreate table
    $pdo->exec("DROP TABLE IF EXISTS \"show\";");
    $pdo->exec("CREATE TABLE 'show' ('show_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'show_name' TEXT DEFAULT 'theaterstück', 'show_link' TEXT DEFAULT 'stuecke', 'show_date'  DATETIME DEFAULT CURRENT_DATE  , 'show_flags' INTEGER NOT NULL DEFAULT 0, 'show_valid' BOOLEAN NOT NULL DEFAULT 1);");


    try {
        $pdo->beginTransaction();
        $sql = "INSERT INTO 'show' ('show_name','show_link','show_date','show_flags') VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);

        foreach ($data as $row) {

            $stmt->execute([
                $row["name"] ?? "theaterstueck",
                $row["link"] ?? "stuecke",
                $row["date"] ?? strtotime('now'),
                $row["flags"] ?? 0
            ]);
            echo "<p>" . print_r($row, true) . "</p>";
        }
        $pdo->commit();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $pdo->rollBack();
    }
}
function insertEvent($pdo) {
    $event_flags_null = 0x00;
    $event_flags_premiere = 0x01;
    $event_flags_ausverkauft = 0x02;
    $event_flags_verschoben = 0x04;
    $event_flags_abgesagt = 0x08;

    $event = [
        ["show-id"=> 10,"stage-id"=>1,"date"=>"17.03.2017 20:00","flags"=>$event_flags_premiere],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"18.03.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"19.03.2017 18:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"24.03.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"25.03.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"26.03.2017 19:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"31.03.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"01.04.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"02.04.2017 18:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"21.04.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"22.04.2017 20:00"],
        ["show-id"=> 10,"stage-id"=>1,"date"=>"23.04.2017 18:00"]
    ];
    $pdo->exec("DROP TABLE IF EXISTS \"event\";");
    $pdo->exec("CREATE TABLE 'event' ('event_id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'show_id' INTEGER NOT NULL ,'stage_id' INTEGER NOT NULL , 'event_date' DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,  'event_info' TEXT DEFAULT '', 'event_flags' INTEGER DEFAULT 0, 'event_valid' BOOLEAN NOT NULL DEFAULT 1);");

    try {
        $pdo->beginTransaction();
        $sql = "INSERT INTO 'event' ('show_id','stage_id','event_date','event_flags') VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);

        foreach ($event as $row) {

            $stmt->execute([
                $row["show-id"] ?? 0,
                $row["stage-id"] ?? 0,
                ollitimestamp($row["date"]),
                $row["flags"] ?? 0,
            ]);
            echo "<p>" . print_r($row, true) . "</p>";
        }
        $pdo->commit();
    } catch (PDOException $e) {
        echo $e->getMessage();
        $pdo->rollBack();
    }
}
