$(document).ready(function(){
    // Als een input focus verliest, wordt het veld gevalideerd
    $("input, textarea").on("blur", function(){
        validateForm($(this));
    });
    
    $('form').on('submit', function(e){
        // OPMERKING: prevent default wordt hier niet toegepast, anders zal de server-side 
        // validation niet doorgaan
        
        // we gaan elke input nog eens valideren
        // we doen dit, omdat het kan zijn dat er geen blur event heeft plaatsgevonden
        $('input:not(:submit)').each(function(){
            validateForm($(this));
        });
    });
});

function validateForm(el) {
    // Indien er een text afkomstig van de server validation nog in de form staat, 
    // wordt deze verwijdert indien het field wordt gevalideert
    $('#serverSideValidation').hide();
    // Verwijder de klasse error van het veld
    el.removeClass("error");
    // De client side fault waarin de foutboodschap wordt ook leeggemaakt
    $('#fault').html('<p style="color:red;"></p>');
      
    // Nagaan of het veld leeg is
    if(isEmpty(el)) {
      el.addClass("error");
      // Er wordt een foutboodschap vermeld onderaan de form
      $('#fault').html('<p style="color:red;">Fill in Required Fields</p>');
    }
  }

  // De Empty-functie die nagaan of een field leeg is of niet
  function isEmpty(el) {
    if(el.val().length == 0) {
      return true;
    }
    return false;
  }