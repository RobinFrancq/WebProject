<?php

  function checkSession(){
    session_start();
    if (!isset($_SESSION["user"])){
      return false;
    }
    return true;
  }
?>