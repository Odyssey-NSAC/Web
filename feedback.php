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

    $email = $_SESSION['email'];
    $article_id = $_POST['article_id'];
    $count = $_POST['question_count'];
    $total_mark = 0;
    for ($x = 1; $x <= $count; $x++) {
        $total_mark += $_POST['mark'.$x];
    }
    $total_mark = ($total_mark/($count*10))*25;
    $response = array( 
        'status' => 0, 
        'message' => 'Feedback submission failed :('
    ); 
    $sql = "INSERT INTO global_mark(article_id,email,mark)
            VALUES('$article_id','$email','$total_mark')";
    $result = $conn->query($sql);
    
    $global_avg_query = "SELECT AVG(mark) AS avg
                          FROM global_mark
                          WHERE article_id = '$article_id'";
    $global_avg_result = $conn->query($global_avg_query);
    
    $self_mark_query = " SELECT self_eval_mark
                         FROM article_info
                         WHERE article_id = '$article_id'";
    $self_mark_result = $conn->query($self_mark_query);
    
    $global_avg = (($global_avg_result)->fetch_assoc())['avg'];
    $self_mark =(( $self_mark_result)->fetch_assoc())['self_eval_mark'];
    
    $total_article_mark = $global_avg + $self_mark;
    
    $insert_mark = "UPDATE article_info
                    SET marks_obtained = '$total_article_mark'
                    WHERE article_id = '$article_id'";
    
    $conn->query($insert_mark);
    
    if ($result === TRUE){
        $response['status'] = 1;
        $response['message'] = "Your freedback sumbitted successfully:) Thank You!! ";
    }
    
    $conn->close();
    echo json_encode($response);
?>