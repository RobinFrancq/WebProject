// DIT SCRIPT ZAL NAGAAN OF ER OP EEN ARGIEF KNOP WERD GEDRUKT EN ZAL BIJGEVOLG EEN AJAX FUCTIE STARTEN
// OM DE JUISTE POSTS IN TE LADEN

// Hier wordt nagegaan of het document ingeladen is
$(function () {
    // Indien op de argBtn wordt gedrukt wordt een anonieme functie gestart
    $('.argBtn').on("click",function(){
        
        // De maand van de knop waar werd op gedrukt wordt opgehaald 
        var month =  $(this).attr("id");

        // Start van de ajax-functie waarbij de month wordt meegegeven aan de argResult.php
        // Deze PHP-file zal de juiste posts inladen en echoën 
        $.ajax({
            type: "POST",
            url: "argResult.php",
            data: {"month": month},
            success: function(html) {
                // Hier worden de posts (die werden geëchood door argResult.php) toegevoegd aan de pagina, 
                // door ze te plaatsten in een div-tag met id filterResult
                $('#filterResult').html(html);
            }
        });
    });
});