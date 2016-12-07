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
            <a href="generate_report.php">
                <div class="aButton">Report!</div>
            </a>
        </div>
        
        <center>
          
        <div id="wrapper" class="container-fluid">
            
               <span id="add_item" onclick="add_item_form()"><p>Add item</p></span>
               <div id="hold" style="width:900px;"></div>
               
               <span id="delete_record" onclick="delete_item()"><p>Delete</p></span>
               <div id="delete"></div>
               
               <span id="update_item" onclick="update_form()"><p>Update items</p></span>
               <table id="updatehold" style="width:900px;" class="table table-hover">
               </table>
        </div>
        
        </center>
     </body>
</html>

<script>
    
    var delete_item = function(){
        $("#delete").empty();
        $("#delete")
        .append($("<input>")
                .attr("type", "number")
                .attr("id", "numberToDelete"))
        .append($("<button>")
            .attr("onclick", "delete_the_thing();")
            .html("Delete"));   
    }

    var delete_the_thing = function(k){
        $.ajax({
            type: 'post',
            url: 'delete_items.php',
            data: {"number":$("#numberToDelete").val()},
            success: function(data){
                update_form();
            }
        })
    }

    var add_item_form = function(){
        $("#hold").empty();
        $("#hold").append($("<div>")
            .attr("class", "form-group row")
            .append($("<label>")
                .attr("for", "example-text-input")
                .attr("class", "col-xs-2 col-form-label")
                .html("English"))
            .append($("<div>")
                .attr("class", "col-xs-10")
                .append($("<input>")
                    .attr("class", "form-control")
                    .attr("type", "text")
                    .attr("id", "eng_phrase"))));
        
        $("#hold").append($("<div>")
            .attr("class", "form-group row")
            .append($("<label>")
                .attr("for", "example-text-input")
                .attr("class", "col-xs-2 col-form-label")
                .html("Portuguese"))
            .append($("<div>")
                .attr("class", "col-xs-10")
                .append($("<input>")
                    .attr("class", "form-control")
                    .attr("type", "text")
                    .attr("id", "por_phrase"))));
        
        $("#hold").append($("<button>")
            .html("ADD")
            .attr("onclick", "do_ppp();"));
        //Then you use ajax to update the database
        
    }
    
    var do_ppp = function(){
        $.ajax({
            type: 'post',
            url: 'update_items.php',
            data: {"eng_phrase" : $("#eng_phrase").val(), "por_phrase" : $("#por_phrase").val()},
            success: function(data){
                update_form();
                console.log(data);
            }
        });
        }
    
    var update_form = function(){
        $("#updatehold").empty();
        $.ajax({
                     type: 'post',
                     url: 'populate_page.php',
                     dataType: 'json',
                     success: function(data) {
                        console.log("We in this bitch!");
                        //Try to update likes and dislikes
                        console.log(data);
                        $("#updatehold").append($("<tr>")
                        .append($("<th>")
                                .html("#"))
                            .append($("<th>")
                                .attr("class", "data")
                                .html("English"))
                            .append($("<th>")
                                .attr("class", "data")
                                .html("Portuguese"))
                            .append($("<th>"))
                            .append($("<th>")));
                            
                        for(var i=1; i <= data[0][0]; i++){
                            $("#updatehold").append(
                                $("<tr>")
                                    .attr("id", "num" + data[i]["ID"])
                                    .attr("onclick", "show_update_bar('" + "num" + data[i]["ID"] + "');")
                                    .append($("<td>")
                                        .html(data[i]["ID"]))
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
                 
                 
    }
    var show_update_bar = function(id){
        console.log(id);
                     $("body").append($("<div>")
                        .attr("class", "update_bar")
                            .append($("<input>")
                                .attr("id", "update_eng")
                                .attr("type", "text")
                                .attr("value", "English"))
                            .append($("<input>")
                                .attr("id", "update_port")
                                .attr("type", "text")
                                .attr("value", "Portuguese"))
                            .append($("<button>")
                                .attr("id", "update_button")
                                .html("Update")
                                .attr("onclick", "connect_update('" +  id + "')")));
                 }
                 
                 var connect_update = function(id){
                     console.log("English value " + $("#update_eng").val());
                     $.ajax({
                        type: 'post',
                        url: 'connect_update.php',
                        data: {"id" : id, "eng_phrase" : $("#update_eng").val(), "por_phrase" : $("#update_port").val()},
                        success: function(data) { 
                            update_form();
                        },
                        error: function(data){
                            console.log("You fucked up again");
                        }
                 });
                 }
</script>