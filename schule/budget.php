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
        echo "Typen: bilanz, list, info". PHP.EOL;
        echo "Returns:". PHP.EOL;
        echo "\tbilanz: int".PHP.EOL;
        echo "\tlist: JSON String";
        echo "\t\tJSON Status:".PHP.EOL;
        echo "\t\t\tPositiver Betrag:".PHP.EOL;
        echo "\t\t\t\t0: Betrag ausstehend".PHP.EOL;
        echo "\t\t\t\t1: Betrag eingegangen".PHP.EOL;
        echo "\t\t\tNegativer Betrag:".PHP.EOL;
        echo "\t\t\t\t0: Betrag angefordert".PHP.EOL;
        echo "\t\t\t\t1: Betrag akzeptiert, auszahlung ausstehend".PHP.EOL;
        echo "\t\t\t\t2: Betrag ausgezahlt".PHP.EOL;
        break;

    default:
        echo "ERROR: Wrong Request Type";
        http_response_code(400);
        break;
}