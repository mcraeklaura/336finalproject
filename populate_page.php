<?php

//Connect to the database and combine all the data

$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";
        
$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = "SELECT * FROM phrases";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

$arr = array();
while($row = $stmt->fetch()){
    array_push($arr, $row);
}
var_dump($arr);
echo json_encode($arr);
?>