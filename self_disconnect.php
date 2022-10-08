<?php
    $servername = "localhost";
    $username = "";
    $password = "";
    $DBname = "";
    
    $conn = new mysqli($servername, $username, $password, $DBname);
    
    if ($conn->connect_error){
        die("Connection Failed:". $conn->connect_error);
    }

    $count = $_POST['question_count'];
    $article_id = $_POST['article_id'];
    $total_mark = 0;
    for ($x = 1; $x <= $count; $x++){
        $total_mark += $_POST['mark'.$x];
    }
    $total_mark = ($total_mark/$count);

    $sql = "UPDATE article_info
            SET self_eval_mark='$total_mark'
            WHERE article_id = '$article_id'";
    
    if ($conn->query($sql) === TRUE){
        echo '<script>alert("Your self evaluation submitted succesfully:) Thank you !!");
                        window.location.href="Author_Dashboard.php";</script>';
        exit;
    }else{
        echo '<script>alert("Something went wrong :( Please resubmit your feedback");
                        window.location.href="self_eval.php";</script>';
        
    }
?>