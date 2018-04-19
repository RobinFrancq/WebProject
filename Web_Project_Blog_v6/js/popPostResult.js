$(function () {
    $('.popPostBtn').on("click",function(){
        
        var postId =  $(this).attr("id");

        $.ajax({
            type: "POST",
            url: "popPostResult.php",
            data: {"postId": postId},
            success: function(html) {
                $('#filterResult').html(html);
            }
        });
    });
});