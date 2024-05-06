<!DOCTYPE html>
<html>
<head>
<title>Reward Program Management</title>
</head>
<body>

<h1>Reward Program Management</h1>
<p>Use this web interface to view, and edit reward member information.</p>

</body>
</html>


<?php
include "dbconn.php";

// Start the table
echo "<table border=1><tr><th>ID</th><th>Guest First Name</th><th>Last Name</th><th>Date Joined</th><th>Level</th><th>Points Total</th><th>Edit Points Total</th></tr>";

$sql = "SELECT rewardMember.id_rewardMember, guest.firstName, guest.lastName, rewardMember.dateJoined, rewardMember.level, rewardMember.pointsTotal FROM u778390814_FinalProj1.rewardMember INNER JOIN u778390814_FinalProj1.guest on u778390814_FinalProj1.rewardMember.guest_id_guest=u778390814_FinalProj1.guest.id_guest";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display the data in the table
        echo "<tr><td>" . $row["id_rewardMember"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["dateJoined"] . "</td><td>" . $row["level"] . "</td><td>" . $row["pointsTotal"] 
        . "</td><td><a href='editpoints.php?id_rewardMember=" . $row["id_rewardMember"] . "'>Edit Points Total</a>"
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

