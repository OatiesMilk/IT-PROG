<?php
session_start();

// Database connection
include('config.php');
$conn = mysqli_connect($localhost, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is an admin
if (!isset($_SESSION['isadmin']) || $_SESSION['isadmin'] != 1) {
    die("Access denied: You do not have permission to view this page.");
}
?>
