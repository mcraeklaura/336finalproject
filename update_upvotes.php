<?php
$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";
        
$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
$sql = "UPDATE comment SET upvotes = upvotes + 1 WHERE ID = '" . $_POST["id"] . "'";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();
    
$sql = "SELECT upvotes FROM comment WHERE ID = '" . $_POST["id"] . "'";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

echo json_encode($stmt->fetch());
?>