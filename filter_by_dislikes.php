<?php

$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";
        
$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT SUM(dislikes) FROM phrases";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();
$max = $stmt->fetch();
echo json_encode($max);

?>