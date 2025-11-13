<!DOCTYPE html>
<html lang="en">
<head>
  <title>Request Status</title>
  <link rel="stylesheet" href="../css/form_style.css">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }
    th {
      background-color: #94d2bd;
      color: #003f4f;
    }
    tr:nth-child(even) {
      background-color: #f1f1f1;
    }
    .status-pending { color: #bb3e03; font-weight: bold; }
    .status-progress { color: #ca6702; font-weight: bold; }
    .status-completed { color: green; font-weight: bold; }
  </style>
</head>
<body>
  <div class="form-box">
    <h1>Request Status</h1>
    <p style="text-align:center; color:#005f73;">
      Below are your submitted maintenance requests and their current status.
    </p>

    <table>
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Apartment Number</th>
          <th>Issue Type</th>
          <th>Description</th>
          <th>Date Submitted</th>
          <th>Status</th>
          <th>Admin Remarks</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $conn = new mysqli("localhost", "root", "", "project25_db");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM request ORDER BY req_id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $statusClass = "";
            if ($row['status'] == 'Pending') $statusClass = "status-pending";
            elseif ($row['status'] == 'In Progress') $statusClass = "status-progress";
            elseif ($row['status'] == 'Completed') $statusClass = "status-completed";

            echo "<tr>
                    <td>".$row['req_id']."</td>
                    <td>".$row['apartment_id']."</td>
                    <td>".$row['issue_type']."</td>
                    <td>".$row['issue_desc']."</td>
                    <td>".$row['req_date']."</td>
                    <td class='$statusClass'>".$row['status']."</td>
                    <td>".$row['admin_remarks']."</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No requests found</td></tr>";
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>

  <div class="footer">
    2025 Apartment Maintenance System - All Rights Reserved.
  </div>
</body>
</html>
