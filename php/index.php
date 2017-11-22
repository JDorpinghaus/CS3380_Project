<?php
    require("db.php");
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo file_get_contents("../html/index.html");
    }
    