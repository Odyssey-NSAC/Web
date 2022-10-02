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
    
    if (isset($_POST['email'])){
        $user_email = $_POST['email'];
    }

    $sql = "SELECT*FROM login_info
            WHERE email = '$user_email'";      

    if(isset($_POST['submit'])){
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $user_info = $result->fetch_assoc();
            if($user_email==$user_info['email']){
                $to = $user_email;
                $password = $user_info['password']; 
                $subject = "Password";
                $txt = "Your password is : $password.";
                header("Location:pages-sign-in.html");
                /*$headers = "From: password@studentstutorial.com" . "\r\n" .
                "CC: somebodyelse@example.com";
                mail($to,$subject,$txt,$headers);*/

                }else{
                    echo 'invalid userid';
                }
        }
    }
    $conn->close();
?>