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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <script src="js/filter_by_likes.js"></script>
        <script src="js/like_dislike.js"></script>
        <script src="js/show_comments.js"></script>
        <script src="js/update_upvotes.js"></script>
        <script src="js/add_comment.js"></script>

        <script type="text/javascript">
            $(document).on("click", "#YourID", function() {
                alert("Test");
            });
        </script>
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
            <p>Search term</p>
            <input type="text" id="term"/>
            <button id="searchButton" onclick="filter_page()">>></button>
            <br><br>
            <button id="like_filter" onclick="filter_by_likes()">Filter by <img src="img/heart_sprite.png">s</button>
            <br><br><br><br>
            <table class="table table-hover" id="translation" style="width: 1000px">
             <tr>
                 <th class="data">English</th>
                 <th class="data">Portuguese</th>
                 <th class="likes"></th>
                 <th class="likes"></th>
             </tr>
             </table>
             <table class="table table-hover" id="translations" style="width: 1000px">
                 
             </table>
             <script>
                 //Populate the table with all the data from the database
                 var checkitbish =1;
                 var filter_page = function(){
                     
                     $.ajax({
                        type: 'post',
                        url: 'populate_page_filter.php',
                        dataType: 'json',
                        data: {"search_term" : $("#term").val()},
                        success: function(t){
                            console.log("In filter_page success");
                            console.log(t);
                            $("#translations").empty();
                            for(var i=1; i <= t[0][0]; i++){
                            $("#translations").append(
                                $("<tr>")
                                    .attr("id", "num" + t[i]["ID"])
                                    .append($("<td>")
                                        .attr("class", "data")
                                        .html(t[i]["phrase_ENG"]))
                                    .append($("<td>")
                                        .attr("class", "data")
                                        .html(t[i]["phrase_PORT"]))
                                    .append($("<td>")
                                        .attr("onclick", "like_dislike('likes', 'num" + t[i]["ID"] + "')")
                                        .attr("id", "likes")
                                        .attr("class", "likes")
                                        .append($("<img>")
                                            .attr("src", "img/heart_sprite.png"))
                                        .append($("<span>")
                                            .attr("id", "likes_num")
                                            .html(" " + t[i]["likes"])))
                                    .append($("<td>")
                                        .attr("onclick", "like_dislike('dislikes', 'num" + t[i]["ID"] + "')")
                                        .attr("id", "dislikes")
                                        .attr("class", "likes")
                                        .append($("<img>")
                                            .attr("src", "img/dislike_sprite.png"))
                                        .append($("<span>")
                                            .attr("id", "dislikes_num")
                                            .html(" " + t[i]["dislikes"])
                                        )
                                    )
                                    .append($("<td>")
                                        .attr("id", "comment_button")
                                        .attr("class", "likes")
                                        .append($("<button>")
                                            .attr("onclick", "show_comments('" + t[i]["ID"] + "')")
                                            .attr("id", "button" + t[i]["ID"])
                                            .attr("type", "button")
                                            .attr("data-toggle", "modal")
                                            .attr("data-target", "#myModal")
                                            .html($("<img>")
                                                .attr("src", "img/comment.png")
                                            )
                                        )
                                    )
                                );
                        }
                        },
                        complete: function(data){
                            console.log("Inside filter_page complete");
                        },
                        error: function(jqXHR, exception) {
                            var msg = '';
                            if (jqXHR.status === 0) {
                 msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        console.log(msg);
                        }
                     });
                   checkitbish = 0; 
                 }
                 
                 if(checkitbish){
                 var ajaxSent = $.ajax({
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
                                    .append($("<td>")
                                        .attr("id", "comment_button")
                                        .attr("class", "likes")
                                        .append($("<button>")
                                            .attr("onclick", "show_comments('" + data[i]["ID"] + "')")
                                            .attr("id", "button" + data[i]["ID"])
                                            .attr("type", "button")
                                            .attr("data-toggle", "modal")
                                            .attr("data-target", "#myModal")
                                            .html($("<img>")
                                                .attr("src", "img/comment.png")
                                            )
                                        )
                                    )
                                );
                        }
                     },
                     complete: function(data){
                         console.log("in complete");
                     },
                     error: function(jqXHR, exception) {
                        
                            var msg = '';
                            if (jqXHR.status === 0) {
                 msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        console.log(msg);
                     }
                 });
                 }
             </script>
        </table>        
        </div>
        </center>
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body" id="modal_body">
                        ...
                    </div>
                    <div class="modal-footer" id="footer">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>