<!DOCTYPE html>
<html>
<head>
<title>Available Rooms</title>
<p>List of Vacant/Available Rooms and Rates</p>
</body>
</html>

<?php
include_once "dbconn.php";

// Start the table
echo "<table border=1><tr><th>ID</th><th>Room Type</th><th>Room Description</th><th>Standard Rate</th><th>ADA Compliance Status</th><th>Room Type</th><th>Room Status</th></tr>";

$sql = "SELECT id_roomType, roomTypeName, roomTypeDesc, rate, adaCompliant, room.roomType_id_roomType, room.roomStatus_id_roomStatus 
        FROM u778390814_FinalProj1.roomType 
        INNER JOIN u778390814_FinalProj1.room 
        ON roomType.id_roomType = room.roomType_id_roomType WHERE room.roomStatus_id_roomStatus=1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_roomType"] . "</td><td>" . $row["roomTypeName"] . "</td><td>" . $row["roomTypeDesc"] . "</td><td>" . $row["rate"] . "</td><td>" . $row["adaCompliant"]. "</td><td>" . $row["roomType_id_roomType"]. "</td><td>" . $row["roomStatus_id_roomStatus"]
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
<a href="main.htm">Back to Main Page</a>
</html>