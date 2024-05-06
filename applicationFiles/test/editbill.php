<!DOCTYPE html>
<html>
<head>
<title>Edit Bill</title>
</head>
<body>
Folio</h1>
<p>Use this web interface to edit a guest's final bill.</p>

</body>
</html>

<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.guestFolio where id_guestFolio = ?";
$id_guestFolio = $_REQUEST["id_guestFolio"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id_guestFolio);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="upfolio.php">
    <label for "discounts">Discounts:</label><br>
    <input type="text" id="discounts" name="discounts"  value="<?php echo $row["discounts"]?>"><br>
    <label for "addCharges">Additional Charges:</label><br>
    <input type="text" id="addCharges" name="addCharges"  value="<?php echo $row["addCharges"]?>"><br>
    <label for "subTotal">Room Charges:</label><br>
    <input type="text" id="subTotal" name="subTotal"  value="<?php echo $row["subTotal"]?>"><br>
    <label for "ccNum">Credit Card Number:</label><br>
    <input type="int" id="ccNum" name="ccNum"  value="<?php echo $row["ccNum"]?>"><br>
    <label for "finalBill">Final Bill:</label><br>
    <input type="text" id="finalBill" name="finalBill" value="<?php echo $row["finalBill"]?>"><br>
    <input type="hidden" id="id_guestFolio" name="id_guestFolio" value="<?php echo $row["id_guestFolio"]?>"><br>
    <input type="submit" value="Submit">
</form>
