<?php
    $conn=mysqli_connect("localhost","root","","project25_db");
    if($conn)
        echo "Connected to database";
    else
    {
        echo "Connection failed";
        exit ();
    }
    //insert into table apartment
    $q1="INSERT INTO apartment(apt_id,apt_name,floor_no,flat_no,bhk_type, no_of_members,occupied) VALUES
                              (1,'Skyline',1,'S101','2BHK', 4,'yes')";
    $r1=mysqli_query($conn,$q1);
    if($r1)
        echo "<br>data inserted";
    else
    {
        echo "<br>data insertion unsuccessfull";
    }
    mysqli_close($conn);
?>
     