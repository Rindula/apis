<?php
include "../../secrets.php";

$dbh = new PDO('mysql:host=localhost;dbname=abi', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');

$t = $_REQUEST["type"];

switch ($t) {
    case 'bilanz':
        
        foreach ($dbh->query('SELECT * FROM bilanz') as $row) {
            echo $row["bilanz"];
        }

        break;
    
    case 'list':
        $list = array();
        foreach ($dbh->query('SELECT * FROM history') as $row) {
            $list[] = array("betrag" => $row["betrag"], "abteilung" => $row["abteilung"], "note" => $row["note"], "status" => $row["status"]);
        }
        echo json_encode($list);
        break;

    case 'info':
        echo "Typen: bilanz, list, info". PHP_EOL;
        echo "Returns:". PHP_EOL;
        echo "\tbilanz: int".PHP_EOL;
        echo "\t\tlink: https://apis.rindula.de/schule/budget.php?type=bilanz".PHP_EOL;
        echo "\tlist: JSON String".PHP_EOL;
        echo "\t\tlink: https://apis.rindula.de/schule/budget.php?type=list".PHP_EOL;
        echo "\t\tJSON Status:".PHP_EOL;
        echo "\t\t\tPositiver Betrag:".PHP_EOL;
        echo "\t\t\t\t0: Betrag ausstehend".PHP_EOL;
        echo "\t\t\t\t1: Betrag eingegangen".PHP_EOL;
        echo "\t\t\tNegativer Betrag:".PHP_EOL;
        echo "\t\t\t\t0: Betrag angefordert".PHP_EOL;
        echo "\t\t\t\t1: Betrag akzeptiert, auszahlung ausstehend".PHP_EOL;
        echo "\t\t\t\t2: Betrag ausgezahlt".PHP_EOL;
        break;

    default:
        echo "ERROR: Wrong Request Type";
        http_response_code(400);
        break;
}