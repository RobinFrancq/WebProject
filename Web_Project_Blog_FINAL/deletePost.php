<?php
    // In deze file wordt een post uit de database verwijdert

    include_once "sessionSecurity.php";
    include_once "./Database/CRUD/UserDb.php";
    include_once "./Database/CRUD/PostDb.php";
    include_once "./Database/CRUD/CategoryDb.php";
    include_once "./Database/CRUD/CommentDb.php";
    
    // Hier gebreurt nog eens een laatste check om na te gaan of de gebruiker een 
    // admin is
    if(!checkSession()){
        header("location:index.php");
    }
    if(UserDb::getUserById($_SESSION["user"])->isAdmin == 0){
        header("location:index.php");
    }

    $postId = $_GET["postId"];

    CommentDb::deleteByPostId($postId);
    
    PostDb::deleteById($postId);
    
    header("location:adminPage.php");
?>