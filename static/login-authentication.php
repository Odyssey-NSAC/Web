<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname = "odyssey";
    
    $conn = new mysqli($servername, $username, $password, $DBname);
    
    if ($conn->connect_error){
        die("Connection Failed:". $conn->connect_error);
    }

    $account_type = $_POST["account"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT*FROM login_info
            WHERE email = '$email'";
    $result = $conn->query($sql);               
        
    if ($result->num_rows > 0){
        $user_info = $result->fetch_assoc();
        if (password_verify($password, $user_info["password"])){
            $_SESSION["name"] = $user_info['name'];
            $_SESSION["email"] = $user_info['email'];
            if(isset($_SESSION["name"])) {
                if ($user_info["account_type"] === "Author"){
                    header("Location:  Author_Dashboard.php");
                }else{
                    header("Location:  Reviewer_Dashboard.php");
                }
            }
        }else{
            echo "Check your details";
        }
    }

    $conn->close();
?>