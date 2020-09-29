<?php

    $dirs = array_filter(glob('*'), 'is_dir');
    $i = 1;

    foreach ($dirs as $value)
    {
        $i++;
    }



    $cur = getcwd();
    if(mkdir ($cur."/folder".$i, 0777)){
       // echo "successfully";    
        $dirs = array_filter(glob('*'), 'is_dir');

        foreach ($dirs as $value)
        {
            $value ;              
        }
        echo json_encode($value);  
    }
    else{
        echo "failed  to create folders";
    }


    



?>