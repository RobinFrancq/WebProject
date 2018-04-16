$(function () {
    $('.argBtn').on("click",function(){
        
        var month =  $(this).attr("id");

        $.ajax({
            type: "POST",
            url: "argResult.php",
            data: {"month": month},
            success: function(html) {
                $('#filterResult').html(html);
            }
        });
    });
});