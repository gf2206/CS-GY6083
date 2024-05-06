<!DOCTYPE html>
<html>
<head>
<title>Hotel Registrations</title>
</head>
<body>

<h1>Active Hotel Registrations</h1>
<p>Use this web interface to view, edit, and delete active hotel registrations</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>Reservation ID</th><th>First Name</th><th>Last Name</th><th>Source</th><th>Check In Date</th><th>Room Type</th><th>Booked Rate</th><th>Room ID</th><th>Room Number</th><th>Delete</th><th>Edit</th><th>Check In</th><th>Check Out</th></tr>";

$sql = "SELECT reservation.id_reservation, guest.firstName, guest.lastName, reservation.source, checkInDate, roomType.roomTypeName, reservation.resRate, room_id_room, room.roomNum FROM u778390814_FinalProj1.reservation INNER JOIN u778390814_FinalProj1.guest ON u778390814_FinalProj1.reservation.guest_id_guest=u778390814_FinalProj1.guest.id_guest LEFT JOIN u778390814_FinalProj1.room ON u778390814_FinalProj1.reservation.room_id_room=u778390814_FinalProj1.room.id_room LEFT JOIN u778390814_FinalProj1.roomType ON u778390814_FinalProj1.reservation.reserved_roomTypeID=u778390814_FinalProj1.roomType.id_roomType WHERE reservation.active=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_reservation"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["source"] . "</td><td>" . $row["checkInDate"] . "</td><td>" . $row["roomTypeName"] . "</td><td>" . $row["resRate"] . "</td><td>"  . $row["room_id_room"] . "</td><td>" . $row["roomNum"]
        . "</td><td><a href='delres.php?id_reservation=" . $row["id_reservation"] . "'>Del</a>"
        . "</td><td><a href='editres.php?id_reservation=" . $row["id_reservation"] . "'>Edit</a>"
        . "</td><td><a href='checkin.php?id_reservation=" . $row["id_reservation"] . "'>Check In</a>"
        . "</td><td><a href='checkout.php?id_reservation=" . $row["id_reservation"] . "'>Check Out</a>"
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
<a href="guest.php">Start a new registration from the Guest Register</a>
<br>
<br>
<a href="main.htm">Back to Main Page</a>