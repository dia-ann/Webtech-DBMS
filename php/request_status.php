<?php
  $conn = mysqli_connect("localhost", "root", "", "project25_db");

  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }
  $user_id = $_GET['uid'];
  $sql = "SELECT req_id, maintenance_type, issue_desc, req_date, main_status 
          FROM request
          WHERE user_id = '$user_id'
          ORDER BY req_id DESC";

  $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<head>
  <title>Request Status</title>
  <link rel="stylesheet" href="../css/form_style.css">

  <style>
    .form-box h1{ 
      text-align: center; 
      margin-bottom: 20px;
    }

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

  
    .status { 
        font-weight: bold;
        color: #003f4f;
    }
  </style>
</head>

<body>
  <div class="form-box">
    <h1>Request Status</h1>

    <p style="text-align:center; color:#005f73;">
      Below are your submitted maintenance requests and their current status.
    </p>
    <div style="text-align: right; margin-bottom: 10px;">
      <a href="../html/resident_dashboard.html">Back</a>
    </div>



    <table>
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Maintenance Type</th>
          <th>Description</th>
          <th>Date Submitted</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
      <?php
      if (mysqli_num_rows($result) > 0) 
        {
          while ($row = mysqli_fetch_array($result)) 
            {
              echo "<tr>
                      <td>{$row['req_id']}</td>
                      <td>{$row['maintenance_type']}</td>
                      <td>{$row['issue_desc']}</td>
                      <td>{$row['req_date']}</td>
                      <td>{$row['main_status']}</td>
                    </tr>";
          }
        } 
        else 
        {
          echo "<tr><td colspan='5'>No requests submitted yet.</td></tr>";
        }
      ?>
      </tbody>
    </table>
  </div>

  <div class="footer">
    2025 Apartment Maintenance System - All Rights Reserved.
  </div>
</body>
</html>

<?php 
  mysqli_close($conn); 
?>
