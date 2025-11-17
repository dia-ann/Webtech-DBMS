<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

$req_id = $_GET['req_id'];

$sql = "DELETE FROM request WHERE req_id='$req_id'";
mysqli_query($conn, $sql);

header("Location: admin_requests.php");
exit;
?>
