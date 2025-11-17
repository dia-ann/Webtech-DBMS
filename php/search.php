<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

if (!$conn) {
    echo "<h3>Connection failed</h3>";
    exit(1);
}

$id_apt = $_GET['apt_id']; 

$q1 = "SELECT * FROM apartment WHERE apt_id='$id_apt'";
$r1 = mysqli_query($conn, $q1);

if ($r1) 
{
    $n = mysqli_num_rows($r1);

    if ($n > 0) 
    {
        while ($info = mysqli_fetch_array($r1)) 
        {
            echo "<div style='
                background: #005f73;
                padding: 20px;
                margin: 30px auto;
                width: 60%;
                border-radius: 10px;
                font-size: 18px;
                line-height: 1.6;
                backdrop-filter: blur(4px);
                color: white;
            '>";

            echo "<h2>Apartment Details</h2>";

            echo "<p><strong>Apartment ID:</strong> " . $info['apt_id'] . "</p>";
            echo "<p><strong>Floor Number:</strong> " . $info['floor_no'] . "</p>";
            echo "<p><strong>Flat Number:</strong> " . $info['flat_no'] . "</p>";
            echo "<p><strong>BHK Type:</strong> " . $info['bhk_type'] . "</p>";
            echo "<p><strong>Number of Members:</strong> " . $info['no_of_members'] . "</p>";
            echo "<p><strong>Occupied:</strong> " . $info['occupied'] . "</p>";

            echo "</div>";
        }
    }
    else 
    {
        echo "<h3>Apartment with this ID does not exist</h3>";
    }
}
else 
{
    echo "<h3>Failed to execute search query</h3>";
}

mysqli_close($conn);
?>
