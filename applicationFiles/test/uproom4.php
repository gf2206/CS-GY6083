<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.room set roomStatus_id_roomStatus = ? where id_room = ?";

$id_room = $_REQUEST["id_room"];
$roomStatus_id_roomStatus = $_REQUEST["roomStatus_id_roomStatus"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $roomStatus_id_roomStatus, $id_room);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'room.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>