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

    // checkIsNumber functie die nagaat of het meegegeven bestand een afbeelding is (png of jpg)
    function checkImage($name){
        if ($_FILES["photo"]["type"] == "image/jpeg" || $_FILES["photo"]["type"] == "image/png"){
            return true;
        }
        else{
            global $errors;
            $errors[$name] = "The image is required and can only be jpeg or png";
        }
    }
?>