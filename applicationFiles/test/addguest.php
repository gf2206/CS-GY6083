<?php
include "dbconn.php";

$sql = "insert into u778390814_FinalProj1.guest (firstName, lastName, address1, address2, email, phone) VALUES (?,?,?,?,?,?)";

$firstName = $_REQUEST["firstName"];
$lastName = $_REQUEST["lastName"];
$address1 = $_REQUEST["address1"];
$address2 = $_REQUEST["address2"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $firstName, $lastName, $address1, $address2, $email, $phone);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'guest.php'</script>";
}
else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

