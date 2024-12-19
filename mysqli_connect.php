<?php
$host = 'localhost';        
$username = 'justinedeluana'; 
$password = 'justinedeluana'; 
$database = 'member_deluana'; 
$dbcon = mysqli_connect($host, $username, $password, $database);
if (!$dbcon) {
    die('Database connection failed: ' . mysqli_connect_error());
}
?>