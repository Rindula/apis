<?php
header("Access-Control-Allow-Origin: *");
include "../../secrets.php"
list($user, $pass) = array(DB_USER, DB_PASSWORD);
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);


switch ($_GET["t"]) {
    case 'hausaufgaben':
        foreach ($dbh->query('SELECT * FROM view_todo') as $row) {
            $out[] = array(
                'id' => utf8_encode($row["ID"]),
                'aufgaben' => utf8_encode($row["Aufgaben"]),
                'datum' => utf8_encode(strval(date("d.m.Y", strtotime($row['Datum'])))),
                'fach' => utf8_encode($row["Fach"])
            );
        }
        $result = "{\"success\":true, \"data\":" . json_encode($out) . "}";
        break;
        
    case 'arbeiten':
        foreach ($dbh->query('SELECT * FROM view_arbeiten') as $row) {
            $out[] = array(
                'id' => utf8_encode($row["id"]),
                'themen' => utf8_encode($row["themen"]),
                'datum' => utf8_encode(strval(date("d.m.Y", strtotime($row['datum'])))),
                'fach' => utf8_encode($row["fach"])
            );
        }
        $result = "{\"success\":true, \"data\":" . json_encode($out) . "}";
        break;
    
    default:
        $result = "{\"success\":false}";
        break;
}


echo($result);
