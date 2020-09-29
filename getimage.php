<?php

    require 'config.php';

    $User_ID = $_POST['uid'];
    $folderName = $_POST['folderName'];


    $email_chk = mysqli_query($con, "SELECT imgName FROM images WHERE path='$folderName' and UserID='$User_ID' ");
    
    if(mysqli_num_rows($email_chk) >=1){
        
        $dirname = "./".$folderName."/";

        $imageTypes = '{*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG,*.gif,*.GIF}';

        $images = glob($dirname . $imageTypes, GLOB_BRACE);

        $data= array();
        
        $i=0;
        foreach($images as $image) {
            $data[$i] =  $image ; 
            $i++;
        }
        echo json_encode($data);  
    }
    else{
        echo json_encode("");  

    }





?>