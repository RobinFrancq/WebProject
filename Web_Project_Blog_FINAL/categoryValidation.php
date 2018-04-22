<?php
    include_once "./Database/CRUD/CategoryDb.php";
    
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

    // checkAvalable functie die nagaat of de meegegeven naam al niet bestaat in
    // de database
    function checkAvalable($name){
        if(CategoryDb::checkIfNameExists($_POST[$name])){
            global $errors;
            $errors[$name] = "Name Allready Exists";
        }
        else{
            return true;
        }
    }

    // checkLenght functie die de lengte van de naam gaan afgaan
    function checkLenght($name){
        if (strlen($_POST[$name]) > 50){
            global $errors;
            $errors[$name] = "Maximum 50 characters";
        }
    }
?>