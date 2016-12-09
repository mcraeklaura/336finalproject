
var filter_by_likes = function(){
    
    $.ajax({
        type: 'post',
        url: 'show_top_likes.php',
        dataType: 'json',
        success: function(t){
            console.log("Inside likes success");
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
                                            .attr("id", "button" + t[i]["ID"])
                                            .attr("onclick", "show_comments('" + t[i]["ID"] + "')")
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
            console.log("Inside likes complete");
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