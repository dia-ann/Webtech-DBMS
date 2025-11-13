<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Request Status</title>
  <link rel="stylesheet" href="../css/form_style.css">
  <style>
    .status-pending { color: #ff8c00; font-weight: bold; }
    .status-inprogress { color: #1e90ff; font-weight: bold; }
    .status-completed { color: #2e8b57; font-weight: bold; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: rgba(0,95,115,0.1); }
  </style>
</head>
<body>
  <div class="form-box">
    <h1>Request Status</h1>

    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<p>Please <a href="signin.html">sign in</a> to view your requests.</p>';
    } else {
        $user_id = intval($_SESSION['user_id']);

        $conn = new mysqli("localhost", "root", "", "project25_db");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT req_id, apartment_id, issue_type, issue_desc, status, req_date, admin_remarks FROM request WHERE user_id = $user_id ORDER BY req_id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table>\n<thead>\n<tr>\n<th>Request ID</th><th>Apartment</th><th>Issue Type</th><th>Description</th><th>Date Submitted</th><th>Status</th><th>Admin Remarks</th>\n</tr>\n</thead>\n<tbody>\n";

            while ($row = $result->fetch_assoc()) {
                $status = $row['status'];
                $class = 'status-pending';
                if (strtolower($status) === 'in progress' || strtolower($status) === 'inprogress') $class = 'status-inprogress';
                if (strtolower($status) === 'completed' || strtolower($status) === 'work completed') $class = 'status-completed';

                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['req_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['apartment_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['issue_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['issue_desc']) . "</td>";
                echo "<td>" . htmlspecialchars($row['req_date']) . "</td>";
                echo "<td class='" . $class . "'>" . htmlspecialchars($status) . "</td>";
                echo "<td>" . htmlspecialchars($row['admin_remarks']) . "</td>";
                echo "</tr>\n";
            }

            echo "</tbody></table>";
        } else {
            echo '<p>No requests found.</p>';
        }

        $conn->close();
    }
    ?>

  </div>

  <div class="footer">2025 Apartment Maintenance System - All Rights Reserved.</div>
</body>
</html>
