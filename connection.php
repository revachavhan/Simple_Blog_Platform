<?php
// Database configuration
$host = "localhost";
$user = "root";
$password = "";
$db = "blogms";

// Create connection
$link = mysqli_connect($host, $user, $password, $db);

// Check connection
if (!$link) {
    die("❌ Database Connection Failed: " . mysqli_connect_error());
}
?>