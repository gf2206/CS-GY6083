<!DOCTYPE html>
<html>
<head>
<title>Hotel Guest Register</title>
</head>
<body>

<h1>Hotel Guest Register</h1>
<p>Use this web interface to add, edit, and delete hotel guests, as well as make new reservastions.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Address1</th><th>Address2</th><th>Email</th><th>Phone</th><th>Delete</th><th>Edit</th><th>New Reservation</th></tr>";

$sql = "SELECT id_guest, firstName, lastName, address1, address2, email, phone FROM u778390814_FinalProj1.guest";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_guest"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["address1"] . "</td><td>" . $row["address2"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"]
        . "</td><td><a href='delguest.php?id_guest=" . $row["id_guest"] . "'>Del</a>"
        . "</td><td><a href='editguest.php?id_guest=" . $row["id_guest"] . "'>Edit</a>"
        . "</td><td><a href='addnewres.php?id_guest=" . $row["id_guest"] . "'>New Reservation</a>"
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
<a href="addguest.htm">Add New Guest</a>
<br>
<br>
<a href="main.htm">Back to Main Page</a>