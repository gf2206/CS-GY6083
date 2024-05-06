<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.guest  set firstName = ?, lastName = ?, address1 = ?, address2 = ?, email = ?, phone = ? where id_guest = ?";

$id_guest = $_REQUEST["id_guest"];
$firstName = $_REQUEST["firstName"];
$lastName = $_REQUEST["lastName"];
$address1 = $_REQUEST["address1"];
$address2 = $_REQUEST["address2"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $firstName, $lastName, $address1, $address2, $email, $phone, $id_guest);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'guest.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

