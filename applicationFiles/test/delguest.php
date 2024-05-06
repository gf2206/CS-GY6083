<?php
include "dbconn.php";

$sql = "delete from u778390814_FinalProj1.guest where id_guest=?";
$id_guest = $_REQUEST["id_guest"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_guest);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'guest.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>