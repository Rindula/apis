<?php
include "../../secrets.php";

$dbh = new PDO('mysql:host=localhost;dbname=abi', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');

$t = $_REQUEST["type"];

switch ($t) {
    case 'bilanz':
        
        foreach ($dbh->query('SELECT * FROM bilanz') as $row) {
            echo $row["bilanz"] . " €";
        }

        break;
    
    case 'list':
        $list = array();
        foreach ($dbh->query('SELECT * FROM history') as $row) {
            $list[] = array("betrag" => $row["betrag"], "abteilung" => $row["abteilung"], "note" => $row["note"], "status" => $row["status"]);
        }
        echo json_encode($list);
        break;

    default:
        echo "ERROR: Wrong Request Type";
        http_response_code(400);
        break;
}