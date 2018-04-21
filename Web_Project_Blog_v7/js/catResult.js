$(function () {
    $('.catBtn').on("click",function(){
        var catId =  $(this).attr("id");
        ajaxCall(catId);
    });
});

function ajaxCall(catId){
    $.ajax({
        type: "POST",
        url: "catResult.php",
        data: {"catId": catId},
        success: function(html) {
            $('#filterResult').html(html);
        }
    });
}