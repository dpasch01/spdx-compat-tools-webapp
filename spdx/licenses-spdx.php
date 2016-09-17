<?php
    $licenses=array();
    foreach(glob('./stdlicenses/*') as $filename){
        array_push($licenses,basename($filename));
    }
    echo json_encode($licenses);
?>