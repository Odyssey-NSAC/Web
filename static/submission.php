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

    $category = $_POST["category"];
    $sub_category = $_POST["sub-category"];
    $activity = $_POST["activity"];
    $topic = $_POST['title'];
    $abstract = $_POST["abstract"];
    $file_type = $_SESSION["file_type"];
    $file_name = $_SESSION["file_name"];
    $age_range = $_POST["age_range"];
    $edu_status = $_POST["edu_status"];
    $self_eval = $_POST["self_eval"];
    $participant_count = $_POST["participant_count"];
    $citation = $_POST["cite"];
    $co_author = $_POST["co-author"];
    $email = $_SESSION["email"];

    $sql = "INSERT INTO article_info(email, category, sub_category, activity, topic, abstract, f_name, f_type, age_range, edu_status, self_eval, participant_count, citation, co_authors )
            VALUES ('$email', '$category', '$sub_category', '$activity', '$topic', '$abstract', '$file_name', '$file_type', '$age_range', '$edu_status', 
                    '$self_eval', '$participant_count', '$citation', '$co_author')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Author_Dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>