<!DOCTYPE html>
<html>
<head>
<title>Room Type Management</title>
</head>
<body>

<h1>Room Type Management</h1>
<p>Use this web interface to view, and edit room type information.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>ID</th><th>Room Type</th><th>Room Description</th><th>Standard Rate</th><th>ADA Compliance Status</th><th>Edit Desc</th><th>Edit Rate</th></tr>";

$sql = "SELECT id_roomType, roomTypeName, roomTypeDesc, rate, adaCompliant FROM u778390814_FinalProj1.roomType";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_roomType"] . "</td><td>" . $row["roomTypeName"] . "</td><td>" . $row["roomTypeDesc"] . "</td><td>" . $row["rate"] . "</td><td>" . $row["adaCompliant"]
        . "</td><td><a href='editroomdesc.php?id_roomType=" . $row["id_roomType"] . "'>Edit Desc</a>"
        . "</td><td><a href='editroomrate.php?id_roomType=" . $row["id_roomType"] . "'>Edit Rate</a>"
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
<a href="newroomtype.htm">Add a new room type</a>
<br>
<br>
<a href="main.htm">Back to Main Page</a>