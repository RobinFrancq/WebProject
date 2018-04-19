$(function () {
    $.ajax({
        type: "POST",
        url: "readHandeler.php",
        success: function(html) {
            console.log(html);
        }
    });
});
  