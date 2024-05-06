<!DOCTYPE html>
<html>
<head>
<title>Edit Registration</title>
</head>
<body>

<h1>Edit Registration</h1>
<p>Use this web interface to edit a hotel registration</p>
<br>
<p>RoomType Key: 1-Single Queen, 2-Single King, 3-Double Queen, 4-Double King, 5-Jr. Suite, 6-Deluxe Suite, 7-Single Queen ADA, 8-Single King ADA</p>


</body>
</html>


<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.reservation where id_reservation = ?";
$id_reservation = $_REQUEST["id_reservation"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id_reservation);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="upres.php">
    <label for "source">Source:</label><br>
    <input type="text" id="source" name="source" value="<?php echo $row["source"]?>"><br>
    <label for "resDate">Reservation Date:</label><br>
    <input type="text" id="resDate" name="resDate"  value="<?php echo $row["resDate"]?>"><br>
    <label for "reserved_roomTypeID">Room Type ID:</label><br>
    <input type="text" id="reserved_roomTypeID" name="reserved_roomTypeID"  value="<?php echo $row["reserved_roomTypeID"]?>"><br>
    <label for "resRate">Resrvation Room Rate:</label><br>
    <input type="text" id="resRate" name="resRate"  value="<?php echo $row["resRate"]?>"><br>
    <label for "checkInDate">Check In Date:</label><br>
    <input type="text" id="checkInDate" name="checkInDate"  value="<?php echo $row["checkInDate"]?>"><br>
    <label for "checkOutDate">Check Out Date:</label><br>
    <input type="text" id="checkOutDate" name="checkOutDate"  value="<?php echo $row["checkOutDate"]?>"><br>
    <input type="hidden" id="id_reservation" name="id_reservation" value="<?php echo $row["id_reservation"]?>"><br>
    <input type="submit" value="Submit">
</form>

