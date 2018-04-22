<?php
    // checkRequired functie gaat nagaan of elke field die meegegeven is binnen de fields array ingevuld is
    // Hij maakt hiervoor gebruik van de required functie
    function checkRequired($fields) {
        foreach($fields as $name) {
            if(required($name)) {
                global $values;
                $values[$name] = $_POST[$name];
            } else {
                global $errors;
                $errors[$name] = "This field is Required";
            }
        }
    }

    // required functie die effectief nagaat of een waarde ingevuld is of niet en stuurt vervolgens
    // true of false terug
    function required($name) {
        if(isset($_POST[$name]) && !empty($_POST[$name])) {
          return true;
        } else {
          return false;
        }
    }

    // checkIsNumber functie die nagaat of het meegegeven field nummeriek is
    function checkIsNumber($field){
        if(is_numeric($_POST[$field])){
            global $values;
            $values[$field] = $_POST[$field];
        }
        else{
            global $errors;
            $errors[$field] = "House Number can only be a number";
        }
    }

    // checkEmail functie die nagaat of de field een valid email adres is
    function checkEmail($field){
        
        // referentie voor "FILTER_VALIDATE_EMAIL":
        // https://www.w3schools.com/php/filter_validate_email.asp
        if (filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            global $values;
            $values[$field] = $_POST[$field];
        } else {
            global $errors;
            $errors[$field] = "This is not a valid Email-address";
        }
    }
?>