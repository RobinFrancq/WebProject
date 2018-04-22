<?php
    //All required fields
    $required = ["name", "lastName", "streetName", "houseNumber", "city", "postalCode", "email", "username", "password"];

    $valid = true;

    //All Errors
    $errors = [
        "name" => "", 
        "lastName" => "",
        "streetName" => "",
        "houseNumber" => "",
        "city" => "",
        "postalCode" => "",
        "email" => "",
        "username" => "",
        "password" => "",    
    ];

    include_once 'registerValidation.php';

    checkRequired($required);

    checkIsNumber("houseNumber");

    checkEmail("email");

    foreach($errors as $error) {
        if(!empty($error)) {
          $valid = false;
          break;
        }
    }

    if(!$valid) {
        include "register.php";
    } 
    else {
        //$values["name"];

        include_once "./Database/CRUD/UserDb.php";
        include_once "./Database/CRUD/AddressDb.php";
        include_once "./Data/User.php";
        include_once "./Data/Address.php";

        $address = new Address(0, $values["postalCode"], $values["city"], $values["streetName"], $values["houseNumber"]);
        AddressDb::insert($address);

        $lastAddress = AddressDb::getLastMadeAddress();

        $user = new User(0, $values["name"], $values["lastName"], $lastAddress->addressID, $values["email"], $values["username"], $values["password"], 0);
        UserDb::insert($user);

        header("location:index.php");
    }
?>