<?php
include "dbconn.php";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->query("USE $dbname");
$sql = "CALL p_checkIn(?)";
$id_reservation = $_GET["id_reservation"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_reservation);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'registrations.php'</script>";
}
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
