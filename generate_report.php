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
                    Welcome ADMIN
                </p>
            </div>
            
            
        </div>
        
        <center>
            
            <div id="wrapper">
                <p>Most likes</p>
                <div id="likes_table"></div>
                
                <p>Total Dislikes</p>
                <div id="dislikes_table"></div>
            </div>
            
        </center>
        
        </body>
        
        <script>
        $.ajax({
                     type: 'post',
                     url: 'filter_by_likes.php',
                     dataType: 'json',
                     success: function(data) {
                         console.log(JSON.stringify(data));
                        $("#likes_table").html(data[0]);
                     },
                     complete: function(data){
                         console.log("in complete");
                     },
                     error: function(data) {
                        console.log("hiffffff : " + data);
                     }
        });
        
        $.ajax({
                     type: 'post',
                     url: 'filter_by_dislikes.php',
                     dataType: 'json',
                     success: function(data) {
                         console.log(JSON.stringify(data));
                        $("#dislikes_table").html(data[0]);
                     },
                     complete: function(data){
                         console.log("in complete");
                     },
                     error: function(data) {
                        console.log("hiffffff : " + data);
                     }
        });
        </script>
        
        </html>