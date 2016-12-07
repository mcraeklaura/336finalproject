<?php
//Connect to the database and redirect user
function doit(){
    $dbHost = getenv('IP');
    $dbPort = 3306;
    $dbName = "translation_web";
    $username = getenv('C9_USER');
    $password = "";
        
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            
    $sql = "UPDATE phrases SET " . $_POST["type"] . " = " . $_POST["type"] . " + 1 WHERE ID = " . substr($_POST["translation"], 3);
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            
    $sql = "SELECT " . $_POST["type"] . " FROM phrases WHERE ID = " . substr($_POST["translation"], 3);
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    $row = $stmt -> fetch();
    
    return $row[$_POST["type"]];
}
echo doit();
?>