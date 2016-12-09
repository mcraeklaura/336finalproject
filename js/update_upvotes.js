var update_upvotes = function(id){
    $.ajax({
        type: 'post',
        url: 'update_upvotes.php',
        dataType: 'json',
        data: {"id":id},
        success: function(t){
            console.log(t);
            $("#upvote_id" + id).html(t[0]);
        }
    })
}