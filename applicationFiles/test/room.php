<!DOCTYPE html>
<html>
<head>
<title>Room Inventory Management</title>
</head>
<body>

<h1>Room Inventory Management</h1>
<p>Use this web interface to view, and edit room inventory information.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>Room ID</th><th>Room Number</th><th>Room Type</th><th>Room Status</th><th>Edit Room Status</th><th>Edit Room</th><th>Delete Room</th></tr>";

$sql = "SELECT room.id_room, room.roomNum, roomType.roomTypeName, roomStatus.roomStatus FROM u778390814_FinalProj1.room INNER JOIN u778390814_FinalProj1.roomStatus ON u778390814_FinalProj1.room.roomStatus_id_roomStatus=u778390814_FinalProj1.roomStatus.id_roomStatus INNER JOIN u778390814_FinalProj1.roomType ON u778390814_FinalProj1.room.roomType_id_roomType=u778390814_FinalProj1.roomType.id_roomType ORDER BY room.roomNum ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_room"] . "</td><td>" . $row["roomNum"] . "</td><td>" . $row["roomTypeName"] . "</td><td>" . $row["roomStatus"]
        . "</td><td><a href='editroomstatus.php?id_room=" . $row["id_room"] . "'>Edit Room Status</a>"
        . "</td><td><a href='editroom.php?id_room=" . $row["id_room"] . "'>Edit Room</a>"
        . "</td><td><a href='delroom.php?id_room=" . $row["id_room"] . "'>Del Room</a>"
        . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>0 results</td></tr>"; // Display a single row with "0 results"
}

// Close the table
echo "</table>";

$conn->close();
?>
<br>
<a href="newroom.htm">Create New Room</a>
<br>
<br>
<a href="main.htm">Back to Main Page</a>