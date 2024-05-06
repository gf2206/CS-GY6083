<?php
include "dbconn.php";

$sql = "insert into u778390814_FinalProj1.room (roomNum, roomType_id_roomType) VALUES (?,?)";

$roomNum = $_REQUEST["roomNum"];
$roomType_id_roomType = $_REQUEST["roomType_id_roomType"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $roomNum, $roomType_id_roomType);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'room.php'</script>";
}
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
