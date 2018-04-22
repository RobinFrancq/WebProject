<?php
    //All required fields
    $required = ["postTitle", "category", "text", "autorId"];

    $valid = true;

    //All Errors
    $errors = [
        "postTitle" => "",
        "category" => "",  
        "text" => "",
        "autorId" => ""
    ];

    include_once 'writeValidation.php';

    checkRequired($required);
    checkImage("photo");

    foreach($errors as $error) {
        if(!empty($error)) {
          $valid = false;
          break;
        }
    }

    if(!$valid) {
        include "write.php";
    } 
    else {
        //$values["name"];

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