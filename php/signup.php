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
    $lang_known=$_POST['lan']
    
    $sql = "INSERT INTO user_info(user_fname, user_lname, gender, email, phone, apartment_id, user_role, lang, passwd) VALUES 
        ('$fname', '$lname', '$gender', '$email', '$phone', '$apt_num', '$user_role','$lang_known', '$password')";
    if (mysqli_query($conn, $sql)) 
    {
        echo "<h2>Registration Successful!</h2>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
    $sq2 = "SELECT * from user_info where user_fname='$fname'";
    $r2=(mysqli_query($conn,$sq2));
    if($r2)
    {
        $n=mysqli_num_rows($r2);
        if($n>0)
        {
            while($info=mysqli_fetch_array($r2))
            {
                echo "<br>User ID is ".$info['user_id'];
                echo "<br> Name is " .$info['usser_fname'];
                echo " " .$info['user_lname'];
                echo "<br> Gender is " .$info['gender'];
                echo "<br> Email is " .$info['email'];
                echo "<br> Role is " .$info['user_role'];
                echo "<br> Phone Number is " .$info['phone'];
                echo "<br> Apartment ID is " .$info['apartment_id'];
                echo "<br> Account created at " .$info['created_at'];
                echo "<br> Languages selected " .$info['lang'];
                echo "<br><br><br><br>";

            }
        }
    }
    else
    {
        echo "Query failed" .mysqli_error($conn);
    }

    mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html>
    <body>
        <button onclick="window.location.href='homepage.html'">Go to Homepage</button>
    </body>
</html>


