<?php
$dbHost = getenv('IP');
    $dbPort = 3306;
    $dbName = "translation_web";
    $username = getenv('C9_USER');
    $password = "";
        
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    $sql = "UPDATE phrases SET phrase_ENG ='" . $_POST["eng_phrase"] . "', phrase_PORT ='" . $_POST["por_phrase"] . "' WHERE ID = " . $_POST["id"];
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    
?>