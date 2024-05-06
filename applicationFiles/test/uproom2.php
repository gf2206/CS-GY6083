<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.roomType set rate = ? where id_roomType = ?";

$id_roomType = $_REQUEST["id_roomType"];
$rate = $_REQUEST["rate"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $rate, $id_roomType);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'roomtype.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>