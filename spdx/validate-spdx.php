<?php

    $file=array();

    $content=file_get_contents($_FILES["spdx-files"]["tmp_name"][0]);
    $content=trim(preg_replace('/\s+/', ' ', $content));
    $content=htmlspecialchars($content);

    $filename=substr($_FILES["spdx-files"]["name"][0],0,strpos($_FILES["spdx-files"]["name"][0], "."));

    $file["filename"]=$filename;
    $file["content"]=$content;

    echo json_encode($file);

?>
