<?php
    //Change to epizy values when deploying
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Database connection failed: " . $db->connect_error);
    }
    
    echo file_get_contents("./html/index.html");