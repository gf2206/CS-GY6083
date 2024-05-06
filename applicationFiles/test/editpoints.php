<!DOCTYPE html>
<html>
<head>
<title>Edit Guest Point Total</title>
</head>
<body>

<h1>Edit Guest Point Total</h1>
<p>Use this web interface to edit a guest's Reward Program point total</p>
<br>

</body>
</html>

<?php
include "dbconn.php";

$sql = "SELECT * FROM u778390814_FinalProj1.rewardMember where id_rewardMember = ?";
$id_rewardMember = $_REQUEST["id_rewardMember"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rewardMember);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >0) {
    $row = $result->fetch_assoc();
}
?>

<form action="uppoints.php">
    <label for "pointsTotal">Points Total:</label><br>
    <input type="text" id="pointsTotal" name="pointsTotal" value="<?php echo $row["pointsTotal"]?>"><br>
    <input type="hidden" id="id_rewardMember" name="id_rewardMember" value="<?php echo $row["id_rewardMember"]?>"><br>
    <input type="submit" value="Submit">
</form>