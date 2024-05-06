<?php
include "dbconn.php";

$sql = "update u778390814_FinalProj1.rewardMember  set pointsTotal= ? where id_rewardMember = ?";

$id_rewardMember = $_REQUEST["id_rewardMember"];
$pointsTotal = $_REQUEST["pointsTotal"];
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $pointsTotal, $id_rewardMember);
if($stmt->execute() === TRUE) {
    echo "<script>window.location.href = 'rewardmem.php'</script>";
}
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>