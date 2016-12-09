
<?php
session_start();
//Connect to the database and combine all the data

$dbHost = getenv('IP');
$dbPort = 3306;
$dbName = "translation_web";
$username = getenv('C9_USER');
$password = "";

$dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

$sql = "SELECT MAX(ID) FROM comment";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute();

$val = $stmt->fetch();

$date = date("m/d H:i");

if(!isset($_SESSION["username"])){
    $username = "anonymous";
}else{
    $username = $_SESSION["username"];
}

$sql="INSERT INTO comment VALUES('" . ($val[0] + 1) . "', '" . $_POST["id"] .
    "', '" . $username . "', '" . $date . "', '" . $_POST["comment"] . "', '0')";
$stmt = $dbConn -> prepare ($sql);
$stmt -> execute ();
?>