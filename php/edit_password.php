<?php

    $conn = mysqli_connect("localhost", "root", "", "project25_db");

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }


    $user_id = $_GET['user_id'];
    $new_pass = $_GET['passwd'];


    $update = "UPDATE user_info SET passwd='$new_pass' WHERE user_id='$user_id'";

    if (mysqli_query($conn, $update)) 
    {
        echo "<h2>Password Updated Successfully!</h2>";
    }
    else
    {
        echo "Error updating record: " . mysqli_error($conn);
        exit;
    }


    $query = "SELECT * FROM user_info WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) 
    {

        $info = mysqli_fetch_array($result);

        echo "<h3>User Details After Update:</h3>";

        echo "<p><b>User ID:</b> " . $info['user_id'] . "</p>";
        echo "<p><b>Name:</b> " . $info['user_fname'] . " " . $info['user_lname'] . "</p>";
        echo "<p><b>Gender:</b> " . $info['gender'] . "</p>";
        echo "<p><b>Email:</b> " . $info['email'] . "</p>";
        echo "<p><b>Role:</b> " . $info['user_role'] . "</p>";
        echo "<p><b>Phone Number:</b> " . $info['phone'] . "</p>";
        echo "<p><b>Password:</b> " . $info['passwd'] . "</p>";
        echo "<p><b>Apartment ID:</b> " . $info['apartment_id'] . "</p>";
        echo "<p><b>Languages:</b> " . $info['lang'] . "</p>";
        echo "<p><b>Created At:</b> " . $info['created_at'] . "</p>";
    }
    else 
    {
        echo "<p>User not found!</p>";
    }

    mysqli_close($conn);
?>

    <br><br>
    <button onclick="window.location.href='../html/resident_dashboard.html'">
        Back to Dashboard
    </button>
