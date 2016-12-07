<?php 
if($_SESSION["action"] == "kill"){
    session_destroy();
}
session_start(); 
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional bootstrap theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <div class="navBar">
            <a href="login.php">
                <div class="aButton">Logout</div>
            </a>
            <div class="title" id="title">
                Login to your acount!
            </div>
            <div style="display: inline-block; align: left;">
                <form action="checkLogin.php" method="post">
                    &nbsp                                    <span style="color: white;">Username:</span> <input type="text" name="username"/>
                    <span style="color: white;">Password:</span> <input type="password" name="password"/>
                    <input type="submit" value="Login"/>
                </form>
            </div>
        </div>
        
        <h1>trans<i style="color: #6683AB;">m8</i></h1>
        <?php
        if($_SESSION["action"] == "badpassword"){
            echo "<span style=\"color:red\">Wrong password</span>";
        }else{
            echo $_SESSION["action"];
        }
        ?>
        
    </body>
</html>