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


    require("db.php");
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo file_get_contents("../html/index.html");
    }
    