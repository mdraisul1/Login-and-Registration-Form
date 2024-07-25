<?php

$servername = "localhost";
$db_user = "root";
$db_password = "password";
$dbname = "login_register";

// Create connection
$conn = mysqli_connect($servername, $db_user, $db_password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed;");
}

