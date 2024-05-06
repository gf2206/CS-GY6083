<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.roomType where id_roomType = ?";
$id_roomType = $_REQUEST["id_roomType"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id_roomType);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="uproom1.php">
    <label for "roomTypeDesc"> Edit Room Description:</label><br>
    <input type="text" id="roomTypeDesc" name="roomTypeDesc" value="<?php echo $row["roomTypeDesc"]?>"><br>
    <input type="hidden" id="id_roomType" name="id_roomType" value="<?php echo $row["id_roomType"]?>"><br>
    <input type="submit" value="Submit">
</form>
<br>
<a href="main.htm">Back to Main Page</a>
<br>
<br>
<a href="roomtype.htm">Back to Room Type Management Page</a>