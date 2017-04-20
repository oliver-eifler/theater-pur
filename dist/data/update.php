<?php
/**
 * Created by PhpStorm.
 * User: darkwolf
 * Date: 26.03.2017
 * Time: 19:30
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
update($pdo);
function update($pdo) {
$sql = "UPDATE event SET event_date=".ollitimestamp("26.03.2017 18:00")." WHERE event_date=".ollitimestamp("26.03.2017 19:00").";";
$pdo->query($sql);
};
function ollitimestamp($string) {
    $datetime = DateTime::createFromFormat("d.m.Y G:i",$string);
    return $datetime->getTimestamp();
}