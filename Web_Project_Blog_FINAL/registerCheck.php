<?php
    // HIER START DE SERVER-SIDE VALIDATION
    
    // Include van de registerValidation-file voor Validatie functies te kunnen
    // gebruiken
    include_once 'registerValidation.php';
    
    // Array van alle field de required zijn in de form
    $required = ["name", "lastName", "streetName", "houseNumber", "city", "postalCode", "email", "username", "password"];

    // Valid variabele die zal aangepast worden naar gelang de juistheid
    // van de gegevens die werden ingegeven
    $valid = true;

    // Array van alle mogelijke errors, deze zullen worden ingevult naar 
    // gelang de juistheid van de gegevens
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

    // Functie afkomstig van commentValidation.php
    checkRequired($required);
    checkIsNumber("houseNumber");
    checkEmail("email");

    // Voor elke error in de errors array wordt nagegaan of deze ingevuld zijn
    // of niet, indien 1 of meer errors zijn ingevult zal de valid variabele 
    // false zijn. Indien geen enkele error is ingevult zal de valid variabele
    // true geven
    foreach($errors as $error) {
        if(!empty($error)) {
          $valid = false;
          break;
        }
    }

    // Indien de valid variabele false is zal geredirect worden naar register.php
    if(!$valid) {
        include "register.php";
    } 
    // Indien de valid variabele true is, zijn de gegevens die worden ingevuld in de form
    // correct en worden ze geinsert in de database
    // vervolgens wordt geredirect naar index.php
    else {
        include_once "./Database/CRUD/UserDb.php";
        include_once "./Database/CRUD/AddressDb.php";
        include_once "./Data/User.php";
        include_once "./Data/Address.php";

        $address = new Address(0, $values["postalCode"], $values["city"], $values["streetName"], $values["houseNumber"]);
        AddressDb::insert($address);


        // Het adres dat net werd toegevoegd aan de database wordt terug opgehaald om de adresID 
        // te gebruiken voor de user toe te voegen
        $lastAddress = AddressDb::getLastMadeAddress();

        $user = new User(0, $values["name"], $values["lastName"], $lastAddress->addressID, $values["email"], $values["username"], $values["password"], 0);
        UserDb::insert($user);

        header("location:index.php");
    }
?>