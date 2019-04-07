<?php

$cred = $_POST["cred"];

if ($cred != "3l7qC9Nn2hUJ2glA0ykTNlt649nOg28QvqaotkJkfuqIjVwJPO5NMibOWujljuvO") {
    http_response_code(403);
    die("Nope");
}

switch ($_POST["method"]) {
    case 'putData':
        $id = $_POST["uname"];
        $name = $_POST["name"];
        $follower = $_POST["follower"];
        $follows = $_POST["follows"];
        $ts = (time() - time() % 60);
        
        require "../../secrets.php";
        
        $dbh = new PDO('mysql:host=localhost;dbname=bigdata', DB_USER, DB_PASSWORD);
        $dbh->query('SET NAMES utf8');
        
        $stmt = $dbh->prepare("INSERT INTO instagram (id, name, follower, follows, tstamp) VALUES (:id, :name, :follower, :follows, :ts)");
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":follower", $follower);
        $stmt->bindParam(":follows", $follows);
        $stmt->bindParam(":ts", $ts);
        
        $stmt->execute();
        break;
    
    default:
        $ret = array();
        foreach ($dbh->query('SELECT * FROM instagram') as $row) {
            $ret[$row["id"]][] = $row;
        }
        echo json_encode($ret);
        break;
}
