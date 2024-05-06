<!DOCTYPE html>
<html>
<head>
<title>Edit Room Number</title>
</head>
<body>

<h1>Edit Room Number</h1>
<p>Use this web interface to edit a hotel room number</p>
<br>

</body>
</html>

<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.room where id_room = ?";
$id_room = $_REQUEST["id_room"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_room);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="uproom3.php">
    <label for "id_room">Room ID:</label><br>
    <input type="text" id="id_room" name="id_room" value="<?php echo $row["id_room"]?>"><br>
    <label for "roomNum">Room Number:</label><br>
    <input type="text" id="roomNum" name="roomNum" value="<?php echo $row["roomNum"]?>"><br>
    <input type="hidden" id="id_room" name="id_room" value="<?php echo $row["id_room"]?>"><br>
    <input type="submit" value="Submit">
</form>