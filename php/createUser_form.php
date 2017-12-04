<!DOCTYPE html>

<html>
<head>
	<title>Create User Account</title>

    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>
    <div id="wrapper" class="wrapperUI">
        <h1 class="login_header">Create New User</h1>
        
        <?php
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>
        
        <form action="createUser.php" method="POST">
            
            <input type="hidden" name="action" value="do_create">
            
            <div class="newUserInput">
                <label for="firstName">First name:</label>
                <input type="text" id="firstName" name="firstName" autofocus>
            </div>
            
            <div class="newUserInput">
                <label for="lastName">Last name:</label>
                <input type="text" id="lastName" name="lastName">
            </div>
            
            <div class="newUserInput">
		<?php /*error flag for non-unique username*/ if($error_flag == 1){ echo "Username taken. Try again."; } ?>
                <label for="username">User name:</label>
                <input type="text" id="username" name="username" value="<?php print $username;?>">
            </div>
            
            <div class="newUserInput">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="ui-widget-content ui-corner-all">
            </div>
            
            <div class="newUserInput">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="confirmPassword" id="confirmPassword" name="confirmPassword">
            </div>
            
            <div class="stack">
                <input type="submit" value="Submit">
            </div>
        </form>
        
        <br>
        <a href="login_form.php">Log In</a>
        
    </div>
</body>
</html>
