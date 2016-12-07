<?php
session_start();

    //Connect to the database and redirect user
    $dbHost = getenv('IP');
    $dbPort = 3306;
    $dbName = "translation_web";
    $username = getenv('C9_USER');
    $password = "";
        
    $dbConn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            
    $sql = " SELECT * FROM usernames WHERE username = '" . $_POST["username"] . "' AND password = '" . $_POST["password"] . "'";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ();
    $row = $stmt -> fetch();
    if($row == 0){
        $_SESSION["action"] = "badpassword";
        header("Location: login.php");
        exit();
    }
    else{
        $_SESSION["username"] = $row["username"];
        $_SESSION["password"] = $row["password"];
        var_dump($row);
        header("Location: user.php");
        exit();
    }

?>