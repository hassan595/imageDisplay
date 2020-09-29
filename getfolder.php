<?php

        $dirs = array_filter(glob('*'), 'is_dir');
        
        $i = 0;
        $data= array();

        foreach ($dirs as $value)
        {
            $data[$i] =  $value ;              
            $i++;
        }
        echo json_encode($data);  
?>