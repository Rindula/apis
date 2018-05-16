<?php
header("Access-Control-Allow-Origin: *");
list($user, $pass) = array('root', '74cb0A0kER');
$dbh = new PDO('mysql:host=localhost;dbname=homeworks', $user, $pass);


switch ($_GET["t"]) {
    case 'hausaufgaben':
        foreach ($dbh->query('SELECT * FROM view_todo') as $row) {
            $out[] = array(
                'id' => utf8_encode($row["ID"]),
                'aufgaben' => $row["Aufgaben"],
                'datum' => utf8_encode(strval(date("d.m.Y", strtotime($row['Datum'])))),
                'fach' => utf8_encode($row["Fach"])
            );
        }
        $result = "{\"success\":true, \"data\":" . json_encode($out) . "}";
        break;
    
    default:
        $result = "{\"success\":false}";
        break;
}


echo($result);