var show_comments = function(id){
    $.ajax({
        type: 'post',
        url: 'show_comments.php',
        dataType: 'json',
        data: {"id":id},
        success: function(t){
            console.log(t);
            $("#myModalLabel").empty();
            $("#modal_body").empty();
            $("#footer").empty();
            $("#myModalLabel").html(t[0][0]);
            $("#modal_body").append(
                $("<table>")
                    .attr("class", "table table-hover")
                    .attr("id", "modal_body_table")
                    .append($("<th>")
                        .html("Username")
                    )
                    .append($("<th>")
                        .html("Comment")
                    )
                    .append($("<th>")
                    )
                );
            $("#footer").append($("<button>")
                .attr("type", "button")
                .attr("class", "btn btn-default")
                .attr("onclick", "add_comment(" + id + ")")
                .html("Post")
            )
            .append($("<input>")
                .attr("type", "text")
                .attr("id", "comment_input")
            );
            var goTo = parseInt(t[1][0]) + 2;
            console.log(goTo);
            for(var i = 2; i < goTo; i++){
                $("#modal_body_table")
                        .append($("<tr>")
                            .append($("<td>")
                                .html(t[i]["username"])
                            )
                            .append($("<td>")
                                .html(t[i]["comment"])
                            )
                            .append($("<td>")
                                .attr("onclick", "update_upvotes('" + t[i][0] + "')")
                                
                                .html("<img src=\"js/heart_sprite.png\"/> ")
                                .append($("<span>")
                                    .attr("id", "upvote_id" + t[i][0])
                                    .html(t[i]["upvotes"])
                                )
                            )
                            
                        );
                
            }
        },
        complete: function(t){
        },
        error: function(){
            console.log("error comment");
        }
    })
}