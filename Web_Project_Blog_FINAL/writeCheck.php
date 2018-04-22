<?php
    // HIER START DE SERVER-SIDE VALIDATION

    // Include van de writeValidation-file voor Validatie functies te kunnen
    // gebruiken
    include_once 'writeValidation.php';
    
    // Array van alle field de required zijn in de form
    $required = ["postTitle", "category", "text", "autorId"];

    // Valid variabele die zal aangepast worden naar gelang de juistheid
    // van de gegevens die werden ingegeven
    $valid = true;

    // Array van alle mogelijke errors, deze zullen worden ingevult naar 
    // gelang de juistheid van de gegevens
    $errors = [
        "postTitle" => "",
        "category" => "",  
        "text" => "",
        "autorId" => ""
    ];

     // Functie afkomstig van writeValidation.php
    checkRequired($required);
    checkImage("photo");

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

    // Indien de valid variabele false is zal geredirect worden naar write.php
    if(!$valid) {
        include "write.php";
    } 
    // Indien de valid variabele true is, zijn de gegevens die worden ingevuld in de form
    // correct en worden ze geinsert in de database
    // vervolgens wordt geredirect naar index.php
    else {
        include_once "./Database/CRUD/PostDb.php";
        include_once "./Data/Post.php";
        include_once "./Database/CRUD/CategoryDb.php";
        include_once "./Data/Category.php";

        $now = date('Y-m-d H:i:s');
        
        $fileName = $_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"], "./images/Uploads/" . $fileName);

        $post = new Post(0, "images/Uploads/" . $fileName, $values["postTitle"], $values["category"], $now, $values["text"], $values["autorId"]);

        PostDb::insert($post);

        header("location:index.php");
    }
?>