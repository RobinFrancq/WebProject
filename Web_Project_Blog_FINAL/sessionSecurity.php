<?php
  
  // functie die nagaat of de session geset is 
  function checkSession(){
    session_start();
    if (!isset($_SESSION["user"])){
      return false;
    }
    return true;
  }
?>