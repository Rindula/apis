<?php

list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);


switch ($_GET["t"]) {
    case 'hausaufgaben':
        foreach ($dbh->query('SELECT * FROM view_todo') as $row) {
            $aufgaben = explode(";", $row["Aufgaben"]);
            $out[] = array(
                'id' => $row["ID"],
                'aufgaben' => $aufgaben,
                'datum' => "".strtotime($row["Datum"]),
                'fach' => $row["Fach"]
            );
        }
        $result = "{'success': true, 'data': " . json_encode($out) . "}";
        break;
    
    default:
        $result = "{'success':false}";
        break;
}


echo($result);