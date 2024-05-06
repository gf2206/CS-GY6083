<!DOCTYPE html>
<html>
<head>
<title>Most Booked Guest</title>
</head>
<body>
Folio</h1>
<p>Use this REPORT to view the guest who has made the most reservations at the Fancy Hotel.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>First Name</th><th>Last Name</th><th>Total Resrvations<tr>";

$sql = "SELECT * FROM u778390814_FinalProj1.MostBookedGuest";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["TotalReservations"]
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