<?php
include "dbconn.php";

$sql = "insert into u778390814_FinalProj1.reservation (source, reserved_roomTypeID, resDate, checkInDate, checkOutDate, guest_id_guest) VALUES (?,?,?,?,?,?)";

$source = $_REQUEST["source"];
$reserved_roomTypeID = $_REQUEST["reserved_roomTypeID"];
$resDate = $_REQUEST["resDate"];
$checkInDate = $_REQUEST["checkInDate"];
$checkOutDate = $_REQUEST["checkOutDate"];
$guest_id_guest =(int) $_REQUEST["id_guest"];

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssi", $source, $reserved_roomTypeID, $resDate, $checkInDate, $checkOutDate, $guest_id_guest);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'guest.php'</script>";
}
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>