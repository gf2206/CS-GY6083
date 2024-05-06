<?php
include "dbconn.php";

$sql = "delete from u778390814_FinalProj1.room where id_room=?";
$id_room = $_REQUEST["id_room"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_room);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'room.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>