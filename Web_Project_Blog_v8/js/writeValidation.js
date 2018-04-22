$(document).ready(function(){
    //als een input focus verliest, valideren we het veld
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
    $('#serverSideValidation').hide();
    //$('#catBtn').hide();
    el.removeClass("error"); // verwijder de klasse error van het veld
    $('#fault').html('<p style="color:red;"></p>');
      
    // nagaan of het veld leeg is
    if(isEmpty(el)) {
      el.addClass("error");
      $('#fault').html('<p style="color:red;">Fill in Required Fields</p>');
    }
  
    // als het veld een type email veld is
    //if(el.attr('type') == "email") {
      // gaan we na of er een geldig emailadres is ingegeven
      //if(!isValidEmail(el)) {
        //el.addClass("error");
      //}
    //}
  
    // als het veld een type password veld is
    //if(el.attr('type') == "password") {
      // gaan we na of het een geldig paswoord is.
      //if(!isValidPass(el)) {
        //el.addClass("error");
      //} else if(el.attr('name') == "herhPassword" && el.val() != $("#password").val()) {
        // als het type passwoord veld het herhPassword veld is dan ga we na of de value van dit veld overeen komt met de value van het andere pasword veld.
        //el.addClass("error");
      //}
    //}
  }

  function isEmpty(el) {
    if(el.val().length == 0) {
      return true;
    }
    return false;
  }