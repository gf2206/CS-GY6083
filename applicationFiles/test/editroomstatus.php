<!DOCTYPE html>
<html>
<head>
<title>Room Status Management</title>
</head>
<body>

<h1>Room Status Management</h1>
<p>Use this web interface to edit a room's status.</p>
<br>
<br>
<p>Room Status Key: 1-Vancant, 2-Occupied, 3-Dirty, 4-Out of Service, 5-Reserved.</p>
</body>
</html>


<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.room where id_room = ?";
$id_room = $_REQUEST["id_room"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id_room);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="uproom4.php">
    <label for "roomStatus_id_roomStatus">Set Room Status:</label><br>
    <input type="text" id="roomStatus_id_roomStatus" name="roomStatus_id_roomStatus" value="<?php echo $row["roomStatus_id_roomStatus"]?>"><br>
    <input type="hidden" id="id_room" name="id_room" value="<?php echo $row["id_room"]?>"><br>
    <input type="submit" value="Submit">
</form>