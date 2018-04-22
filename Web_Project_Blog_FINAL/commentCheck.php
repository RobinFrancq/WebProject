<?php
    // HIER START DE SERVER-SIDE VALIDATION
    
    // Include van de commentValidation-file voor Validatie functies te kunnen
    // gebruiken
    include_once 'commentValidation.php';
    
    // Array van alle field de required zijn in de form
    $required = ["title", "text", "rating", "userId", "postId", "date"];

    // Valid variabele die zal aangepast worden naar gelang de juistheid
    // van de gegevens die werden ingegeven
    $valid = true;

    // Array van alle mogelijke errors, deze zullen worden ingevult naar 
    // gelang de juistheid van de gegevens
    $errors = [
        "title" => "", 
        "text" => "", 
        "rating" => "", 
        "userId" => "", 
        "postId" => "", 
        "date" => "", 
    ];

    // Functie afkomstig van commentValidation.php
    checkRequired($required);
    checkLenght("title");

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

    // Indien de valid variabele false is zal geredirect worden naar commentForm.php
    if(!$valid) {
        include "commentForm.php";
    } 
    // Indien de valid variabele true is, zijn de gegevens die worden ingevuld in de form
    // correct en worden ze geinsert in de database
    // vervolgens wordt geredirect naar index.php
    else {
        include_once "./Database/CRUD/CommentDb.php";
        include_once "./Data/Comment.php"; 

        $comment = new Comment(0, $values["userId"], $values["text"], $values["rating"], $values["postId"], $values["date"], $values["title"]);

        CommentDb::insert($comment);
        header("location:index.php");
    }
?>