<?php
$host   = 'localhost';
$dbName = 'crud_demo';
$dbUser = 'root';      // Change if needed
$dbPass = '';          // Change if needed

$conn = new mysqli($host, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
}
?>
