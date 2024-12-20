<?php
// Enable us to use Headers
ob_start();
// Set sessions
if(!isset($_SESSION)) {
session_start();
}
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "jerobyte_cdb";
$connection1 = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")
?>