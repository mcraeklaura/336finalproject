<?php
$dbHost = getenv('IP');
    $dbPort = 3306;
    $dbName = "translation_web";
    $username = getenv('C9_USER');
    $password = "";
        
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    $sql = "SELECT MAX(ID) FROM phrases";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    $max = $stmt->fetch();
    
            
    $sql = "INSERT INTO phrases VALUES('" . ($max[0] + 1) . "', '" . $_POST["eng_phrase"] . "', '" . $_POST["por_phrase"] . "', '0', '0')";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    
?>