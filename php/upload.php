<?php
	if(!session_start()){
        header("Location: error.php");
        exit;
    }
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if (!$loggedIn) {
		header("Location: login.php");
		exit;
	}

    require_once('../getid3/getid3.php');
    require("db.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo file_get_contents("../html/upload.html");
    } else {
        $getID3 = new getID3;
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["mp3"]["name"]); //TODO sanitize this
        $mp3FileType = $_FILES["mp3"]["type"]; //TODO check type server-side
        
        if($mp3FileType != "audio/mp3" && $mp3FileType != "audio/mp3"){
            echo "Error: file is not an mp3.\n";
            echo "Extension is " . $mp3FileType;
            exit();
        }
        
        $tags = $getID3->analyze($_FILES['mp3']['tmp_name']);
        getid3_lib::CopyTagsToComments($tags);
        $username = $_SESSION['loggedin'];
        $sql = "SELECT userID FROM users WHERE loginID = '" . $username . "'";
        $result = $db->query($sql);
        
        if(!result){
            echo("Error searching for songs: " . $db->error);
        } else{
            if($result->num_rows > 0){
            	$user = $result->fetch_assoc();
            }
            $result->close;
        }
        $userID = $user['userID'];
        $mp3 = addslashes(file_get_contents($_FILES['mp3']['tmp_name'])); //TODO better way to do this
        $sql = "INSERT INTO songs (mp3, title, artist, album, genre, userID) VALUES ('" . $mp3 . "', '" . $tags[comments_html][title][0] . "', '" . $tags[comments_html][artist][0] . "', '" . $tags[comments_html][album][0] . "', '" . $tags[comments_html][genre][0] . "', '" . $userID . "')";
        $result = $db->query($sql);
        if(!$result){
            echo("Error inserting file: " . $db->error);
        } else {
            $id = $db->insert_id;
        }
        $html = file_get_contents("../html/edit.html");
        $html = str_replace("{songId}", $id, $html);
        $html = str_replace("{title}", $tags[comments_html][title][0] ? $tags[comments_html][title][0] : "", $html);
        $html = str_replace("{artist}", $tags[comments_html][artist][0] ? $tags[comments_html][artist][0] : "", $html);
        $html = str_replace("{album}", $tags[comments_html][album][0] ? $tags[comments_html][album][0] : "", $html);
        $html = str_replace("{genre}", $tags[comments_html][genre][0] ? $tags[comments_html][genre][0] : "", $html);
        echo $html;
    }