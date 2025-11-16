<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

$req_id = $_POST['req_id'];
$status = $_POST['main_status'];

$sql = "UPDATE request SET main_status='$status' WHERE req_id='$req_id'";
mysqli_query($conn, $sql);

header("Location: admin_requests.php");
exit;
?>
