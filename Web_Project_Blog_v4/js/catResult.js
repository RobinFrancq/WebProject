$(function () {
    $('.catBtn').on("click",function(){
        
        var catId =  $(this).attr("id");

        $.ajax({
            type: "POST",
            url: "catResult.php",
            data: {"catId": catId},
            success: function(html) {
                $('#filterResult').html(html);
            }
        });
    });
});