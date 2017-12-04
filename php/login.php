<?php

    function checkHTTPS() {
        if(!empty($_SERVER['HTTPS']))
            if($_SERVER['HTTPS'] !== 'off')
                return true; //https
            else
                return false; //http
         else
            if($_SERVER['SERVER_PORT'] == 443)
                return true; //https
            else
                return false; //http
    }
    
    // HTTPS redirect
    if (!checkHTTPS) {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURL");
		exit;
	}
	
	if(!session_start()) {
		// If the session couldn't start, present an error
		header("Location: error.php");
		exit;
	}
	
	// Check to see if the user has already logged in
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if ($loggedIn) {
		header("Location: index.php");
		exit;
	}
	
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'do_login') {
		handle_login();
	} else {
		login_form();
	}
	
	function handle_login() {
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
        print($password);
        print($username);
        // Connect to database
        require_once 'db.php';
        
        // Check for errors
        if ($db->connect_error) {
            $error = 'Error: ' . $db->connect_errno . ' ' . $db->connect_error;
			require "login_form.php";
            exit;
        }
        
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
        
        //more secure password storing for website
        $password = sha1($password); 
        
        // Build SQL query
		$query = "SELECT userID FROM users WHERE loginID = '$username' AND password = '$password'";
        print($query);
		// send $query
		$mysqliResult = $db->query($query);
		
        if ($mysqliResult) {
            // How many records were returned?
            $match = $mysqliResult->num_rows;

            // Close the results
            $mysqliResult->close();
            // Close the DB connection
            $db->close();


            // If there was a match, login
  		    if ($match == 1) {
                $_SESSION['loggedin'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $error = 'Error: Incorrect username or password';
                require "login_form.php";
                exit;
            }
        }
        // Else, there was no result
        else {
          $error = 'Login Error: Please contact the system administrator.';
          require "login_form.php";
          exit;
        }
	}
	
	function login_form() {
		$username = "";
		$error = "";
		require "login_form.php";
        exit;
	}
?>