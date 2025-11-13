<?php
session_start();

// Sign-in using database users only. Store session and redirect based on role.
// connect
$conn = mysqli_connect("localhost", "root", "", "project25_db");
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit;
}

$em = isset($_POST['email']) ? trim($_POST['email']) : '';
$psw = isset($_POST['password']) ? trim($_POST['password']) : '';

if ($em === '' || $psw === '') {
    echo "<script>alert('Please provide email and password'); window.location.href='../html/signin.html';</script>";
    exit;
}

// Find user by email (case-insensitive, trimmed).
$stmt = $conn->prepare("SELECT user_id, user_role, passwd FROM user_info WHERE LOWER(TRIM(email)) = LOWER(TRIM(?)) LIMIT 1");
if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit;
}

$stmt->bind_param('s', $em);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    // no account with this email
    $stmt->close();
    mysqli_close($conn);
    echo "<script>alert('No account found with that email.'); window.location.href='../html/signin.html';</script>";
    exit;
}

$stmt->bind_result($userId, $role, $dbPasswd);
$stmt->fetch();
$stmt->close();

// trim and compare password exactly
$dbPasswd = trim($dbPasswd);
if ($dbPasswd !== $psw) {
    mysqli_close($conn);
    echo "<script>alert('Incorrect password.'); window.location.href='../html/signin.html';</script>";
    exit;
}

// success
$_SESSION['user_id'] = $userId;
$_SESSION['email'] = $em;
$_SESSION['user_role'] = $role;

mysqli_close($conn);

if ($role == 'Resident') {
    echo "<script>alert('Welcome Resident!'); window.location.href='../html/resident_dashboard.html';</script>";
} elseif ($role == 'Admin') {
    echo "<script>alert('Welcome Admin!'); window.location.href='../html/admin_dashboard.html';</script>";
} else {
    echo "<script>alert('Unknown role. Please contact admin.'); window.location.href='../html/signin.html';</script>";
}
?>