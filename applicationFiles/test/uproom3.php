<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.room set roomNum = ? where id_room = ?";

$id_room = $_REQUEST["id_room"];
$roomNum = $_REQUEST["roomNum"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $roomNum, $id_room);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'room.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>