<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        header("Location: index.php");
    } else if  ($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        //TODO sanitize these
        $id = $_REQUEST['songId'];
        $title = $_REQUEST['title'];
        $artist = $_REQUEST['artist'];
        $album = $_REQUEST['album'];
        $genre = $_REQUEST['genre'];
        
        $html = file_get_contents("../html/edit.html");
        $html = str_replace("{songId}", $id, $html);
        $html = str_replace("{title}", $title, $html);
        $html = str_replace("{artist}", $artist, $html);
        $html = str_replace("{album}", $album, $html);
        $html = str_replace("{genre}", $genre, $html);
        echo $html;
    }