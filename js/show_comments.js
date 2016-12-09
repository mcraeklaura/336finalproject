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
                        .html("Upvotes")
                    )
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
                                .append($("<img>")
                                    .attr("src", "img/Upvote.png")
                                )
                                .html(t[i]["upvotes"])
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