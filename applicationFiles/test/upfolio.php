<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.guestFolio  set discounts= ?, addCharges = ?, subTotal = ?, ccNum= ? , finalBill= ? where id_guestFolio = ?";

$id_guestFolio = $_REQUEST["id_guestFolio"];
$discounts = $_REQUEST["discounts"];
$addCharges = $_REQUEST["addCharges"];
$subTotal = $_REQUEST["subTotal"];
$ccNum = $_REQUEST["ccNum"];
$finalBill = $_REQUEST["finalBill"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $discounts, $addCharges, $subTotal, $ccNum, $finalBill, $id_guestFolio);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'bill.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>