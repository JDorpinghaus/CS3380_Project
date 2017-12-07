<?php
    require_once("db.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        echo file_get_contents("../html/search.html");
    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $id = $_REQUEST['songId'];
        $title = $_REQUEST['title'];
        $artist = $_REQUEST['artist'];
        $album = $_REQUEST['album'];
        $genre = $_REQUEST['genre'];
        $songs = array();
        
        $sql = "SELECT * FROM songs WHERE title LIKE '%" . $title . "%' OR album LIKE '%" . $album . "%' OR artist LIKE '%" . $artist . "%' OR genre LIKE '%" . $genre . "%'";
        
        $result = $db->query($sql);
        
        if(!result){
            echo("Error searching for songs: " . $db->error);
        } else{
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    array_push($songs, $row);
                }
            }
            $result->close;
        }
        $tableRow = file_get_contents("../html/tableRow.html");
        $table = "<br><br><table>\n";
        $table .= "<tr><th>ID</th><th>Title</th><th>Artist</th><th>Album</th><th>Genre</th></tr>";
        
        foreach ($songs as $song){
            
            $id = $song['id'];
            $title = $song['title'];
            $artist = $song['artist'];
            $album = $song['album'];
            $genre = $song['genre'];
            
            $tableRow = str_replace("{songId}", $id, $tableRow);
            $tableRow = str_replace("{title}", $title, $tableRow);
            $tableRow = str_replace("{artist}", $artist, $tableRow);
            $tableRow = str_replace("{album}", $album, $tableRow);
            $tableRow = str_replace("{genre}", $genre, $tableRow);
            $table .= $tableRow;
        }
        
        $table .= "</body>";
        $html = file_get_contents("../html/index.html");
        $html = str_replace("</body>", $table, $html);
        echo $html;
    }