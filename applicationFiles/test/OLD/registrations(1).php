<!DOCTYPE html>
<html>
<head>
<title>Hotel Registrations</title>
</head>
<body>

<h1>Hotel Registrations</h1>
<p>Use this web interface to add, edit and delete hotel registrations</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>Reservation ID</th><th>First Name</th><th>Last Name</th><th>Source</th><th>Check In Date</th><th>Delete</th><th>Edit</th></tr>";

$sql = "SELECT reservation.id_reservation, guest.firstName, guest.lastName, reservation.source, checkInDate FROM u778390814_FinalProj1.reservation INNER JOIN u778390814_FinalProj1.guest on u778390814_FinalProj1.reservation.guest_id_guest=u778390814_FinalProj1.guest.id_guest";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_reservation"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["source"] . "</td><td>" . $row["checkInDate"]
        . "</td><td><a href='delres.php?id_reservation=" . $row["id_reservation"] . "'>Del</a>"
        . "</td><td><a href='editres.php?id_reservation=" . $row["id_reservation"] . "'>Edit</a>"
        . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>0 results</td></tr>"; // Display a single row with "0 results"
}

// Close the table
echo "</table>";

$conn->close();
?>
<a href="addres.htm">Add New Registration</a>