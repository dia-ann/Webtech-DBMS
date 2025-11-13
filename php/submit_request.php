<?php
session_start();

// require user to be logged in to submit a request
if (!isset($_SESSION['user_id'])) {
    // not signed in
    header('Location: ../html/signin.html');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project25_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$residentName = isset($_POST['residentName']) ? $conn->real_escape_string($_POST['residentName']) : '';
$apartmentNumber = isset($_POST['apartmentNumber']) && $_POST['apartmentNumber'] !== '' ? intval($_POST['apartmentNumber']) : 'NULL';
$issueType = isset($_POST['issueType']) ? $conn->real_escape_string($_POST['issueType']) : '';
$description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : '';

$user_id = intval($_SESSION['user_id']);

// prepare and insert using a simple insert statement
$apartment_val = ($apartmentNumber !== 'NULL') ? $apartmentNumber : 'NULL';
$sql = "INSERT INTO request (apartment_id, user_id, issue_type, issue_desc, status) VALUES ($apartment_val, $user_id, '" . $issueType . "', '" . $description . "', 'Pending')";

if ($conn->query($sql) === TRUE) {
  header('Location: ../html/request_status.php');
  exit;
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
?>
