<?php

    $spdxJSON=array("count" => count($_FILES["spdx-files"]['name']));
    $files=array();

    for($i=0; $i<count($_FILES["spdx-files"]['name']); $i++) {
        $file=array();
        
        $content=file_get_contents($_FILES["spdx-files"]["tmp_name"][$i]);
        $content=trim(preg_replace('/\s+/', ' ', $content));
        $content=htmlspecialchars($content);
        
        $filename=substr($_FILES["spdx-files"]["name"][$i],0,strpos($_FILES["spdx-files"]["name"][$i], "."));
        
        $file["filename"]=$filename;
        $file["content"]=$content;
        
        array_push($files,$file);
    }
    
    $spdxJSON["files"]=$files;
    echo json_encode($spdxJSON);
    
?>