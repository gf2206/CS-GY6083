<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.guestFolio  set paid=1 where id_guestFolio = ?";

$id_guestFolio = $_REQUEST["id_guestFolio"];
$paid = 1;
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_guestFolio);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'bill.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>