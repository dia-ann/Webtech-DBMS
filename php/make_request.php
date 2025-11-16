<?php
    $conn = mysqli_connect("localhost", "root", "", "project25_db");
    if (!$conn) 
    {
        echo "Connection failed: " . mysqli_connect_error();
    }
    $resident_name = $_POST['residentName'];
    $apartment_id = $_POST['apartmentNumber'];
    $user_id = $_POST['user_id'];
    $issue_desc = $_POST['description'];
    $req_date = $_POST['preferredDate'];
    $st = "Pending";

    $maintenance_type = $_POST['maintenanceType'];
    if (isset($_POST['maintenanceType']))
    {
       $maintenance_type = implode(", ", $_POST['maintenanceType']);
    }


    $sql = "INSERT INTO request(user_name,apartment_id,user_id,maintenance_type,issue_desc,req_date,main_status) VALUES 
        ('$resident_name', '$apartment_id', '$user_id', '$maintenance_type', '$issue_desc', '$req_date','$st')";
    if (mysqli_query($conn, $sql)) 
    {
        echo "<script>
        alert('Request submitted successfully!');
        window.location.href='../html/resident_dashboard.html';
        </script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }

?>
