<?php
    //Check if the file exist
    if(!empty($_GET['file'])){
        //Define valuables
        $FileName  = basename($_GET['file']);
        $FilePath  = "../uploads/".$FileName;
        //Get if the file is stored
        if(!empty($FileName) && file_exists($FilePath)){
            //define header
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$FileName");
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: binary");

            //read file
            readfile($FilePath);
            exit;
        }
        //User message
        else{
            echo "file not exit";
        }
    }
    header('location:index.php?tablename='.$_GET['tablename']);
?>