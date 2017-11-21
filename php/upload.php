<?php
    require_once('../getid3/getid3.php');
    require("db.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo file_get_contents("../html/upload.html");
    } else {
        $getID3 = new getID3;
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["mp3"]["name"]); //TODO sanitize this
        $imageFileType = $_FILES["mp3"]["type"]; //TODO check type server-side
        
        if($imageFileType != "audio/mp3" && $imageFileType != "audio/mp3"){
            echo "Error: file is not an mp3.\n";
            echo "Extension is " . $imageFileType;
            exit();
        }
        
        if (!move_uploaded_file($_FILES["mp3"]["tmp_name"], $target_file)) { //TODO store file in database instead of on server
            echo "Error saving file.";
            exit();
        }
        $tags = $getID3->analyze($target_file);
        getid3_lib::CopyTagsToComments($tags);
        $html = file_get_contents("../html/edit.html");
        $html = str_replace("{title}", $tags[comments_html][title] ? $tags[comments_html][title][0] : "", $html);
        $html = str_replace("{artist}", $tags[comments_html][artist] ? $tags[comments_html][artist][0] : "", $html);
        $html = str_replace("{album}", $tags[comments_html][album] ? $tags[comments_html][album][0] : "", $html);
        $html = str_replace("{genre}", $tags[comments_html][genre] ? $tags[comments_html][genre][0] : "", $html);
        echo $html;
    }