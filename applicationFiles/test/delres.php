<?php
include "dbconn.php";

$sql = "delete from u778390814_FinalProj1.reservation where id_reservation=?";
$id_reservation = $_REQUEST["id_reservation"];
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