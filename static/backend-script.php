<?php
session_start();
upload_file();

function upload_file(){
   $uploadTo = "upload/"; 
   $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
   $fileName = $_FILES['file']['name'];
   $tempPath=$_FILES["file"]["tmp_name"];
   
   $basename = basename($fileName);
   $originalPath = $uploadTo.$basename; 
   $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
   if(!empty($fileName)){ 
    
      if(in_array($fileType, $allowFileType)){ 
         if(move_uploaded_file($tempPath,$originalPath)){ 
            $_SESSION["file_type"] = $fileType;
            $_SESSION["file_name"] = $fileName;
         }else{ 
            echo 'File Not uploaded ! try again';
         } 
      }else{
         echo $fileType." file type not allowed";
      }
   }else{  
     echo "Please Select a file";
   }       
}

?>