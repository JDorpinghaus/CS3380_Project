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
	
    //if no session
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
	
	if ($action == 'do_create') {
		create_user();
	} else {
		create_user_form();
	}
	
	function create_user() {
        $firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
        $lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
		$username = empty($_POST['username']) ? '' : $_POST['username'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
        $confirmPassword = empty($_POST['confirmPassword']) ? '' : $_POST['confirmPassword'];
        
        if(strcmp($password,$confirmPassword)==0){
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
            $password = sha1($password);
            
            // Build query
    		$query = "INSERT INTO users(firstName, lastName, loginID, password) VALUES ('$firstName', '$lastName', '$username', '$password')";
    		
            // If there was a result...
            if ($db->query($query)==TRUE) {
                
                $db->close();
    
                $error = "New User Created Successfully";
                require "login_form.php";
                exit;
            }
               
            else{
                $error = "Insert Error: " . $query . "<br>" . $db->error;
                require "createUser_form.php";
                exit;
            }
        }
        //  //passwords do not match
        else {
          $error = 'Error: passwords do not match!';
          require "createUser_form.php";
          exit;
        }
	}
	function create_user_form() {
		$username = "";
		$error = "";
		require "createUser_form.php";
        exit;
	}
?>