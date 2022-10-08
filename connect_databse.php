<?php
    $servername = "localhost";
    $username = "";
    $password = "";
    $DBname = "";
    
    $conn = new mysqli($servername, $username, $password, $DBname);
    
    if ($conn->connect_error){
        die("Connection Failed:". $conn->connect_error);
    }
?>