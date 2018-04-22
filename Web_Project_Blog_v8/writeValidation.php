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