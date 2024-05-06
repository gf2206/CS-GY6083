<?php
include "dbconn.php";

$sql = "insert into u778390814_FinalProj1.roomType (roomTypeName, roomTypeDesc, rate, adaCompliant) VALUES (?,?,?,?)";

$roomTypeName = $_REQUEST["roomTypeName"];
$roomTypeDesc = $_REQUEST["roomTypeDesc"];
$rate = $_REQUEST["rate"];
$adaCompliant = $_REQUEST["adaCompliant"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $roomTypeName, $roomTypeDesc, $rate, $adaCompliant);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'roomtype.php'</script>";
}
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>