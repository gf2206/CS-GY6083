<?php
include "dbconn.php";

$sql = "insert into u778390814_FinalProj1.reservation (source, resDate, checkInDate, checkOutDate) VALUES (?,?,?,?)";

$source = $_REQUEST["source"];
$resDate = $_REQUEST["resDate"];
$checkInDate = $_REQUEST["checkInDate"];
$checkOutDate = $_REQUEST["checkOutDate"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $source, $resDate, $checkInDate, $checkOutDate);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'registrations.php'</script>";
}
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>