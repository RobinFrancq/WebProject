<?php
    // HIER START DE SERVER-SIDE VALIDATION
    
    // Include van de commentValidation-file voor Validatie functies te kunnen
    // gebruiken
    include_once 'categoryValidation.php';
    
    // Array van alle field de required zijn in de form
    $required = ["name"];

    // Valid variabele die zal aangepast worden naar gelang de juistheid
    // van de gegevens die werden ingegeven
    $valid = true;

    // Array van alle mogelijke errors, deze zullen worden ingevult naar 
    // gelang de juistheid van de gegevens
    $errors = [
        "name" => ""
    ];

    // Functie afkomstig van commentValidation.php
    checkRequired($required);
    checkAvalable("name");
    checkLenght("name");

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

    // Indien de valid variabele false is zal geredirect worden naar adminPage.php
    if(!$valid) {
        include "adminPage.php";
    } 
    // Indien de valid variabele true is, zijn de gegevens die worden ingevuld in de form
    // correct en worden ze geinsert in de database
    // vervolgens wordt geredirect naar adminPage.php
    else {
        include_once "./Database/CRUD/CategoryDb.php";
        include_once "./Data/Category.php";

        $category = new Category(0, $values["name"]);
        CategoryDb::insert($category);

        header("location:adminPage.php");
    }
?>