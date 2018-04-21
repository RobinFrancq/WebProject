<?php
    //All required fields
    $required = ["name"];

    $valid = true;

    //All Errors
    $errors = [
        "name" => ""
    ];

    include_once 'categoryValidation.php';

    checkRequired($required);
    checkAvalable("name");

    foreach($errors as $error) {
        if(!empty($error)) {
          $valid = false;
          break;
        }
    }

    if(!$valid) {
        include "adminPage.php";
    } 
    else {
        include_once "./Database/CRUD/CategoryDb.php";
        include_once "./Data/Category.php";

        $category = new Category(0, $values["name"]);
        CategoryDb::insert($category);

        header("location:adminPage.php");
    }
?>