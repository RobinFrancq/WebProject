<?php
    // HIER START DE VERIFICATIE VAN DE GEGEVENS
    
    include_once "./Database/CRUD/UserDb.php";

    //Hier wordt nagegaan ofdat de request method effectief POST was
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Username en password worden nagekeken door gebruik te maken van de 
        // checkUserDetails methode van de UserDb klasse
        if ($userId = UserDb::checkUserDetails($_POST["username"], $_POST["password"])) {
            
            //Hier wordt de session aangemaakt en geredirect naar de homepage
            session_start();
            $_SESSION["user"] = $userId;

            if(isset($_POST["stayLoggedIn"])){
                setcookie("loginUserId", $userId, time() + (86400 * 1095), "/");
            }
            header("location:index.php");
        }
        else{
            header("Location:login.php");
        }
    } 
    
    // Indien de request method geen POST was wordt er geredirect naar de login page
    else {
        header("Location:login.php");
    }
?>