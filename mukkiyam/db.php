<?php
//Enable us to use Headers
ob_start();
// Set sessions
if(!isset($_SESSION)) {
session_start();
}
//require_once __DIR__ . '/../../1637028036/vendor/autoload.php';
//if (!class_exists('Dotenv\Dotenv')) {
   // die('Dotenv\Dotenv not found. Please check your Composer installation.');
//}
//use Dotenv\Dotenv;

// Load the shared .env file
//$dotenv = Dotenv::createImmutable('D:\xampp\htdocs');
//$dotenv->load();

// Define the database credentials for each company
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "jero_jrc";
$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")
?>


