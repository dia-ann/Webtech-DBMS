<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM request ORDER BY req_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - All Requests</title>
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
        .btn {
            padding: 6px 10px;
            cursor: pointer;
        }
        .back-link {
            text-decoration: none;
            padding: 6px 12px;
            background-color: #005f73;
            color: white;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<div class="form-box">

    <h2 style="text-align:center;">All Requests</h2>

    <p style="text-align:right;">
        <a class="back-link" href="../html/admin_dashboard.html">Back</a>
    </p>

    <table>
        <tr>
            <th>Request ID</th>
            <th>User Name</th>
            <th>Apartment</th>
            <th>User ID</th>
            <th>Maintenance Type</th>
            <th>Description</th>
            <th>Date Submitted</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

    <?php
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";
            echo "<td>{$row['req_id']}</td>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td>{$row['apartment_id']}</td>";
            echo "<td>{$row['user_id']}</td>";
            echo "<td>{$row['maintenance_type']}</td>";
            echo "<td>{$row['issue_desc']}</td>";
            echo "<td>{$row['req_date']}</td>";

            echo "<td>
                    <form action='admin_update_request.php' method='POST'>
                        <input type='hidden' name='req_id' value='{$row['req_id']}'>
                        <select name='main_status'>
                            <option ".($row['main_status']=="Pending" ? "selected" : "").">Pending</option>
                            <option ".($row['main_status']=="In Progress" ? "selected" : "").">In Progress</option>
                            <option ".($row['main_status']=="Completed" ? "selected" : "").">Completed</option>
                        </select>
                  </td>";

            echo "<td>
                    <button type='submit' class='btn'>Update</button>
                    </form>

                    <form action='admin_delete_request.php' method='POST'
                          onsubmit=\"return confirm('Delete this request?');\">
                        <input type='hidden' name='req_id' value='{$row['req_id']}'>
                        <button type='submit' class='btn'>Delete</button>
                    </form>
                  </td>";

            echo "</tr>";
        }

    } else {
        echo "<tr><td colspan='10'>No requests found.</td></tr>";
    }
    ?>
    </table>

</div>

</body>
</html>

<?php mysqli_close($conn); ?>
