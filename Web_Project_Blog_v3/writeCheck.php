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

        $categoryId = CategoryDb::getCategoryByName($values["category"])->categoryID;

        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        
        $file = $_FILES["photo"]["tmp_name"];
        
        $image = addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
        $imageName = addslashes($_FILES["photo"]["name"]);
        //$imageSize = getimagesize($_FILES["photo"]["tmp_name"]);

        $post = new Post(0, $image, $values["title"], $categoryId, $now, $values["text"], $values["autorId"]);
        //var_dump($post);
        
        
        //$post = new Post(0, $values["photo"], $values["title"], $categoryId, $now, $values["text"], $values["autorId"]);
        
        //echo PostDb::insert($post);

        header("location:index.php");
    }
?>