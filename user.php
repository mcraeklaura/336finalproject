<?php session_start(); ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/grayscale.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional bootstrap theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
    <body>
        <script src="js/like_dislike.js"></script>
        <div class="navBar">
            <a href="login.php">
                <div class="aButton">Logout</div>
            </a>
            <div class="title" id="title">
                <p>
                    Hello, <?php echo $_SESSION["username"]; ?>!
                </p>
            </div>
        </div>
        
        <center>
            
        <div id="wrapper" class="container-fluid">
            <table class="table table-hover" id="translations" style="width: 900px">
             <tr>
                 <th class="data">English</th>
                 <th class="data">Portuguese</th>
                 <th class="likes"></th>
                 <th class="likes"></th>
             </tr>
             <script>
                 //Populate the table with all the data from the database
                 $.ajax({
                     type: 'post',
                     url: 'populate_page.php',
                     dataType: 'json',
                     success: function(data) {
                        console.log("We in this bitch!");
                        //Try to update likes and dislikes
                        console.log(data);
                        
                        for(var i=1; i <= data[0][0]; i++){
                            $("#translations").append(
                                $("<tr>")
                                    .attr("id", "num" + data[i]["ID"])
                                    .append($("<td>")
                                        .attr("class", "data")
                                        .html(data[i]["phrase_ENG"]))
                                    .append($("<td>")
                                        .attr("class", "data")
                                        .html(data[i]["phrase_PORT"]))
                                    .append($("<td>")
                                        .attr("onclick", "like_dislike('likes', 'num" + data[i]["ID"] + "')")
                                        .attr("id", "likes")
                                        .attr("class", "likes")
                                        .append($("<img>")
                                            .attr("src", "img/heart_sprite.png"))
                                        .append($("<span>")
                                            .attr("id", "likes_num")
                                            .html(" " + data[i]["likes"])))
                                    .append($("<td>")
                                        .attr("onclick", "like_dislike('dislikes', 'num" + data[i]["ID"] + "')")
                                        .attr("id", "dislikes")
                                        .attr("class", "likes")
                                        .append($("<img>")
                                            .attr("src", "img/dislike_sprite.png"))
                                        .append($("<span>")
                                            .attr("id", "dislikes_num")
                                            .html(" " + data[i]["dislikes"])
                                        )
                                    )
                                );
                        }
                     },
                     complete: function(data){
                         console.log("in complete");
                     },
                     error: function(data) {
                        console.log("hiffffff : " + data);
                     }
                 });
                 
             </script>
        </table>        
        </div>
        </center>
    </body>
</html>