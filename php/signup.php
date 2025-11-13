<?php

    $conn = mysqli_connect("localhost", "root", "", "project25_db");
    if (!$conn) 
    {
        echo "Connection failed: " . mysqli_connect_error();
    }
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $apt_num = $_POST['num'];
    $user_role = $_POST['account_type'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO user_info(user_fname, user_lname, gender, email, phone, apartment_id, user_role, passwd) VALUES 
        ('$fname', '$lname', '$gender', '$email', '$phone', '$apt_num', '$user_role', '$password')";
    
    if (mysqli_query($conn, $sql)) 
    {
        echo "<h2>Registration Successful!</h2>";
        echo "<p>Welcome, $fname $lname</p>";
        echo "<p><b>Account Type:</b> $user_role</p>";
        echo "<p>Apartment Number: $apt_num</p>";
       
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>
