<?php
    include_once "sessionSecurity.php";
    include_once "./Database/CRUD/UserDb.php";
    include_once "./Database/CRUD/PostDb.php";
    include_once "./Database/CRUD/CategoryDb.php";
    
    if(!checkSession()){
        header("location:index.php");
    }
    if(UserDb::getUserById($_SESSION["user"])->isAdmin == 0){
        header("location:index.php");
    }

    $postId = $_GET["postId"];
    PostDb::deleteById($postId);
    header("location:adminPage.php");
?>