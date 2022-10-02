<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBname = "odyssey";
    
    $conn = new mysqli($servername, $username, $password, $DBname);
    
    if ($conn->connect_error){
        die("Connection Failed:". $conn->connect_error);
    }

    $account_type = $_POST["account"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $con_password = $_POST["verify_password"];
    $dob = $_POST["dob"];
    $status = $_POST["status"];
    $highest_edu = $_POST["highest_edu"];
    $country = $_POST["country"];
    $zip_code = $_POST["zip-code"];
    $associated = $_POST["associated"];
    $interest = $_POST["interestd_category"];
    $duration = $_POST["experience_duration"];

    $sql = "INSERT INTO login_info
            VALUES ('$email', '$account_type', '$name', '$password', '$dob', '$status', '$highest_edu', '$country', '$zip_code', '$associated', '$interest', '$duration')";

    if ($conn->query($sql) === TRUE) {
        header("Location:pages-sign-up.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>