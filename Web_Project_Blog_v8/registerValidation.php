<?php
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

    function required($name) {
        if(isset($_POST[$name]) && !empty($_POST[$name])) {
          return true;
        } else {
          return false;
        }
    }

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

    function checkEmail($field){
        //https://www.w3schools.com/php/filter_validate_email.asp
        if (filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            global $values;
            $values[$field] = $_POST[$field];
        } else {
            global $errors;
            $errors[$field] = "This is not a valid Email-address";
        }
    }
?>