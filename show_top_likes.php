<?php
$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";
        
$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$sql="SELECT COUNT(ID) FROM phrases";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

$arr = array();
$arr[0] = $stmt -> fetch();

$sql="SELECT * FROM phrases ORDER BY likes DESC";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();

while($row = $stmt->fetch()){
    array_push($arr, $row);
}
echo json_encode($arr);
?>