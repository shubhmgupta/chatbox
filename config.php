<?php
$servername = "servername"; //replace with your server name
$username = "username"; //replace with your MySQL username
$password = "password"; //replace with your MySQL password
$dbname = "databasename"; //replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
die('Something went wrong try again');
}
// echo "Connected successfully";
?>
