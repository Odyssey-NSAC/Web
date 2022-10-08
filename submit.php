<?php 
    session_start();
    // File upload folder 
    $uploadDir = 'uploads/'; 
    
    // Allowed file types 
    $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
    
    // Default response 
    $response = array( 
        'status' => 0, 
        'message' => 'Form submission failed, please try again.' 
    ); 
    if (isset($_SESSION['name']) && isset($_SESSION['email'])){
         $name = $_SESSION["name"];
         $email = $_SESSION['email'];
    }
    
    $category = $_POST['category']; 
    $sub_category = $_POST['sub_category']; 
    $activity = $_POST['activity']; 
    $title = $_POST['title']; 
    $abstract = $_POST['abstract']; 
    $description = $_POST['description']; 
    $age_range = $_POST['age_range']; 
    $edu_status = $_POST['edu_status']; 
    $count = $_POST['participant_count']; 
    $cite = $_POST['cite'];
    $co_author = $_POST['co_author']; 
    $article_id = "!@u-".substr($name,0,5)."_".substr($title,0,6).rand(1000000,9999999);
    
    $_SESSION['article_id'] = $article_id; 
    $_SESSION['activity'] = $activity;  
    $uploadStatus = 1; 
        
    // Upload file 
    $uploadedFile = ''; 
    if(!empty($_FILES["file"]["name"])){ 
        // File path config 
        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $uploadDir . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
        
        // Allow certain file formats to upload 
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to the server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                $uploadedFile = $fileName; 
            }else{ 
                $uploadStatus = 0; 
                $response['message'] = 'Sorry, there was an error uploading your file.'; 
            } 
        }else{ 
            $uploadStatus = 0; 
            $response['message'] = 'Sorry, only '.implode('/', $allowTypes).' files are allowed to upload.'; 
        } 
    } 
    
    if($uploadStatus == 1){ 
        $dbHost = "localhost";
        $dbUsername = "id19658361_admin";
        $dbPassword = "7ZO04%6*ArhctiH5";
        $dbName = "id19658361_odyssey";
        
        // Create database connection 
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
        
        // Check connection 
        if ($db->connect_error) { 
            die("Connection failed: " . $db->connect_error); 
        }
        
        // Insert form data in the database 
        $sqlQ = "INSERT INTO article_info (article_id,email,category,sub_category,activity,title,abstract,description,age_range,edu_status,participant_count,cite,co_authors,f_type,f_name,submitted_on) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())"; 
        $stmt = $db->prepare($sqlQ); 
        $stmt->bind_param("ssssssssssissss",$article_id,$email,$category,$sub_category,$activity,$title,$abstract,$description,$age_range,$edu_status,$count,$cite,$co_authors,$fileType, $uploadedFile); 
        $insert = $stmt->execute(); 
        
        if($insert){ 
            $response['status'] = 1; 
            $response['message'] = 'Form data submitted successfully!'; 
        } 
    }
    
    // Return response 
    echo json_encode($response);
    
    ?>
    