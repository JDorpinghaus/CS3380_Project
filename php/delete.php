<?php
    require_once("db.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        echo file_get_contents("../html/index.html");
    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $id = $_REQUEST['songId'];

        $songs = array();
        
        $sql = "DELETE FROM songs WHERE id='" . $id . "'";
        
        $result = $db->query($sql);
        
        if(!result){
            echo("Error deleting song with ID " . $id . ": " . $db->error);
        }
        else {
        	$message = "<p>Deleted song " . $id . " from database</p></body>";
        	$html = file_get_contents("../html/index.html");
        	$html = str_replace("</body>", $message, $html);
        	echo $html;
        }
    }