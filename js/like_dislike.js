function like_dislike(clicked_id, trans_id)
{
    $.ajax({
        type: 'post',
        url: 'like_dislike.php',
        data: {type: clicked_id, translation: trans_id},
        success: function(data) {
            //Try to update likes and dislikes
            console.log("hii : " + data);
            var temp;
            if(clicked_id == "likes"){
                temp = "likes";
            }else{
                temp = "dislikes";
            }
            console.log(trans_id + " " + clicked_id);
            $("#" + trans_id + " " + "#" + clicked_id + " #" + temp + "_num").html(data);
            
        },
        error: function(data) {
            console.log("hi : " + data);
        }
    });
}