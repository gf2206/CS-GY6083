<?php
header("Cache-Control: no-cache");
$servername = "localhost";
$username = "u778390814_root";
$password = "ThisIsForDB1!";
$dbname = "u778390814_FinalProj1";


// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>