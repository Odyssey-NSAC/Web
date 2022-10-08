<?php
    $servername = "localhost";
    $username = "";
    $password = "";
    $DBname = "";
    
    $conn = new mysqli($servername, $username, $password, $DBname);
    
    if ($conn->connect_error){
        die("Connection Failed:". $conn->connect_error);
    }

    $account_type = $_POST["account"];
    $name = strtoupper($_POST["name"]);
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $age_range = $_POST["age_range"];
    $status = $_POST["status"];
    $highest_edu = $_POST["highest_edu"];
    $country = $_POST["country"];
    $zip_code = $_POST["zip_code"];
    $associated = $_POST["associated"];
    $interest = $_POST["interestd_category"];
    
    if ($account_type === "Author"){
        $duration = $_POST["experience_duration"];
        $sql = "INSERT INTO authors_info
                VALUES ('$email', '$name', '$password', '$age_range', '$status', '$highest_edu', '$country', '$zip_code', '$associated', '$interest', '$duration')";
    }else{
        $sql = "INSERT INTO reviewers_info
                VALUES ('$email', '$name', '$password', '$age_range', '$status', '$highest_edu', '$country', '$zip_code', '$associated', '$interest')";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location:pages-sign-up.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>