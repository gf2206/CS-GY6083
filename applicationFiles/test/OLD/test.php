
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


$sql = "SELECT id_guest, firstName, lastName, address1, address2, email, phone FROM u778390814_FinalProj1.guest";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo "ID: " . $row["id_guest"] . " - Name: " . $row["firstName"] . " " . $row["lastName"] . " - Address1: " . $row["address1"] . " - Address2: " . $row["address2"] . " - email: " . $row["email"] . " - Phone: " . $row["phone"] . "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>