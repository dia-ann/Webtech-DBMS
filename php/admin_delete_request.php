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

$conn = new mysqli('localhost', 'root', '', 'project25_db');
if ($conn->connect_error) {
    die('DB error: ' . $conn->connect_error);
}

$sql = "DELETE FROM request WHERE req_id=$req_id";

if ($conn->query($sql) === TRUE) {
    header('Location: ../html/admin_dashboard.html');
    exit;
} else {
    echo 'Error: ' . $conn->error;
}

$conn->close();
?>