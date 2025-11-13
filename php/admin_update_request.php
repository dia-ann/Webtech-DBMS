<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    echo "Unauthorized";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/admin_dashboard.html');
    exit;
}

$req_id = isset($_POST['req_id']) ? intval($_POST['req_id']) : 0;
$status = isset($_POST['status']) ? $_POST['status'] : '';
$admin_remarks = isset($_POST['admin_remarks']) ? $_POST['admin_remarks'] : null;

$conn = new mysqli('localhost', 'root', '', 'project25_db');
if ($conn->connect_error) {
    die('DB error: ' . $conn->connect_error);
}

$status_safe = $conn->real_escape_string($status);
$remarks_safe = $admin_remarks !== null ? "'" . $conn->real_escape_string($admin_remarks) . "'" : 'NULL';

$sql = "UPDATE request SET status='$status_safe', admin_remarks=$remarks_safe, admin_remarks_date=NOW() WHERE req_id=$req_id";

if ($conn->query($sql) === TRUE) {
    header('Location: ../html/admin_dashboard.html');
    exit;
} else {
    echo 'Error: ' . $conn->error;
}

$conn->close();
?>