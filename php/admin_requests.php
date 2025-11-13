<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    echo "<p>Access denied. Please <a href='../html/signin.html'>sign in</a> as admin.</p>";
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'project25_db');
if ($conn->connect_error) {
    die('DB connection failed: ' . $conn->connect_error);
}

$sql = "SELECT req_id, apartment_id, user_id, issue_type, issue_desc, status, req_date, admin_remarks FROM request ORDER BY req_id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Requests</title>
  <link rel="stylesheet" href="../css/form_style.css">
  <style>
    .container { max-width: 1100px; margin: 30px auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background-color: rgba(0,95,115,0.08); }
    select, input[type="text"] { padding:6px; border-radius:4px; }
    .btn { padding:6px 10px; border-radius:6px; border:none; background:#005f73; color:white; cursor:pointer; }
    .btn-danger { background:#b00020; }
    .topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
    .back { background:#005f73; color:white; padding:6px 10px; border-radius:4px; text-decoration:none; }
  </style>
</head>
<body>
  <div class="form-box container">
    <div class="topbar">
      <h2>All Requests</h2>
      <a class="back" href="../html/admin_dashboard.html">Back</a>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Apartment</th>
            <th>User ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
            <th>Admin Remarks</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['req_id']); ?></td>
            <td><?php echo htmlspecialchars($row['apartment_id']); ?></td>
            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
            <td><?php echo htmlspecialchars($row['issue_type']); ?></td>
            <td><?php echo htmlspecialchars($row['issue_desc']); ?></td>
            <td><?php echo htmlspecialchars($row['req_date']); ?></td>
            <td>
              <form method="post" action="admin_update_request.php">
                <input type="hidden" name="req_id" value="<?php echo intval($row['req_id']); ?>">
                <select name="status">
                  <?php
                  $opts = ['Pending','In Progress','Work Completed'];
                  foreach ($opts as $o) {
                      $sel = ($o == $row['status']) ? 'selected' : '';
                      echo "<option value=\"$o\" $sel>$o</option>";
                  }
                  ?>
                </select>
            </td>
            <td><input type="text" name="admin_remarks" value="<?php echo htmlspecialchars($row['admin_remarks']); ?>"></td>
            <td>
                <button type="submit" class="btn">Update</button>
                </form>

                <form method="post" action="admin_delete_request.php" style="display:inline;margin-left:6px" onsubmit="return confirm('Delete this request?');">
                  <input type="hidden" name="req_id" value="<?php echo intval($row['req_id']); ?>">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No requests found.</p>
    <?php endif; ?>

  </div>
</body>
</html>
<?php $conn->close(); ?>
