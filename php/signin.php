<?php
    $conn = mysqli_connect("localhost", "root", "", "project25_db");
    if (!$conn) 
    {
        echo "Connection failed: " .mysqli_connect_error();
    }
    $em=$_POST['email'];
    $psw=$_POST['password'];
    $sql="SELECT * FROM user_info WHERE email='$em' AND passwd='$psw'";
    $result=mysqli_query($conn,$sql);
    if ($result) 
    {
        $n = mysqli_num_rows($result);

        if ($n > 0) 
        {
            $row = mysqli_fetch_array($result);
            $role = $row['user_role'];

            echo "<h3>Login Successful!</h3>";

        
            if ($role == 'Resident')
            {
                echo "<script>alert('Welcome Resident!'); window.location.href='../html/resident_dashboard.html';</script>";
            } 
            elseif ($role == 'Admin')
            {
                echo "<script>alert('Welcome Admin!'); window.location.href='../html/admin_dashboard.html';</script>";
            } 
            else
            {
                echo "<script>alert('Unknown role. Please contact admin.');</script>";
            }
        } 
        else 
        {
            echo "<script>alert('Invalid Email or Password!'); window.location.href='../html/signin.html';</script>";
        }
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>