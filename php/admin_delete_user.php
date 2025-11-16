<?php
$conn = mysqli_connect("localhost", "root", "", "project25_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['user_id'])) 
{
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM user_info WHERE user_id = '$user_id'";

    if (mysqli_query($conn, $sql)) 
    {
        echo "<script>
                alert('User deleted successfully!');
                window.location.href = 'admin_users.php';
              </script>";
    } 
    else 
    {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
else 
{
    echo "No user selected to delete.";
}

mysqli_close($conn);
?>
