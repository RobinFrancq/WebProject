<?php
    //All required fields
    $required = ["title", "text", "rating", "userId", "postId", "date"];

    $valid = true;

    //All Errors
    $errors = [
        "title" => "", 
        "text" => "", 
        "rating" => "", 
        "userId" => "", 
        "postId" => "", 
        "date" => "", 
    ];

    include_once 'commentValidation.php';

    checkRequired($required);

    foreach($errors as $error) {
        if(!empty($error)) {
          $valid = false;
          break;
        }
    }

    if(!$valid) {
        include "commentForm.php";
    } 
    else {
        //$values["name"];

        //include_once "./Database/CRUD/UserDb.php";
        //include_once "./Database/CRUD/AddressDb.php";
        //include_once "./Data/User.php";
        //include_once "./Data/Address.php";

        //$address = new Address(0, $values["postalCode"], $values["city"], $values["streetName"], $values["houseNumber"]);
        //AddressDb::insert($address);

        //$user = new User(0, $values["name"], $values["lastName"], 1, $values["email"], $values["username"], $values["password"], 0);
        //UserDb::insert($user);

        header("location:index.php");
    }
?>