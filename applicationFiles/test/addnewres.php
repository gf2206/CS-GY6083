<!DOCTYPE html>
<html>
<head>
<title>New Reservation</title>
</head>
<body>

<h1>New Guest Reservation</h1>
<p>Use this web interface to add a new guest reservation.</p>
<br>
</body>
</html>


<?php
$id_guest = $_GET["id_guest"];
?>


<form action="addnewres2.php">
    <label for "source">Source:</label><br>
    <input type="text" id="source" name="source"><br>
    <label for "reserved_roomTypeID">Room Type ID:</label><br>
    <input type="int" id="reserved_roomTypeID" name="reserved_roomTypeID"><br>
    <label for "resDate">Reservation Date:</label><br>
    <input type="text" id="resDate" name="resDate"><br>
    <label for "checkInDate">Check In Date:</label><br>
    <input type="text" id="checkInDate" name="checkInDate"><br>
    <label for "checkOutDate">Check Out Date:</label><br>
    <input type="text" id="checkOutDate" name="checkOutDate"><br>
    <label for "resRate">Reservation Rate:</label><br>
    <input type="text" id="resRate" name="resRate"><br>
    <label for="id_guest">Guest ID:</label><br>
    <input type="text" id="id_guest" name="id_guest" value="<?php echo $id_guest; ?>"><br>
    <input type="submit" value="Submit">
</form>

<?php
include "availrooms.php";
?>