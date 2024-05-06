<!DOCTYPE html>
<html>
<head>
<title>Guest Folio</title>
</head>
<body>
Folio</h1>
<p>Use this web interface to create and edit a guest's final bill.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>Folio ID</th><th>Reservation ID</th><th>First Name</th><th>Last Name</th><th>Sub Total</th><th>Final Bill</th><th>Credit Card Number</th><th>Edit Bill-Credit Card<th>Mark Bill Paid</th><tr>";

$sql = "SELECT guestFolio.id_guestFolio, reservation.id_reservation, guest.firstName, guest.lastName, guestFolio.subTotal, guestFolio.finalBill, guestFolio.ccNum FROM u778390814_FinalProj1.reservation INNER JOIN u778390814_FinalProj1.guest ON reservation.guest_id_guest=guest.id_guest INNER JOIN u778390814_FinalProj1.guestFolio ON reservation.id_reservation=guestFolio.reservation_id_reservation WHERE guestFolio.id_guestFolio IS NOT NULL AND guestFolio.paid=0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_guestFolio"] . "</td><td>" . $row["id_reservation"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["subTotal"] . "</td><td>" . $row["finalBill"] . "</td><td>" . $row["ccNum"]
        . "</td><td><a href='editbill.php?id_guestFolio=" . $row["id_guestFolio"] . "'>Edit Bill-Credit Card</a>"
        . "</td><td><a href='paybill.php?id_guestFolio=" . $row["id_guestFolio"] . "'>Mark Bill Paid</a>"
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