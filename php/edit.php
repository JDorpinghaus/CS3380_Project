<?php
    require_once("db.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo file_get_contents("../html/upload.html");
    } else if  ($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //TODO sanitize these
        $id = $_REQUEST['songId'];
        $title = $_REQUEST['title'];
        $artist = $_REQUEST['artist'];
        $album = $_REQUEST['album'];
        $genre = $_REQUEST['genre'];
        
        $sql = "UPDATE songs SET title='" . $title . "', artist='" . $artist . "', album='" . $album . "', genre='" . $genre . "' WHERE id='" . $id . "'";
        $result = $db->query($sql);
        if(!$result){
            echo("Error updating entry: " . $db->error);
        }
        
        $html = file_get_contents("../html/index.html");
        echo $html;
    }