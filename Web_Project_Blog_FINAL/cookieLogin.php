<?php
    // Deze file zal eerst overlopen bij het openen van de website
    // om na te gaan of de cookie voor het ingelogd blijven 
    // was ingevuld, indien dit zo is zal de user worden ingelogd
    if(isset($_COOKIE["loginUserId"])){
        session_start();
        $_SESSION["user"] = $_COOKIE["loginUserId"];
    }
?>