// DIT SCRIPT ZAL NAGAAN OF ER OP EEN CATEGORIE KNOP WERD GEDRUKT EN ZAL BIJGEVOLG EEN AJAX FUCTIE STARTEN
// OM DE JUISTE POSTS IN TE LADEN

// Hier wordt nagegaan of het document ingeladen is
$(function () {
    // Indien op de catBtn wordt gedrukt wordt een anonieme functie gestart
    $('.catBtn').on("click",function(){
        
        var catId =  $(this).attr("id");

        // Start van de ajax-functie waarbij de catId wordt meegegeven aan de catResult.php
        // Deze PHP-file zal de juiste posts inladen en echoën 
        $.ajax({
            type: "POST",
            url: "catResult.php",
            data: {"catId": catId},
            success: function(html) {
                // Hier worden de posts (die werden geëchood door catResult.php) toegevoegd aan de pagina, 
                // door ze te plaatsten in een div-tag met id filterResult
                $('#filterResult').html(html);
            }
        });
    });
});