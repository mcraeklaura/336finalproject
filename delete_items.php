<?php
$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";
        
$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "DELETE FROM phrases WHERE ID = '" . $_POST["number"] . "'";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();
?>