// DIT SCRIPT ZAL NAGAAN OF ER OP EEN POPULAR_POSTS KNOP WERD GEDRUKT EN ZAL BIJGEVOLG EEN AJAX FUCTIE STARTEN
// OM DE JUISTE POSTS IN TE LADEN

// Hier wordt nagegaan of het document ingeladen is
$(function () {
    
    // Indien op de popPostBtn wordt gedrukt wordt een anonieme functie gestart
    $('.popPostBtn').on("click",function(){
        
        // De postId van de knop waar werd op gedrukt wordt opgehaald
        var postId =  $(this).attr("id");

        // Start van de ajax-functie waarbij de postId wordt meegegeven aan de popPostResult.php
        // Deze PHP-file zal de juiste posts inladen en echoën 
        $.ajax({
            type: "POST",
            url: "popPostResult.php",
            data: {"postId": postId},
            success: function(html) {
                // Hier worden de posts (die werden geëchood door popPostResult.php) toegevoegd aan de pagina, 
                // door ze te plaatsten in een div-tag met id filterResult
                $('#filterResult').html(html);
            }
        });
    });
});