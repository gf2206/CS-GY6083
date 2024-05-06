<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.reservation  set source= ?, resDate = ?, reserved_roomTypeID = ?,resRate= ?, checkInDate = ?, checkOutDate = ? where id_reservation = ?";

$id_reservation = $_REQUEST["id_reservation"];
$source = $_REQUEST["source"];
$resDate = $_REQUEST["resDate"];
$reserved_roomTypeID = $_REQUEST["reserved_roomTypeID"];
$resRate = $_REQUEST["resRate"];
$checkInDate = $_REQUEST["checkInDate"];
$checkOutDate = $_REQUEST["checkOutDate"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $source, $resDate, $reserved_roomTypeID, $resRate, $checkInDate, $checkOutDate, $id_reservation);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'registrations.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>