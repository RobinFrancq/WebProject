<?php
    if(isset($_COOKIE["loginUserId"])){
        session_start();
        $_SESSION["user"] = $_COOKIE["loginUserId"];
    }
?>