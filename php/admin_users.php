<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT user_id, user_fname, user_lname, email, phone, apartment_id, user_role 
        FROM user_info ORDER BY user_id ASC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
    <link rel="stylesheet" href="../css/form_style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #94d2bd;
            color: #003f4f;
        }
        .delete-btn {
            background: #b00020;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            background: #005f73;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<div class="form-box">
    <a href="../html/admin_dashboard.html" class="back-btn">Back</a>
    <h1>Registered Users</h1>

    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Apartment</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) 
        {
            while ($row = mysqli_fetch_array($result)) 
            {
                echo "<tr>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['user_fname']} {$row['user_lname']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['apartment_id']}</td>";
                echo "<td>{$row['user_role']}</td>";

                echo "<td><a href='admin_delete_user.php?user_id={$row['user_id']}'>Delete</a></td>";

                echo "</tr>";
            }
        }
        else
        {
            echo "<tr><td colspan='7'>No users found.</td></tr>";
        }
        ?>
    </table>
</div>

<div class="footer">
    2025 Apartment Maintenance System — All Rights Reserved
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
