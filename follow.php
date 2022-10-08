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

    $response = array( 
        'status' => 0, 
        'message' => 'Feedback submission failed :('
    ); 
    $reviewer_email = $_SESSION['email'];
    $author_email = $_SESSION['author_email'];
    $follow_query = "INSERT INTO follow
                     VALUES('$reviewer_email','$author_email')";
    
    $result = $conn->query($follow_query);
    if ($result === TRUE){
        $response['status'] = 1;
        $response['message'] = "Your freedback sumbitted successfully:) Thank You!! ";
    }
    $conn->close();
    echo json_encode($response);
?>