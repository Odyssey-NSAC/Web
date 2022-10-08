<?php
    session_start();
    $servername = "localhost";
    $username = "";
    $password = "";
    $DBname = "";
    
    $conn = new mysqli($servername, $username, $password, $DBname);
    
    if ($conn->connect_error){
        die("Connection Failed:". $conn->connect_error);
    }

    $account_type = $_POST["account"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if ($account_type === "Author"){
        $sql = "SELECT*FROM authors_info
                WHERE email = '$email'";
    }else{
        $sql = "SELECT*FROM reviewers_info
                WHERE email = '$email'";
    }
    
    $result = $conn->query($sql);               
        
    if ($result->num_rows > 0){
        $user_info = $result->fetch_assoc();
        if (password_verify($password, $user_info["password"])){
            $_SESSION["name"] = $user_info['name'];
            $_SESSION["account_type"] = $account_type;
            $_SESSION["email"] = $email;
            if(isset($_SESSION['Array'])){
                $article_view_status = $_SESSION['Array'][0];
            }else{
                $article_view_status = FALSE;
            }
            if(isset($_SESSION["email"])) {
                if ($article_view_status){
                    header("Location:Articles.php");
                }else{
                    if ($account_type === "Author"){
                        header("Location:Author_Dashboard.php");
                    }else{
                        header("Location:Reviewer_Dashboard.php");
                    }
                }
            }else{
                "<script>
                    alert('Please Log In First');
                    document.location='pages-sign-up.html'
                 </script>";
            }
        }else{
            echo"<script>
                    alert('Password mismatch');
                    document.location='pages-sign-up.html'
                 </script>";
        }
    }else{
        echo"<script>
                alert('Please select correct account type or check your login details');
                document.location='pages-sign-up.html'
            </script>";
    }

    $conn->close();
?>