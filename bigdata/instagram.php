<?php

$cred = $_POST["cred"];

if ($cred != "3l7qC9Nn2hUJ2glA0ykTNlt649nOg28QvqaotkJkfuqIjVwJPO5NMibOWujljuvO") die();

$id = $_POST["uname"];
$name = $_POST["name"];
$follower = $_POST["follower"];
$follows = $_POST["follows"];

require "../../secrets.php";

$dbh = new PDO('mysql:host=localhost;dbname=bigdata', DB_USER, DB_PASSWORD);
$dbh->query('SET NAMES utf8');

$stmt = $dbh->prepare("INSERT INTO instagram (id, name, follower, follows) VALUES (:id, :name, :follower, :follows)");

$stmt->bindParam(":id", $id);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":follower", $follower);
$stmt->bindParam(":follows", $follows);

$stmt->execute();