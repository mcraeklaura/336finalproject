<?php

//Connect to the database and combine all the data

$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";
  $arr = array();      
$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql="SELECT phrase_ENG FROM phrases WHERE ID = '" . $_POST["id"] . "'";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

$arr[0] = $stmt->fetch();

$sql="SELECT COUNT(ID) FROM comment WHERE phrase_ID = '" . $_POST["id"] . "'";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

$arr[1] = $stmt->fetch();

$sql="SELECT * FROM comment WHERE phrase_ID = '" . $_POST["id"] . "'";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

while($row = $stmt->fetch()){
    array_push($arr, $row);
}
echo json_encode($arr);
?>