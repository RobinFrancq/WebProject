<?php
    include_once "./Database/CRUD/UserDb.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (UserDb::checkUserDetails($_POST["username"], $_POST["password"])) {
            //Aanmaak van de session
            session_start();
            $_SESSION["user"] = $_POST["username"];
            header("location:index.php");
        }
        else{
            header("Location:login.php");
        }
    } else {
        header("Location:login.php");
    }
?>