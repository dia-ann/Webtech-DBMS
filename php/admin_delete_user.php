<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    echo "Unauthorized";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../php/admin_users.php');
    exit;
}

$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

$conn = new mysqli('localhost', 'root', '', 'project25_db');
if ($conn->connect_error) {
    die('DB error: ' . $conn->connect_error);
}

// Prevent deleting currently signed-in admin user
$current = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
if ($user_id === $current) {
    // don't allow deleting self
    header('Location: ../php/admin_users.php');
    exit;
}

$del = $conn->prepare('DELETE FROM user_info WHERE user_id = ?');
$del->bind_param('i', $user_id);
if ($del->execute()) {
    $del->close();
    $conn->close();
    header('Location: ../php/admin_users.php');
    exit;
} else {
    echo 'Error deleting user: ' . $conn->error;
}

$conn->close();
?>