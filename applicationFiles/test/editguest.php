<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.guest where id_guest = ?";
$id_guest = $_REQUEST["id_guest"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id_guest);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="upguest.php">
    <label for "firstName">First Name:</label><br>
    <input type="text" id="firstName" name="firstName" value="<?php echo $row["firstName"]?>"><br>
    <label for "lastName">Last Name:</label><br>
    <input type="text" id="lastName" name="lastName"  value="<?php echo $row["lastName"]?>"><br>
    <label for "address1">Address1:</label><br>
    <input type="text" id="address1" name="address1"  value="<?php echo $row["address1"]?>"><br>
    <label for "address2">Address2:</label><br>
    <input type="text" id="address2" name="address2"  value="<?php echo $row["address2"]?>"><br>
    <label for "email">Email:</label><br>
    <input type="email" id="email" name="email"  value="<?php echo $row["email"]?>"><br>
    <label for "phone">First Name:</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $row["phone"]?>"><br>
    <input type="hidden" id="id_guest" name="id_guest" value="<?php echo $row["id_guest"]?>"><br>
    <input type="submit" value="Submit">
</form>
