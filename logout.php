<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    session_destroy();
    header("Location:pages-sign-in.html");
    session_unset();
    session_destroy(); 
?>
