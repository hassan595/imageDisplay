<?php
    require 'config.php';


   $del_img =$_POST['iname']  ;

   $str_img = explode("/",$del_img);

   $str_img = $str_img[count($str_img)- 1];

   $sql = "DELETE FROM images WHERE imgName ='$str_img' ";
    $result  = mysqli_query($con, $sql);
    if($result){
        unlink($del_img);
        echo "deleted Image";
    }
    else{
        echo "Cannot delete Image";
    }

?>
