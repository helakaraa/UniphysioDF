<?php

$servername = "185.98.131.90 "; // Enter MySQL server address
$username = "ferre941045"; //MySQL User Name
$password = "HJ4NG32F"; //MySQL Password
$dbname = "ferre941045"; //
global $conn;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn -> connect_error) {
	die("Connection to database failed: " . $conn -> connect_error);
	exit();
}
?>