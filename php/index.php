<?php
    require("db.php");
    echo phpinfo();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo file_get_contents("../html/index.html");
    }
    