<!DOCTYPE html>

<html>
<head>
	<title>Database Login</title>
<!--    style -->
    <style>
        #loginUI{
            background-color: coral;
            max-width: 400px;
            max-height:50px;
            
        }
    
    
    </style>
<!--    script for submit -->
    <script>
        $(function(){
            $("input[type=submit]").button();
        });
    </script>
</head>
<body>

    <div id="loginUI" class="login_ui">   <!-- wrapper div-->
        <h1 class="ui_header">Login</h1>
        
        <?php   //print error if exsist
            if ($error) {
                print "<div class=\"ui-state-error\">$error</div>\n";
            }
        ?>
        
        <form action="login.php" method="POST">   <!-- login form  -->
            
            <input type="hidden" name="action" value="do_login">
            
            <div class="userNameDiv">  <!-- User name Div-->
                <label for="username">User name:</label>
                <input type="text" id="username" name="username" class="userNameInput" autofocus value="<?php print $username; ?>">
            </div>
            
            <div class="passwordDiv">   <!-- Password Div-->
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="passInput">
            </div>
            
            <div class="stack">
                <input type="submit" value="Submit">
            </div>
        </form>
        
        <br>
        <a href="createUser_form.php">Not a User?</a>
        
    </div>
</body>
</html>