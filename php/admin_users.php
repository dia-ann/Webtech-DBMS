<?php
session_start();

// Only admin can access
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    echo "<p>Access denied. Please <a href='../html/signin.html'>sign in</a> as admin.</p>";
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'project25_db');
if ($conn->connect_error) {
    die('DB connection failed: ' . $conn->connect_error);
}

$sql = "SELECT user_id, user_fname, user_lname, email, phone, apartment_id, user_role FROM user_info ORDER BY user_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="../css/form_style.css">
  <style>
    .container { max-width: 1000px; margin: 30px auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background-color: rgba(0,95,115,0.08); }
    .delete-btn { background: #b00020; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; }
    .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
    .back { background:#005f73; color:white; padding:6px 10px; border-radius:4px; text-decoration:none; }
  </style>
</head>
<body>
  <div class="form-box container">
    <div class="topbar">
      <h2>All Registered Users</h2>
      <a class="back" href="../html/admin_dashboard.html">Back</a>
    </div>

            <?php if ($result && $result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Apartment</th>
            <th>Role</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
            <td><?php echo htmlspecialchars($row['user_fname'] . ' ' . $row['user_lname']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['apartment_id']); ?></td>
            <td><?php echo htmlspecialchars($row['user_role']); ?></td>
            <td>
                <form method="post" action="admin_delete_user.php" onsubmit="return confirm('Delete this user?');">
                  <input type="hidden" name="user_id" value="<?php echo intval($row['user_id']); ?>">
                  <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No users found.</p>
    <?php endif; ?>

  </div>
</body>
</html>
<?php $conn->close(); ?>
