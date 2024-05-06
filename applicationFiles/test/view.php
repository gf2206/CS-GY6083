<!DOCTYPE html>
<html>
<head>
<title>Guest Folio</title>
</head>
<body>
Folio</h1>
<p>Use this web interface to view a guest's final bill without any credit card information.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>First Name</th><th>Last Name</th><th>Check Out Date</th><th>Rate</th><th>Room Number</th><th>Final Bill<tr>";

$sql = "SELECT * FROM u778390814_FinalProj1.guest_folio_no_cc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["checkOutDate"] . "</td><td>" . $row["resRate"] . "</td><td>" . $row["roomNum"] . "</td><td>" . $row["finalBill"]
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